<?php

return [
    'title' => 'Sistem Durumu',
    'active_incidents' => [
        'title' => 'Aktif Olaylar',
        'warning' => 'Şu anda bazı sorunlar yaşıyoruz',
        'impact' => [
            'critical' => 'Kritik',
            'major' => 'Büyük',
            'minor' => 'Küçük',
            'none' => 'Hiçbiri'
        ],
        'status' => 'Durum',
        'affected_services' => 'Etkilenen servisler',
        'incident_reported' => 'Olay Bildirildi'
    ],
    'all_systems_operational' => 'Tüm sistemler çalışıyor',
    'service' => [
        'status' => [
            'operational' => 'Çalışıyor',
            'not_operational' => 'Çalışmıyor',
            'not_checked' => 'Kontrol edilmedi'
        ],
        'uptime' => ':percentage çalışma süresi'
    ]
]; 