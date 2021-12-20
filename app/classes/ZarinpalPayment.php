<?php

namespace App\Classes;

class ZarinpalPayment {

    private $merchantId = 'ae7a0556-cd8b-11e9-bd68-000c295eb8fc';

    /**
     * send data to bank.
     */
    public function send($amount, $financialItemId) {
        $data = [
            "merchant_id" => $this->merchantId,
            "amount" => $amount * 10,
            "callback_url" => route('financialItems.payment.vrify', ['financialItem' => $financialItemId]),
            "description" => "پرداخت قسط",
            "metadata" => ["financialItemId" => $financialItemId],
        ];
        $jsonData = json_encode($data);
        $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/request.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ]);
        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true, JSON_PRETTY_PRINT);
        curl_close($ch);
        if ($err) {
            die("cURL Error #:" . $err);
        } else {
            if (empty($result['errors'])) {
                if ($result['data']['code'] == 100) {
                    $url = "https://www.zarinpal.com/pg/StartPay/{$result['data']["authority"]}";
                    echo "<script>window.location = '$url';</script>";
                    exit;
                }
            } else {
                die("Error Code:#" . $result['errors']['code'] . ' ' . "message:" . $result['errors']['message']);
            }
        }
    }

    /**
     * verify payment.
     */
    public function verify($bankData) {
        if ($bankData['Status'] == 'OK') {
            $Authority = $bankData['Authority'];
            $amount = $bankData['amount'];
            $data = [
                "merchant_id" => $this->merchantId,
                "authority" => $Authority,
                "amount" => $amount * 10
            ];
            $jsonData = json_encode($data);
            $ch = curl_init('https://api.zarinpal.com/pg/v4/payment/verify.json');
            curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v4');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($jsonData)
            ]);
            $result = curl_exec($ch);
            $err = curl_error($ch);
            curl_close($ch);
            $result = json_decode($result, true);
            if ($err) {
                return ['done' => false, 'msg' => null];
            } else {
                if ($result['data']['code'] == 100) {
                    return ['done' => true, 'tr_code' => $result['data']['ref_id'], 'ref_code' => $result['data']['ref_id'], 'amount' => $amount];
                } else {
                    return ['done' => false, 'msg' => null];
                }
            }
        } else {
            return ['done' => false, 'msg' => 'تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.'];
        }
    }
}
