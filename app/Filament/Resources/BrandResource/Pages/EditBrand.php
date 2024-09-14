<?php

namespace App\Filament\Resources\BrandResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\BrandResource;

class EditBrand extends EditRecord
{
    use EditRecord\Concerns\Translatable;


    protected static string $resource = BrandResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Brand updated')
            ->body('The Brand has been saved successfully.');
    }
    public function getTitle(): string
    {
        return 'Brand';
    }
}
