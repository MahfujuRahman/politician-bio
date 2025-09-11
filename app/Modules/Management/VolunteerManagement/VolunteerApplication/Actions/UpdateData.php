<?php

namespace App\Modules\Management\VolunteerManagement\VolunteerApplication\Actions;

class UpdateData
{
    static $model = \App\Modules\Management\VolunteerManagement\VolunteerApplication\Models\Model::class;

    public static function execute($request,$slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
            $requestData = $request->validated();

            // Extract selected_prerequisites
            $selectedPrerequisites = $request->input('selected_prerequisites') ?? [];
            unset($requestData['selected_prerequisites']);

            $data->update($requestData);

            // Delete existing VolunteerPreRequisiteApplication records
            \App\Modules\Management\VolunteerManagement\VolunteerPreRequisite\Models\VolunteerPreRequisiteApplicationModel::where('volunteer_application_id', $data->id)->ForceDelete();

            // Create new records
            foreach ($selectedPrerequisites as $prereqId => $optionIds) {
                foreach ($optionIds as $optionId) {
                    \App\Modules\Management\VolunteerManagement\VolunteerPreRequisite\Models\VolunteerPreRequisiteApplicationModel::create([
                        'volunteer_application_id' => $data->id,
                        'prerequisite_id' => (int)$prereqId,
                        'prerequisite_option_id' => (int)$optionId,
                        'status' => 'active'
                    ]);
                }
            }

            return messageResponse('Item updated successfully',$data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}