<?php

namespace App\Modules\Management\HistoryTimelineManagement\HistoryTimeline\Actions;

class GetAllData
{
    public static $model = \App\Modules\Management\HistoryTimelineManagement\HistoryTimeline\Models\Model::class;

    public static function execute()
    {
        try {
            $pageLimit = request()->input('limit') ?? 10;
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'desc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? '*';
            $start_date = request()->input('start_date');
            $end_date = request()->input('end_date');

            $with = [];

            $condition = [];

            $data = self::$model::query();

            // Default order by month_year to get latest data first
            if (!request()->has('sort_by_col')) {
                $orderByColumn = 'month_year';
                $orderByType = 'desc';
            }

            if (request()->has('month_year') && request()->input('month_year')) {
                $condition['month_year'] = request()->input('month_year');
            }

            // If no specific month_year is requested, get latest entries based on month_year field
            if (request()->has('latest_by_month') && request()->input('latest_by_month')) {
                $data = $data->orderBy('month_year', 'desc')
                    ->limit(8);
            }


            if (request()->has('search') && request()->input('search')) {
                $searchKey = request()->input('search');
                $data = $data->where(function ($q) use ($searchKey) {
                    $q->where('month_year', 'like', '%' . $searchKey . '%');
                    $q->orWhere('title', 'like', '%' . $searchKey . '%');
                    $q->orWhere('description', 'like', '%' . $searchKey . '%');
                    $q->orWhere('image', 'like', '%' . $searchKey . '%');

                });
            }

            if ($start_date && $end_date) {
                if ($end_date > $start_date) {
                    $data->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']);
                } elseif ($end_date == $start_date) {
                    $data->whereDate('created_at', $start_date);
                }
            }

            if ($status == 'trased') {
                $data = $data->trased();
            }

            if (request()->has('get_all') && (int) request()->input('get_all') === 1) {
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->limit($pageLimit)
                    ->orderBy($orderByColumn, $orderByType)
                    ->get();
                return entityResponse($data);
            } elseif ($status == 'trased') {
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->orderBy($orderByColumn, $orderByType)
                    ->paginate($pageLimit);
            } else {
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->orderBy($orderByColumn, $orderByType)
                    ->paginate($pageLimit);
            }
            // dd($data);
            return entityResponse([
                ...$data->toArray(),
                'active_data_count'   => self::$model::active()->count(),
                'inactive_data_count' => self::$model::inactive()->count(),
                'trased_data_count'   => self::$model::trased()->count(),
            ]);

        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}