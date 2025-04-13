<?php

return [
    'create' => [
        'title' => 'Servis Grubu Oluştur',
        'description' => 'Servislerinizi düzenlemek için yeni bir grup oluşturun.',
        'form' => [
            'name' => 'İsim',
            'name_placeholder' => 'API Servisleri',
            'description' => 'Açıklama',
            'description_placeholder' => 'API ile ilgili tüm servisler için bir grup',
            'display_order' => 'Görüntüleme Sırası',
            'display_order_help' => 'Düşük sayılar önce görüntülenecektir.',
            'cancel' => 'İptal',
            'submit' => 'Oluştur'
        ]
    ],
    'edit' => [
        'title' => 'Servis Grubunu Düzenle',
        'description' => 'Servis grubu bilgilerini güncelleyin.',
        'form' => [
            'name' => 'İsim',
            'name_placeholder' => 'API Servisleri',
            'description' => 'Açıklama',
            'description_placeholder' => 'API ile ilgili tüm servisler için bir grup',
            'display_order' => 'Görüntüleme Sırası',
            'display_order_help' => 'Düşük sayılar önce görüntülenecektir.',
            'cancel' => 'İptal',
            'submit' => 'Güncelle'
        ]
    ],
    'show' => [
        'title' => 'Servis Grubu Detayları',
        'description' => 'Servis grubu detayları',
        'actions' => [
            'edit' => 'Grubu Düzenle',
            'add_service' => 'Servis Ekle',
            'add_first_service' => 'İlk servisinizi ekleyin'
        ],
        'details' => [
            'name' => 'İsim',
            'display_order' => 'Görüntüleme Sırası',
            'description' => 'Açıklama',
            'no_description' => 'Açıklama bulunmuyor',
            'services' => 'Bu Gruptaki Servisler',
            'no_services' => 'Bu grupta servis bulunamadı.'
        ],
        'table' => [
            'name' => 'İsim',
            'url' => 'URL',
            'status' => 'Durum',
            'display_order' => 'Görüntüleme Sırası',
            'actions' => 'İşlemler',
            'view' => 'Görüntüle',
            'edit' => 'Düzenle',
            'check' => 'Kontrol Et'
        ],
        'status' => [
            'operational' => 'Çalışıyor',
            'not_operational' => 'Çalışmıyor',
            'not_checked' => 'Kontrol edilmedi'
        ]
    ]
]; 