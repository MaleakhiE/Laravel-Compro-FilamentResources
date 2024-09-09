<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\TypeProjects;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TypeProjectsResource\Pages;
use App\Filament\Resources\TypeProjectsResource\RelationManagers;
use App\Filament\Resources\TypeProjectsResource\Widgets\TypeProjectStat;

class TypeProjectsResource extends Resource
{
    protected static ?string $model = TypeProjects::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Projects Management';

    protected static ?string $navigationLabel = 'Type Projects';

    protected static ?string $navigationIcon = 'heroicon-o-ellipsis-horizontal-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\ToggleColumn::make('status'),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTypeProjects::route('/'),
            'create' => Pages\CreateTypeProjects::route('/create'),
            'edit' => Pages\EditTypeProjects::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            TypeProjectStat::class,
        ];
    }
}
