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
                            ->action(fn($get, $set) => self::fetchAddress($get, $set))
                            ->color('primary')
                    ),

                TextInput::make('suburb')
                    ->label('Suburb')
                    ->required(),

                TextInput::make('street_number')
                    ->label('Street Number')
                    ->dehydrated(false),

                TextInput::make('street_type')
                    ->label('Street Type')
                    ->dehydrated(false),

                TextInput::make('postcode')
                    ->label('Postcode')
                    ->required(),

                TextInput::make('state')
                    ->label('State')
                    ->required(),

                TextInput::make('company_id')
                    ->label('Company Id')
                    ->dehydrated(false),

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

    public static function fetchAddress(callable $get, callable $set)
    {
        $streetName = $get('street_name');
        $postcode = $get('postcode');
        $state = $get('state');
        $suburb = $get('suburb');
        $streetType = $get('street_type');
        $streetNumber = $get('street_number');
        $companyId = $get('company_id');

        if (empty($streetName)) {
            return;
        }

        $service = new AddressService();
        $result = $service->findAddress($companyId, $streetName, $suburb, $postcode, $state, $streetType, $streetNumber);

        if (!empty($result)) {
            $set('suburb', $result[0]['Address'] ?? '');
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
