<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function getInfolist(string $name): ?Infolist
    {
        return Infolist::make()
            ->record($this->record)
            ->schema([
                TextEntry::make('name')->label('Name')->weight('bold'),
                TextEntry::make('description')->label('This Description')->columnSpanFull(),
                TextEntry::make('productCategory.name')->label('Category'),
                TextEntry::make('productColor.name')->label('Color'),
            ]);
    }

    public function getTitle(): string
    {
        return 'View Product';
    }

    public function getBreadcrumbs(): array
    {
        return [
            url('/admin/products') => 'Products',
            '' => 'View',
        ];
    }
}
