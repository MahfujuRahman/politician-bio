<?php

namespace App\Modules\Management\PublicCommentManagement\PublicComment\Actions;

class StoreData
{
    static $model = \App\Modules\Management\PublicCommentManagement\PublicComment\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();

            // Process file uploads for specific fields
                            if ($request->hasFile('commenter_image')) {
                    $file = $request->file('commenter_image');
                    $requestData['commenter_image'] = uploader($file, 'uploads/PublicCommentManagement/PublicComment');
                }
          
            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}