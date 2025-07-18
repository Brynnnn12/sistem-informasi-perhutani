<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubmissionResource\Pages;
use App\Filament\Resources\SubmissionResource\RelationManagers;
use App\Models\Submission;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';

    protected static ?string $navigationLabel = 'Pengajuan';

    protected static ?string $modelLabel = 'Pengajuan';

    protected static ?string $pluralModelLabel = 'Data Pengajuan';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Aktivitas';

    // Semua role bisa akses pengajuan
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
                    })
                    ->visible(fn() => Auth::user()?->hasRole('masyarakat')),

                Forms\Components\Select::make('user_id')
                    ->label('Pemohon')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->disabled()
                    ->visible(fn() => Auth::user()?->hasAnyRole(['admin', 'petugas'])),

                Forms\Components\Hidden::make('status')
                    ->default('pending')
                    ->visible(fn() => Auth::user()?->hasRole('masyarakat')),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                    ])
                    ->default('pending')
                    ->visible(fn() => Auth::user()?->hasAnyRole(['admin', 'petugas'])),

                Forms\Components\TextInput::make('title')
                    ->label('Judul Pengajuan')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Permohonan Izin Pemanfaatan Lahan'),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->placeholder('Jelaskan detail pengajuan Anda')
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('attachment')
                    ->label('Lampiran Dokumen')
                    ->directory('submission-attachments')
                    ->disk('public')
                    ->visibility('public')
                    ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                    ->maxSize(5120) // 5MB
                    ->helperText('Format: PDF, JPG, PNG. Maksimal 5MB'),

                Forms\Components\DateTimePicker::make('submitted_at')
                    ->label('Tanggal Pengajuan')
                    ->required()
                    ->default(now())
                    ->disabled(fn(string $context) => $context === 'edit'),

                Forms\Components\DateTimePicker::make('approved_at')
                    ->label('Tanggal Persetujuan')
                    ->visible(fn(Forms\Get $get) => in_array($get('status'), ['approved', 'rejected'])),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pemohon')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(50),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(function (string $state): string {
                        return match ($state) {
                            'pending' => 'Menunggu',
                            'approved' => 'Disetujui',
                            'rejected' => 'Ditolak',
                            default => $state,
                        };
                    }),

                Tables\Columns\TextColumn::make('attachment')
                    ->label('Lampiran')
                    ->formatStateUsing(function ($state) {
                        return $state ? 'Ada' : 'Tidak ada';
                    })
                    ->color(fn($state) => $state ? 'success' : 'gray')
                    ->icon(fn($state) => $state ? 'heroicon-o-paper-clip' : 'heroicon-o-x-mark'),

                Tables\Columns\TextColumn::make('submitted_at')
                    ->label('Tanggal Pengajuan')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('approved_at')
                    ->label('Tanggal Diproses')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->placeholder('Belum diproses'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                    ]),

                Tables\Filters\SelectFilter::make('user')
                    ->label('Pemohon')
                    ->relationship('user', 'name'),
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
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                            ])
                            ->required(),
                        Forms\Components\DateTimePicker::make('approved_at')
                            ->label('Tanggal Persetujuan')
                            ->default(now()),
                        Forms\Components\Textarea::make('notes')
                            ->label('Catatan')
                            ->placeholder('Catatan untuk pemohon (opsional)'),
                    ])
                    ->action(function (Submission $record, array $data): void {
                        $record->update([
                            'status' => $data['status'],
                            'approved_at' => $data['approved_at'],
                        ]);
                    })
                    ->visible(fn() => Auth::user()?->hasAnyRole(['admin', 'petugas']))
                    ->requiresConfirmation(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->action(function (Submission $record) {
                        $record->update([
                            'status' => 'approved',
                            'approved_at' => now(),
                        ]);
                    })
                    ->visible(fn(Submission $record) => $record->status === 'pending' && Auth::user()?->hasAnyRole(['admin', 'petugas']))
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Pengajuan')
                    ->modalDescription('Apakah Anda yakin ingin menyetujui pengajuan ini?'),

                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->action(function (Submission $record) {
                        $record->update([
                            'status' => 'rejected',
                            'approved_at' => now(),
                        ]);
                    })
                    ->visible(fn(Submission $record) => $record->status === 'pending' && Auth::user()?->hasAnyRole(['admin', 'petugas']))
                    ->requiresConfirmation()
                    ->modalHeading('Tolak Pengajuan')
                    ->modalDescription('Apakah Anda yakin ingin menolak pengajuan ini?'),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('submitted_at', 'desc');
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
            'index' => Pages\ListSubmissions::route('/'),
            'create' => Pages\CreateSubmission::route('/create'),
            'edit' => Pages\EditSubmission::route('/{record}/edit'),
        ];
    }
}
