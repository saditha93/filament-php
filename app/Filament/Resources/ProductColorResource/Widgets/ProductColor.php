<?php

namespace App\Filament\Resources\ProductColorResource\Widgets;

use App\Filament\Resources\ProductCategoryResource;
use App\Filament\Resources\ProductColorResource;
use App\Filament\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductCategory;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductColor extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make("Product Color",\App\Models\ProductColor::count())
            ->description("Product Colors Count")
            ->descriptionIcon('heroicon-o-swatch',IconPosition::Before)
            ->url(ProductColorResource::getUrl())
            ->color(Color::Blue),

            Stat::make("Product Categories", ProductCategory::count())
                ->description("Product Categories Count")
                ->descriptionIcon('heroicon-o-tag',IconPosition::Before)
                ->url(ProductCategoryResource::getUrl())
                ->color(Color::Red),

            Stat::make("Products", Product::count())
                ->description("Product Count")
                ->descriptionIcon('heroicon-o-building-storefront',IconPosition::Before)
                ->url(ProductResource::getUrl())
                ->color(Color::Green)
        ];
    }
}
