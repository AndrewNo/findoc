<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function payer()
    {
        return $this->belongsTo(Payer::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
