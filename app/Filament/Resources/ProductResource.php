<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use App\Enums\ProductTypeEnum;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Pages\SubNavigationPosition;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\ToggleButtons;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\Collection;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\ProductResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Section as InfoSection;
use App\Filament\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    Section::make('Product Details')
                    ->schema(static::getDetailsFormSchema()),

                    Section::make()
                    ->schema(static::getProductPricesFormSchema()),

                    Section::make()
                    ->schema([static::getProductPhotosFormSchema()])


                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Grid::make([
                    'lg' => 3,
                    '2xl' => 3,
                ]),

                Tables\Columns\Layout\Stack::make([

                        Tables\Columns\Layout\Split::make([
                            TextColumn::make('prod_sku')
                            ->searchable()
                            ->sortable()
                            ->label('SKU')
                            ->badge()
                            ->color('success')
                            ->copyable()
                            ->size(TextColumn\TextColumnSize::Large)
                            ->weight(FontWeight::Bold),

                            ColorColumn::make('prod_color')
                            ->label('Color')
                        ]),

                        ImageColumn::make('productImages.url')
                        ->label('Images')
                        ->limit(1)
                        ->height('100%')
                        ->width('100%'),

                    Tables\Columns\Layout\Stack::make([

                        TextColumn::make('prod_name')
                        ->searchable()
                        ->sortable()
                        ->label('Product')
                        ->formatStateUsing(fn(string $state) : string => ucwords($state))
                        ->description(fn (Model $record) => ucwords($record->brand->brand_name))
                        ->size(TextColumn\TextColumnSize::Large)
                        ->weight(FontWeight::Bold),

                        Tables\Columns\Layout\Split::make([

                            TextColumn::make('prod_price')
                            ->label('Price')
                            ->sortable()
                            ->money('PHP'),

                            TextColumn::make('prod_qty')
                            ->label('Qty.')
                            ->badge()
                            ->color('success')
                            ->weight(FontWeight::Bold)
                            ->tooltip('Product stock quantity'),

                            IconColumn::make('is_visible')
                            ->label('Is Visible')
                            ->tooltip('Visible to the public')
                            ->boolean()

                        ]),
                    ]),
                ])->space(3),
                Tables\Columns\Layout\Panel::make([
                    Tables\Columns\Layout\Split::make([

                        TextColumn::make('productCategories.prod_cat_name')
                        ->badge()
                        ->color('warning')
                        ->formatStateUsing(fn (string $state) : string => ucwords($state)),

                    ]),
                ])->collapsible(),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->paginated([
                9,
                18,
                36,
                'all',
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                // Tables\Actions\ActionGroup::make([
                //     Tables\Actions\EditAction::make(),
                //     Tables\Actions\DeleteAction::make(),
                // ])->tooltip('Actions')
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
            ->emptyStateIcon('heroicon-o-squares-plus')
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
            'view' => Pages\ViewProduct::route('/{record}')
        ];
    }

    /** @return Forms\Components\Component[] */
    public static function getDetailsFormSchema(): array
    {
        return [
           Group::make()
           ->schema([

                TextInput::make('prod_name')
                    ->label('Product')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $state, Forms\Set $set) => $set('prod_slug', Str::slug($state))),

                TextInput::make('prod_slug')
                    ->label('Slug')
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

                Group::make()
                ->schema([
                    TextInput::make('prod_barcode')
                    ->label('Barcode')
                    ->maxLength(255),

                    Select::make('brand_id')
                    ->label('Brand')
                    ->relationship(
                        'brand',
                        'brand_name',
                        fn ($query) => $query->orderBy('brand_name')
                    )
                    ->native(false)
                    ->preload()
                    ->optionsLimit(6)
                    ->searchable()
                    ->required(),


                    TextInput::make('prod_qty')
                        ->label('Quantity')
                        ->required()
                        ->numeric()
                        ->default(1)
                        ->dehydrated()
                        ->minValue(1),

                    TextInput::make('prod_security_stock')
                        ->label('Security Stock')
                        ->numeric()
                        ->default(5)
                        ->dehydrated()
                        ->minValue(0),
                ])
                ->columnSpanFull()
                ->columns([
                    'sm' => 1,
                    'md' => 2,
                    'lg' => 4
                ]),


                Select::make('productCategories')
                    ->label('Categories')
                    ->relationship(
                        'productCategories',
                        'prod_cat_name',
                        fn ($query) => $query->orderBy('prod_cat_name')
                    )
                    ->multiple()
                    ->preload()
                    ->optionsLimit(6)
                    ->searchable()
                    ->columnSpanFull()
                    ->required()
                    ->createOptionForm([

                        Split::make([
                            Section::make('Create a new product category')
                                ->icon('heroicon-o-queue-list')
                                ->schema([
                                    TextInput::make('prod_cat_name')
                                    ->label('Name')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (string $state, Forms\Set $set) => $set('prod_cat_slug', Str::slug($state))),

                                    TextInput::make('prod_cat_slug')
                                        ->label('Slug')
                                        ->disabled()
                                        ->dehydrated()
                                        ->required()
                                        ->maxLength(255),

                                    Textarea::make('prod_cat_desc')
                                        ->rows(6)
                                        ->maxLength(5000)
                                        ->columnSpanFull(),
                            ]),

                            Group::make()
                            ->schema([

                                Section::make()
                                ->schema([
                                    ToggleButtons::make('is_visible')
                                    ->label('Is visible to the public?')
                                    ->boolean()
                                    ->grouped()
                                    ->default(true)
                                    ->dehydrated(),
                                ]),

                                Section::make('Image')
                                    ->schema([

                                        FileUpload::make('prod_cat_image')
                                            ->image()
                                            ->hiddenLabel()
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '16:9',
                                                '4:3',
                                                '1:1',
                                            ])
                                            ->maxSize(3048),
                                ])
                                ->collapsible()
                                ->columnSpan(1),
                            ])
                            ->columns([
                                'sm' => 1,
                                'md' => 1,
                                'lg' => 1,
                            ]),
                        ])
                        ->columnSpanFull()
                    ]),

                Group::make()
                ->schema([
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

                    ToggleButtons::make('prod_requires_shipping')
                        ->label('Is require shipping?')
                        ->required()
                        ->boolean()
                        ->grouped()
                        ->default(false)
                        ->dehydrated(),

                    ToggleButtons::make('prod_backorder')
                        ->label('Is backorder allowed?')
                        ->required()
                        ->boolean()
                        ->grouped()
                        ->default(true)
                        ->dehydrated(),
                ])
                ->columnSpan('full')
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
               'md' => 3,
               'lg' => 3,
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
                            ->default(0)
                            ->minlength(0)
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

    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ViewProduct::class,
            Pages\EditProduct::class,
        ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfoSection::make()
                ->schema([

                    ImageEntry::make('productImages.url')
                    ->hiddenLabel()
                    ->stacked()
                    ->limit(3)
                    ->height(100)
                    ->square(),

                    TextEntry::make('prod_name')
                    ->label('Product')
                    ->size(TextEntry\TextEntrySize::Large)
                    ->weight(FontWeight::ExtraBold)
                    ->formatStateUsing(fn (string $state) : string => ucwords($state) ),

                    TextEntry::make('prod_sku')
                    ->label('SKU')
                    ->size(TextEntry\TextEntrySize::Large)
                    ->weight(FontWeight::ExtraBold)
                    ->badge()
                    ->color('success')
                    ->copyable()
                    ->toolTip('Copy SKU'),






                ])
            ]);
    }
}
