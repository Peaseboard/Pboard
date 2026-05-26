<?php
namespace App\Filament\CreateUser;

use App\Filament\CreateUser;
use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
;
protected static string $resource = UserResource::class;
}