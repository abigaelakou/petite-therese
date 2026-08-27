<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache des permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ============================================================
        // PERMISSIONS — organisées par module
        // ============================================================
        $permissions = [

            // -- Élèves --
            'eleves.voir',
            'eleves.creer',
            'eleves.modifier',
            'eleves.supprimer',
            'eleves.archiver',
            'eleves.exporter',

            // -- Inscriptions --
            'inscriptions.voir',
            'inscriptions.creer',
            'inscriptions.valider',
            'inscriptions.refuser',
            'inscriptions.passage_automatique',

            // -- Classes --
            'classes.voir',
            'classes.creer',
            'classes.modifier',
            'classes.supprimer',

            // -- Années scolaires --
            'annees.voir',
            'annees.creer',
            'annees.modifier',
            'annees.activer',
            'annees.archiver',

            // -- Notes --
            'notes.voir',
            'notes.saisir',
            'notes.modifier',
            'notes.supprimer',

            // -- Bulletins --
            'bulletins.voir',
            'bulletins.generer',
            'bulletins.publier',
            'bulletins.imprimer',

            // -- Absences --
            'absences.voir',
            'absences.enregistrer',
            'absences.modifier',
            'absences.justifier',

            // -- Emplois du temps --
            'emplois.voir',
            'emplois.creer',
            'emplois.modifier',
            'emplois.supprimer',

            // -- Paiements --
            'paiements.voir',
            'paiements.enregistrer',
            'paiements.modifier',
            'paiements.supprimer',
            'paiements.imprimer_recu',
            'paiements.relancer',
            'paiements.exporter',

            // -- Communication --
            'circulaires.voir',
            'circulaires.creer',
            'circulaires.publier',
            'circulaires.supprimer',

            // -- Documents --
            'documents.voir',
            'documents.ajouter',
            'documents.supprimer',
            'documents.telecharger',

            // -- Site vitrine --
            'contacts.voir',
            'contacts.traiter',
            'pre_inscriptions.voir',
            'pre_inscriptions.traiter',
            'pre_inscriptions.convertir',

            // -- Reporting --
            'stats.voir',
            'rapports.generer',
            'rapports.exporter',

            // -- Utilisateurs --
            'utilisateurs.voir',
            'utilisateurs.creer',
            'utilisateurs.modifier',
            'utilisateurs.supprimer',
            'roles.gerer',

            // -- Archives (Super Admin uniquement) --
            'archives.voir',
            'archives.creer',
            'archives.restaurer',
            'archives.supprimer',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $this->command->info('✓ ' . count($permissions) . ' permissions créées');

        // ============================================================
        // RÔLES ET LEURS PERMISSIONS
        // ============================================================

        // ── SUPER ADMIN ─────────────────────────────────────────────
        // Accès total — toutes les permissions
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $superAdmin->syncPermissions(Permission::all());
        $this->command->info('✓ Rôle super_admin — toutes les permissions');

        // ── DIRECTEUR DES ÉTUDES ────────────────────────────────────
        $directeur = Role::firstOrCreate(['name' => 'directeur', 'guard_name' => 'web']);
        $directeur->syncPermissions([
            // Élèves
            'eleves.voir', 'eleves.creer', 'eleves.modifier', 'eleves.exporter',
            // Inscriptions
            'inscriptions.voir', 'inscriptions.creer',
            'inscriptions.valider', 'inscriptions.refuser',
            'inscriptions.passage_automatique',
            // Classes
            'classes.voir', 'classes.creer', 'classes.modifier',
            // Années scolaires
            'annees.voir', 'annees.creer', 'annees.modifier', 'annees.activer',
            // Notes
            'notes.voir', 'notes.saisir', 'notes.modifier',
            // Bulletins
            'bulletins.voir', 'bulletins.generer', 'bulletins.publier', 'bulletins.imprimer',
            // Absences
            'absences.voir', 'absences.enregistrer', 'absences.modifier', 'absences.justifier',
            // Emplois du temps
            'emplois.voir', 'emplois.creer', 'emplois.modifier',
            // Paiements (consultation uniquement)
            'paiements.voir',
            // Communication
            'circulaires.voir', 'circulaires.creer', 'circulaires.publier',
            // Documents
            'documents.voir', 'documents.ajouter', 'documents.telecharger',
            // Site vitrine
            'contacts.voir', 'contacts.traiter',
            'pre_inscriptions.voir', 'pre_inscriptions.traiter', 'pre_inscriptions.convertir',
            // Reporting
            'stats.voir', 'rapports.generer', 'rapports.exporter',
            // Utilisateurs (consultation)
            'utilisateurs.voir',
        ]);
        $this->command->info('✓ Rôle directeur');

        // ── COMPTABLE ───────────────────────────────────────────────
        $comptable = Role::firstOrCreate(['name' => 'comptable', 'guard_name' => 'web']);
        $comptable->syncPermissions([
            // Élèves (consultation)
            'eleves.voir',
            // Inscriptions (consultation)
            'inscriptions.voir',
            // Paiements — accès complet
            'paiements.voir', 'paiements.enregistrer', 'paiements.modifier',
            'paiements.imprimer_recu', 'paiements.relancer', 'paiements.exporter',
            // Documents
            'documents.voir', 'documents.telecharger',
            // Reporting financier
            'stats.voir', 'rapports.generer', 'rapports.exporter',
        ]);
        $this->command->info('✓ Rôle comptable');

        // ── ENSEIGNANT ──────────────────────────────────────────────
        $enseignant = Role::firstOrCreate(['name' => 'enseignant', 'guard_name' => 'web']);
        $enseignant->syncPermissions([
            // Élèves (ses classes uniquement — filtré dans les Resources)
            'eleves.voir',
            // Notes (ses classes uniquement)
            'notes.voir', 'notes.saisir', 'notes.modifier',
            // Bulletins (consultation)
            'bulletins.voir', 'bulletins.imprimer',
            // Absences (ses classes)
            'absences.voir', 'absences.enregistrer', 'absences.justifier',
            // Emplois du temps (consultation)
            'emplois.voir',
            // Circulaires (consultation)
            'circulaires.voir',
            // Documents (consultation)
            'documents.voir', 'documents.telecharger',
        ]);
        $this->command->info('✓ Rôle enseignant');

        // ── PARENT / TUTEUR ─────────────────────────────────────────
        $parent = Role::firstOrCreate(['name' => 'parent', 'guard_name' => 'web']);
        $parent->syncPermissions([
            // Élèves (son enfant uniquement — filtré)
            'eleves.voir',
            // Bulletins (son enfant)
            'bulletins.voir', 'bulletins.imprimer',
            // Absences (son enfant)
            'absences.voir',
            // Emplois du temps (consultation)
            'emplois.voir',
            // Paiements (son enfant — consultation)
            'paiements.voir', 'paiements.imprimer_recu',
            // Circulaires
            'circulaires.voir',
            // Documents (son enfant)
            'documents.voir', 'documents.telecharger',
        ]);
        $this->command->info('✓ Rôle parent');

        // ============================================================
        // ASSIGNER LE RÔLE SUPER ADMIN AU PREMIER UTILISATEUR
        // ============================================================
        $superAdminUser = User::where('email', 'superadmin@lapetitetherese.com')->first();

        if ($superAdminUser) {
            $superAdminUser->assignRole('super_admin');
            $this->command->info('✓ Rôle super_admin assigné à : ' . $superAdminUser->email);
        } else {
            $this->command->warn('⚠ Utilisateur superadmin@lapetitetherese.com non trouvé — assignez le rôle manuellement.');
        }

        $this->command->info("\n=== Rôles & Permissions créés avec succès ! ===");
        $this->command->table(
            ['Rôle', 'Permissions'],
            [
                ['super_admin', 'Toutes (' . Permission::count() . ')'],
                ['directeur',   $directeur->permissions()->count()],
                ['comptable',   $comptable->permissions()->count()],
                ['enseignant',  $enseignant->permissions()->count()],
                ['parent',      $parent->permissions()->count()],
            ]
        );
    }
}