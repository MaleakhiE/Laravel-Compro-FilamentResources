<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\SystemInformation;
use Filament\Forms\Components\Card;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SystemInformationResource\Pages;
use App\Filament\Resources\SystemInformationResource\RelationManagers;

class SystemInformationResource extends Resource
{
    protected static ?string $model = SystemInformation::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'Information System';

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('logo')
                            ->image()
                            ->directory('logo')
                            ->required()
                            ->rule('file'),
                        Forms\Components\TextInput::make('address')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->required()
                            ->maxLength(255)
                            ->tel(),
                        Forms\Components\TextInput::make('email')
                            ->required()
                            ->maxLength(255)
                            ->email(),
                        Forms\Components\TextInput::make('facebook')
                            ->required()
                            ->url()
                            ->default('http://')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('twitter')
                            ->required()
                            ->url()
                            ->default('http://')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('linkedin')
                            ->required()
                            ->url()
                            ->default('http://')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('instagram')
                            ->required()
                            ->url()
                            ->default('http://')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('whatsapp')
                            ->url()
                            ->default('http://')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('copyright')
                            ->required()
                            ->maxLength(255),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('copyright'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListSystemInformation::route('/'),
            'create' => Pages\CreateSystemInformation::route('/create'),
            'edit' => Pages\EditSystemInformation::route('/{record}/edit'),
        ];
    }
}
