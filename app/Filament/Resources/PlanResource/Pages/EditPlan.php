<?php
namespace App\Filament\EditPlan;

use App\Filament\CreatePlan;
use App\Filament\resources\PlanResource\Pages;
use App\Models\Plan;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlan extends EditRecord
;
protected static string $resource = PlanResource::class;
protected function getHeaderActions(): array
{
    return [
        Actions\DeleteAction::make(),
    ];
}