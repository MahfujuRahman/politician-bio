<?php

namespace App\Modules\Management\VolunteerManagement\VolunteerApplication\Actions;

class StoreData
{
    static $model = \App\Modules\Management\VolunteerManagement\VolunteerApplication\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();

            // Process selected_prerequisites into prerequisite JSON
            if (isset($requestData['selected_prerequisites'])) {
                $prerequisites = [];
                $id = 1;
                foreach ($requestData['selected_prerequisites'] as $title => $options) {
                    $prerequisites[] = [
                        'id' => $id++,
                        'title' => $title,
                        'options' => $options
                    ];
                }
                $requestData['prerequisite'] = json_encode($prerequisites);
                unset($requestData['selected_prerequisites']);
            }

            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}