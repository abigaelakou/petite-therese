<?php

namespace App\Filament\Pages;

use App\Models\AnneeScolaire;
use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Hash;

class EditProfile extends Page
{
    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedUserCircle;
    protected string $view = 'filament.pages.edit-profile';
    protected static ?string $navigationLabel = 'Mon profil';
    protected static ?string $title = 'Mon profil';
    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        $user = auth()->user();
        $this->form->fill([
            'name'      => $user->name,
            'email'     => $user->email,
            'telephone' => $user->telephone ?? '',
            'photo'     => $user->photo,
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Photo de profil')
                    ->icon('heroicon-o-camera')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Photo')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios(['1:1'])
                            ->imageResizeMode('cover')
                            ->imageResizeTargetWidth('300')
                            ->imageResizeTargetHeight('300')
                            ->directory('profiles')
                            ->visibility('public')
                            ->maxSize(2048)
                            ->helperText('Photo redimensionnée en 300x300px.')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                Section::make('Informations personnelles')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nom complet')
                            ->required()
                            ->maxLength(100),
                        TextInput::make('email')
                            ->label('Adresse email')
                            ->email()
                            ->required()
                            ->maxLength(100),
                        TextInput::make('telephone')
                            ->label('Téléphone')
                            ->tel()
                            ->maxLength(20)
                            ->placeholder('+225 07 00 00 00 00'),
                    ])->columns(2),

                Section::make('Changer le mot de passe')
                    ->icon('heroicon-o-lock-closed')
                    ->description('Laissez vide si vous ne souhaitez pas changer votre mot de passe.')
                    ->schema([
                        TextInput::make('current_password')
                            ->label('Mot de passe actuel')
                            ->password()
                            ->revealable()
                            ->columnSpan(1),
                        TextInput::make('password')
                            ->label('Nouveau mot de passe')
                            ->password()
                            ->revealable()
                            ->minLength(8)
                            ->columnSpan(1),
                        TextInput::make('password_confirmation')
                            ->label('Confirmer le mot de passe')
                            ->password()
                            ->revealable()
                            ->same('password')
                            ->columnSpan(1),
                    ])->columns(2)
                    ->collapsible(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $user = auth()->user();

        if (!empty($data['password'])) {
            if (empty($data['current_password']) || !Hash::check($data['current_password'], $user->password)) {
                Notification::make()
                    ->title('Mot de passe actuel incorrect')
                    ->danger()
                    ->send();
                return;
            }
            $user->password = Hash::make($data['password']);
        }

        $user->name      = $data['name'];
        $user->email     = $data['email'];
        $user->telephone = $data['telephone'] ?? null;

        if (!empty($data['photo'])) {
            $user->photo = is_array($data['photo'])
                ? array_values($data['photo'])[0]
                : $data['photo'];
        }

        $user->save();

        Notification::make()
            ->title('Profil mis à jour avec succès !')
            ->success()
            ->send();
    }
}