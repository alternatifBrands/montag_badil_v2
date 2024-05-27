<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use App\Models\City;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use App\Enums\StatusType;
use Filament\Tables\Table;
use App\Models\BrandAlternative;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use App\Filament\Resources\BrandAlternativeResource\Pages;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\BrandAlternativeResource\RelationManagers;

class BrandAlternativeResource extends Resource
{
    protected static ?string $model = BrandAlternative::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'BrandAlternative';
    protected static ?int $navigationSort = 6;
    protected static ?string $navigationGroup = 'Brand Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->string(),

                        // TextInput::make('founder')
                        //     ->required()
                        //     ->string(),

                        // TextInput::make('owner')
                        //     ->required()
                        //     ->string(),

                        // DatePicker::make('year')
                        //     ->required()
                        //     ->format('d-m-Y')
                        //     ->date(),

                        TextInput::make('url')
                            ->required()
                            ->url(),

                        // Textarea::make('description')
                        //     ->required()
                        //     ->string(),

                        // TextInput::make('parent_company')
                        //     ->required()
                        //     ->string(),

                        // TextInput::make('industry')
                        //     ->required()
                        //     ->string(),

                        // TextInput::make('notes')
                        //     ->required()
                        //     ->string(),

                        // TextInput::make('barcode')
                        //     ->required()
                        //     ->string(),

                        Select::make('status')
                            ->required()
                            ->options(StatusType::class),

                        // SpatieMediaLibraryFileUpload::make('brand_logo')
                        //     ->collection('brand_alternative')
                        //     ->image()
                        //     ->acceptedFileTypes(['image/png', 'image/jpeg'])
                        //     ->maxSize(1024)
                        //     ->columnSpanFull(),
                        FileUpload::make('image')->directory('brand_alternative_image'),

                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required(),

                        Select::make('country_id')
                            ->relationship('country', 'name')
                            ->required()
                            ->preload()
                            ->live(),

                        // Select::make('city_id')
                        //     ->options(fn(Get $get): Collection => City::query()
                        //         ->where('country_id', $get('country_id'))
                        //         ->pluck('name', 'id'))
                        //     ->label('City')
                        //     ->required()
                        //     ->preload()
                        //     ->live(),

                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required(),

                        Select::make('brands')
                            ->relationship('brands', 'name')
                            ->multiple()
                            ->preload(),
                    ])->columns(2)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                // TextColumn::make('No')->state(
                //     static function (HasTable $livewire, stdClass $rowLoop): string {
                //         return (string) (
                //             $rowLoop->iteration +
                //             ($livewire->getTableRecordsPerPage() * (
                //                 $livewire->getTablePage() - 1
                //             ))
                //         );
                //     }
                // ),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),


                TextColumn::make('founder')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('owner')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('year')
                    ->searchable()
                    ->date('d-m-Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('url')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('description')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('parent_company')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('industry')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('notes')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('barcode')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('status'),

                // SpatieMediaLibraryImageColumn::make('brand_logo')
                //     ->collection('brand_alternative')
                //     ->width(150)
                //     ->height(150),
                ImageColumn::make('image'),

                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('country.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('city.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('category.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('created_at')
                    ->searchable()
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),


                TextColumn::make('updated_at')
                    ->searchable()
                    ->dateTime('d-m-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                ExportBulkAction::make(),
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBrandAlternatives::route('/'),
            'create' => Pages\CreateBrandAlternative::route('/create'),
            'edit' => Pages\EditBrandAlternative::route('/{record}/edit'),
        ];
    }
}
