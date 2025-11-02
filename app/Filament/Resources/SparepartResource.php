<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SparepartResource\Pages;
use App\Filament\Resources\SparepartResource\RelationManagers;
use App\Models\Sparepart;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\KategoriSparepart;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;

class SparepartResource extends Resource
{
    protected static ?string $model = Sparepart::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_sparepart')
                ->placeholder('Masukan Nama Sparepart')
                ->required()
                ->maxLength(255),
                Select::make('kategori_sparepart_id')
                ->label('Kategori Sparepart')
                ->options(function () {
                    return KategoriSparepart::with('kategoriKomponen') // pastikan relasi di model sesuai!
                        ->get()
                        ->mapWithKeys(function ($item) {
                            $kodeKomponen = $item->kategoriKomponen?->kode_komponen;
                            $kodePrefix = $item->kode_prefix;
                            $namaKategori = $item->nama_kategori;

                            // format: ENG-FLT (FILTER)
                            return [
                                $item->id => "{$kodeKomponen}-{$kodePrefix}{$namaKategori}"
                            ];
                        });
                    })
                ->searchable()
                ->required()
                ->placeholder('Pilih kategori sparepart'),
                TextInput::make('number_part')
                ->placeholder('Masukan Number Part')
                ->required()
                ->maxLength(255),
                TextInput::make('alternatif_number')
                ->placeholder('Opsional')                    
                ->maxLength(255),
                Select::make('satuan')
                ->label('Satuan')
                ->options([
                        'pcs' => 'Pcs',
                        'set' => 'Set',
                        'unit' => 'Unit',
                        'liter' => 'Liter',
                        'kg' => 'Kilogram',
                        'meter' => 'Meter',
                        'box' => 'Box',
                        'roll' => 'Roll',
                        'pack' => 'Pack',
                    ])
                ->searchable()
                ->required(),
                Textarea::make('keterangan')
                ->placeholder('Tambahkan Keterangan Jika Ada')
                ->columnSpanFull()
                ->rows(6),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('No')
            ->label('No')
            ->rowIndex(),
            TextColumn::make('kode_sparepart')
            ->label('Kode & Komponen')
            ->getStateUsing(function ($record) {
                    $komponen = $record->kategoriSparepart?->kategoriKomponen?->kode_komponen;
                    return "{$record->kode_sparepart}";
                })
            ->sortable()
            ->searchable(),
                TextColumn::make('nama_sparepart')
                    ->searchable(),
                TextColumn::make('number_part')
                    ->searchable(),
                TextColumn::make('alternatif_number')
                    ->searchable()
                    ->placeholder('Tidak ada'),
                TextColumn::make('satuan')
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
            'index' => Pages\ListSpareparts::route('/'),
            'create' => Pages\CreateSparepart::route('/create'),
            'edit' => Pages\EditSparepart::route('/{record}/edit'),
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
