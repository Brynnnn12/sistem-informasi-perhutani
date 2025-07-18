<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ForestResource\Pages;
use App\Filament\Resources\ForestResource\RelationManagers;
use App\Models\Forest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ForestResource extends Resource
{
    protected static ?string $model = Forest::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationLabel = 'Hutan';

    protected static ?string $modelLabel = 'Hutan';

    protected static ?string $pluralModelLabel = 'Data Hutan';

    protected static ?int $navigationSort = 1;

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
                Forms\Components\TextInput::make('name')
                    ->label('Nama Hutan')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Hutan Gunung Slamet'),

                Forms\Components\Textarea::make('location')
                    ->label('Lokasi')
                    ->required()
                    ->placeholder('Alamat lengkap atau koordinat GPS')
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('area_size')
                    ->label('Luas Area (Hektar)')
                    ->required()
                    ->numeric()
                    ->step(0.01)
                    ->suffix('Ha'),

                Forms\Components\Select::make('status')
                    ->label('Status Hutan')
                    ->required()
                    ->options([
                        'active' => 'Aktif',
                        'protected' => 'Lindung',
                        'damaged' => 'Rusak',
                    ])
                    ->default('active'),

                Forms\Components\Select::make('forest_type')
                    ->label('Jenis Hutan')
                    ->required()
                    ->options([
                        'konservasi' => 'Konservasi',
                        'produksi' => 'Produksi',
                        'lindung' => 'Lindung',
                        'wisata' => 'Wisata',
                    ])
                    ->default('konservasi'),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->placeholder('Deskripsi kondisi dan karakteristik hutan')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Hutan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('location')
                    ->label('Lokasi')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),

                Tables\Columns\TextColumn::make('area_size')
                    ->label('Luas (Ha)')
                    ->numeric(decimalPlaces: 2)
                    ->suffix(' Ha')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'active',
                        'warning' => 'protected',
                        'danger' => 'damaged',
                    ])
                    ->formatStateUsing(function (string $state): string {
                        return match ($state) {
                            'active' => 'Aktif',
                            'protected' => 'Lindung',
                            'damaged' => 'Rusak',
                            default => $state,
                        };
                    }),

                Tables\Columns\BadgeColumn::make('forest_type')
                    ->label('Jenis')
                    ->colors([
                        'success' => 'konservasi',
                        'warning' => 'produksi',
                        'info' => 'lindung',
                        'danger' => 'wisata',
                    ])
                    ->formatStateUsing(function (string $state): string {
                        return match ($state) {
                            'konservasi' => 'Konservasi',
                            'produksi' => 'Produksi',
                            'lindung' => 'Lindung',
                            'wisata' => 'Wisata',
                            default => $state,
                        };
                    }),

                Tables\Columns\TextColumn::make('plants_count')
                    ->label('Jumlah Tanaman')
                    ->counts('plants')
                    ->suffix(' jenis'),

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
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status Hutan')
                    ->options([
                        'active' => 'Aktif',
                        'protected' => 'Lindung',
                        'damaged' => 'Rusak',
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
            'index' => Pages\ListForests::route('/'),
            'create' => Pages\CreateForest::route('/create'),
            'edit' => Pages\EditForest::route('/{record}/edit'),
        ];
    }
}
