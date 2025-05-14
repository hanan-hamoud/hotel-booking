<?php

namespace App\Filament\Resources;

use App\Enums\RoomType;
use App\Enums\RoomStatus;
use App\Models\Room;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\RoomResource\Pages;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('hotel_id')
                    ->relationship('hotel', 'name') 
                    ->required()
                    ->label('الفندق'),

                Forms\Components\TextInput::make('room_number')
                    ->required()
                    ->label('رقم الغرفة'),

                Forms\Components\Select::make('room_type')
                    ->options(
                        collect(RoomType::cases())->mapWithKeys(fn($type) => [
                            $type->value => $type->label(),
                        ])->toArray()
                    )
                    ->required()
                    ->label('نوع الغرفة'),

                Forms\Components\TextInput::make('price_per_night')
                    ->numeric()
                    ->required()
                    ->label('السعر لكل ليلة'),

                Forms\Components\Select::make('status')
                    ->options(
                        collect(RoomStatus::cases())->mapWithKeys(fn($status) => [
                            $status->value => $status->label(),
                        ])->toArray()
                    )
                    ->required()
                    ->label('الحالة'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('room_number')
                    ->label('رقم الغرفة')
                    ->searchable(),

                Tables\Columns\TextColumn::make('room_type')
                    ->label('نوع الغرفة')
                    ->formatStateUsing(fn($state) => RoomType::from($state)->label())
                    ->sortable(),

                Tables\Columns\TextColumn::make('price_per_night')
                    ->label('السعر')
                    ->money('usd') 
                    ->sortable(),

                    Tables\Columns\TextColumn::make('room_type')
                    ->label('نوع الغرفة')
                    ->formatStateUsing(fn($state) => $state->label()) 
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('status')
                    ->label('الحالة')
                    ->formatStateUsing(fn($state) => $state->label()) 
                    ->badge()
                    ->colors([
                        'primary' => 'confirmed',
                        'danger' => 'cancelled',
                        'success' => 'completed',
                    ]),
                

                Tables\Columns\TextColumn::make('hotel.name')
                    ->label('الفندق')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('الغرف');
    }
}
