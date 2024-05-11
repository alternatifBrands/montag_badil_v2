<?php

namespace App\Filament\Resources\BrandMapAlternativeResource\Pages;

use App\Filament\Resources\BrandMapAlternativeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use EightyNine\ExcelImport\ExcelImportAction;

class ListBrandMapAlternatives extends ListRecords
{
    protected static string $resource = BrandMapAlternativeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExcelImportAction::make()
                ->color("primary"),
            Actions\CreateAction::make(),
        ];
    }
}
