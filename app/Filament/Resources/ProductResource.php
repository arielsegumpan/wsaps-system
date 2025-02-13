<?php

namespace App\Filament\Resources;

use App\Enums\ProductTypeEnum;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\ProductImage;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Create a new product')
                ->description('Fill the form below to create a new product.')
                ->schema([
                    Section::make('Product Details')
                    ->schema([static::getDetailsFormSchema()]),

                    Section::make()
                    ->schema([static::getProductPricesFormSchema()]),

                    Section::make()
                    ->schema([static::getProductPhotosFormSchema()])


                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])->tooltip('Actions')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('toggle-visibility')
                    ->label('Toggle Visibility')
                    ->icon('heroicon-o-eye')
                    ->action(function (Collection $records): void {
                        $records->each(function ($record) {
                            $record->update([
                                'is_visible' => !$record->is_visible
                            ]);
                        });
                    })
                    ->deselectRecordsAfterCompletion()
                    ->requiresConfirmation()
                    ->modalIcon('heroicon-o-eye')
                    ->modalHeading('Toggle Visibility')
                    ->modalDescription('Toggle visibility is to make the selected product category(s) visible or hidden on the website.')
                    ->modalSubmitActionLabel('Yes')
                    ->color('success'),
                ]),
            ])
            ->deferLoading()
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label(__('New Product')),
            ])
            ->emptyStateIcon('heroicon-o-shopping-bag')
            ->emptyStateHeading('No Products are created')
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    /** @return Forms\Components\Component[] */
    public static function getDetailsFormSchema(): array
    {
        return [
           Group::make()
           ->schema([
                TextInput::make('prod_name')
                ->required()
                ->maxLength(255)
                ->live(onBlur: true)
                ->afterStateUpdated(fn (string $state, Forms\Set $set) => $set('prod_slug', Str::slug($state))),

                TextInput::make('prod_slug')
                ->disabled()
                ->dehydrated()
                ->required()
                ->maxLength(255)
                ->unique(Product::class, 'prod_slug', ignoreRecord: true),

                TextInput::make('prod_sku')
                ->label('SKU')
                ->default('SKU-'. date('His-') . strtoupper(Str::random(6)))
                ->disabled()
                ->dehydrated()
                ->required()
                ->maxLength(32)
                ->unique(Product::class, 'prod_sku', ignoreRecord: true),

                TextInput::make('prod_barcode')
                ->label('Barcode')
                ->maxLength(255),

                Group::make()
               ->schema([
                    TextInput::make('prod_qty')
                    ->label('Quantity')
                    ->required()
                    ->numeric()
                    ->default(0),

                    TextInput::make('prod_security_stock')
                    ->numeric()
                    ->default(0),

                    ToggleButtons::make('is_visible')
                    ->label('Is visible to the public?')
                    ->boolean()
                    ->grouped()
                    ->default(true)
                    ->dehydrated(),

                    ToggleButtons::make('is_featured')
                    ->label('Is featured?')
                    ->boolean()
                    ->grouped()
                    ->default(false)
                    ->dehydrated(),
               ])
               ->columnSpanFull()
               ->columns([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 4
               ]),

                RichEditor::make('prod_desc')
                ->label('Description')
                ->columnSpan('full')
                ->maxLength(65535),


           ])->columns([
               'sm' => 1,
               'md' => 2,
               'lg' => 2,
           ])->columnSpanFull()

        ];
    }

    /** @return Forms\Components\Component[] */
    public static function getProductPricesFormSchema(): array
    {
        return [
           Group::make()
           ->schema([
                TextInput::make('prod_price')
                ->label('Old Price')
                ->numeric()
                ->default(0),

                TextInput::make('prod_price')
                ->label('Price')
                ->numeric()
                ->default(0),

                TextInput::make('prod_cost')
                ->label('Cost')
                ->numeric()
                ->default(0),

                ColorPicker::make('prod_color')
                ->label('Color')
                ->regex('/^#([a-f0-9]{6}|[a-f0-9]{3})\b$/')
                ->default('#ff0000')
                ->dehydrated(),

                ToggleButtons::make('prod_type')
                ->required()
                ->options(ProductTypeEnum::class)
                ->default('pending')
                ->colors([
                    'deliverable' => 'primary',
                    'downloadable' => 'success',
                ])
                // ->disableOptionWhen(fn (string $value): bool => $value === 'published')
                // ->in(fn (ToggleButtons $component): array => array_keys($component->getEnabledOptions()))
                ->inline(true),

                DatePicker::make('prod_published_at')
                ->label('Published At')
                ->native(false)
                ->dehydrated()
                ->default(now()),

           ])->columns([
               'sm' => 1,
               'md' => 2,
               'lg' => 2,
           ])->columnSpanFull()

        ];
    }

    /** @return Forms\Components\Component[] */
    public static function getProductPhotosFormSchema(): Repeater
    {
        return Repeater::make('productImages')
            ->label('')
            ->relationship()
            ->schema([

                Split::make([
                    FileUpload::make('url')
                    ->image()
                    ->required()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        null,
                        '1:1',
                        '4:3',
                    ])
                    ->maxSize(2048)
                    ->hiddenLabel(),

                    Group::make()
                    ->schema([
                        TextInput::make('alt_text')
                            ->maxLength(255),

                        TextInput::make('display_order')
                            ->numeric()
                            ->unique(ProductImage::class, 'display_order', ignoreRecord: true),

                        ToggleButtons::make('is_primary')
                            ->boolean()
                            ->grouped()
                            ->default(false)
                            ->dehydrated()
                            ->columnSpanFull()
                    ])
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
                        'lg' => 2
                    ])
                ])
                ->columnSpanFull()

             ])
             ->defaultItems(1)
             ->columns([
                 'sm' => 1,
                 'md' => 2,
                 'lg' => 2,
             ])
             ->required()
             ->addActionLabel('Add more')
            ->reorderable()
            ->collapsible();
    }
}
