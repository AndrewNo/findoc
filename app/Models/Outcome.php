<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
