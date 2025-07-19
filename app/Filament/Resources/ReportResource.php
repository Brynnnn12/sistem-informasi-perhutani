<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Filament\Resources\ReportResource\RelationManagers;
use App\Models\Report;
use App\Models\Forest;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ReportResource extends Resource
{
    protected static ?string $model = Report::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-triangle';

    protected static ?string $navigationLabel = 'Laporan';

    protected static ?string $modelLabel = 'Laporan';

    protected static ?string $pluralModelLabel = 'Data Laporan';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Aktivitas';

    // Semua role bisa akses laporan
    public static function canAccess(): bool
    {
        return Auth::user()?->hasAnyRole(['admin', 'petugas', 'masyarakat']) ?? false;
    }

    public static function canCreate(): bool
    {
        return Auth::user()?->hasAnyRole(['admin', 'petugas', 'masyarakat']) ?? false;
    }

    public static function canEdit($record): bool
    {
        $user = Auth::user();
        // Admin dan petugas bisa edit semua, masyarakat hanya bisa edit milik sendiri yang masih pending
        if ($user?->hasAnyRole(['admin', 'petugas'])) {
            return true;
        }
        return $user?->hasRole('masyarakat') && $record->user_id === $user->id && $record->status === 'pending';
    }

    public static function canDelete($record): bool
    {
        $user = Auth::user();
        // Admin bisa delete semua, masyarakat hanya bisa delete milik sendiri yang masih pending
        if ($user?->hasRole('admin')) {
            return true;
        }
        return $user?->hasRole('masyarakat') && $record->user_id === $user->id && $record->status === 'pending';
    }

    public static function canView($record): bool
    {
        $user = Auth::user();
        // Admin dan petugas bisa lihat semua, masyarakat hanya bisa lihat milik sendiri
        if ($user?->hasAnyRole(['admin', 'petugas'])) {
            return true;
        }
        return $user?->hasRole('masyarakat') && $record->user_id === $user->id;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('user_id')
                    ->default(function () {
                        return Auth::id();
                    }),

                Forms\Components\Hidden::make('status')
                    ->default('pending')
                    ->visible(fn(string $context) => $context === 'create'),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Menunggu',
                        'in_progress' => 'Dalam Proses',
                        'resolved' => 'Selesai',
                    ])
                    ->default('pending')
                    ->visible(fn(string $context) => $context === 'edit' && Auth::user()?->hasAnyRole(['admin', 'petugas'])),

                Forms\Components\Select::make('forest_id')
                    ->label('Lokasi Hutan')
                    ->relationship('forest', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\TextInput::make('title')
                    ->label('Judul Laporan')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Kebakaran Hutan, Illegal Logging'),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->placeholder('Jelaskan detail kejadian yang dilaporkan')
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('photo')
                    ->label('Foto Bukti')
                    ->image()
                    ->directory('report-photos')
                    ->disk('public')
                    ->visibility('public')
                    ->maxSize(5120) // 5MB
                    ->helperText('Upload foto sebagai bukti laporan. Maksimal 5MB'),

                Forms\Components\DateTimePicker::make('reported_at')
                    ->label('Tanggal Laporan')
                    ->required()
                    ->default(now())
                    ->disabled(fn(string $context) => $context === 'edit'),

                Forms\Components\DateTimePicker::make('verified_at')
                    ->label('Tanggal Verifikasi')
                    ->visible(fn(Forms\Get $get) => in_array($get('status'), ['in_progress', 'resolved'])),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pelapor')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('forest.name')
                    ->label('Lokasi Hutan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Laporan')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto Bukti')
                    ->disk('public')
                    ->size(50)
                    ->square(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'in_progress' => 'info',
                        'resolved' => 'success',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending' => 'Menunggu',
                        'in_progress' => 'Dalam Proses',
                        'resolved' => 'Selesai',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('reported_at')
                    ->label('Tanggal Laporan')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('verified_at')
                    ->label('Tanggal Verifikasi')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('Belum diverifikasi'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diupdate Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Menunggu',
                        'in_progress' => 'Dalam Proses',
                        'resolved' => 'Selesai',
                    ]),
                Tables\Filters\SelectFilter::make('forest_id')
                    ->label('Lokasi Hutan')
                    ->relationship('forest', 'name'),
            ])
            ->headerActions([
                Tables\Actions\Action::make('printAllData')
                    ->label('Cetak Semua Data PDF')
                    ->icon('heroicon-o-document-text')
                    ->color('info')
                    ->action(function () {
                        $reports = static::getEloquentQuery()->with(['user', 'forest'])->get();

                        return response()->streamDownload(function () use ($reports) {
                            echo app('dompdf.wrapper')
                                ->loadView('pdf.reports-bulk', ['reports' => $reports])
                                ->setPaper('a4', 'portrait')
                                ->stream();
                        }, 'semua-laporan-' . now()->format('Y-m-d') . '.pdf');
                    })
                    ->tooltip('Download semua laporan dalam satu PDF'),
            ])
            ->actions([
                Tables\Actions\Action::make('updateStatus')
                    ->label('Update Status')
                    ->icon('heroicon-m-pencil-square')
                    ->color('warning')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Menunggu',
                                'in_progress' => 'Dalam Proses',
                                'resolved' => 'Selesai',
                            ])
                            ->required(),
                        Forms\Components\DateTimePicker::make('verified_at')
                            ->label('Tanggal Verifikasi')
                            ->default(now()),
                    ])
                    ->action(function (Report $record, array $data): void {
                        $record->update([
                            'status' => $data['status'],
                            'verified_at' => $data['verified_at'],
                        ]);
                    })
                    ->visible(fn() => Auth::user()?->hasAnyRole(['admin', 'petugas']))
                    ->requiresConfirmation(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('printAllPDF')
                        ->label('Cetak PDF Semua')
                        ->icon('heroicon-o-printer')
                        ->color('success')
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            // Load relationships for all records
                            $records->load(['user', 'forest']);

                            return response()->streamDownload(function () use ($records) {
                                echo app('dompdf.wrapper')
                                    ->loadView('pdf.reports-bulk', ['reports' => $records])
                                    ->setPaper('a4', 'portrait')
                                    ->stream();
                            }, 'laporan-bulk-' . now()->format('Y-m-d') . '.pdf');
                        })
                        ->deselectRecordsAfterCompletion()
                        ->tooltip('Download laporan terpilih dalam satu PDF'),
                ]),
            ]);
    }

    // Filter data berdasarkan role
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = Auth::user();

        // Admin dan petugas bisa lihat semua data
        if ($user?->hasAnyRole(['admin', 'petugas'])) {
            return $query;
        }

        // Masyarakat hanya bisa lihat data milik sendiri
        if ($user?->hasRole('masyarakat')) {
            return $query->where('user_id', $user->id);
        }

        return $query;
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
            'index' => Pages\ListReports::route('/'),
            'create' => Pages\CreateReport::route('/create'),
            'edit' => Pages\EditReport::route('/{record}/edit'),
        ];
    }
}
