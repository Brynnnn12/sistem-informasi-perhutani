<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlantResource\Pages;
use App\Filament\Resources\PlantResource\RelationManagers;
use App\Models\Plant;
use App\Models\Forest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PlantResource extends Resource
{
    protected static ?string $model = Plant::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationLabel = 'Tanaman';

    protected static ?string $modelLabel = 'Tanaman';

    protected static ?string $pluralModelLabel = 'Data Tanaman';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Manajemen Data';

    // Hanya admin dan petugas yang bisa akses
    public static function canAccess(): bool
    {
        return Auth::user()?->hasAnyRole(['admin', 'petugas']) ?? false;
    }

    public static function canCreate(): bool
    {
        return Auth::user()?->hasAnyRole(['admin', 'petugas']) ?? false;
    }

    public static function canEdit($record): bool
    {
        return Auth::user()?->hasAnyRole(['admin', 'petugas']) ?? false;
    }

    public static function canDelete($record): bool
    {
        return Auth::user()?->hasRole('admin') ?? false;
    }

    public static function canView($record): bool
    {
        return Auth::user()?->hasAnyRole(['admin', 'petugas', 'masyarakat']) ?? false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('forest_id')
                    ->label('Hutan')
                    ->relationship('forest', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('name')
                    ->label('Nama Tanaman')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Jati, Mahoni'),

                Forms\Components\Select::make('type')
                    ->label('Jenis Tanaman')
                    ->required()
                    ->options([
                        'kayu_keras' => 'Kayu Keras',
                        'kayu_lunak' => 'Kayu Lunak',
                        'tanaman_endemik' => 'Tanaman Endemik',
                    ]),

                Forms\Components\TextInput::make('quantity')
                    ->label('Kuantitas')
                    ->required()
                    ->numeric()
                    ->minValue(0)
                    ->suffix('pohon'),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->placeholder('Deskripsi tambahan tentang tanaman')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('forest.name')
                    ->label('Hutan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Tanaman')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('type')
                    ->label('Jenis')
                    ->colors([
                        'success' => 'kayu_keras',
                        'warning' => 'kayu_lunak',
                        'info' => 'tanaman_endemik',
                    ])
                    ->formatStateUsing(function (string $state): string {
                        return match ($state) {
                            'kayu_keras' => 'Kayu Keras',
                            'kayu_lunak' => 'Kayu Lunak',
                            'tanaman_endemik' => 'Tanaman Endemik',
                            default => $state,
                        };
                    }),

                Tables\Columns\TextColumn::make('quantity')
                    ->label('Kuantitas')
                    ->numeric()
                    ->suffix(' pohon')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('forest_id')
                    ->label('Hutan')
                    ->relationship('forest', 'name'),

                Tables\Filters\SelectFilter::make('type')
                    ->label('Jenis Tanaman')
                    ->options([
                        'kayu_keras' => 'Kayu Keras',
                        'kayu_lunak' => 'Kayu Lunak',
                        'tanaman_endemik' => 'Tanaman Endemik',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListPlants::route('/'),
            'create' => Pages\CreatePlant::route('/create'),
            'edit' => Pages\EditPlant::route('/{record}/edit'),
        ];
    }
}
