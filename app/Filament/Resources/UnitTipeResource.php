<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UnitTipeResource\Pages;
use App\Filament\Resources\UnitTipeResource\RelationManagers;
use App\Models\UnitTipe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UnitTipeResource extends Resource
{
    protected static ?string $model = UnitTipe::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
        public static function getNavigationGroup(): ?string
    {
        return 'Table Master'; // misalkan Sparepart masuk sini
    }
        public static function getNavigationLabel(): string
    {
        return 'Tipe Unit'; 
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_tipe')
                    ->required()
                    ->maxLength(255),
                Textarea::make('deskripsi')
                    ->columnSpanFull(),
                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')
                ->label('No')
                ->rowIndex(),
                TextColumn::make('nama_tipe')
                ->label('Tipe Unit')
                ->searchable(),
                TextColumn::make('deskripsi')
                ->searchable()
                ->placeholder('Tidak Ada Deskripsi'),
                TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUnitTipes::route('/'),
            'create' => Pages\CreateUnitTipe::route('/create'),
            'edit' => Pages\EditUnitTipe::route('/{record}/edit'),
        ];
    }
}
