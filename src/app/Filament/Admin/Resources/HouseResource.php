<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\HouseResource\Pages;
use App\Filament\Admin\Resources\HouseResource\RelationManagers;
use App\Models\House;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HouseResource extends Resource
{
    protected static ?string $model = House::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Houses';
    protected static ?string $pluralModelLabel = 'Houses';
    protected static ?string $modelLabel = 'House';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(100),

            Forms\Components\Textarea::make('description')
                ->maxLength(255)
                ->rows(3),

            Forms\Components\TextInput::make('price')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('address')
                ->required(),

            Forms\Components\TextInput::make('land_area')
                ->label('Land Area (m²)')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('building_area')
                ->label('Building Area (m²)')
                ->numeric()
                ->required(),

            Forms\Components\Select::make('seller_id')
                ->relationship('seller', 'name')
                ->label('Seller')
                ->required()
                ->searchable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('price')->money('IDR', true),
            Tables\Columns\TextColumn::make('address')->limit(30),
            Tables\Columns\TextColumn::make('seller.name')->label('Seller'),
            Tables\Columns\TextColumn::make('land_area')->label('Land (m²)'),
            Tables\Columns\TextColumn::make('building_area')->label('Building (m²)'),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHouses::route('/'),
            'create' => Pages\CreateHouse::route('/create'),
            'edit' => Pages\EditHouse::route('/{record}/edit'),
        ];
    }
}
