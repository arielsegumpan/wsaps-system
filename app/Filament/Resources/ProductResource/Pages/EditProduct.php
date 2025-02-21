<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getTitle(): string | Htmlable
    {
        /** @var Product */
        $record = $this->getRecord();

        return 'Edit ' . ucwords($record->prod_name . ': (' . $record->prod_sku .')');
    }

    protected function getActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['prod_name'] = ucwords($data['prod_name']);
        $data['prod_slug'] = strtoupper($data['prod_slug']);

        return $data;
    }
}
