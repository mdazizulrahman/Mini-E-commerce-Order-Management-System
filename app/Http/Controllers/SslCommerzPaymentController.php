<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\product;
use App\Models\Order;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout(Request $request)
    {
        return view('frontend.exampleEasycheckout');
    }

    public function exampleHostedCheckout($id = null)
    {

        $id = $id ?? 1;

        // ডাটাবেসের products টেবিল থেকে ডাটা আনা
        $product = DB::table('products')->where('id', $id)->first();

        // যদি ডাটাবেসে ওই ID-তে কোনো প্রোডাক্ট না থাকে
        if (!$product) {
            return "Product not found in database!";
        }

        // ব্লেড ফাইলের সুবিধার জন্য $order এবং $product দুই নামেই ডাটা পাঠানো হলো
        return view('frontend.exampleHosted', [
            'product' => $product,
            'order'   => $product // কারণ আপনার ব্লেডে $order->total_amount ও আছে
        ]);

        return view('frontend.exampleHosted', compact('order'));
    }

    public function index(Request $request)
    {
        $post_data = array();
        $post_data['total_amount'] = $request->amount; # ডায়নামিক অ্যামাউন্ট
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // ইউনিক ট্রানজেকশন আইডি তৈরি

        # CUSTOMER INFORMATION (রিকোয়েস্ট থেকে ডাটা নেওয়া হচ্ছে)
        $post_data['cus_name'] = $request->customer_name;
        $post_data['cus_email'] = $request->customer_email;
        $post_data['cus_add1'] = $request->address;
        $post_data['cus_phone'] = $request->customer_mobile;
        $post_data['cus_country'] = "Bangladesh";

        // বাকি ফাকা ফিল্ডগুলো ডিফল্ট ভ্যালু দিয়ে রাখা হলো
        $post_data['cus_add2'] = $post_data['cus_city'] = $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_country'] = "Bangladesh";
        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # ডাটাবেসে অর্ডার ইনসার্ট করা (আপনার ব্লেড টেবিলের কলাম অনুযায়ী)
        DB::table('orders')->insert([
            'customer_name'   => $post_data['cus_name'],
            'phone'           => $post_data['cus_phone'],
            'email'           => $post_data['cus_email'],
            'address'         => $post_data['cus_add1'],
            'transaction_id'  => $post_data['tran_id'],
            'total_amount'    => $post_data['total_amount'],
            'currency'        => $post_data['currency'],
            'status'          => 'pending', // ছোট হাতের অক্ষর
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        $sslc = new SslCommerzNotification();
        # পেমেন্ট গেটওয়েতে রিডাইরেক্ট করা
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        # ডাটাবেস থেকে অর্ডারের বর্তমান অবস্থা চেক করা
        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'total_amount as amount')->first();

        if ($order_details->status == 'pending' || $order_details->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'processing']); // সফল হলে স্ট্যাটাস পরিবর্তন

                return redirect()->route('admin.order.order-list')->with('message', 'Transaction is successfully Completed');
            }
        } else if ($order_details->status == 'processing' || $order_details->status == 'completed') {
            return redirect()->route('admin.order.order-list')->with('message', 'Transaction is already Successful');
        } else {
            return "Invalid Transaction";
        }
    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        # SslCommerzPaymentController.php এর index ফাংশনে এই অংশটুকু আপডেট করুন
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'customer_name' => $post_data['cus_name'], // 'name' এর বদলে 'customer_name'
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'total_amount' => $post_data['total_amount'], // 'amount' এর বদলে 'total_amount'
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }


    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_details = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_details->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);
            echo "Transaction is Cancel";
        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}
