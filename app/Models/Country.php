<?php

namespace App\Models;

use App\Models\User;
use App\Models\Brand;
use App\Models\State;
use App\Models\Location;
use App\Models\Modelable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'capital'
    ];
    public $timestamps = false;
    public function states() :HasMany
    {
        return $this->hasMany(State::class);
    }
    public function cities() :HasMany
    {
        return $this->hasMany(City::class);
    }
    public function users() :HasMany
    {
        return $this->hasMany(User::class);
    }
    public function brands() :HasMany
    {
        return $this->hasMany(Brand::class);
    }
}
