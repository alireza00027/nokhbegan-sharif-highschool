<?php

namespace App\Http\Controllers;

use App\Classes\ZarinpalPayment;
use App\Models\FinancialItem;
use Illuminate\Http\Request;
use App\Models\Payment;

class FinancialItemController extends Controller {
    public function payment(FinancialItem $financialItem) {
        $user = auth()->user();
        (new ZarinpalPayment)->send($financialItem->amount, $financialItem->id);
    }

    public function check() {
    }

    public function vrify(FinancialItem $financialItem) {
    }
}
