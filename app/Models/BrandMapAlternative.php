<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrandMapAlternative extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_id',
        'alternative_id'
    ];
    protected $table = 'brands_alternatives';
}
