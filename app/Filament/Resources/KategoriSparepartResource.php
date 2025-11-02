<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriSparepartResource\RelationManagers;
use App\Models\KategoriKomponen;
use Filament\Forms;
use App\Filament\Resources\KategoriSparepartResource\Pages;
use App\Models\KategoriSparepart;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;

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
                Select::make('kategori_komponen_id') 
                    ->relationship('kategoriKomponen'   , 'nama_komponen'), //KategoriKomponen = nama model nya, nama_komponen =field nya
                TextInput::make('kategori_sparepart')
                    ->required()
                    ->placeholder('kategori sparepart')
                    ->maxLength(100),
                TextInput::make('kode_prefix')
                    ->placeholder('Opsional')
                    ->maxLength(255),
                Textarea::make('deskripsi')
                    ->placeholder('Deskripsi Sparepart')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kategoriKomponen.kode_komponen')
                    ->label('Kode Komponen')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('kode_prefix')
                    ->searchable(),
                TextColumn::make('kategori_sparepart')
                    ->searchable(),
                TextColumn::make('deskripsi')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                EditAction::make(),
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
