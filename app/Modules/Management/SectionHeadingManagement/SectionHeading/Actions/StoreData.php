<?php

namespace App\Modules\Management\SectionHeadingManagement\SectionHeading\Actions;

class StoreData
{
    static $model = \App\Modules\Management\SectionHeadingManagement\SectionHeading\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $requestData['image'] = uploader($file, 'uploads/SectionHeadingManagement/SectionHeading');
            }
            if ($request->hasFile('background_image')) {
                $file = $request->file('background_image');
                $requestData['background_image'] = uploader($file, 'uploads/SectionHeadingManagement/SectionHeading');
            }
            if ($request->hasFile('primary_image')) {
                $file = $request->file('primary_image');
                $requestData['primary_image'] = uploader($file, 'uploads/SectionHeadingManagement/SectionHeading');
            }
            if ($request->hasFile('side_image')) {
                $file = $request->file('side_image');
                $requestData['side_image'] = uploader($file, 'uploads/SectionHeadingManagement/SectionHeading');
            }

            $data = self::$model::query()->updateOrCreate(
                ['section_type' => $requestData['section_type']],
                $requestData
            );

            if ($data->wasRecentlyCreated) {
                return messageResponse('Item added successfully', $data, 201);
            } else {
                return messageResponse('Item updated successfully', $data, 200);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}