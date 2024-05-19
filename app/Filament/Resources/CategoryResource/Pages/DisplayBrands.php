<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Resources\Pages\Page;

class DisplayBrands extends Page
{
    protected static string $resource = CategoryResource::class;

    protected static string $view = 'filament.resources.category-resource.pages.display-brands';
}
