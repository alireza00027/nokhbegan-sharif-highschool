<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financial extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'grade',
        'amount',
        'paid',
        'n_items',
        'n_paid_items'
    ];

//relationships
    public function financialItems()
    {
        return $this->hasMany(FinancialItem::class,'financial_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

//methods

    public function createFinancialItems($number)
    {
        $allDays=270;
        $payFinancialItemsDays=$allDays/$number;
        for($i=0 ; $i<$number ; $i++) {
            $date=new Carbon($this->created_at);
            $financialItem=new FinancialItem();
            $financialItem->financial_id=$this->id;
            $financialItem->amount=$this->amount / $number;
            $financialItem->status='paying';
            $financialItem->date_pay=$date->addDays($i*$payFinancialItemsDays);
            $financialItem->save();
        }

    }

    public function getGrade()
    {
        switch ($this->grade) {
            case 'seventh':
                return 'هفتم';
                break;
            
            case 'eighth':
                return 'هشتم';
                break;
            case 'ninth':
                return 'نهم';
                break;    
        }
    }
    
    public function getStatusText()
    {
        switch ($this->status) {
            case 'paying':
                return 'در حال پرداخت';
                break;
            
            case 'paid':
                return 'پرداخت شده';
                break;
        }
    }
}
