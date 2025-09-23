<?php

namespace App\Http\Controllers\Payment;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Gateways\SSLCommerz\SSLCommerz;

class PaymentController extends Controller
{
    static $model = \App\Modules\Management\Donation\Models\Model::class;

    public function order()
    {

        $requestData = request()->input('requestData');

        // Generate a unique transaction ID
        $trxId = time() . Str::random(5);

        // Get donation slug if available
        $donationSlug = request()->input('donation_details_slug', '');

        // Store requestData in cache with trx_id as key (expires in 2 hours)
        cache()->put('payment_data_' . $trxId, $requestData, now()->addHours(1));

        $sslc = new SSLCommerz();
        $sslc->amount(request()->input('amount'))
            ->trxid($trxId) // Use our generated trx_id
            ->product('Products From TechPark Politicians')
            ->customer(request()->input('customer_name'), request()->input('customer_email'))
            ->setExtras($donationSlug); // Only pass slug in value_a

        return $sslc->make_payment();
    }


    public function success(Request $request)
    {
        $trx_id = $request->tran_id;
        $subtotal = $request->store_amount ?? 0;
        $total = $request->amount ?? 0;
        $donation_details_slug = $request->value_a;

        // Retrieve requestData from cache using transaction ID
        $requestData = cache()->get('payment_data_' . $trx_id);

        $validate = SSLCommerz::validate_payment($request);

        if ($validate) {
            try {
                DB::beginTransaction();

                $bankID = $request->bank_tran_id;

                $requestData['is_paid'] = 'yes';
                $requestData['trx_id'] = $trx_id;

                $data = self::$model::query()->create($requestData);

                // Insert into orders
                $orderId = DB::table('orders')->insertGetId([
                    'order_no'       => time() . rand(100, 999),
                    'user_id'        => $data->id, // Use the ID from the created donation record
                    'order_date'     => now(),
                    'payment_method' => 1, // sslcommerz
                    'payment_status' => 1, // paid
                    'trx_id'         => $trx_id,
                    'sub_total'      => $subtotal,
                    'total'          => $total,
                    'slug'           => Str::slug(Str::random(6))
                ]);

                // Insert into order_payments
                DB::table('order_payments')->insert([
                    'order_id'           => $orderId,
                    'payment_through'    => "sslcommerz",
                    'tran_id'            => $request->tran_id,
                    'bank_tran_id'       => $bankID,
                    'val_id'             => $request->val_id,
                    'amount'             => $request->amount,
                    'card_type'          => $request->card_type,
                    'store_amount'       => $request->store_amount,
                    'card_no'            => $request->card_no,
                    'status'             => $request->status,
                    'tran_date'          => $request->tran_date,
                    'currency'           => $request->currency,
                    'card_issuer'        => $request->card_issuer,
                    'card_brand'         => $request->card_brand,
                    'card_sub_brand'     => $request->card_sub_brand,
                    'card_issuer_country' => $request->card_issuer_country,
                    'created_at'         => Carbon::now()
                ]);

                // ✅ If everything runs fine
                DB::commit();

                // Clean up cache
                cache()->forget('payment_data_' . $trx_id);

                $successMessage = 'You donated successfully!';
                return redirect('donation/details?slug=' . $donation_details_slug . '&success=' . urlencode($successMessage))
                    ->with('success', $successMessage);
            } catch (\Exception $e) {
                // ❌ If something fails, rollback
                DB::rollBack();
                return redirect()->back()->with('error', 'Payment succeeded but order creation failed: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('error', 'Payment validation failed.');
    }

    public function failure(Request $request)
    {
        $donation_details_slug = $request->value_a;

        $successMessage = 'Payment failed! Please try again.!';
        return redirect('donation/details?slug=' . $donation_details_slug . '&error=' . urlencode($successMessage))
            ->with('error', $successMessage);
    }

    public function cancel(Request $request)
    {
         $donation_details_slug = $request->value_a;

        $successMessage = 'Payment Cancelled! Please try again.!';
        return redirect('donation/details?slug=' . $donation_details_slug . '&error=' . urlencode($successMessage))
            ->with('error', $successMessage);
    }

    public function refund($bankID)
    {
        /**
         * SSLCommerz::refund($bank_trans_id, $amount [,$reason])
         */

        $refund = SSLCommerz::refund($bankID, 1500); // 1500 => refund amount

        if ($refund->status) {
            /**
             * States:
             * success : Refund request is initiated successfully
             * failed : Refund request is failed to initiate
             * processing : The refund has been initiated already
             */

            $state  = $refund->refund_state;

            /**
             * RefID will be used for post-refund status checking
             */

            $refID  = $refund->ref_id;

            /**
             *  To get all the outputs
             */

            dd($refund->output);
        } else {
            return $refund->message;
        }
    }

    public function check_refund_status($refID)
    {
        $refund = SSLCommerz::query_refund($refID);

        if ($refund->status) {
            /**
             * States:
             * refunded : Refund request has been proceeded successfully
             * processing : Refund request is under processing
             * cancelled : Refund request has been proceeded successfully
             */

            $state  = $refund->refund_state;

            /**
             * RefID will be used for post-refund status checking
             */

            $refID  = $refund->ref_id;

            /**
             *  To get all the outputs
             */

            dd($refund->output);
        } else {
            return $refund->message;
        }
    }

    public function get_transaction_status($trxID)
    {
        $query = SSLCommerz::query_transaction($trxID);

        if ($query->status) {
            dd($query->output);
        } else {
            $query->message;
        }
    }

    // public function ipn(Request $request)
    // {
    //     #Received all the payement information from the gateway
    //     if ($request->input('tran_id')) #Check transation id is posted or not.
    //     {

    //         $tran_id = $request->input('tran_id');

    //         #Check order status in order tabel against the transaction id or order id.
    //         $order_details = DB::table('orders')
    //             ->where('transaction_id', $tran_id)
    //             ->select('transaction_id', 'status', 'currency', 'amount')->first();

    //         if ($order_details->status == 'Pending') {
    //             $sslc = new SslCommerzNotification();
    //             $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
    //             if ($validation == TRUE) {
    //                 /*
    //                 That means IPN worked. Here you need to update order status
    //                 in order table as Processing or Complete.
    //                 Here you can also sent sms or email for successful transaction to customer
    //                 */
    //                 $update_product = DB::table('orders')
    //                     ->where('transaction_id', $tran_id)
    //                     ->update(['status' => 'Processing']);

    //                 echo "Transaction is successfully Completed";
    //             }
    //         } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

    //             #That means Order status already updated. No need to udate database.

    //             echo "Transaction is already successfully Completed";
    //         } else {
    //             #That means something wrong happened. You can redirect customer to your product page.

    //             echo "Invalid Transaction";
    //         }
    //     } else {
    //         echo "Invalid Data";
    //     }
    // }
}
