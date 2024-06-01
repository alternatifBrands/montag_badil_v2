<?php

namespace App\Models;

use App\Models\City;
use App\Models\User;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Carbon;
use App\Models\BrandAlternative;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Brand extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable = [
        'name',
        'founder',
        'owner',
        'year',
        'url',
        'description',
        'parent_company',
        'industry',
        'notes',
        'image',
        'is_alternative',
        'barcode',
        'status',
        'category_id',
        'user_id',
        'country_id',
        'city_id'
    ];
    protected function year(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('d-m-Y'),
            set: fn ($value) => isset($value) ? Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d') : NULL
        );
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('brand');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
    
    public function brandAlternatives(): BelongsToMany
    {
        return $this->belongsToMany(BrandAlternative::class,'brands_alternatives', 'brand_id', 'alternative_id');
    }
}
