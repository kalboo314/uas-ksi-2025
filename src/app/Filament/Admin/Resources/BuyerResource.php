<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\BuyerResource\Pages;
use App\Filament\Admin\Resources\BuyerResource\RelationManagers;
use App\Models\Buyer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BuyerResource extends Resource
{
    protected static ?string $model = Buyer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Buyers';
    protected static ?string $pluralModelLabel = 'Buyers';
    protected static ?string $modelLabel = 'Buyer';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(100),

            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(100),

            Forms\Components\TextInput::make('phone')
                ->tel()
                ->required()
                ->maxLength(20),

            Forms\Components\Textarea::make('address')
                ->maxLength(255)
                ->rows(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('email')
                ->sortable(),

            Tables\Columns\TextColumn::make('phone'),

            Tables\Columns\TextColumn::make('address')
                ->limit(30),
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
            'index' => Pages\ListBuyers::route('/'),
            'create' => Pages\CreateBuyer::route('/create'),
            'edit' => Pages\EditBuyer::route('/{record}/edit'),
        ];
    }
}
