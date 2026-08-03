<?php

namespace App\Filament\Resources\Contacts\Schemas;

use App\Models\Contact;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Message reçu')
                    ->schema([
                        TextInput::make('nom')->label('Nom')->disabled(),
                        TextInput::make('email')->label('Email')->disabled(),
                        TextInput::make('telephone')->label('Téléphone')->disabled(),
                        TextInput::make('sujet')->label('Sujet')->disabled()->columnSpanFull(),
                        Textarea::make('message')->label('Message')->disabled()->rows(4)->columnSpanFull(),
                    ])->columns(2),

                Section::make('Traitement')
                    ->schema([
                        Select::make('statut')
                            ->label('Statut')
                            ->options(Contact::STATUTS)
                            ->required(),
                        Textarea::make('reponse')
                            ->label('Notes internes / Réponse')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}