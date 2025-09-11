<?php

namespace App\Modules\Management\VolunteerManagement\VolunteerPreRequisite\Actions;

use  \App\Modules\Management\VolunteerManagement\VolunteerPreRequisite\Models\VolunteerPreRequisiteOptionModel;
use  \App\Modules\Management\VolunteerManagement\VolunteerPreRequisite\Models\VolunteerPreRequisiteApplicationModel;

class UpdateData
{
    static $model = \App\Modules\Management\VolunteerManagement\VolunteerPreRequisite\Models\Model::class;

    public static function execute($request, $slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...', $data, 404, 'error');
            }
            $requestData = $request->validated();
            $optionsJson = $requestData['options'] ?? '[]';
            $options = json_decode($optionsJson, true);
            unset($requestData['options']);

            $data->update($requestData);

            // Get existing options
            $existingOptions = VolunteerPreRequisiteOptionModel::where('prerequisite_id', $data->id)->get();

            // Collect IDs from new options
            $newOptionIds = [];
            foreach ($options as $option) {
                if (!empty($option['id'])) {
                    // Update existing
                    $existing = $existingOptions->find($option['id']);
                    if ($existing) {
                        $existing->update(['title' => $option['title'], 'status' => 'active']);
                        $newOptionIds[] = $option['id'];
                    }
                } else {
                    // Create new
                    $newOption = \App\Modules\Management\VolunteerManagement\VolunteerPreRequisite\Models\VolunteerPreRequisiteOptionModel::create([
                        'title' => $option['title'],
                        'prerequisite_id' => $data->id,
                        'status' => 'active'
                    ]);
                    $newOptionIds[] = $newOption->id;
                }
            }

            // Delete existing options not in new list
            VolunteerPreRequisiteOptionModel::where('prerequisite_id', $data->id)
                ->whereNotIn('id', $newOptionIds)->forceDelete();

            VolunteerPreRequisiteApplicationModel::where('prerequisite_id', $data->id)
                ->whereNotIn('prerequisite_option_id', $newOptionIds)->forceDelete();

            return messageResponse('Item updated successfully', $data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
