<?php

namespace App\Filament\Resources\ProductCategoryResource\Pages;

use App\Filament\Resources\ProductCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductCategory extends EditRecord
{
    protected static string $resource = ProductCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['prod_cat_name'] = ucwords($data['prod_cat_name']);
        $data['prod_cat_slug'] = strtolower($data['prod_cat_slug']);
        $data['prod_cat_desc'] = ucfirst($data['prod_cat_desc']);
        return $data;
    }
}
