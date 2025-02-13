<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductCategoryResource\Pages;
use App\Filament\Resources\ProductCategoryResource\RelationManagers;
use App\Models\ProductCategory;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Infolists\Components\Group as InfoGroup;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Infolists\Components\Split as InfoSplit;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    protected static ?string $modelLabel = 'Product Categories';

    // protected static ?string $navigationLabel = 'Product Categories';

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('prod_cat_image')
                ->label('Image')
                ->extraImgAttributes(['loading' => 'lazy'])
                ->square()
                ->size(50),

                TextColumn::make('prod_cat_name')
                ->label('Category Name')
                ->sortable()
                ->searchable()
                ->formatStateUsing(fn(string $state): string => ucwords($state))
                ->description(fn(ProductCategory $record): string => "{$record->prod_cat_slug}"),

                TextColumn::make('prod_cat_desc')
                ->label('Description')
                ->wrap()
                ->limit(100),

                ToggleColumn::make('is_visible')
                ->label('Visibility'),

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
                ->label(__('New Product Category')),
            ])
            ->emptyStateIcon('heroicon-o-queue-list')
            ->emptyStateHeading('No Product Categories are created')
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
            'index' => Pages\ListProductCategories::route('/'),
            'create' => Pages\CreateProductCategory::route('/create'),
            'edit' => Pages\EditProductCategory::route('/{record}/edit'),
        ];
    }


    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfoSection::make()
                ->schema([
                    InfoSplit::make([
                        InfoGroup::make()
                        ->schema([
                            ImageEntry::make('prod_cat_image')
                            ->hiddenLabel()
                            ->width(350)
                            ->height(200)
                            ->square(),
                        ])
                        ->columns([
                                'sm' => 1,
                                'md' => 1,
                                'lg' => 1,
                        ]),


                        InfoGroup::make()
                        ->schema([
                            TextEntry::make('prod_cat_name')
                                ->label('Name')
                                ->size(TextEntry\TextEntrySize::Large)
                                ->weight(FontWeight::ExtraBold),

                            TextEntry::make('prod_cat_slug')
                                ->label('Slug'),

                            IconEntry::make('is_visible')
                                ->label('Is visible to the public?')
                                ->icon(fn (string $state): string => match ($state) {
                                    '1' => 'heroicon-o-check',
                                    '0' => 'heroicon-o-x',
                                })
                                ->color(fn (string $state): string => match ($state) {
                                    '1' => 'success',
                                    '0' => 'danger',
                                }),
                        ])

                    ])
                    ->columnSpanFull()
                ]),

                InfoSection::make()
                ->schema([
                    TextEntry::make('prod_cat_desc')
                    ->label('Description')
                    ->columnSpanFull(),
                ])
            ]);
    }
}
