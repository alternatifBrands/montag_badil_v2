<?php

namespace App\Models;

use App\Models\City;
use App\Models\User;
use App\Models\Brand;
use App\Models\Country;
use App\Models\Product;
use App\Models\Category;
use App\Models\Location;
use App\Models\Modelable;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BrandAlternative extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable = [
        'name',
        'founder',
        'owner',
        'url',
        'description',
        'parent_company',
        'industry',
        'notes',
        'barcode',
        'status',
        'image',
        'meta_title',
        'meta_description',
        'keywords',
        'canonicalUrl',
        'slug',
        'category_id',
        'user_id',
        'country_id',
        'city_id'
    ];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('brand_alternative');
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
    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class,'brands_alternatives', 'alternative_id','brand_id');
    }
    public function locations()
    {
        return $this->morphToMany(Country::class, 'modelable','locations','modelable_id')->withPivot('country_id');
    }
}
