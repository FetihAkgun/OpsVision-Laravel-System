<?php

return [
    'create' => [
        'title' => 'Create Incident',
        'description' => 'Report a new incident or outage.',
        'form' => [
            'title' => 'Title',
            'title_placeholder' => 'API Service Outage',
            'description' => 'Description',
            'description_placeholder' => 'Detailed description of the incident',
            'status' => 'Status',
            'impact' => 'Impact Level',
            'affected_services' => 'Affected Services',
            'start_date' => 'Start Date',
            'start_date_help' => 'When did the incident start? Leave empty for current time.',
            'resolution_date' => 'Resolution Date',
            'resolution_date_help' => 'When was the incident resolved? Leave empty if ongoing.',
            'visible' => 'Visible',
            'visible_help' => 'Make this incident publicly visible on the status page.',
            'cancel' => 'Cancel',
            'submit' => 'Create',
            'saving' => 'Saving...',
            'validation' => [
                'no_services' => 'Please select at least one service!',
                'required_fields' => 'Please correct the following errors:',
            ]
        ],
        'status_options' => [
            'investigating' => 'Investigating',
            'identified' => 'Identified',
            'monitoring' => 'Monitoring',
            'resolved' => 'Resolved'
        ],
        'impact_options' => [
            'minor' => 'Minor',
            'major' => 'Major',
            'critical' => 'Critical'
        ]
    ],
    'edit' => [
        'title' => 'Edit Incident',
        'description' => 'Update incident details and affected services.',
        'form' => [
            'title' => 'Title',
            'title_placeholder' => 'API Service Outage',
            'description' => 'Description',
            'description_placeholder' => 'Detailed description of the incident',
            'status' => 'Status',
            'impact' => 'Impact Level',
            'affected_services' => 'Affected Services',
            'start_date' => 'Start Date',
            'start_date_help' => 'When did the incident start?',
            'resolution_date' => 'Resolution Date',
            'resolution_date_help' => 'When was the incident resolved? Leave empty if ongoing.',
            'visible' => 'Visible',
            'visible_help' => 'Make this incident publicly visible on the status page.',
            'cancel' => 'Cancel',
            'submit' => 'Update',
            'saving' => 'Updating...',
            'validation' => [
                'no_services' => 'Please select at least one service!',
                'required_fields' => 'Please correct the following errors:',
            ]
        ],
        'status_options' => [
            'investigating' => 'Investigating',
            'identified' => 'Identified',
            'monitoring' => 'Monitoring',
            'resolved' => 'Resolved'
        ],
        'impact_options' => [
            'none' => 'None',
            'minor' => 'Minor',
            'major' => 'Major',
            'critical' => 'Critical'
        ]
    ],
    'show' => [
        'title' => 'Incident Details',
        'description' => 'View and manage incident details.',
        'actions' => [
            'edit' => 'Edit',
            'delete' => 'Delete',
            'back' => 'Back to List',
            'delete_confirm' => 'Are you sure you want to delete this incident?'
        ],
        'details' => [
            'title' => 'Title',
            'description' => 'Description',
            'status' => 'Status',
            'impact' => 'Impact',
            'start_date' => 'Start Date',
            'resolution_date' => 'Resolution Date',
            'visible' => 'Visible on Status Page',
            'created_at' => 'Created At',
            'affected_services' => 'Affected Services',
            'no_services' => 'No affected services'
        ],
        'status' => [
            'investigating' => 'Investigating',
            'identified' => 'Identified',
            'monitoring' => 'Monitoring',
            'resolved' => 'Resolved'
        ],
        'impact' => [
            'critical' => 'Critical',
            'major' => 'Major',
            'minor' => 'Minor',
            'none' => 'None'
        ],
        'visibility' => [
            'yes' => 'Yes',
            'no' => 'No'
        ]
    ]
]; 