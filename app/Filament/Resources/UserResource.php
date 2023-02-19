<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Models\User;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $slug = 'users';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $label = 'Kullanıcılar';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->columns(2)->schema([
                    TextInput::make('name')
                        ->placeholder('Adı soyadı')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('email')
                        ->placeholder('Email adresi')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),

                    DateTimePicker::make('email_verified_at')->placeholder('E-posta doğrulama tarihi'),

                    TextInput::make('password')
                        ->placeholder('Şifre')
                        ->password()
                        ->dehydrateStateUsing(fn($state) => Hash::make($state))
                        ->dehydrated(fn($state) => filled($state))
                        ->required(fn(Page $livewire) => ($livewire instanceof CreateUser))
                        ->maxLength(255),
                    //->visible(fn (Component $livewire): bool => $livewire instanceof Pages\CreateUser),

                    Select::make('roles')
                        ->multiple()
                        ->relationship('roles', 'name')
                        ->preload(),

                    Select::make('permissions')
                        ->multiple()
                        ->relationship('permissions', 'name')
                        ->preload(),



                ]), //Card
                Section::make('Image')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Image')
                            ->image()
                            ->disableLabel(),
                    ])->collapsible(),

            ]);// schema
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    ImageColumn::make('image')->circular()->grow(false),
                    Stack::make([
                        TextColumn::make('name')->searchable()->sortable(),
                        TextColumn::make('email')->searchable()->sortable(),

                    ]),
                    TextColumn::make('email_verified_at')->dateTime('d.m.Y')->sortable(),
                    TextColumn::make('created_at')->dateTime('d.m.Y')->sortable(),
                    TextColumn::make('updated_at')->dateTime('d.m.Y')->sortable(),
                ])->from('md'),

            ])
            ->filters([
                Tables\Filters\Filter::make('Onaylanmış')->query(fn(Builder $query): Builder => $query->whereNotNull('email_verified_at')),
                Tables\Filters\Filter::make('Onaylanmamış')->query(fn(Builder $query): Builder => $query->whereNull('email_verified_at')),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->color('success'),
                    Tables\Actions\EditAction::make()->color('primary'),
                    Tables\Actions\DeleteAction::make()->color('danger'),
                ]),
            ])
            ->bulkActions([
                // ->action(fn (Collection $records) => $records->each->activate($records))
                BulkAction::make('Tarihi güncelle')
                    ->requiresConfirmation()
                    ->color('primary')
                    ->icon('heroicon-o-calendar')
                    ->visible(fn(User $record): bool => auth()->user()->can('update', $record))
                    ->action(fn(Collection $records) => $records->each->activate($records)),
                BulkAction::make('Tarihi güncelle 2')
                    ->requiresConfirmation()
                    ->color('success')
                    ->icon('heroicon-o-check')
                    ->visible(fn(User $record): bool => auth()->user()->can('update', $record))
                    ->action(function (Collection $records, array $data): void {
                        foreach ($records as $record) {
                            $record->email_verified_at = now();
                            $record->save();
                        }
                    }),
                DeleteBulkAction::make()
                    ->requiresConfirmation()
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->visible(fn(User $record): bool => auth()->user()->can('update', $record)),

                BulkAction::make('Diğer işlemler')
                    ->color('success')
                    ->action(function () {
                        Notification::make()
                            ->title('Merhaba **Abdulkadir**\'Bu deneme bir notification mesajıdır!')
                            ->warning()
                            ->send();
                    }),
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
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    protected static function getNavigationBadge(): ?string
    {
        // return self::$model::whereColumn('qty', '<', 'security_stock')->count();
        return self::$model::count();
    }
}
