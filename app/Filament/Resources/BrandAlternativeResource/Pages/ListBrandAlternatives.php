<?php

namespace App\Filament\Resources\BrandAlternativeResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use App\Imports\BrandAlternativeImport;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use EightyNine\ExcelImport\ExcelImportAction;
use App\Filament\Resources\BrandAlternativeResource;

class ListBrandAlternatives extends ListRecords
{
    protected static string $resource = BrandAlternativeResource::class;
    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'pending' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending')),
            'approved' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'approved')),
            'rejected' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'rejected')),
        ];
    }
    protected function getHeaderActions(): array
    {
        return [
            ExcelImportAction::make()
            // ->use(BrandAlternativeImport::class)
                ->color("primary"),
            Actions\CreateAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return 'BrandAlternative';
    }
}
