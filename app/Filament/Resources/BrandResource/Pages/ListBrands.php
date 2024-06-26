<?php

namespace App\Filament\Resources\BrandResource\Pages;

use Filament\Actions;
use App\Imports\BrandImport;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\BrandResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use EightyNine\ExcelImport\ExcelImportAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;

class ListBrands extends ListRecords
{
    protected static string $resource = BrandResource::class;
    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'pending' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending')),
            'approved' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'approved')),
            // 'rejected' => Tab::make()
            //     ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'rejected')),
        ];
    }
    protected function getHeaderActions(): array
    {
        return [
            ExcelImportAction::make()
            ->use(BrandImport::class)
                ->color("primary"),
            Actions\CreateAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return 'Brand';
    }
}
