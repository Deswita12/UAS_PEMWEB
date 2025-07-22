<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PelatihResource\Pages;
use App\Filament\Admin\Resources\PelatihResource\RelationManagers;
use App\Models\Pelatih;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PelatihResource extends Resource
{
    protected static ?string $model = Pelatih::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

     public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama_pelatih')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->email()
                ->maxLength(255),
            Forms\Components\TextInput::make('no_hp')
                ->tel()
                ->maxLength(20),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('nama_pelatih')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('email'),
            Tables\Columns\TextColumn::make('no_hp'),
            Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            // kamu bisa tambahkan relasi ke Product di sini nanti
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPelatihs::route('/'),
            'create' => Pages\CreatePelatih::route('/create'),
            'edit' => Pages\EditPelatih::route('/{record}/edit'),
        ];
    }

}
