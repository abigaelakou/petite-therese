<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasAnyRole([
            'super_admin', 'directeur', 'enseignant', 'comptable', 'parent'
        ]);
    }

    // Relations
    public function eleve(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Eleve::class);
    }

    public function classesEnseignees(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Classe::class, 'enseignant_id');
    }

    public function paiementsEnregistres(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Paiement::class, 'enregistre_par');
    }
}
