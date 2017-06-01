<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Debt extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
