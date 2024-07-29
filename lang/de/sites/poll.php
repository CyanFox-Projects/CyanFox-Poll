<?php

return [
    'title' => 'Titel',
    'description' => 'Beschreibung',
    'email' => 'E-Mail',
    'email_hint' => 'Die Angabe der E-Mail-Adresse ist optional und wird nur in der Umfrage-Suchfunktion verwendet.',
    'end_date' => 'Enddatum',
    'votes' => 'Stimmen',

    'table' => [
        'title' => 'Titel',
        'max_votes' => 'Max. Stimmen',
        'unlimited_votes' => 'Unbegrenzte Stimmen',
        'votes' => 'Stimmen',
        'name' => 'Name',
        'custom_input' => 'Benutzerdefinierte Eingabe',
        'description' => 'Beschreibung',
        'end_date' => 'Enddatum',
    ],

    'buttons' => [
        'add_answer' => 'Antwort hinzufügen',
        'export' => 'Exportieren',
    ],

    'modals' => [
        'delete_poll' => [
            'title' => 'Umfrage löschen',
            'description' => 'Bist du sicher, dass du die Umfrage löschen möchtest?',
            'buttons' => [
                'delete_poll' => 'Umfrage löschen',
            ],
        ],
        'add_vote' => [
            'custom_input' => [
                'title' => 'Benutzerdefinierte Eingabe',
                'description' => 'Diese Stimme erfordert eine benutzerdefinierte Eingabe.',

                'custom_input' => 'Benutzerdefinierte Eingabe',
            ],

            'title' => 'Stimme hinzufügen',
            'description' => 'Füge eine Stimme zur Umfrage hinzu.',

            'name' => 'Name',
            'poll_answers' => 'Antworten',
            'poll_answers_placeholder' => 'Wähle eine Antworten aus',

            'buttons' => [
                'add_vote' => 'Weitere Stimme hinzufügen',
                'vote' => 'Stimme hinzufügen',
            ],
        ],
        'add_answer' => [
            'title' => 'Antwort hinzufügen',
            'description' => 'Füge eine Antwort zur Umfrage hinzu.',

            'max_votes' => 'Max. Stimmen',
            'unlimited_votes' => 'Unbegrenzte Stimmen',
            'unlimited_votes_hint' => 'Wenn angekreuzt, hat die Antwort unbegrenzt viele Stimmen',
            'use_custom_input' => 'Benutzerdefinierte Eingabe verwenden',
            'custom_input_hint' => 'Wenn angekreuzt, kann die Antwort eine benutzerdefinierte Eingabe haben',

            'notifications' => [
                'answer_added' => 'Antwort erfolgreich hinzugefügt',
            ],

            'buttons' => [
                'add_answer' => 'Antwort hinzufügen',
            ],
        ],
        'update_answer' => [
            'title' => 'Antwort aktualisieren',
            'description' => 'Aktualisiere eine Antwort',

            'max_votes' => 'Max. Stimmen',
            'unlimited_votes' => 'Unbegrenzte Stimmen',
            'use_custom_input' => 'Benutzerdefinierte Eingabe verwenden',

            'notifications' => [
                'answer_updated' => 'Antwort erfolgreich aktualisiert',
            ],

            'buttons' => [
                'update_answer' => 'Antwort aktualisieren',
            ],
        ],
    ],

    'create_poll' => [
        'title' => 'Umfrage erstellen',
        'tab_title' => 'Umfrage erstellen',

        'notifications' => [
            'poll_created' => 'Umfrage erfolgreich erstellt',
        ],

        'buttons' => [
            'create_poll' => 'Umfrage erstellen',
        ],
    ],

    'find_poll' => [
        'title' => 'Umfrage finden',
        'tab_title' => 'Umfrage finden',

        'no_polls_found' => 'Keine Umfragen unter dieser E-Mail-Adresse gefunden',

        'buttons' => [
            'search' => 'Suchen',
        ],
    ],

    'admin_dashboard' => [
        'title' => 'Umfrage Admin | :title',
        'tab_title' => 'Umfragen » Admin :title',

        'public_link' => 'Öffentlicher Link',
        'admin_link' => 'Administrationslink',

        'notifications' => [
            'copied_to_clipboard' => 'Erfolgreich in die Zwischenablage kopiert',
            'poll_deleted' => 'Umfrage erfolgreich gelöscht',
            'poll_updated' => 'Umfrage erfolgreich aktualisiert',
        ],

        'tabs' => [
            'answers' => 'Antworten',
            'votes' => 'Stimmen',
        ],

        'buttons' => [
            'copy_to_clipboard' => 'In die Zwischenablage kopieren',
            'delete_poll' => 'Umfrage löschen',
            'update_poll' => 'Umfrage aktualisieren',
        ],
    ],

    'vote' => [
        'title' => 'Umfrage | :title',
        'tab_title' => 'Umfragen » :title',
        'poll_ended' => 'Diese Umfrage ist beendet',

        'notifications' => [
            'vote_added' => 'Stimme erfolgreich hinzugefügt',
        ],

        'buttons' => [
            'vote' => 'Stimme hinzufügen',
        ],
    ],
];
