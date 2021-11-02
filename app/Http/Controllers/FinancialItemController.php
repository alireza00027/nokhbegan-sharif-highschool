<?php

namespace App\Http\Controllers;

use App\Models\FinancialItem;
use Illuminate\Http\Request;
use App\Http\Controllers\zarinpal_function;
use App\Models\Payment;

class FinancialItemController extends Controller {
    protected $MerchantID     = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";
    public function payment(FinancialItem $financialItem) {
        if ($financialItem->amount == 0 and $financialItem->status != 'paying') {
            alert()->error('عملیات ناموفق', 'پرداختی وجود ندارد');
        }
        require_once("zarinpal_function.php");
        $MerchantID     = $this->MerchantID;
        $Amount = $financialItem->amount;
        $Description     = "تراکنش زرین پال";
        $Email             = auth()->user()->email;
        $CallbackURL     = "http://127.0.0.1:8000//financialItems/payment/check";
        $ZarinGate         = false;
        $SandBox         = false;
        $zp     = new zarinpal();
        $result = $zp->request($MerchantID, $Amount, $Description, $Email, $CallbackURL, $SandBox, $ZarinGate);

        if (isset($result["Status"]) && $result["Status"] == 100) {
            Payment::create([
                'user_id' => auth()->user()->id,
                'financialItem_id' => $financialItem->id,
                'resnumber' => $result["Authority"],
                'price' => $financialItem->amount,
                'payment' => true
            ]);

            // Success and redirect to pay
            $zp->redirect($result["StartPay"]);
        } else {
            // error 
            echo "خطا در ایجاد تراکنش";
            echo "<br />کد خطا : " . $result["Status"];
            echo "<br />تفسیر و علت خطا : " . $result["Message"];
        }
    }

    public function check() {

        require_once("zarinpal_function.php");

        $MerchantID     = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";
        $Amount         = 100;
        $ZarinGate         = false;
        $SandBox         = false;

        $zp     = new zarinpal();
        $result = $zp->verify($MerchantID, $Amount, $SandBox, $ZarinGate);

        if (isset($result["Status"]) && $result["Status"] == 100) {
            $Authority = $result["Authority"];
            $payment = Payment::where('resnumber', $Authority)->firstOrFail();
            $financialItem = FinancialItem::findOrFail($payment->financialItem_id);
            $financialItem->status = "paid";
            $financialItem->save();
            alert()->success('عملیات موفق', 'عملیات با موفقیت انجام شد');
            return redirect()->route('financials.show', ['financial' => $financialItem->financial->id]);
            // Success
            echo "تراکنش با موفقیت انجام شد";
            echo "<br />مبلغ : " . $result["Amount"];
            echo "<br />کد پیگیری : " . $result["RefID"];
            echo "<br />Authority : " . $result["Authority"];
        } else {
            // error
            echo "پرداخت ناموفق";
            echo "<br />کد خطا : " . $result["Status"];
            echo "<br />تفسیر و علت خطا : " . $result["Message"];
        }
    }
}
