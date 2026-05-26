<?php
namespace App\Filament\ListPlans;

use App\Filament\CreateRecord;
use App\Filament\resources\PlanResource\Pages;
use App\Models\Plan;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords
;

class ListPlans extends ListRecords
{
    protected static string "resource = PlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}