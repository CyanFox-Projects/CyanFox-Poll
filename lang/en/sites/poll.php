<?php

return [
    'title' => 'Title',
    'description' => 'Description',
    'email' => 'Email',
    'email_hint' => 'Email is optional and will only be used in the find poll feature.',
    'end_date' => 'End Date',
    'votes' => 'Votes',

    'table' => [
        'title' => 'Title',
        'max_votes' => 'Max Votes',
        'unlimited_votes' => 'Unlimited Votes',
        'votes' => 'Votes',
        'name' => 'Name',
        'custom_input' => 'Custom Input',
        'description' => 'Description',
        'end_date' => 'End Date',
    ],

    'buttons' => [
        'add_answer' => 'Add Answer',
        'export' => 'Export',
    ],

    'modals' => [
        'delete_poll' => [
            'title' => 'Delete Poll',
            'description' => 'Are you sure you want to delete this poll?',
            'buttons' => [
                'delete_poll' => 'Delete Poll',
            ],
        ],
        'add_vote' => [
            'custom_input' => [
                'title' => 'Enter custom input',
                'description' => 'The vote requires a custom input',

                'custom_input' => 'Custom Input',
            ],

            'title' => 'Add Vote',
            'description' => 'Add a new vote to the poll.',

            'name' => 'Name',
            'poll_answers' => 'Poll Answers',
            'poll_answers_placeholder' => 'Select an answer',

            'buttons' => [
                'add_vote' => 'Add Vote',
                'vote' => 'Vote',
            ],
        ],
        'add_answer' => [
            'title' => 'Add Answer',
            'description' => 'Add a new answer to the poll.',

            'max_votes' => 'Max Votes',
            'unlimited_votes' => 'Unlimited Votes',
            'use_custom_input' => 'Use Custom Input',

            'notifications' => [
                'answer_added' => 'Answer added successfully',
            ],

            'buttons' => [
                'add_answer' => 'Add Answer',
            ],
        ],
        'update_answer' => [
            'title' => 'Update Answer',
            'description' => 'Update an existing answer',

            'max_votes' => 'Max Votes',
            'unlimited_votes' => 'Unlimited Votes',
            'use_custom_input' => 'Use Custom Input',

            'notifications' => [
                'answer_updated' => 'Answer updated successfully',
            ],

            'buttons' => [
                'update_answer' => 'Update Answer',
            ],
        ],
    ],

    'create_poll' => [
        'title' => 'Create Poll',
        'tab_title' => 'Create Poll',

        'notifications' => [
            'poll_created' => 'Poll created successfully',
        ],

        'buttons' => [
            'create_poll' => 'Create Poll',
        ],
    ],

    'find_poll' => [
        'title' => 'Find Poll',
        'tab_title' => 'Find Poll',

        'no_polls_found' => 'No polls found for this email.',

        'buttons' => [
            'search' => 'Search',
        ],
    ],

    'admin_dashboard' => [
        'title' => 'Poll Admin | :title',
        'tab_title' => 'Polls » Admin :title',

        'public_link' => 'Public Link',
        'admin_link' => 'Admin Link',

        'notifications' => [
            'copied_to_clipboard' => 'Copied to clipboard',
            'poll_deleted' => 'Poll deleted successfully',
            'poll_updated' => 'Poll updated successfully',
        ],

        'tabs' => [
            'answers' => 'Answers',
            'votes' => 'Votes',
        ],

        'buttons' => [
            'copy_to_clipboard' => 'Copy to Clipboard',
            'delete_poll' => 'Delete Poll',
            'update_poll' => 'Update Poll',
        ],
    ],

    'vote' => [
        'title' => 'Vote | :title',
        'tab_title' => 'Polls » Vote :title',

        'notifications' => [
            'vote_added' => 'Vote added successfully',
        ],

        'buttons' => [
            'vote' => 'Vote',
        ],
    ],
];
