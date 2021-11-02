<?php

namespace App\Http\Controllers;

use App\Models\Financial;
use App\Models\FinancialItem;
use Illuminate\Http\Request;

class FinancialController extends Controller {
    public function index() {
        $title = 'لیست حسابهای مالی';
        $user = auth()->user();
        $financials = Financial::where('user_id', $user->id)->latest()->paginate(3);
        return view('app.financials.index', compact('title', 'financials'));
    }

    public function show(Financial $financial) {
        $title = 'مشاهده حساب مالی';
        $financialItems = FinancialItem::where('financial_id', $financial->id)->orderBy('date_pay')->get();
        return view('app.financials.show', compact('title', 'financial', 'financialItems'));
    }
}
