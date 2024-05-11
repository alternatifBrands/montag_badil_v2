<?php

namespace App\Filament\Resources\BrandMapAlternativeResource\Pages;

use App\Filament\Resources\BrandMapAlternativeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBrandMapAlternative extends EditRecord
{
    protected static string $resource = BrandMapAlternativeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
