<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Hekmatinasser\Verta\Verta;

class FinancialItem extends Model
{
    use HasFactory;

    protected $fillable=[
        'financila_id',
        'amount',
        'paid_at',
        'status',
        'date_pay',
    ];

    //relationships

    public function financial()
    {
        return $this->belongsTo(Financial::class,'financial_id');
    }

    //methods

    public function getStatus()
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

    public function getPayDate()
    {
        $v = Verta::instance($this->date_pay);
        return $v->format('%B %d، %Y');
    }

    public function getPaidDate()
    {
        if($this->paid_at!==NULL) {
            $v = Verta::instance($this->paid_at);
            return $v->format('%B %d، %Y');
        }else
            return 'پرداخت نشده';
    }
}
