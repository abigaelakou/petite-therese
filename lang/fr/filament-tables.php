<?php

return [
    'columns' => [
        'text' => [
            'more_list_items' => 'et :count de plus',
        ],
    ],
    'fields' => [
        'bulk_select_page' => [
            'label' => 'Sélectionner/désélectionner tous les éléments de la page',
        ],
        'bulk_select_record' => [
            'label' => 'Sélectionner/désélectionner l\'élément :key',
        ],
        'bulk_select_group' => [
            'label' => 'Sélectionner/désélectionner le groupe :title',
        ],
        'search' => [
            'label' => 'Rechercher',
            'placeholder' => 'Rechercher...',
        ],
    ],
    'summary' => [
        'heading' => 'Résumé',
        'subheadings' => [
            'all' => 'Tous les :label',
            'group' => 'Total :group',
            'page' => 'Cette page',
        ],
        'summarizers' => [
            'average' => ['label' => 'Moyenne'],
            'count' => ['label' => 'Nombre'],
            'sum' => ['label' => 'Total'],
            'range' => ['label' => 'Plage'],
            'icon_count' => ['label' => 'Nombre'],
        ],
    ],
    'actions' => [
        'disable_reordering' => ['label' => 'Terminer le réordonnancement'],
        'enable_reordering' => ['label' => 'Réordonner'],
        'filter' => ['label' => 'Filtrer'],
        'open_bulk_actions' => ['label' => 'Actions groupées'],
        'toggle_columns' => ['label' => 'Colonnes'],
    ],
    'empty' => [
        'heading' => 'Aucun enregistrement',
        'description' => 'Créez votre premier enregistrement en cliquant sur le bouton ci-dessous.',
    ],
    'filters' => [
        'actions' => [
            'apply' => ['label' => 'Appliquer'],
            'remove' => ['label' => 'Supprimer ce filtre'],
            'remove_all' => ['label' => 'Supprimer tous les filtres'],
            'reset' => ['label' => 'Réinitialiser'],
        ],
        'heading' => 'Filtres',
        'indicator' => 'Filtres actifs',
        'multi_select' => ['placeholder' => 'Tous'],
        'select' => ['placeholder' => 'Tous'],
        'trashed' => [
            'label' => 'Éléments supprimés',
            'only_trashed' => 'Uniquement les supprimés',
            'with_trashed' => 'Avec les supprimés',
            'without_trashed' => 'Sans les supprimés',
        ],
    ],
    'grouping' => [
        'fields' => [
            'group' => ['label' => 'Grouper par'],
            'direction' => [
                'label' => 'Direction',
                'options' => [
                    'asc' => 'Croissant',
                    'desc' => 'Décroissant',
                ],
            ],
        ],
    ],
    'reorder_indicator' => 'Faites glisser les enregistrements dans l\'ordre souhaité.',
    'selection_indicator' => [
        'selected_count' => '1 enregistrement sélectionné|:count enregistrements sélectionnés',
        'actions' => [
            'select_all' => ['label' => 'Sélectionner tout :count'],
            'deselect_all' => ['label' => 'Désélectionner tout'],
        ],
    ],
    'sorting' => [
        'fields' => [
            'column' => ['label' => 'Trier par'],
            'direction' => [
                'label' => 'Direction',
                'options' => [
                    'asc' => 'Croissant',
                    'desc' => 'Décroissant',
                ],
            ],
        ],
    ],
    'pagination' => [
        'label' => 'Pagination',
        'overview' => ':first à :last sur :total résultats',
        'pages' => [
            'next' => ['label' => 'Suivant'],
            'previous' => ['label' => 'Précédent'],
        ],
        'fields' => [
            'records_per_page' => ['label' => 'par page'],
        ],
    ],
];