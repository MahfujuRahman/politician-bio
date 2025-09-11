<?php

namespace App\Modules\Management\VolunteerManagement\VolunteerPreRequisite\Actions;

class StoreData
{
    static $model = \App\Modules\Management\VolunteerManagement\VolunteerPreRequisite\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();
            $options = $requestData['options'];
            unset($requestData['options']);

            if ($data = self::$model::query()->create($requestData)) {
                // Create options
                foreach ($options as $option) {
                    \App\Modules\Management\VolunteerManagement\VolunteerPreRequisite\Models\VolunteerPreRequisiteOptionModel::create([
                        'title' => $option,
                        'prerequisite_id' => $data->id,
                        'status' => 'active'
                    ]);
                }
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}