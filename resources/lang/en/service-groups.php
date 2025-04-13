<?php

return [
    'create' => [
        'title' => 'Create Service Group',
        'description' => 'Create a new group to organize your services.',
        'form' => [
            'name' => 'Name',
            'name_placeholder' => 'API Services',
            'description' => 'Description',
            'description_placeholder' => 'A group for all API-related services',
            'display_order' => 'Display Order',
            'display_order_help' => 'Lower numbers will be displayed first.',
            'cancel' => 'Cancel',
            'submit' => 'Create'
        ]
    ],
    'edit' => [
        'title' => 'Edit Service Group',
        'description' => 'Update the service group information.',
        'form' => [
            'name' => 'Name',
            'name_placeholder' => 'API Services',
            'description' => 'Description',
            'description_placeholder' => 'A group for all API-related services',
            'display_order' => 'Display Order',
            'display_order_help' => 'Lower numbers will be displayed first.',
            'cancel' => 'Cancel',
            'submit' => 'Update'
        ]
    ],
    'show' => [
        'title' => 'Service Group Details',
        'description' => 'Service group details',
        'actions' => [
            'edit' => 'Edit Group',
            'add_service' => 'Add Service',
            'add_first_service' => 'Add your first service'
        ],
        'details' => [
            'name' => 'Name',
            'display_order' => 'Display Order',
            'description' => 'Description',
            'no_description' => 'No description provided',
            'services' => 'Services in this Group',
            'no_services' => 'No services found in this group.'
        ],
        'table' => [
            'name' => 'Name',
            'url' => 'URL',
            'status' => 'Status',
            'display_order' => 'Display Order',
            'actions' => 'Actions',
            'view' => 'View',
            'edit' => 'Edit',
            'check' => 'Check'
        ],
        'status' => [
            'operational' => 'Operational',
            'not_operational' => 'Not Operational',
            'not_checked' => 'Not checked'
        ]
    ]
]; 