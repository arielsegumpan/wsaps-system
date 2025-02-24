<?php

namespace App\Filament\Resources\BrandResource\Pages;

use App\Filament\Resources\BrandResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBrand extends CreateRecord
{
    protected static string $resource = BrandResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['brand_name'] = ucwords($data['brand_name']);
        $data['brand_slug'] = strtolower($data['brand_slug']);
        $data['brand_desc'] = ucfirst($data['brand_desc']);
        return $data;
    }
}
