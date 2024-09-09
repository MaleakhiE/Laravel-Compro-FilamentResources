<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UsersResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UsersResource\RelationManagers;
use App\Filament\Resources\UsersResource\Widgets\UsersStat;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $recordTitleAttribute = 'email';

    protected static ?string $navigationGroup = 'Users Management';

    protected static ?string $navigationLabel = 'Users & Roles';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        Forms\Components\Select::make('role')
                            ->columnSpan(2)
                            ->options([
                                '1' => 'Admin',
                                '0' => 'User',
                            ])
                            ->default('1'),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->unique()
                            ->required()
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password')
                            ->revealable(true)
                            ->password()
                            ->minLength(8)
                            ->same('password_confirmation')
                            ->dehydrateStateUsing(fn($state) => !empty($state) ? bcrypt($state) : null)
                            ->dehydrated(fn($state) => !empty($state))
                            ->required(fn(string $context): bool => $context === 'create'),
                        Forms\Components\TextInput::make('password_confirmation')
                            ->revealable(true)
                            ->password()
                            ->minLength(8)
                            ->dehydrated(false)
                            ->required(fn(string $context): bool => $context === 'create'),
                    ])
                    ->columns(2),
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
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\SelectColumn::make('role')
                    ->options([
                        '1' => 'Admin',
                        '0' => 'User',
                    ])
                    ->searchable()
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\ToggleColumn::make('status')
                    ->searchable()
                    ->sortable()
                    ->alignCenter(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'User',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\ForceDeleteBulkAction::make(),
                Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUsers::route('/create'),
            'edit' => Pages\EditUsers::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            UsersStat::class
        ];
    }
}
