<?php
namespace App\Filament\EditUser;

use App\Filament\CreateUser;
use App\Filament\resources\UserResource\Pages;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
;
protected static string $resource = UserResource::class;
protected function getHeaderActions(): array
{
    return [
        Actions\DeleteAction::make(),
    ];
}