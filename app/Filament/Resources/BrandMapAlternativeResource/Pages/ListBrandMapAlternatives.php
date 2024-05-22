<?php

namespace App\Filament\Resources\BrandMapAlternativeResource\Pages;

use Filament\Actions;
use App\Imports\MapImport;
use Filament\Resources\Pages\ListRecords;
use EightyNine\ExcelImport\ExcelImportAction;
use App\Filament\Resources\BrandMapAlternativeResource;

class ListBrandMapAlternatives extends ListRecords
{
    protected static string $resource = BrandMapAlternativeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExcelImportAction::make()
                ->use(MapImport::class)
                ->color("primary"),
            Actions\CreateAction::make(),
        ];
    }
}
