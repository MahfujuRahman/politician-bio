<?php

namespace App\Modules\Management\HistoryTimelineManagement\HistoryTimeline\Actions;

class GetCustomData
{
    static $model = \App\Modules\Management\HistoryTimelineManagement\HistoryTimeline\Models\Model::class;

    public static function execute()
    {
        try {
            $data = self::$model::query()
                ->active()
                ->orderBy('month_year', 'desc')
                ->orderBy('id', 'desc')
                ->take(8)
                ->get();
            if (!$data) {
                return messageResponse('No data found', null, 404, 'error');
            }
            return response()->json($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
