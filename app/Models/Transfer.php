<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    public function account_from_detail()
    {
        return $this->belongsTo(Account::class, 'account_from');
    }

    public function account_to_detail()
    {
        return $this->belongsTo(Account::class, 'account_to');
    }


}
