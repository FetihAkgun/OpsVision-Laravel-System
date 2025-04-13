<?php

return [
    'create' => [
        'title' => 'Servis Oluştur',
        'description' => 'İzlemek için yeni bir servis ekleyin.',
        'form' => [
            'service_group' => 'Servis Grubu',
            'select_group' => 'Bir grup seçin',
            'name' => 'İsim',
            'name_placeholder' => 'API Servisi',
            'description' => 'Açıklama',
            'description_placeholder' => 'Servis açıklaması',
            'url' => 'URL',
            'url_placeholder' => 'https://api.example.com/status',
            'method' => 'Metot',
            'expected_status_code' => 'Beklenen Durum Kodu',
            'timeout' => 'Zaman Aşımı',
            'timeout_help' => 'Saniye cinsinden zaman aşımı',
            'display_order' => 'Görüntüleme Sırası',
            'display_order_help' => 'Düşük sayılar önce görüntülenecektir',
            'headers' => 'Başlıklar',
            'headers_help' => 'İstek başlıkları için JSON formatı',
            'payload' => 'İçerik',
            'payload_help' => 'İstek gövdesi için JSON formatı',
            'active' => 'Aktif',
            'active_help' => 'Servis izlemeyi etkinleştir veya devre dışı bırak',
            'cancel' => 'İptal',
            'submit' => 'Oluştur'
        ],
        'validation' => [
            'form_errors' => 'Form doğrulama hataları',
            'validation_errors' => 'Doğrulama hataları oluştu',
            'field_required' => 'zorunludur',
            'invalid_json_headers' => 'Başlıklar için geçersiz JSON formatı',
            'invalid_json_payload' => 'İçerik için geçersiz JSON formatı'
        ]
    ],
    'edit' => [
        'title' => 'Servisi Düzenle',
        'description' => 'Servis bilgilerini güncelleyin.',
        'form' => [
            'service_group' => 'Servis Grubu',
            'select_group' => 'Bir grup seçin',
            'name' => 'İsim',
            'name_placeholder' => 'API Servisi',
            'description' => 'Açıklama',
            'description_placeholder' => 'Servis açıklaması',
            'url' => 'URL',
            'url_placeholder' => 'https://api.example.com/status',
            'method' => 'Metot',
            'expected_status_code' => 'Beklenen Durum Kodu',
            'timeout' => 'Zaman Aşımı',
            'timeout_help' => 'Saniye cinsinden zaman aşımı',
            'display_order' => 'Görüntüleme Sırası',
            'display_order_help' => 'Düşük sayılar önce görüntülenecektir',
            'headers' => 'Başlıklar',
            'headers_help' => 'İstek başlıkları için JSON formatı',
            'payload' => 'İçerik',
            'payload_help' => 'İstek gövdesi için JSON formatı',
            'active' => 'Aktif',
            'active_help' => 'Servis izlemeyi etkinleştir veya devre dışı bırak',
            'cancel' => 'İptal',
            'submit' => 'Güncelle'
        ],
        'validation' => [
            'form_errors' => 'Form doğrulama hataları',
            'validation_errors' => 'Doğrulama hataları oluştu',
            'field_required' => 'zorunludur',
            'invalid_json_headers' => 'Başlıklar için geçersiz JSON formatı',
            'invalid_json_payload' => 'İçerik için geçersiz JSON formatı'
        ]
    ],
    'index' => [
        'title' => 'Servisler',
        'add_new' => 'Yeni Servis Ekle',
        'no_services' => 'Servis bulunamadı',
        'create_first' => 'İlk servisinizi oluşturun',
        'table' => [
            'name' => 'İsim',
            'group' => 'Grup',
            'url' => 'URL',
            'status' => 'Durum',
            'active' => 'Aktif',
            'actions' => 'İşlemler',
            'view' => 'Görüntüle',
            'edit' => 'Düzenle',
            'check' => 'Kontrol Et'
        ],
        'status' => [
            'working' => 'Çalışıyor',
            'not_working' => 'Çalışmıyor',
            'not_checked' => 'Kontrol Edilmedi'
        ],
        'active' => [
            'yes' => 'Evet',
            'no' => 'Hayır'
        ]
    ],
    'show' => [
        'title' => 'Servis Detayları',
        'description' => 'Servis detayları ve izleme bilgileri',
        'actions' => [
            'edit' => 'Düzenle',
            'delete' => 'Sil',
            'delete_confirm' => 'Bu servisi silmek istediğinizden emin misiniz?'
        ],
        'details' => [
            'service_group' => 'Servis Grubu',
            'name' => 'İsim',
            'description' => 'Açıklama',
            'no_description' => 'Açıklama bulunmuyor',
            'url' => 'URL',
            'method' => 'Metot',
            'expected_status_code' => 'Beklenen Durum Kodu',
            'timeout' => 'Zaman Aşımı',
            'active' => 'Aktif',
            'display_order' => 'Görüntüleme Sırası',
            'headers' => 'Başlıklar',
            'no_headers' => 'Başlık yok',
            'payload' => 'İçerik',
            'no_payload' => 'İçerik yok',
            'created_at' => 'Oluşturulma Tarihi',
            'updated_at' => 'Son Güncelleme'
        ],
        'status' => [
            'active' => 'Aktif',
            'inactive' => 'Pasif'
        ],
        'uptime' => [
            'title' => 'Son Erişilebilirlik Kontrolleri',
            'description' => 'Bu servis için son 10 erişilebilirlik kontrolü',
            'table' => [
                'date' => 'Tarih',
                'status' => 'Durum',
                'response_time' => 'Yanıt Süresi',
                'status_code' => 'Durum Kodu',
                'error' => 'Hata'
            ],
            'status' => [
                'successful' => 'Başarılı',
                'failed' => 'Başarısız'
            ]
        ]
    ]
]; 