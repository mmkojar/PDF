<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'product_no',
        'morning',
        'evening',
        'date',
        'month_year'
    ];
}
