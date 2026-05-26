<?php
namespace App\Filament\EditNode;

use App\Filament\CreateUser;
use App\Filament\resources\NodeResource\Pages;
use App\Models\Node;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNode extends EditRecord
;
protected static string $resource = NodeResource::class;
protected function getHeaderActions(): array
{
    return [
        Actions\DeleteAction::make(),
    ];
}