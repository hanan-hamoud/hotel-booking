<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HotelResource\Pages;
use App\Filament\Resources\HotelResource\RelationManagers;
use App\Models\Hotel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\NumberInput;
use Filament\Forms\Components\JsonInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;
class HotelResource extends Resource
{
    protected static ?string $model = Hotel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('اسم الفندق')
                    ->required()
                    ->maxLength(255),
    
                Textarea::make('location')
                    ->label('الموقع')
                    ->required(),
    
                Textarea::make('description')
                    ->label('الوصف')
                    ->nullable(),
    
                TextInput::make('number_of_rooms')
                    ->label('عدد الغرف')
                    ->numeric()
                    ->required()
                    ->rule('min:1')
                    ->rule('max:9999'),
    
                TextInput::make('phone')
                    ->label('رقم الهاتف')
                    ->nullable()
                    ->helperText('ادخل رقم الهاتف'),
    
                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->nullable()
                    ->helperText('ادخل البريد الإلكتروني'),
            ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->label('اسم الفندق'),
    
                TextColumn::make('location')
                    ->label('الموقع'),
    
                TextColumn::make('number_of_rooms')
                    ->label('عدد الغرف'),
    
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('تاريخ الإنشاء'),
    
                    TextColumn::make('contact_info')
                    ->label('تفاصيل الاتصال')
                    // ->formatStateUsing(function ($state) {
                    //     $contact_info = json_decode($state, true);
                
                    //     $phone = isset($contact_info['phone']) ? $contact_info['phone'] : 'غير متوفر';
                    //     $email = isset($contact_info['email']) ? $contact_info['email'] : 'غير متوفر';
                
                    //     return "الهاتف: $phone، البريد الإلكتروني: $email";
                    // })
                
            
            
            ])
            ->filters([ 
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), 
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
            'index' => Pages\ListHotels::route('/'),
            'create' => Pages\CreateHotel::route('/create'),
            'edit' => Pages\EditHotel::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('الفنادق');  
    }

    public static function saving($record)
    {
        if ($record->phone && $record->email) {
            $contact_info = [
                'phone' => $record->phone,
                'email' => $record->email
            ];
    
            $record->contact_info = json_encode($contact_info);
    
            $record->phone = null;
            $record->email = null;
        }
    }
    

}

