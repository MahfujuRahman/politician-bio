<?php

namespace App\Modules\Management\EventManagement\Event\Actions;

class UpdateData
{
    static $model = \App\Modules\Management\EventManagement\Event\Models\Model::class;

    public static function execute($request,$slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            $requestData = $request->validated();
            
            // Process file uploads for specific fields
            if ($request->hasFile('banner_image')) {
                $file = $request->file('banner_image');
                $requestData['banner_image'] = uploader($file, 'uploads/EventManagement/Event');
            }

            $data->update($requestData);
            return messageResponse('Item updated successfully',$data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}