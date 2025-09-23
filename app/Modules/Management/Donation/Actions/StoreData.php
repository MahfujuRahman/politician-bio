<?php

namespace App\Modules\Management\Donation\Actions;

class StoreData
{
    static $model = \App\Modules\Management\Donation\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();

            if ($requestData['payment_method'] == 'sslcommerze') {
                return redirect()->route(
                    'payment.order',
                    [
                        'amount' => $requestData['amount'],
                        'customer_name' => $requestData['first_name'] . ' ' . $requestData['last_name'],
                        'customer_email' => $requestData['email'],
                        'donation_details_slug' => $request->donation_details_slug,
                        'requestData' => $requestData,
                    ]
                );
            } else {
                if ($data = self::$model::query()->create($requestData)) {
                    return messageResponse('Item added successfully', $data, 201);
                }
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
