<?php

namespace App\Modules\Management\NewsManagement\News\Actions;

class GetCustomData
{
    static $model = \App\Modules\Management\NewsManagement\News\Models\Model::class;

    public static function execute()
    {
        try {
            $lead_news = self::$model::query()->with('news_category_id')->active()->latest()->take(8)->orderBy('id','desc')->get();
            $side_news = self::$model::query()->with('news_category_id')->active()->latest()->take(8)->orderBy('id','desc')->get();
            $data = [
                'lead_news' => $lead_news,
                'side_news' => $side_news,
            ];
            if (!$data) {
                return messageResponse('No data found', null, 404, 'error');
            }
            return response()->json($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
