<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use App\Models\Brand;
use App\Models\Country;
use App\Models\Product;
use Filament\Models\Contracts\FilamentUser;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia,FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles,InteractsWithMedia;

    public function canAccessPanel(Panel $panel): bool
    {
        // if($panel->getId()==='admin') {
        //     return $this->hasRole('admin_role_web');
        // }
        // return $this->hasRole('user_role_web');
        return $this->hasRole('admin_role_web');
    }

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'email_verified_at',
        'remember_token',
        'country_id',
        'type'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function brands(): HasMany
    {
        return $this->hasMany(Brand::class);
    }
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profile');
    }
}
