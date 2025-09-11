<?php

namespace App\Modules\Management\VolunteerManagement\VolunteerApplication\Actions;

class StoreData
{
    static $model = \App\Modules\Management\VolunteerManagement\VolunteerApplication\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();

                        // Extract selected_prerequisites
            $selectedPrerequisites = $request->input('selected_prerequisites') ?? [];
            unset($requestData['selected_prerequisites']);

            if ($data = self::$model::query()->create($requestData)) {
                // Create VolunteerPreRequisiteApplication records
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
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
