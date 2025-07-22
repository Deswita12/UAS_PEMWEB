<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PesertaResource\Pages;
use App\Filament\Admin\Resources\PesertaResource\RelationManagers;
use App\Models\Peserta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;

    class PesertaResource extends Resource
{
    protected static ?string $model = Peserta::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_peserta')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('kelas_id')
                    ->relationship('kelas', 'nama_kelas')
                    ->required(),

                Forms\Components\Select::make('sesi')
                    ->options([
                        'pagi' => 'Pagi',
                        'malam' => 'Malam',
                    ])
                    ->required(),

                // Select::make('pelatih_id')
                // ->relationship('pelatih', 'nama_pelatih') // SESUAI NAMA KOLOM DI DB

            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_peserta')
                    ->label('Nama Peserta')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('kelas.nama_kelas') // ini dari relasi 'kelas()'
                    ->label('Kelas')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('sesi')
                    ->label('Sesi')
                    ->sortable(),

                TextColumn::make('kelas.pelatih.nama_pelatih')
                    ->label('Pelatih')
                    ->sortable()
                    ->searchable(),

            ]);
    }


    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPeserta::route('/'),
            'create' => Pages\CreatePeserta::route('/create'),
            'edit' => Pages\EditPeserta::route('/{record}/edit'),
        ];
    }
}
