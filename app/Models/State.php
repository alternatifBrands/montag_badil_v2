<?php

namespace App\Models;

use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'country_id'
    ];
    public $timestamps = false;
    public function country() :BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function cities() :HasMany
    {
        return $this->hasMany(City::class);
    }
}
