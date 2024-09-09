<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Menu;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MenuResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MenuResource\RelationManagers;
use Wiebenieuwenhuis\FilamentCodeEditor\Components\CodeEditor;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Information System';

    protected static ?string $navigationLabel = 'Menu';

    protected static ?string $navigationIcon = 'heroicon-o-ellipsis-horizontal-circle';

    public static function form(Form $form): Form
    {

        // Find the highest position in the database
        $highestPosition = Menu::query()->latest('position');

        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                '1' => 'Active',
                                '0' => 'Inactive',
                            ])
                            ->default('1'),
                        Forms\Components\Select::make('position')
                            ->label('Position')
                            ->default($highestPosition->first()->position ?? 0)
                            ->options(range(1, 10)),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        CodeEditor::make('code_menu')
                            ->label('Menu - Code Structure')
                            ->required(),
                        CodeEditor::make('code_structure')
                            ->label('Main Structure - Code')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('position')
                    ->label('Position')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('status'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([])
            ->reorderable('position');
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
