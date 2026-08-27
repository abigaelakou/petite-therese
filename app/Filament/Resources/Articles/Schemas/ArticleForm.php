<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Article;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Informations de l\'article')
                ->description('Rédigez un article pour la section Vie Scolaire du site.')
                ->icon('heroicon-o-newspaper')
                ->schema([
                    TextInput::make('titre')
                        ->label('Titre de l\'article')
                        ->required()
                        ->maxLength(200)
                        ->placeholder('ex: Fête de fin d\'année 2025 — Une journée inoubliable !')
                        ->columnSpanFull()
                        ->live(onBlur: true),

                    Select::make('categorie')
                        ->label('Catégorie')
                        ->options(Article::CATEGORIES)
                        ->required()
                        ->default('evenement')
                        ->columnSpan(1),

                    Select::make('statut')
                        ->label('Statut')
                        ->options(Article::STATUTS)
                        ->required()
                        ->default('brouillon')
                        ->reactive()
                        ->columnSpan(1),

                    DateTimePicker::make('publie_le')
                        ->label('Date de publication')
                        ->displayFormat('d/m/Y H:i')
                        ->default(now())
                        ->visible(fn($get) => $get('statut') === 'publie')
                        ->columnSpan(1),

                ])->columns(2),

            Section::make('Photo de couverture')
                ->icon('heroicon-o-photo')
                ->schema([
                    FileUpload::make('photo_couverture')
                        ->label('Photo de couverture')
                        ->image()
                        ->imageEditor()
                        ->imageResizeMode('cover')
                        ->imageResizeTargetWidth('1200')
                        ->imageResizeTargetHeight('630')
                        ->directory('articles')
                        ->visibility('public')
                        ->maxSize(5120)
                        ->helperText('Redimensionnée en 1200x630px. Format recommandé pour le web.')
                        ->columnSpanFull(),
                ])
                ->collapsible(),

            Section::make('Contenu')
                ->icon('heroicon-o-document-text')
                ->schema([
                    Textarea::make('extrait')
                        ->label('Extrait (résumé court)')
                        ->rows(3)
                        ->maxLength(300)
                        ->placeholder('Un court résumé affiché dans la liste des articles...')
                        ->columnSpanFull(),

                    RichEditor::make('contenu')
                        ->label('Contenu complet de l\'article')
                        ->required()
                        ->toolbarButtons([
                            'bold', 'italic', 'underline',
                            'bulletList', 'orderedList',
                            'h2', 'h3',
                            'link', 'blockquote',
                        ])
                        ->columnSpanFull(),
                ]),

        ]);
    }
}