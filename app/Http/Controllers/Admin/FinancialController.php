<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Financial;
use App\Models\FinancialItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FinancialController extends Controller {

    public function index() {
        $financials = Financial::with('user')->latest()->paginate(15);
        $title = 'حساب های مالی';
        return view('admin.financials.index', compact('title', 'financials'));
    }
    public function create() {
        $title = 'ثبت حساب مالی';
        return view('admin.financials.create', compact('title'));
    }

    public function show(Financial $financial) {
        $title = 'مشاهده حساب مالی';
        $financialItems = FinancialItem::where('financial_id', $financial->id)->orderBy('date_pay')->get();
        return view('admin.financials.show', compact('title', 'financial', 'financialItems'));
    }

    public function store(Request $request) {

        $this->validate($request, [
            'student_id' => 'required',
            'n_items' => 'required',
            'amount' => 'required'
        ]);
        // $financial=Financial::insert([
        //     'user_id'=>$request->student_id,
        //     'grade'=>$request->grade,
        //     'amount'=>$request->amount,
        //     'n_items'=>$request->n_items,
        //     'created_at'=>Carbon::createFromTimestamp($request->createdAtTimestamp),
        //     'updated_at'=>Carbon::createFromTimestamp($request->createdAtTimestamp),
        // ]);
        $financial = new Financial();
        $financial->user_id = $request->student_id;
        $financial->grade = $request->grade;
        $financial->amount = $request->amount;
        $financial->n_items = $request->n_items;
        $financial->created_at = Carbon::createFromTimestamp($request->createdAtTimestamp);
        $financial->updated_at = Carbon::createFromTimestamp($request->createdAtTimestamp);
        $financial->save();
        $financial->createFinancialItems($request->n_items);

        return redirect()->route('admin.financials.show', ['financial' => $financial->id]);
    }
}
