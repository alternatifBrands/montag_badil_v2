<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Enums\StatusType;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\ProductAlternative;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use App\Filament\Resources\ProductAlternativeResource\Pages;
use App\Filament\Resources\ProductAlternativeResource\RelationManagers;

class ProductAlternativeResource extends Resource
{
    protected static ?string $model = ProductAlternative::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'ProductAlternative';
    protected static ?int $navigationSort = 9;
    protected static ?string $navigationGroup = 'Product Management';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->string(),

                        Textarea::make('description')
                            ->required()
                            ->string(),

                        TextInput::make('notes')
                            ->required()
                            ->string(),

                        TextInput::make('barcode')
                            ->required()
                            ->string(),

                        Select::make('status')
                            ->required()
                            ->options(StatusType::class),

                        // SpatieMediaLibraryFileUpload::make('product_logo')
                        //     ->collection('product_alternative')
                        //     ->image()
                        //     ->acceptedFileTypes(['image/png', 'image/jpeg'])
                        //     ->maxSize(1024)
                        //     ->columnSpanFull(),

                        FileUpload::make('image')->directory('product_alternative_image'),

                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required(),

                        Select::make('brand_id')
                            ->relationship('brand', 'name')
                            ->required(),
                    ])->columns(2)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('No')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),


                TextColumn::make('description')
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

                // SpatieMediaLibraryImageColumn::make('product_logo')
                //     ->collection('product_alternative')
                //     ->width(150)
                //     ->height(150),
                ImageColumn::make('image'),

                TextColumn::make('user.name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('brand.name')
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
            'index' => Pages\ListProductAlternatives::route('/'),
            'create' => Pages\CreateProductAlternative::route('/create'),
            'edit' => Pages\EditProductAlternative::route('/{record}/edit'),
        ];
    }
}
