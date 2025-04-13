<?php

return [
    'title' => 'System Status',
    'active_incidents' => [
        'title' => 'Active Incidents',
        'warning' => 'We are currently experiencing some issues',
        'impact' => [
            'critical' => 'Critical',
            'major' => 'Major',
            'minor' => 'Minor',
            'none' => 'None'
        ],
        'status' => 'Status',
        'affected_services' => 'Affected services',
        'incident_reported' => 'Incident Reported'
    ],
    'all_systems_operational' => 'All systems are operational',
    'service' => [
        'status' => [
            'operational' => 'Operational',
            'not_operational' => 'Not Operational',
            'not_checked' => 'Not Checked'
        ],
        'uptime' => ':percentage uptime'
    ]
]; 