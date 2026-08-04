<x-filament-widgets::widget>
    @php
        $user = auth()->user();
        $annee = \App\Models\AnneeScolaire::where('est_active', true)->first();
        $role = $user->getRoleNames()->first() ?? 'utilisateur';
        $roleLabels = [
            'super_admin' => '👑 Super Administrateur',
            'directeur'   => '🎓 Directeur des Études',
            'comptable'   => '💰 Comptable',
            'enseignant'  => '📚 Enseignant',
            'parent'      => '👨‍👩‍👧 Parent / Tuteur',
        ];
        $roleLabel = $roleLabels[$role] ?? $role;

        // Actions rapides selon le rôle
        $actions = [];
        if (in_array($role, ['super_admin', 'directeur'])) {
            $actions[] = ['url' => route('filament.admin.resources.eleves.create'), 'label' => '+ Nouvel élève', 'primary' => true];
            $actions[] = ['url' => route('filament.admin.resources.inscriptions.create'), 'label' => '+ Inscription', 'primary' => false];
        }
        if (in_array($role, ['super_admin', 'comptable'])) {
            $actions[] = ['url' => route('filament.admin.resources.paiements.create'), 'label' => '+ Paiement', 'primary' => false];
        }
    @endphp

    <div style="
        background: linear-gradient(135deg, #1B2B6B 0%, #12205A 60%, #2E9EC5 100%);
        border-radius: 16px;
        padding: 1.5rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
        box-shadow: 0 4px 20px rgba(27,43,107,0.2);
        position: relative;
        overflow: hidden;
    ">
        <div style="position:absolute;top:-30px;right:-30px;width:150px;height:150px;background:rgba(201,168,76,0.08);border-radius:50%;"></div>
        <div style="position:absolute;bottom:-20px;right:100px;width:80px;height:80px;background:rgba(46,158,197,0.1);border-radius:50%;"></div>

        {{-- Avatar + Infos --}}
        <div style="display:flex;align-items:center;gap:1rem;">
            @if($user->photo ?? false)
                <img src="{{ asset('storage/' . $user->photo) }}"
                     style="width:56px;height:56px;border-radius:50%;object-fit:cover;border:3px solid rgba(201,168,76,0.5);">
            @else
                <div style="width:56px;height:56px;background:linear-gradient(135deg,#C9A84C,#A8893A);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.3rem;font-weight:900;color:#1B2B6B;border:3px solid rgba(201,168,76,0.4);flex-shrink:0;">
                    {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
            @endif
            <div>
                <div style="color:rgba(255,255,255,0.65);font-size:0.78rem;margin-bottom:2px;">
                    {{ now()->translatedFormat('l d F Y') }}
                </div>
                <div style="color:#ffffff;font-size:1.15rem;font-weight:800;line-height:1.2;">
                    Bonjour, {{ $user->name }} 👋
                </div>
                <div style="margin-top:5px;">
                    <span style="background:rgba(201,168,76,0.2);color:#C9A84C;padding:2px 10px;border-radius:20px;font-size:0.72rem;font-weight:700;letter-spacing:0.05em;border:1px solid rgba(201,168,76,0.3);">
                        {{ $roleLabel }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Année scolaire --}}
        @if($annee)
        <div style="text-align:center;">
            <div style="color:rgba(255,255,255,0.6);font-size:0.72rem;margin-bottom:4px;">Année scolaire</div>
            <div style="background:rgba(201,168,76,0.2);border:1px solid rgba(201,168,76,0.4);color:#C9A84C;padding:6px 20px;border-radius:8px;font-size:1rem;font-weight:800;">
                {{ $annee->libelle }}
            </div>
            <div style="color:rgba(255,255,255,0.45);font-size:0.68rem;margin-top:4px;">
                {{ $annee->date_debut?->format('d/m/Y') }} → {{ $annee->date_fin?->format('d/m/Y') }}
            </div>
        </div>
        @endif

        {{-- Actions rapides --}}
        <div style="display:flex;gap:0.75rem;flex-wrap:wrap;align-items:center;">
            @foreach($actions as $i => $action)
            <a href="{{ $action['url'] }}" style="
                {{ $action['primary'] ? 'background:linear-gradient(135deg,#C9A84C,#A8893A);color:#1B2B6B;box-shadow:0 2px 8px rgba(201,168,76,0.3);' : 'background:rgba(255,255,255,0.1);color:#ffffff;border:1px solid rgba(255,255,255,0.2);' }}
                padding:8px 16px;border-radius:8px;font-size:0.8rem;font-weight:700;text-decoration:none;
            ">{{ $action['label'] }}</a>
            @endforeach

            {{-- Profil --}}
            <a href="{{ route('filament.admin.pages.edit-profile') }}" 
   style="background:rgba(255,255,255,0.08);color:rgba(255,255,255,0.8);padding:8px 16px;border-radius:8px;font-size:0.8rem;font-weight:700;text-decoration:none;border:1px solid rgba(255,255,255,0.15);">
    Mon profil
</a>

            {{-- Déconnexion --}}
            <a href="#" onclick="event.preventDefault();document.getElementById('logout-form-widget').submit();"
               style="background:rgba(220,38,38,0.15);color:#fca5a5;padding:8px 16px;border-radius:8px;font-size:0.8rem;font-weight:700;text-decoration:none;border:1px solid rgba(220,38,38,0.3);">
                Déconnexion
            </a>
            <form id="logout-form-widget" action="{{ route('filament.admin.auth.logout') }}" method="POST" style="display:none;">@csrf</form>
        </div>
    </div>
</x-filament-widgets::widget>