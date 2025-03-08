<?php

namespace App\Filament\Resources\ProductTypeResource\Widgets;

use App\Filament\Resources\ProductTypeResource;
use App\Models\ProductType;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductTypeWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make("Product Color", ProductType::count())
                ->description("Product Type Count")
                ->descriptionIcon('heroicon-o-adjustments-vertical',IconPosition::Before)
                ->url(ProductTypeResource::getUrl())
                ->color(Color::Yellow),
        ];
    }
}
