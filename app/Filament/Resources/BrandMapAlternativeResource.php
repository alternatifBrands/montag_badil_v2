<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BrandMapAlternativeResource\Pages;
use App\Filament\Resources\BrandMapAlternativeResource\RelationManagers;
use App\Models\BrandMapAlternative;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BrandMapAlternativeResource extends Resource
{
    protected static ?string $model = BrandMapAlternative::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 7;
    protected static ?string $navigationGroup = 'Brand Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    // public static function table(Table $table): Table
    // {
    //     return $table
    //         ->columns([
    //             //
    //         ])
    //         ->filters([
    //             //
    //         ])
    //         ->actions([
    //         ])
    //         ->bulkActions([
    //             Tables\Actions\BulkActionGroup::make([
    //                 Tables\Actions\DeleteBulkAction::make(),
    //             ]),
    //         ]);
    // }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrandMapAlternatives::route('/'),
            'create' => Pages\CreateBrandMapAlternative::route('/create'),
            'edit' => Pages\EditBrandMapAlternative::route('/{record}/edit'),
        ];
    }
}
