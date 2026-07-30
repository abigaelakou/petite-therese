<?php

return [
    'auth' => [
        'login' => [
            'title' => 'Connexion',
            'heading' => 'Bienvenue',
            'form' => [
                'email' => [
                    'label' => 'Adresse email',
                ],
                'password' => [
                    'label' => 'Mot de passe',
                ],
                'remember' => [
                    'label' => 'Se souvenir de moi',
                ],
                'actions' => [
                    'authenticate' => [
                        'label' => 'Se connecter',
                    ],
                ],
            ],
            'messages' => [
                'failed' => 'Ces identifiants ne correspondent à aucun compte.',
                'throttled' => 'Trop de tentatives. Réessayez dans :seconds secondes.',
            ],
            'notifications' => [
                'throttled' => [
                    'title' => 'Trop de tentatives',
                    'body' => 'Réessayez dans :seconds secondes.',
                ],
            ],
        ],
        'password_reset' => [
            'request' => [
                'title' => 'Mot de passe oublié',
                'heading' => 'Réinitialiser le mot de passe',
                'form' => [
                    'email' => [
                        'label' => 'Adresse email',
                    ],
                    'actions' => [
                        'request' => [
                            'label' => 'Envoyer le lien',
                        ],
                    ],
                ],
                'notifications' => [
                    'sent' => [
                        'title' => 'Lien envoyé',
                        'body' => 'Un lien de réinitialisation a été envoyé à votre adresse email.',
                    ],
                    'throttled' => [
                        'title' => 'Trop de tentatives',
                        'body' => 'Réessayez dans :seconds secondes.',
                    ],
                ],
            ],
            'reset' => [
                'title' => 'Nouveau mot de passe',
                'heading' => 'Nouveau mot de passe',
                'form' => [
                    'email' => ['label' => 'Adresse email'],
                    'password' => ['label' => 'Nouveau mot de passe'],
                    'password_confirmation' => ['label' => 'Confirmer le mot de passe'],
                    'actions' => [
                        'reset' => ['label' => 'Réinitialiser'],
                    ],
                ],
                'notifications' => [
                    'success' => ['title' => 'Mot de passe modifié'],
                    'invalid_token' => ['title' => 'Lien invalide ou expiré'],
                ],
            ],
        ],
        'profile' => [
            'heading' => 'Mon profil',
            'form' => [
                'email' => ['label' => 'Adresse email'],
                'name' => ['label' => 'Nom complet'],
                'password' => ['label' => 'Nouveau mot de passe'],
                'password_confirmation' => ['label' => 'Confirmer le mot de passe'],
                'actions' => [
                    'save' => ['label' => 'Enregistrer'],
                ],
            ],
            'notifications' => [
                'saved' => ['title' => 'Profil mis à jour'],
            ],
        ],
    ],
    'pages' => [
        'dashboard' => [
            'title' => 'Tableau de bord',
        ],
    ],
    'sidebar' => [
        'groups' => [
            'navigation' => 'Navigation',
        ],
    ],
    'global_search' => [
        'placeholder' => 'Rechercher...',
        'no_results_message' => 'Aucun résultat',
        'empty_subheading' => 'Essayez un autre terme',
        'start_typing_prompt' => 'Commencez à taper...',
    ],
    'widgets' => [
        'account' => [
            'actions' => [
                'profile' => ['label' => 'Mon profil'],
                'logout' => ['label' => 'Se déconnecter'],
            ],
        ],
        'filament_info' => [
            'open_documentation_action' => 'Documentation',
        ],
    ],
    'layout' => [
        'actions' => [
            'sidebar' => [
                'collapse' => ['label' => 'Réduire la barre latérale'],
                'expand' => ['label' => 'Développer la barre latérale'],
            ],
            'dark_mode' => [
                'disable' => ['label' => 'Mode clair'],
                'enable' => ['label' => 'Mode sombre'],
            ],
        ],
    ],
    'unsaved_changes_alert' => 'Des modifications non enregistrées seront perdues.',
    'register' => [
        'title' => 'Créer un compte',
        'heading' => 'Créer un compte',
    ],
];