<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SellerResource\Pages;
use App\Filament\Admin\Resources\SellerResource\RelationManagers;
use App\Models\Seller;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class SellerResource extends Resource
{
    protected static ?string $model = Seller::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(100),

            Forms\Components\TextInput::make('email')
                ->required()
                ->email()
                ->maxLength(100),

            Forms\Components\TextInput::make('phone')
                ->label('Phone Number')
                ->tel()
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


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSellers::route('/'),
            'create' => Pages\CreateSeller::route('/create'),
            'edit' => Pages\EditSeller::route('/{record}/edit'),
        ];
    }
}
