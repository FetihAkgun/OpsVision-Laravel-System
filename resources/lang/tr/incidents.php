<?php

return [
    'create' => [
        'title' => 'Olay Oluştur',
        'description' => 'Yeni bir olay veya kesinti bildirin.',
        'form' => [
            'title' => 'Başlık',
            'title_placeholder' => 'API Servis Kesintisi',
            'description' => 'Açıklama',
            'description_placeholder' => 'Olayın detaylı açıklaması',
            'status' => 'Durum',
            'impact' => 'Etki Seviyesi',
            'affected_services' => 'Etkilenen Servisler',
            'start_date' => 'Başlangıç Tarihi',
            'start_date_help' => 'Olay ne zaman başladı? Şimdiki zaman için boş bırakın.',
            'resolution_date' => 'Çözüm Tarihi',
            'resolution_date_help' => 'Olay ne zaman çözüldü? Devam ediyorsa boş bırakın.',
            'visible' => 'Görünür',
            'visible_help' => 'Bu olayı durum sayfasında herkese açık olarak görünür yap.',
            'cancel' => 'İptal',
            'submit' => 'Oluştur',
            'saving' => 'Kaydediliyor...',
            'validation' => [
                'no_services' => 'Lütfen en az bir servis seçin!',
                'required_fields' => 'Lütfen aşağıdaki hataları düzeltin:',
            ]
        ],
        'status_options' => [
            'investigating' => 'İnceleniyor',
            'identified' => 'Tanımlandı',
            'monitoring' => 'İzleniyor',
            'resolved' => 'Çözüldü'
        ],
        'impact_options' => [
            'minor' => 'Küçük',
            'major' => 'Büyük',
            'critical' => 'Kritik'
        ]
    ],
    'edit' => [
        'title' => 'Olay Düzenle',
        'description' => 'Olay detaylarını ve etkilenen servisleri güncelleyin.',
        'form' => [
            'title' => 'Başlık',
            'title_placeholder' => 'API Servis Kesintisi',
            'description' => 'Açıklama',
            'description_placeholder' => 'Olayın detaylı açıklaması',
            'status' => 'Durum',
            'impact' => 'Etki Seviyesi',
            'affected_services' => 'Etkilenen Servisler',
            'start_date' => 'Başlangıç Tarihi',
            'start_date_help' => 'Olay ne zaman başladı?',
            'resolution_date' => 'Çözülme Tarihi',
            'resolution_date_help' => 'Olay ne zaman çözüldü? Devam ediyorsa boş bırakın.',
            'visible' => 'Görünür',
            'visible_help' => 'Bu olayı durum sayfasında herkese açık olarak görünür yapın.',
            'cancel' => 'İptal',
            'submit' => 'Güncelle',
            'saving' => 'Güncelleniyor...',
            'validation' => [
                'no_services' => 'Lütfen en az bir servis seçin!',
                'required_fields' => 'Lütfen aşağıdaki hataları düzeltin:',
            ]
        ],
        'status_options' => [
            'investigating' => 'İnceleniyor',
            'identified' => 'Belirlendi',
            'monitoring' => 'İzleniyor',
            'resolved' => 'Çözüldü'
        ],
        'impact_options' => [
            'none' => 'Yok',
            'minor' => 'Düşük',
            'major' => 'Yüksek',
            'critical' => 'Kritik'
        ]
    ],
    'show' => [
        'title' => 'Olay Detayları',
        'description' => 'Olay detaylarını görüntüleyin ve yönetin.',
        'actions' => [
            'edit' => 'Düzenle',
            'delete' => 'Sil',
            'back' => 'Listeye Dön',
            'delete_confirm' => 'Bu olayı silmek istediğinizden emin misiniz?'
        ],
        'details' => [
            'title' => 'Başlık',
            'description' => 'Açıklama',
            'status' => 'Durum',
            'impact' => 'Etki',
            'start_date' => 'Başlangıç Tarihi',
            'resolution_date' => 'Çözülme Tarihi',
            'visible' => 'Durum Sayfasında Görünür',
            'created_at' => 'Oluşturulma Tarihi',
            'affected_services' => 'Etkilenen Servisler',
            'no_services' => 'Etkilenen servis yok'
        ],
        'status' => [
            'investigating' => 'İnceleniyor',
            'identified' => 'Belirlendi',
            'monitoring' => 'İzleniyor',
            'resolved' => 'Çözüldü'
        ],
        'impact' => [
            'critical' => 'Kritik',
            'major' => 'Yüksek',
            'minor' => 'Düşük',
            'none' => 'Yok'
        ],
        'visibility' => [
            'yes' => 'Evet',
            'no' => 'Hayır'
        ]
    ]
]; 