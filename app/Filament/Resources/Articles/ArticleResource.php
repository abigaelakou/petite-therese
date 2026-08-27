<?php

namespace App\Filament\Resources\Articles;

use App\Filament\Resources\Articles\Pages\CreateArticle;
use App\Filament\Resources\Articles\Pages\EditArticle;
use App\Filament\Resources\Articles\Pages\ListArticles;
use App\Filament\Resources\Articles\Schemas\ArticleForm;
use App\Filament\Resources\Articles\Tables\ArticlesTable;
use App\Models\Article;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;
    protected static ?string $navigationLabel = 'Vie Scolaire';
    protected static ?string $modelLabel = 'Article';
    protected static ?string $pluralModelLabel = 'Articles Vie Scolaire';
    protected static ?int $navigationSort = 3;
    protected static ?string $recordTitleAttribute = 'titre';

    public static function getNavigationGroup(): ?string
    {
        return 'Site vitrine';
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur', 'secretaire']) ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur', 'secretaire']) ?? false;
    }

    public static function canEdit($record): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur', 'secretaire']) ?? false;
    }

    public static function canDelete($record): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'directeur']) ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return ArticleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ArticlesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListArticles::route('/'),
            'create' => CreateArticle::route('/create'),
            'edit'   => EditArticle::route('/{record}/edit'),
        ];
    }
}