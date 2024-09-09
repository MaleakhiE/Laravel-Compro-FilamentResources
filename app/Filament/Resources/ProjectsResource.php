<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Clients;
use App\Models\Projects;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\TypeProjects;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\ProjectsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProjectsResource\RelationManagers;
use App\Filament\Resources\ProjectsResource\Widgets\ProjectsStats;

class ProjectsResource extends Resource
{
    protected static ?string $model = Projects::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'Projects Management';

    protected static ?string $navigationLabel = 'Projects';

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    public static function form(Form $form): Form
    {
        // Fetch clients
        $clients = Clients::all();
        $clientOptions = [];

        foreach ($clients as $client) {
            $clientOptions[$client->id] = $client->name;
        }

        $type_projects = TypeProjects::all();
        $type_projectOptions = [];

        foreach ($type_projects as $type_project) {
            $type_projectOptions[$type_project->id] = $type_project->name;
        }
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('client_id')
                            ->label('Client')
                            ->options($clientOptions)
                            ->searchable()
                            ->required(),
                        Forms\Components\Select::make('projects.name')
                            ->label('Type Project')
                            ->options($type_projectOptions)
                            ->searchable()
                            ->required(),
                        Forms\Components\TextInput::make('description')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('link')
                            ->required()
                            ->url()
                            ->default('http://')
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('image')
                            ->directory('projects')
                            ->image()
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/gif'])
                            ->rule('file'),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client Name')
                    ->searchable()
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('type.name')
                    ->label('Type Project')
                    ->searchable()
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('link')
                    ->searchable()
                    ->alignCenter(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProjects::route('/create'),
            'edit' => Pages\EditProjects::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            ProjectsStats::class
        ];
    }
}
