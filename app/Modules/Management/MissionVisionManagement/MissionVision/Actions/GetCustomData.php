<?php

namespace App\Modules\Management\MissionVisionManagement\MissionVision\Actions;

class GetCustomData
{
    static $model = \App\Modules\Management\MissionVisionManagement\MissionVision\Models\Model::class;

    public static function execute()
    {
        try {
            $vision = self::$model::query()->active()->where('page_type','vision')->latest()->first();
            $mission = self::$model::query()->active()->where('page_type','mission')->latest()->first();
            $future_plan = self::$model::query()->active()->where('page_type','future_plan')->latest()->first();
            $data = [
                'vision' => $vision,
                'mission' => $mission,
                'future_plan' => $future_plan
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
