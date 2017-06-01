<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transfer extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function account_from_detail()
    {
        return $this->belongsTo(Account::class, 'account_from');
    }

    public function account_to_detail()
    {
        return $this->belongsTo(Account::class, 'account_to');
    }


}
