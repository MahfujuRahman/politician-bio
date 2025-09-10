<?php

namespace App\Modules\Management\BannerManagement\Banner\Actions;

class UpdateData
{
    static $model = \App\Modules\Management\BannerManagement\Banner\Models\Model::class;

    public static function execute($request,$slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            $requestData = $request->validated();

             // Process file uploads for specific fields
                            if ($request->hasFile('image')) {
                    $file = $request->file('image');
                    $requestData['image'] = uploader($file, 'uploads/BannerManagement/Banner');
                }
                if ($request->hasFile('background_image')) {
                    $file = $request->file('background_image');
                    $requestData['background_image'] = uploader($file, 'uploads/BannerManagement/Banner');
                }
  
            $data->update($requestData);
            return messageResponse('Item updated successfully',$data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}