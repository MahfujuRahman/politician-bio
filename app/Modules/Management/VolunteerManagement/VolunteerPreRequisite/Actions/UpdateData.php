<?php

namespace App\Modules\Management\VolunteerManagement\VolunteerPreRequisite\Actions;

class UpdateData
{
    static $model = \App\Modules\Management\VolunteerManagement\VolunteerPreRequisite\Models\Model::class;

    public static function execute($request,$slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            $requestData = $request->validated();
            $options = $requestData['options'] ?? [];
            unset($requestData['options']);

            $data->update($requestData);

            // Delete existing options
            \App\Modules\Management\VolunteerManagement\VolunteerPreRequisite\Models\VolunteerPreRequisiteOptionModel::where('prerequisite_id', $data->id)->forceDelete();

            // Create new options
            foreach ($options as $option) {
                \App\Modules\Management\VolunteerManagement\VolunteerPreRequisite\Models\VolunteerPreRequisiteOptionModel::create([
                    'title' => $option,
                    'prerequisite_id' => $data->id,
                    'status' => 'active'
                ]);
            }

            return messageResponse('Item updated successfully',$data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}