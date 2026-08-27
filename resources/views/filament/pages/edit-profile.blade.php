<x-filament-panels::page>

    {{-- HEADER PROFIL ──────────────────────────────────────── --}}
    @php $user = auth()->user(); @endphp
    <div style="
        background: linear-gradient(135deg, #1B2B6B 0%, #12205A 100%);
        border-radius: 16px;
        padding: 2rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 20px rgba(27,43,107,0.2);
    ">
        @if($user->photo)
            <img src="{{ asset('storage/' . $user->photo) }}"
                 style="width:80px;height:80px;border-radius:50%;object-fit:cover;border:4px solid rgba(201,168,76,0.6);">
        @else
            <div style="width:80px;height:80px;background:linear-gradient(135deg,#C9A84C,#A8893A);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:2rem;font-weight:900;color:#1B2B6B;border:4px solid rgba(201,168,76,0.4);flex-shrink:0;">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
        @endif
        <div>
            <div style="color:#ffffff;font-size:1.4rem;font-weight:800;">{{ $user->name }}</div>
            <div style="color:rgba(255,255,255,0.65);font-size:0.9rem;margin-top:4px;">{{ $user->email }}</div>
            <div style="margin-top:8px;">
                @foreach($user->getRoleNames() as $role)
                <span style="background:rgba(201,168,76,0.2);color:#C9A84C;padding:3px 12px;border-radius:20px;font-size:0.75rem;font-weight:700;border:1px solid rgba(201,168,76,0.3);text-transform:uppercase;letter-spacing:0.05em;">
                    {{ str_replace('_', ' ', $role) }}
                </span>
                @endforeach
            </div>
        </div>
    </div>

    {{-- FORMULAIRE ──────────────────────────────────────────── --}}
    <x-filament::section>
        <form wire:submit="save">
            {{ $this->form }}

            <div style="margin-top:1.5rem;display:flex;gap:1rem;">
                <x-filament::button type="submit" color="primary" size="lg">
                    Enregistrer les modifications
                </x-filament::button>
                <x-filament::button
                    tag="a"
                    href="{{ route('filament.admin.pages.dashboard') }}"
                    color="gray"
                    size="lg">
                    Retour au tableau de bord
                </x-filament::button>
            </div>
        </form>
    </x-filament::section>

</x-filament-panels::page>