<?php

namespace App\Modules\Management\ContactUsManagement\ContactPeople\Actions;

class StoreData
{
    static $model = \App\Modules\Management\ContactUsManagement\ContactPeople\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();

            // Build a friendly, optionally personalized message for Contact Us submissions
            $name = $requestData['first_name'] ?? null;
            $messageText = $name
                ? "Thank you, {$name}! We’ve received your message and truly appreciate you reaching out to us."
                : "Thank you for contacting us! We’ve received your message and truly appreciate you reaching out.";

            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse($messageText, $data, 201);
            }

            return messageResponse('Unable to save contact message', [], 400, 'error');
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}