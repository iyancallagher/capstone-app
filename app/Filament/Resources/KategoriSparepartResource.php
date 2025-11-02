<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriSparepartResource\Pages;
use App\Filament\Resources\KategoriSparepartResource\RelationManagers;
use App\Models\KategoriSparepart;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KategoriSparepartResource extends Resource
{
    protected static ?string $model = KategoriSparepart::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
        public static function getNavigationGroup(): ?string
    {
        return 'Table Master'; // misalkan Sparepart masuk sini
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kategori_komponen_id') 
                ->relationship('kategoriKomponen', 'nama_komponen'),
                Forms\Components\TextInput::make('kategori_sparepart')
                    ->required()
                    ->placeholder('kategori sparepart')
                    ->maxLength(100),
                Forms\Components\TextInput::make('kode_prefix')
                    ->placeholder('Opsional')
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi')
                    ->placeholder('Deskripsi Sparepart')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kategoriKomponen.kode_komponen')
                    ->label('Kode Komponen')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kode_prefix')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori_sparepart')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deskripsi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListKategoriSpareparts::route('/'),
            'create' => Pages\CreateKategoriSparepart::route('/create'),
            'edit' => Pages\EditKategoriSparepart::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
