<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceGroup;
use Illuminate\Database\Seeder;

class ServiceGroupSeeder extends Seeder
{
    public function run(): void
    {
        $serviceGroups = [
            [
                'name' => 'Web Servisleri',
                'description' => 'Web tabanlı servisler ve API\'ler',
                'display_order' => 1,
                'services' => [
                    [
                        'name' => 'Ana Web Sitesi',
                        'description' => 'Ana web sitesi kontrolü',
                        'url' => 'https://example.com',
                        'method' => 'GET',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 1,
                    ],
                    [
                        'name' => 'Blog API',
                        'description' => 'Blog içerik API\'si',
                        'url' => 'https://api.example.com/blog',
                        'method' => 'GET',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 2,
                    ],
                    [
                        'name' => 'Kullanıcı API',
                        'description' => 'Kullanıcı yönetim API\'si',
                        'url' => 'https://api.example.com/users',
                        'method' => 'GET',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 3,
                    ],
                    [
                        'name' => 'Ürün API',
                        'description' => 'Ürün kataloğu API\'si',
                        'url' => 'https://api.example.com/products',
                        'method' => 'GET',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 4,
                    ],
                ],
            ],
            [
                'name' => 'Veritabanı Servisleri',
                'description' => 'Veritabanı bağlantı ve performans servisleri',
                'display_order' => 2,
                'services' => [
                    [
                        'name' => 'MySQL Veritabanı',
                        'description' => 'Ana veritabanı servisi',
                        'url' => 'mysql://localhost:3306',
                        'method' => 'GET',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 1,
                    ],
                    [
                        'name' => 'Redis Önbellek',
                        'description' => 'Redis önbellek servisi',
                        'url' => 'redis://localhost:6379',
                        'method' => 'GET',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 2,
                    ],
                    [
                        'name' => 'MongoDB Veritabanı',
                        'description' => 'NoSQL veritabanı servisi',
                        'url' => 'mongodb://localhost:27017',
                        'method' => 'GET',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 3,
                    ],
                    [
                        'name' => 'PostgreSQL Veritabanı',
                        'description' => 'Analitik veritabanı servisi',
                        'url' => 'postgresql://localhost:5432',
                        'method' => 'GET',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 4,
                    ],
                ],
            ],
            [
                'name' => 'E-posta Servisleri',
                'description' => 'E-posta gönderim ve alım servisleri',
                'display_order' => 3,
                'services' => [
                    [
                        'name' => 'SMTP Sunucusu',
                        'description' => 'Ana e-posta gönderim servisi',
                        'url' => 'smtp://mail.example.com:587',
                        'method' => 'GET',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 1,
                    ],
                    [
                        'name' => 'IMAP Sunucusu',
                        'description' => 'E-posta alım servisi',
                        'url' => 'imap://mail.example.com:993',
                        'method' => 'GET',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 2,
                    ],
                    [
                        'name' => 'E-posta API',
                        'description' => 'E-posta işlem API\'si',
                        'url' => 'https://api.example.com/email',
                        'method' => 'GET',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 3,
                    ],
                    [
                        'name' => 'E-posta Kuyruğu',
                        'description' => 'E-posta kuyruk servisi',
                        'url' => 'https://queue.example.com/email',
                        'method' => 'GET',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 4,
                    ],
                ],
            ],
            [
                'name' => 'Ödeme Servisleri',
                'description' => 'Ödeme işlem ve entegrasyon servisleri',
                'display_order' => 4,
                'services' => [
                    [
                        'name' => 'Ödeme API',
                        'description' => 'Ana ödeme işlem API\'si',
                        'url' => 'https://api.example.com/payment',
                        'method' => 'POST',
                        'timeout' => 10,
                        'expected_status_code' => 200,
                        'display_order' => 1,
                    ],
                    [
                        'name' => 'Banka Entegrasyonu',
                        'description' => 'Banka entegrasyon servisi',
                        'url' => 'https://api.example.com/bank',
                        'method' => 'POST',
                        'timeout' => 10,
                        'expected_status_code' => 200,
                        'display_order' => 2,
                    ],
                    [
                        'name' => 'Ödeme Kuyruğu',
                        'description' => 'Ödeme işlem kuyruk servisi',
                        'url' => 'https://queue.example.com/payment',
                        'method' => 'GET',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 3,
                    ],
                    [
                        'name' => 'Fatura API',
                        'description' => 'Fatura oluşturma API\'si',
                        'url' => 'https://api.example.com/invoice',
                        'method' => 'POST',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 4,
                    ],
                ],
            ],
            [
                'name' => 'Dosya Servisleri',
                'description' => 'Dosya depolama ve yönetim servisleri',
                'display_order' => 5,
                'services' => [
                    [
                        'name' => 'Dosya Depolama',
                        'description' => 'Ana dosya depolama servisi',
                        'url' => 'https://storage.example.com',
                        'method' => 'GET',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 1,
                    ],
                    [
                        'name' => 'CDN Servisi',
                        'description' => 'İçerik dağıtım ağı servisi',
                        'url' => 'https://cdn.example.com',
                        'method' => 'GET',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 2,
                    ],
                    [
                        'name' => 'Dosya API',
                        'description' => 'Dosya işlem API\'si',
                        'url' => 'https://api.example.com/files',
                        'method' => 'GET',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 3,
                    ],
                    [
                        'name' => 'Yedekleme Servisi',
                        'description' => 'Otomatik yedekleme servisi',
                        'url' => 'https://backup.example.com',
                        'method' => 'GET',
                        'timeout' => 5,
                        'expected_status_code' => 200,
                        'display_order' => 4,
                    ],
                ],
            ],
        ];

        foreach ($serviceGroups as $groupData) {
            $services = $groupData['services'];
            unset($groupData['services']);

            $serviceGroup = ServiceGroup::create($groupData);

            foreach ($services as $serviceData) {
                $serviceData['service_group_id'] = $serviceGroup->id;
                Service::create($serviceData);
            }
        }
    }
} 