<?php

namespace App\Modules\Management\BannerManagement\Banner\Actions;

class StoreData
{
    static $model = \App\Modules\Management\BannerManagement\Banner\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();
            dd($requestData);
            // Process file uploads for specific fields
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $requestData['image'] = uploader($file, 'uploads/BannerManagement/Banner');
            }
            if ($request->hasFile('background_image')) {
                $file = $request->file('background_image');
                $requestData['background_image'] = uploader($file, 'uploads/BannerManagement/Banner');
            }

            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}