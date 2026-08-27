<?php

namespace App\Filament\Resources\Certificats\Pages;

use App\Filament\Resources\Certificats\CertificatResource;
use App\Models\AnneeScolaire;
use App\Models\Inscription;
use Filament\Resources\Pages\CreateRecord;

class CreateCertificat extends CreateRecord
{
    protected static string $resource = CertificatResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Certificat créé avec succès !';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['delivre_par'] = auth()->id();
        $data['delivre_le']  = now();

        // Récupérer la classe de l'élève
        $anneeId = $data['annee_scolaire_id']
            ?? AnneeScolaire::where('est_active', true)->first()?->id;

        $inscription = Inscription::where('eleve_id', $data['eleve_id'])
            ->where('annee_scolaire_id', $anneeId)
            ->where('statut', 'validee')
            ->latest()
            ->first();

        $data['classe_id'] = $inscription?->classe_id;

        return $data;
    }

    protected function afterCreate(): void
    {
        // Rediriger vers le PDF après création
        $this->redirect(route('certificats.pdf', $this->record));
    }
}