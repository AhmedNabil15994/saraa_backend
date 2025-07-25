<?php namespace App\Services\Payment\Contract;

interface PaymentInterface
{
    public function send($order, $type ="api-order", $payment = "knet");

    public function getResultForPayment($data, $type ="api-order", $payment = "knet");
}
