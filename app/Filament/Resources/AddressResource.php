<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AddressResource\Pages;
use App\Models\Address;
use App\Services\AddressService;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use Filament\Forms\Components\Actions\Action;

// ✅ Correct import

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;
    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('street_name')
                    ->label('Street Name')
                    ->required()
                    ->suffixAction(
                        Action::make('fetch_address')
                            ->label('Fetch')
                            ->icon('heroicon-o-magnifying-glass')
                            ->action(fn($state, $set) => self::fetchAddress($state, $set))
                            ->color('primary')
                    ),

                TextInput::make('suburb')
                    ->label('Suburb')
                    ->required(),

                TextInput::make('postcode')
                    ->label('Postcode')
                    ->required(),

                TextInput::make('state')
                    ->label('State')
                    ->required(),

                TextInput::make('directory_id')
                    ->label('Directory ID')
                    ->suffixAction(
                        Action::make('qualify_service')
                            ->label('Check')
                            ->icon('heroicon-o-magnifying-glass')
                            ->action(fn($state, $set) => self::qualifyService($state, $set))
                            ->color('success')
                    ),
            ]);
    }

    public static function fetchAddress($state, callable $set)
    {
        $service = new AddressService();
        $result = $service->findAddress(
            $state,
            null,
            '3000',
            'VIC'
        );

        if (!empty($result)) {
            $set('suburb', $result[0]['Address'] ?? ''); // Autofill suburb
            $set('directory_id', $result[0]['DirectoryIdentifier'] ?? '');
        } else {
            $set('suburb', '');
            $set('directory_id', '');
        }
    }

    public static function qualifyService($state, callable $set)
    {
        $service = new AddressService();
        $result = $service->qualifyService($state);

        if ($result['result'] === 'Success') {
            $set('service_type', $result['data'][0]->ServiceType ?? 'Unknown');
        } else {
            $set('service_type', '');
        }
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('street_name')->label('Street Name'),
                TextColumn::make('suburb')->label('Suburb'),
                TextColumn::make('postcode')->label('Postcode'),
                TextColumn::make('state')->label('State'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAddresses::route('/'),
            'create' => Pages\CreateAddress::route('/create'),
            'edit' => Pages\EditAddress::route('/{record}/edit'),
        ];
    }
}
