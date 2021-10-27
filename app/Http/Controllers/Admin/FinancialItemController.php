<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinancialItem;
use Illuminate\Http\Request;

class FinancialItemController extends Controller
{
    public function show(FinancialItem $financialItem)
    {
        $title='مشاهده قسط';
        return view('admin.financialItems.show',compact('title','financialItem'));
    }
}
