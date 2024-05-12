<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\BrandAlternative;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    protected $perPage = 5;

    public function brands(): HasMany
    {
        return $this->hasMany(Brand::class);
    }
    public function brand_alternatives(): HasMany
    {
        return $this->hasMany(BrandAlternative::class);
    }
}
