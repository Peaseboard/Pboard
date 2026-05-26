<?php
namespace App\Filament\ListNodes;

use App\Filament\CreateRecord;
use App\Filament\resources\NodeResource\Pages;
use App\Models\Node;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords
;

class ListNodes extends ListRecords
{
    protected static string "resource = NodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}