<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Projects;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\ProjectsShowCases;
use Filament\Forms\Components\Card;
use App\Filament\Resources\ProjectsShowCaseResource\Pages;
use App\Filament\Resources\ProjectsShowCaseResource\Widgets\ProjectsShowCaseStats;

class ProjectsShowCaseResource extends Resource
{
    protected static ?string $model = ProjectsShowCases::class;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?string $navigationLabel = 'Projects Show Case';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        // Find the highest position in the database
        $highestPosition = ProjectsShowCases::query()->latest('position');

        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\Select::make('status')
                            ->options([
                                '1' => 'Active',
                                '0' => 'Inactive',
                            ])
                            ->default('1')
                            ->required(),
                        Forms\Components\Select::make('position')
                            ->label('Position')
                            ->default($highestPosition->first()->position ?? 1)
                            ->options(range(1, 4))
                            ->required(),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('project_id')
                            ->label('Project')
                            ->options(function () {
                                return Projects::pluck('title', 'id')->toArray();
                            })
                            ->required(),
                        Forms\Components\FileUpload::make('image')
                            ->directory('projects-show-case')
                            ->image(),
                        Forms\Components\TextInput::make('video')
                            ->required()
                            ->maxLength(255)
                            ->rule('url'),
                        Forms\Components\RichEditor::make('description')
                            ->required()
                            ->maxLength(255),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('projects.title')
                    ->searchable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('description')
                    ->alignCenter()
                    ->html(),
                Tables\Columns\TextColumn::make('position')
                    ->alignCenter()
                    ->sortable(),
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
            ])
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
            'index' => Pages\ListProjectsShowCases::route('/'),
            'create' => Pages\CreateProjectsShowCase::route('/create'),
            'edit' => Pages\EditProjectsShowCase::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [

            ProjectsShowCaseStats::class
        ];
    }
}
