<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\CreateRecord\Concerns\HasWizard;
use Illuminate\Support\Str;

class CreateProduct extends CreateRecord
{
    use HasWizard;

    protected static string $resource = ProductResource::class;

    public function form(Form $form): Form
    {
        return parent::form($form)
            ->schema([
                Wizard::make($this->getSteps())
                    ->startOnStep($this->getStartStep())
                    ->cancelAction($this->getCancelFormAction())
                    ->submitAction($this->getSubmitFormAction())
                    ->skippable($this->hasSkippableSteps())
                    ->contained(false),
            ])
            ->columns(null);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $data['prod_name'] = ucwords($data['prod_name']);
        $data['prod_slug'] = strtolower($data['prod_slug']);

        return $data;
    }

     /** @return Step[] */
     protected function getSteps(): array
     {
         return [
             Step::make('Product Details')
                ->icon('heroicon-o-shopping-bag')
                 ->schema([
                     Section::make()->schema(ProductResource::getDetailsFormSchema())->columns(),
                 ]),

             Step::make('Price Details')
                 ->icon('heroicon-o-currency-dollar')
                 ->schema([
                     Section::make()->schema(ProductResource::getProductPricesFormSchema()),
                 ]),

            Step::make('Product Images')
                ->icon('heroicon-o-photo')
                ->schema([
                    Section::make()->schema([ProductResource::getProductPhotosFormSchema()]),
                ]),
         ];
     }
}
