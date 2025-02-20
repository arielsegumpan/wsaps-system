<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BlogCategoryResource\Pages;
use App\Filament\Resources\BlogCategoryResource\RelationManagers;

class BlogCategoryResource extends Resource
{
    protected static ?string $modelLabel = 'Categories';

    protected static ?string $navigationLabel = 'Categories';

    protected static ?string $model = BlogCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-numbered-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')
                ->schema([

                    Group::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->required()
                            ->placeholder('Enter the name of the category')
                            ->live(onBlur: true)
                            ->maxLength(255)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('cat_slug', Str::slug($state)) : null),


                        TextInput::make('cat_slug')
                            ->label('Slug')
                            ->disabled()
                            ->dehydrated()
                            ->required()
                            ->maxLength(255)
                            ->unique(BlogCategory::class, 'cat_slug', ignoreRecord: true),
                    ])
                    ->columns([
                        'sm' => 1,
                        'md' => 2,
                    ]),

                    ToggleButtons::make('cat_is_visible')
                        ->label('Is visible to the public?')
                        ->boolean()
                        ->default(true)
                        ->dehydrated()
                        ->grouped(),

                    Textarea::make('description')
                        ->label('Description')
                        ->placeholder('Enter the description of the category')
                        ->rows(6)
                        ->maxLength(3000)
                        ->columnSpanFull(),


                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Category')
                    ->formatStateUsing(fn (string $state): string => ucwords($state))
                    ->badge()
                    ->color('warning'),
                TextColumn::make('slug')
                    ->searchable()
                    ->sortable()
                    ->label('Slug'),
                TextColumn::make('description')
                    ->label('Description')
                    ->wrap()
                    ->limit(50),
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
                ]),
            ])
            ->deferLoading()
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                ->icon('heroicon-m-plus')
                ->label(__('New Category')),
            ])
            ->emptyStateIcon('heroicon-o-numbered-list')
            ->emptyStateHeading('No Categories are created')
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
            'index' => Pages\ListBlogCategories::route('/'),
            'create' => Pages\CreateBlogCategory::route('/create'),
            'edit' => Pages\EditBlogCategory::route('/{record}/edit'),
        ];
    }
}
