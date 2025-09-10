<?php

namespace App\Modules\Management\NewsManagement\News\Actions;

class GetAllData
{
    static $model = \App\Modules\Management\NewsManagement\News\Models\Model::class;

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

            $with = ['news_category_id'];

            $condition = [];

            $data = self::$model::query();

            if (request()->has('search') && request()->input('search')) {
                $searchKey = request()->input('search');
                $data = $data->where(function ($q) use ($searchKey) {
                    $q->orWhere('title', 'like', '%' . $searchKey . '%');

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

            if (request()->has('get_unique_tags') && (int) request()->input('get_unique_tags') === 1) {
                $tags = self::$model::where('status', 'active')
                    ->whereNotNull('tags')
                    ->where('tags', '!=', '')
                    ->pluck('tags')
                    ->flatMap(function ($tag) {
                        return explode(',', $tag);
                    })
                    ->map(function ($tag) {
                        return trim($tag);
                    })
                    ->filter(function ($tag) {
                        return !empty($tag);
                    })
                    ->unique()
                    ->values();

                return entityResponse($tags);
            }

            if (request()->has('get_categories') && (int) request()->input('get_categories') === 1) {
                $categories = \App\Modules\Management\NewsManagement\NewsCategory\Models\Model::active()
                    ->select('id', 'title', 'slug')
                    ->withCount([
                        'news' => function ($q) {
                            $q->where('status', 'active');
                        }
                    ])
                    ->orderBy('title', 'asc')
                    ->get();

                return entityResponse($categories);
            }

            if (request()->has('get_recent') && (int) request()->input('get_recent') === 1) {
                $recentLimit = request()->input('recent_limit') ?? 5;
                $recentNews = self::$model::where('status', 'active')
                    ->whereNotNull('date')
                    ->orderBy('date', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->limit($recentLimit)
                    ->with($with)
                    ->get();

                return entityResponse($recentNews);
            }

            if (request()->has('get_latest') && (int) request()->input('get_latest') === 1) {
                $latestLimit = request()->input('latest_limit') ?? 5;
                $latestNews = self::$model::where('status', 'active')
                    ->whereNotNull('date')
                    ->orderBy('date', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->limit($latestLimit)
                    ->with($with)
                    ->get();

                return entityResponse($latestNews);
            }

            if (request()->has('get_prev_next') && (int) request()->input('get_prev_next') === 1) {
                $currentId = request()->input('current_id');
                $currentNews = self::$model::find($currentId);

                $prevNext = [
                    'prev_news' => null,
                    'next_news' => null,
                ];

                if ($currentNews) {
                    // Get previous news (older)
                    $prevNews = self::$model::where('status', 'active')
                        ->where('id', '<', $currentId)
                        ->orderBy('id', 'desc')
                        ->select('id', 'title', 'slug')
                        ->first();

                    // Get next news (newer)
                    $nextNews = self::$model::where('status', 'active')
                        ->where('id', '>', $currentId)
                        ->orderBy('id', 'asc')
                        ->select('id', 'title', 'slug')
                        ->first();

                    $prevNext = [
                        'prev_news' => $prevNews,
                        'next_news' => $nextNews,
                    ];
                }

                return entityResponse($prevNext);
            }

            if (request()->has('tag_name') && request()->input('tag_name')) {
                $tag_name = request()->input('tag_name');
                $data = $data->where('tags', 'like', '%' . $tag_name . '%');
            }

            if (request()->has('category_id') && request()->input('category_id')) {
                $category_id = request()->input('category_id');
                $data = $data->where('news_category_id', $category_id);
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
            } else if ($status == 'trased') {
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

            return entityResponse([
                ...$data->toArray(),
                "active_data_count"   => self::$model::active()->count(),
                "inactive_data_count" => self::$model::inactive()->count(),
                "trased_data_count"   => self::$model::trased()->count(),
            ]);

        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}