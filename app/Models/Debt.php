<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
