<?php

namespace App\Modules\Management\BannerManagement\Banner\Actions;

class GetCustomData
{
    static $model = \App\Modules\Management\BannerManagement\Banner\Models\Model::class;

    public static function execute()
    {
        try {
            $data = self::$model::query()->active()->latest()->first();
            if (!$data) {
                return messageResponse('No data found', null, 404, 'error');
            }
            return response()->json($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
