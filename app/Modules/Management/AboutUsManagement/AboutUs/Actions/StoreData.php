<?php

namespace App\Modules\Management\AboutUsManagement\AboutUs\Actions;

class StoreData
{
    static $model = \App\Modules\Management\AboutUsManagement\AboutUs\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();
            // Process file uploads for specific fields
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $requestData['image'] = uploader($file, 'uploads/AboutUsManagement/AboutUs');
            }
          
            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}