<?php

namespace App\Modules\Management\PollManagement\Poll\Actions;

use Illuminate\Support\Facades\Log;

class UpdateData
{
    static $model = \App\Modules\Management\PollManagement\Poll\Models\Model::class;

    public static function execute($request, $slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...', $data, 404, 'error');
            }

            $requestData = $request->validated();

            // Process file uploads for specific fields
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $requestData['image'] = uploader($file, 'uploads/PollManagement/Poll');
            }

            if (isset($requestData['is_voting'])) {
                if ($requestData['is_voting']) {
                    self::$model::query()->where('is_voting', '1')->update(['is_voting' => '0']);
                    $requestData['is_voting'] = '1';
                } else {
                    $requestData['is_voting'] = '0';
                }
            }

            // explicit assign and save to ensure column is written
            $data->update($requestData);

            return messageResponse('Item updated successfully', $data, 201);
        } catch (\Exception $e) {
            Log::error('UpdateData - Exception:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}