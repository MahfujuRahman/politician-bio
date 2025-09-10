<?php

namespace App\Modules\Management\BannerManagement\Banner\Actions;

class GetAllData
{
    public static $model = \App\Modules\Management\BannerManagement\Banner\Models\Model::class;

    public static function execute()
    {
        try {
            $pageLimit = (int) (request()->input('limit') ?? 10);
            $orderByColumn = request()->input('sort_by_col') ?? 'id';
            $orderByType = request()->input('sort_type') ?? 'desc';
            $status = request()->input('status') ?? 'active';
            $fields = request()->input('fields') ?? '*';
            $start_date = request()->input('start_date');
            $end_date = request()->input('end_date');
            // dd($pageLimit);
            $with = [];

            $condition = [

            ];

            $data = self::$model::query();

            if (request()->has('search') && request()->input('search')) {
                $searchKey = request()->input('search');
                $data = $data->where(function ($q) use ($searchKey) {
                    $q->where('slogan', 'like', '%' . $searchKey . '%');

                    $q->orWhere('election_type', 'like', '%' . $searchKey . '%');

                    $q->orWhere('main_title', 'like', '%' . $searchKey . '%');

                    $q->orWhere('short_title', 'like', '%' . $searchKey . '%');

                    $q->orWhere('description', 'like', '%' . $searchKey . '%');

                    $q->orWhere('perma_link', 'like', '%' . $searchKey . '%');

                    $q->orWhere('image', 'like', '%' . $searchKey . '%');

                    $q->orWhere('background_image', 'like', '%' . $searchKey . '%');
                });
            }

            if ($start_date && $end_date) {
                if ($end_date > $start_date) {
                    $data->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']);
                } elseif ($end_date == $start_date) {
                    $data->whereDate('created_at', $start_date);
                }
            }

            if ('trased' == $status) {
                $data = $data->trased();
            }

            if (request()->has('get_all') && 1 === (int) request()->input('get_all')) {
                $data = $data
                    ->with($with)
                    ->select($fields)
                    ->where($condition)
                    ->where('status', $status)
                    ->limit($pageLimit)
                    ->orderBy($orderByColumn, $orderByType)
                    ->get();
                    dd($data->toArray());
                return entityResponse($data);
            } elseif ('trased' == $status) {
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
                    ->paginate($pageLimit );
            }
            // dd($data->toArray());
            return entityResponse([
                ...$data->toArray(),
                'active_data_count' => self::$model::active()->count(),
                'inactive_data_count' => self::$model::inactive()->count(),
                'trased_data_count' => self::$model::trased()->count(),
            ]);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
