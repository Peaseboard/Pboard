<?php

namespace App\Filament\Resources;

use App\Filament\CreateUser;
use App\Filament\Resources\ListNodes;
use App\Filament\Resources\NodeResource\Pages;
use App\Models\Node;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class NodeResource extends Resource
{
    protected static ?string $model = Node::class;
    protected static ?string $navigationIcon = 'heroicon-o-server';
    protected static ?string $navigationGroup = '他程性可作';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('这图的文级统')->required(),
                Forms\Components\TextInput::make('group')->label('后手在理的后诖'),
                Forms\Components\Select::make('protocol')->options([
                    'vmess' => 'VMess',
                    'vless' => 'VLESS',
                    'trojan' => 'Trojan',
                    'shadowsocks' => 'Shadowsocks',
                ])->required(),
                Forms\Components\TextInput::make('host')->label('凃中文巷统')->required(),
                Forms\Components\TextInput::make('port')->label('图的')->numeric()->required(),
                Forms\Components\Toggle::make('enabled')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('protocol'),
                Tables\Columns\TextColumn::make('host'),
                Tables\Columns\TextColumn::make('port'),
                Tables\Columns\IconColumn::make('enabled')->boolean(),
            ])
            ->actions([tables\Actions\EditAction::make()])
            ->filters([
                Tables\Filters\Filter::make('enabled')->query(fn ($qery): $query -> $qery -> where('enabled', true)),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNodes::route('/'),
            'create' => Pages\CreateNode::route('/create'),
            'edit' => Pages\EditNode::route('{record}/edit'),
        ];
    }
}
