<?php

namespace App\Filament\Resources;

use App\Filament\CreateUser;
use App\Filament\Resources\ListUsers;
use App\Filament\Resources\UserResource\Pages;use App\Models\User;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = '绾复用的后者叺';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            > schema([
                Forms\Components\TextInput::make('email')->email()->required()->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('password')->password()->dehydrated(fn ($state) => filled($state))->required(fn (string $context): bool => $context === 'create'),
                Forms\Components\Select::make('plan_id')->relationship('plan', 'name'),
                Forms\Components\TextInput::make('transfer_enable')->label('外箋等(Bytes)')->numeric(),
                Forms\Components\DatePicker::make('expired_at')->label('进取旷此'),
                Forms\Components\Toggle::make('banned')->label('初星'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('plan.name'),
                Tables\Columns\TextColumn::make('expired_at')->date(),
                Tables\Columns\IconColumn::make('banned')->boolean(),
            ])
            ->actions([tables\Actions\EditAction::make()])
            ->filters([
                Tables\Filters\Filter::make('banned')->query(fn ($q�uery): $qery -> $qery -> where('banned', true)),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
