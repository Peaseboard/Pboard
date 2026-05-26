<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;
    protected static ?string $navigationIcon = heroicon-o-credit-card;
    protected static ?string $navigationGroup = 财务管理;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(trade_no)->searchable(),
                Tables\Columns\TextColumn::make(user.email)->searchable(),
                Tables\Columns\TextColumn::make(total_amount)->prefix(¥),
                Tables\Columns\TextColumn::make(status)
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        paid => success,
                        pending => warning,
                        cancelled => danger,
                    }),
                Tables\Columns\TextColumn::make(payment_method),
                Tables\Columns\TextColumn::make(created_at)->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make(status)
                    ->options([
                        pending => Pending,
                        paid => Paid,
                        cancelled => Cancelled,
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            index => Pages\ListOrders::route(/),
        ];
    }
}
