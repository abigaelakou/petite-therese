<?php

return [
    'components' => [
        'builder' => [
            'actions' => [
                'clone' => ['label' => 'Dupliquer'],
                'add' => ['label' => 'Ajouter à :label'],
                'add_between' => ['label' => 'Insérer entre les blocs'],
                'delete' => ['label' => 'Supprimer'],
                'reorder' => ['label' => 'Déplacer'],
                'move_down' => ['label' => 'Déplacer vers le bas'],
                'move_up' => ['label' => 'Déplacer vers le haut'],
                'collapse' => ['label' => 'Réduire'],
                'expand' => ['label' => 'Développer'],
                'collapse_all' => ['label' => 'Tout réduire'],
                'expand_all' => ['label' => 'Tout développer'],
            ],
        ],
        'checkbox_list' => [
            'actions' => [
                'deselect_all' => ['label' => 'Tout désélectionner'],
                'select_all' => ['label' => 'Tout sélectionner'],
            ],
        ],
        'file_upload' => [
            'editor' => [
                'actions' => [
                    'cancel' => ['label' => 'Annuler'],
                    'drag_crop' => ['label' => 'Mode recadrage'],
                    'drag_move' => ['label' => 'Mode déplacement'],
                    'flip_horizontal' => ['label' => 'Retourner horizontalement'],
                    'flip_vertical' => ['label' => 'Retourner verticalement'],
                    'move_down' => ['label' => 'Descendre'],
                    'move_left' => ['label' => 'Aller à gauche'],
                    'move_right' => ['label' => 'Aller à droite'],
                    'move_up' => ['label' => 'Monter'],
                    'reset' => ['label' => 'Réinitialiser'],
                    'rotate_left' => ['label' => 'Rotation gauche'],
                    'rotate_right' => ['label' => 'Rotation droite'],
                    'set_custom_aspect_ratio' => ['label' => 'Ratio personnalisé'],
                    'save' => ['label' => 'Enregistrer'],
                    'zoom_100' => ['label' => 'Zoom 100%'],
                    'zoom_in' => ['label' => 'Zoom avant'],
                    'zoom_out' => ['label' => 'Zoom arrière'],
                ],
            ],
            'editor_title' => 'Modifier l\'image',
            'uploading' => 'Envoi en cours...',
            'max_files' => 'Vous pouvez uploader au maximum :count fichiers.',
            'max_parallel_uploads' => 'Vous ne pouvez uploader que :count fichiers à la fois.',
            'max_size' => 'La taille maximale est de :max.',
            'min_size' => 'La taille minimale est de :min.',
            'messages' => [
                'upload' => 'Cliquez pour uploader ou glissez-déposez',
            ],
        ],
        'key_value' => [
            'actions' => [
                'add' => ['label' => 'Ajouter une ligne'],
                'delete' => ['label' => 'Supprimer la ligne'],
            ],
            'fields' => [
                'key' => ['label' => 'Clé'],
                'value' => ['label' => 'Valeur'],
            ],
        ],
        'markdown_editor' => [
            'toolbar_buttons' => [
                'attach_files' => 'Joindre des fichiers',
                'blockquote' => 'Citation',
                'bold' => 'Gras',
                'bullet_list' => 'Liste à puces',
                'code_block' => 'Bloc de code',
                'heading' => 'Titre',
                'italic' => 'Italique',
                'link' => 'Lien',
                'ordered_list' => 'Liste numérotée',
                'redo' => 'Rétablir',
                'strike' => 'Barré',
                'table' => 'Tableau',
                'undo' => 'Annuler',
            ],
        ],
        'repeater' => [
            'actions' => [
                'add' => ['label' => 'Ajouter à :label'],
                'add_between' => ['label' => 'Insérer'],
                'delete' => ['label' => 'Supprimer'],
                'clone' => ['label' => 'Dupliquer'],
                'reorder' => ['label' => 'Déplacer'],
                'move_down' => ['label' => 'Déplacer vers le bas'],
                'move_up' => ['label' => 'Déplacer vers le haut'],
                'collapse' => ['label' => 'Réduire'],
                'expand' => ['label' => 'Développer'],
                'collapse_all' => ['label' => 'Tout réduire'],
                'expand_all' => ['label' => 'Tout développer'],
            ],
        ],
        'select' => [
            'actions' => [
                'create_option' => ['modal' => ['heading' => 'Créer']],
                'edit_option' => ['modal' => ['heading' => 'Modifier']],
            ],
            'boolean' => [
                'true' => 'Oui',
                'false' => 'Non',
            ],
            'loading_message' => 'Chargement...',
            'max_items_message' => 'Vous ne pouvez sélectionner que :count éléments.',
            'no_search_results_message' => 'Aucun résultat pour votre recherche.',
            'placeholder' => 'Sélectionnez une option',
            'searching_message' => 'Recherche...',
            'search_prompt' => 'Commencez à taper...',
        ],
        'tags_input' => [
            'placeholder' => 'Nouveau tag',
        ],
        'wizard' => [
            'actions' => [
                'previous_step' => ['label' => 'Précédent'],
                'next_step' => ['label' => 'Suivant'],
            ],
        ],
        'date_time_picker' => [
            'modal' => [
                'heading' => 'Sélectionner une date',
                'actions' => [
                    'set_date' => ['label' => 'Valider'],
                ],
            ],
            'today' => 'Aujourd\'hui',
        ],
    ],
    'nullable_select_placeholder' => '—',
];