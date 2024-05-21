<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\CategoryResource;
use App\Imports\CategoryImport;
use EightyNine\ExcelImport\ExcelImportAction;

class ListCategories extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // ExcelImportAction::make()->color("primary")->hidden(!auth()->user()->hasRole('admin_role_web')),
            ExcelImportAction::make()
            ->use(CategoryImport::class)
            ->color("primary"),
            Actions\CreateAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return 'Category';
    }
    
}
