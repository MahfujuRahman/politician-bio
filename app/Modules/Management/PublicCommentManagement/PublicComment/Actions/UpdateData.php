<?php

namespace App\Modules\Management\PublicCommentManagement\PublicComment\Actions;

class UpdateData
{
    static $model = \App\Modules\Management\PublicCommentManagement\PublicComment\Models\Model::class;

    public static function execute($request,$slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            $requestData = $request->validated();

             // Process file uploads for specific fields
                            if ($request->hasFile('commenter_image')) {
                    $file = $request->file('commenter_image');
                    $requestData['commenter_image'] = uploader($file, 'uploads/PublicCommentManagement/PublicComment');
                }
  
            $data->update($requestData);
            return messageResponse('Item updated successfully',$data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}