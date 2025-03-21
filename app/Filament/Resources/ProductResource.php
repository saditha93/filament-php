<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductCategoryResource\RelationManagers\TypesRelationManager;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('product_category_id')
                    ->label('Product Category')
                    ->options(ProductCategory::all()->pluck('name', 'id'))
                    ->required(),
                Forms\Components\Select::make('product_color_id')
                    ->label('Product Color')
                    ->options(ProductColor::all()->pluck('name', 'id'))
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->nullable()
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('productCategory.name')->label('Category')->sortable(),
                TextColumn::make('productColor.name')->label('Color')->sortable(),
                TextColumn::make('description')->limit(50),
                TextColumn::make('created_at')->dateTime(),
                ViewColumn::make('status_bar')
                    ->view('filament.components.status_bar'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('View')
                    ->icon('heroicon-o-eye')
                    ->url(fn(Product $record) => static::getUrl('view', ['record' => $record->id]))
                    ->openUrlInNewTab(),
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
            TypesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
            'view' => Pages\ViewProduct::route('/{record}/view'),
        ];
    }
}
