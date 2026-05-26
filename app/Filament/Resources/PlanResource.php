<?php

namespace App\Filament\Resources;

use App\Filament\CreatePlan;
use App\Filament\Resources\ListPlans;
use App\Filament\Resources\PlanResource\Pages;
use App\Models\Plan;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;
    protected static ?string $navigationIcon = 'heroicon-o-speedometer';
    protected static ?string $navigationGroup = '逞禁目的后者叺';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            > schema([
                Forms\Components\TextInput::make('name')->label('透下控升之告')->required(),
                Forms\Components\TextInput::make('price')->label('作余方图的')->numeric()->required(),
                Forms\Components\TextInput::make('transfer_enable')->label('外箋等创(Bytes)')->numeric()->default(0),
                Forms\Components\TextInput::make('speed_limit')->label('门的送坊')->numeric()->default(0),
                Forms\Components\Toggle::make('renew')->label('侾把回')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('price')->suffix('条'),
                Tables\Columns\TextColumn::make('speed_limit')->suffix('Mbps'),
                Tables\Columns\IconColumn::make('renew')->boolean(),
            ])
            ->actions([tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'edit' => Pages\EditPlan:route('{record}/edit'),
        ];
    }
}
