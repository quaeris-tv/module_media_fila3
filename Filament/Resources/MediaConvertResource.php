<?php

namespace Modules\Media\Filament\Resources;

use Modules\Media\Filament\Resources\MediaConvertResource\Pages;
use Modules\Media\Filament\Resources\MediaConvertResource\RelationManagers;
use App\Models\MediaConvert;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MediaConvertResource extends Resource
{
    protected static ?string $model = MediaConvert::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListMediaConverts::route('/'),
            'create' => Pages\CreateMediaConvert::route('/create'),
            'edit' => Pages\EditMediaConvert::route('/{record}/edit'),
        ];
    }
}
