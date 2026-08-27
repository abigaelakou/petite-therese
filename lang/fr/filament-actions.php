<?php

return [
    'single' => [
        'label' => 'Action',
    ],
    'modal' => [
        'requires_confirmation_subheading' => 'Êtes-vous sûr de vouloir effectuer cette action ?',
        'confirmation' => 'Êtes-vous sûr ?',
    ],
    'create' => [
        'single' => [
            'label' => 'Créer',
            'modal' => [
                'heading' => 'Créer :label',
                'actions' => [
                    'create' => ['label' => 'Créer'],
                    'create_another' => ['label' => 'Créer et ajouter un autre'],
                ],
            ],
            'notifications' => [
                'created' => ['title' => 'Créé avec succès'],
            ],
        ],
    ],
    'edit' => [
        'single' => [
            'label' => 'Modifier',
            'modal' => [
                'heading' => 'Modifier :label',
                'actions' => [
                    'save' => ['label' => 'Enregistrer'],
                ],
            ],
            'notifications' => [
                'saved' => ['title' => 'Modifié avec succès'],
            ],
        ],
    ],
    'delete' => [
        'single' => [
            'label' => 'Supprimer',
            'modal' => [
                'heading' => 'Supprimer :label',
                'description' => 'Êtes-vous sûr de vouloir supprimer cet élément ? Cette action est irréversible.',
                'actions' => [
                    'delete' => ['label' => 'Supprimer'],
                ],
            ],
            'notifications' => [
                'deleted' => ['title' => 'Supprimé avec succès'],
            ],
        ],
        'multiple' => [
            'label' => 'Supprimer la sélection',
            'modal' => [
                'heading' => 'Supprimer la sélection',
                'description' => 'Êtes-vous sûr de vouloir supprimer les éléments sélectionnés ?',
                'actions' => [
                    'delete' => ['label' => 'Supprimer'],
                ],
            ],
            'notifications' => [
                'deleted' => ['title' => 'Supprimés avec succès'],
            ],
        ],
    ],
    'view' => [
        'single' => [
            'label' => 'Voir',
            'modal' => [
                'heading' => 'Voir :label',
                'actions' => [
                    'edit' => ['label' => 'Modifier'],
                ],
            ],
        ],
    ],
    'replicate' => [
        'single' => [
            'label' => 'Dupliquer',
            'notifications' => [
                'replicated' => ['title' => 'Dupliqué avec succès'],
            ],
        ],
    ],
    'force_delete' => [
        'single' => [
            'label' => 'Supprimer définitivement',
            'modal' => [
                'heading' => 'Supprimer définitivement',
                'description' => 'Cette action est irréversible.',
                'actions' => [
                    'delete' => ['label' => 'Supprimer définitivement'],
                ],
            ],
            'notifications' => [
                'deleted' => ['title' => 'Supprimé définitivement'],
            ],
        ],
    ],
    'restore' => [
        'single' => [
            'label' => 'Restaurer',
            'modal' => [
                'heading' => 'Restaurer :label',
                'actions' => [
                    'restore' => ['label' => 'Restaurer'],
                ],
            ],
            'notifications' => [
                'restored' => ['title' => 'Restauré avec succès'],
            ],
        ],
    ],
    'export' => [
        'single' => [
            'label' => 'Exporter',
        ],
    ],
    'import' => [
        'single' => [
            'label' => 'Importer',
        ],
    ],
    'attach' => [
        'single' => [
            'label' => 'Associer',
            'modal' => [
                'heading' => 'Associer :label',
                'actions' => [
                    'attach' => ['label' => 'Associer'],
                    'attach_another' => ['label' => 'Associer et ajouter un autre'],
                ],
            ],
            'notifications' => [
                'attached' => ['title' => 'Associé avec succès'],
            ],
        ],
    ],
    'detach' => [
        'single' => [
            'label' => 'Dissocier',
            'modal' => [
                'heading' => 'Dissocier :label',
                'actions' => [
                    'detach' => ['label' => 'Dissocier'],
                ],
            ],
            'notifications' => [
                'detached' => ['title' => 'Dissocié avec succès'],
            ],
        ],
    ],
    'dissociate' => [
        'single' => [
            'label' => 'Retirer',
            'modal' => [
                'heading' => 'Retirer :label',
                'actions' => [
                    'dissociate' => ['label' => 'Retirer'],
                ],
            ],
            'notifications' => [
                'dissociated' => ['title' => 'Retiré avec succès'],
            ],
        ],
    ],
];