<?php

return [
    'create' => [
        'title' => 'Create Service',
        'description' => 'Add a new service to monitor.',
        'form' => [
            'service_group' => 'Service Group',
            'select_group' => 'Select a group',
            'name' => 'Name',
            'name_placeholder' => 'API Service',
            'description' => 'Description',
            'description_placeholder' => 'Service description',
            'url' => 'URL',
            'url_placeholder' => 'https://api.example.com/status',
            'method' => 'Method',
            'expected_status_code' => 'Expected Status Code',
            'timeout' => 'Timeout',
            'timeout_help' => 'Timeout in seconds',
            'display_order' => 'Display Order',
            'display_order_help' => 'Lower numbers will be displayed first',
            'headers' => 'Headers',
            'headers_help' => 'JSON format for request headers',
            'payload' => 'Payload',
            'payload_help' => 'JSON format for request body',
            'active' => 'Active',
            'active_help' => 'Enable or disable service monitoring',
            'cancel' => 'Cancel',
            'submit' => 'Create'
        ],
        'validation' => [
            'form_errors' => 'Form validation errors',
            'validation_errors' => 'Validation errors occurred',
            'field_required' => 'is required',
            'invalid_json_headers' => 'Invalid JSON format for headers',
            'invalid_json_payload' => 'Invalid JSON format for payload'
        ]
    ],
    'edit' => [
        'title' => 'Edit Service',
        'description' => 'Update service information.',
        'form' => [
            'service_group' => 'Service Group',
            'select_group' => 'Select a group',
            'name' => 'Name',
            'name_placeholder' => 'API Service',
            'description' => 'Description',
            'description_placeholder' => 'Service description',
            'url' => 'URL',
            'url_placeholder' => 'https://api.example.com/status',
            'method' => 'Method',
            'expected_status_code' => 'Expected Status Code',
            'timeout' => 'Timeout',
            'timeout_help' => 'Timeout in seconds',
            'display_order' => 'Display Order',
            'display_order_help' => 'Lower numbers will be displayed first',
            'headers' => 'Headers',
            'headers_help' => 'JSON format for request headers',
            'payload' => 'Payload',
            'payload_help' => 'JSON format for request body',
            'active' => 'Active',
            'active_help' => 'Enable or disable service monitoring',
            'cancel' => 'Cancel',
            'submit' => 'Update'
        ],
        'validation' => [
            'form_errors' => 'Form validation errors',
            'validation_errors' => 'Validation errors occurred',
            'field_required' => 'is required',
            'invalid_json_headers' => 'Invalid JSON format for headers',
            'invalid_json_payload' => 'Invalid JSON format for payload'
        ]
    ],
    'index' => [
        'title' => 'Services',
        'add_new' => 'Add New Service',
        'no_services' => 'No services found',
        'create_first' => 'Create your first service',
        'table' => [
            'name' => 'Name',
            'group' => 'Group',
            'url' => 'URL',
            'status' => 'Status',
            'active' => 'Active',
            'actions' => 'Actions',
            'view' => 'View',
            'edit' => 'Edit',
            'check' => 'Check'
        ],
        'status' => [
            'working' => 'Working',
            'not_working' => 'Not Working',
            'not_checked' => 'Not Checked'
        ],
        'active' => [
            'yes' => 'Yes',
            'no' => 'No'
        ]
    ],
    'show' => [
        'title' => 'Service Details',
        'description' => 'Service details and monitoring information',
        'actions' => [
            'edit' => 'Edit',
            'delete' => 'Delete',
            'delete_confirm' => 'Are you sure you want to delete this service?'
        ],
        'details' => [
            'service_group' => 'Service Group',
            'name' => 'Name',
            'description' => 'Description',
            'no_description' => 'No description provided',
            'url' => 'URL',
            'method' => 'Method',
            'expected_status_code' => 'Expected Status Code',
            'timeout' => 'Timeout',
            'active' => 'Active',
            'display_order' => 'Display Order',
            'headers' => 'Headers',
            'no_headers' => 'No headers',
            'payload' => 'Payload',
            'no_payload' => 'No payload',
            'created_at' => 'Created At',
            'updated_at' => 'Last Updated'
        ],
        'status' => [
            'active' => 'Active',
            'inactive' => 'Inactive'
        ],
        'uptime' => [
            'title' => 'Recent Uptime Checks',
            'description' => 'Last 10 uptime checks for this service',
            'table' => [
                'date' => 'Date',
                'status' => 'Status',
                'response_time' => 'Response Time',
                'status_code' => 'Status Code',
                'error' => 'Error'
            ],
            'status' => [
                'successful' => 'Successful',
                'failed' => 'Failed'
            ]
        ]
    ]
]; 