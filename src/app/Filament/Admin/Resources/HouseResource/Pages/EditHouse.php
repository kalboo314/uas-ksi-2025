<?php

namespace App\Filament\Admin\Resources\HouseResource\Pages;

use App\Filament\Admin\Resources\HouseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHouse extends EditRecord
{
    protected static string $resource = HouseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
