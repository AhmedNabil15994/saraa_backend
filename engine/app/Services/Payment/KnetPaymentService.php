<?php namespace App\Services\Payment;

use App\Services\Payment\Contract\PaymentInterface;

class KnetPaymentService implements PaymentInterface
{
    // TEST CREDENTIALS
    protected $MERCHANT_ID    = "1201";
    protected $USERNAME              = "test";
    protected $PASSWORD          = "test";
    protected $API_KEY        = "jtest123";
    protected $URL            = "https://api.upayments.com/test-payment";
    protected $TEST_MOD       = 1;


    public function __construct()
    {
        $path = base_path().'/../../app.saraakw.com/config/modules.php';
        $data = require_once($path);
        $payments = isset($data) && isset($data['payment_configs']) && !empty($data['payment_configs'])  ? $data['payment_configs'] : [];
        $this->extraMerchantsData                   = [];
        $upaymentMode      = $payments['upayment']['mode'];
        $this->TEST_MOD    = $upaymentMode == "live" ? 0 : 1;
        $this->MERCHANT_ID = $payments['upayment'][$upaymentMode]['merchant_id'];
        $this->USERNAME    = $payments['upayment'][$upaymentMode]['api_username'];
        $this->PASSWORD    = $payments['upayment'][$upaymentMode]['api_password'];
        $this->API_KEY     = $upaymentMode == "live" ? password_hash($payments['upayment'][$upaymentMode]['api_key'], PASSWORD_BCRYPT) : $payments['upayment'][$upaymentMode]['api_key'];
        $this->URL         = $upaymentMode == "live" ? 'https://api.upayments.com/payment-request' : "https://api.upayments.com/test-payment";
    }

    public function send($order, $type ="api-order", $payment = "knet")
    {
        $url = $this->paymentUrls($type);
        $fields = [
            'api_key'               => $this->API_KEY,
            'merchant_id'           =>  $this->MERCHANT_ID,
            'username'              => $this->USERNAME,
            'password'              => stripslashes($this->PASSWORD),
            'order_id'              => $order['id'],
            // 'CurrencyCode'          => 'kd',//setting('default_currency'), //only works in production mode
            'CstFName'              => $order["name"] ??  'null',
            'CstEmail'              => $order["email"]?? 'null',
            'CstMobile'             => $order["mobile"] ? str_replace("-", "", $order["mobile"]) : 'null',
            'success_url'       => $url['success'],
            'error_url'             => $url['failed'],
            'test_mode'         => $this->TEST_MOD, // test mode enabled
            // 'whitelabled'       => true, // only accept in live credentials (it will not work in test)
            'payment_gateway'   => $payment,// knet / cc
            'total_price'           => $order["total"] ,
        ];
        $fields_string = http_build_query($fields);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $server_output = json_decode($server_output, true);
        if ($server_output["status"] == "errors") {
            throw new \Exception($server_output["error_msg"], 502);
        }

        return $server_output['paymentURL'];
    }

    public function paymentUrls($type)
    {
        if ($type == 'api-order') {
            $url['success'] = url(route('api.payment.success'));
            $url['failed']  = url(route('api.payment.failed'));
        }

        if ($type == 'frontend-order') {
            $url['success'] = url(route('frontend.payment.success'));
            $url['failed']  = url(route('frontend.payment.failed'));
        }

        return $url;
    }


    public function getResultForPayment($data, $type ="api-order", $payment = "knet")
    {
        $order["id"]     = $data["id"];
        $order["total"]  = $data["total"];
        $order["name"]   = optional($data->user)->name ?? "";
        $order["email"]  = optional($data->user)->email ?? "";
        $order["mobile"] = optional($data->user)->mobile ?? "";
        return $this->send($order, $type, $payment);
    }
}
