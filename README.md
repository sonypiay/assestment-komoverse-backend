# Simple REST API Score Game

### Tech Stack
- PHP 8.3
- Laravel 11
- MariaDB

### Installation
```
composer install
```

Copy file .env.example dan simpan sebagai .env
```
cp .env.example .env
```

Generate APP_KEY menggunakan perintah berikut:
```
php artisan key:generate --ansi
```

Tambahkan variable pada file .env berikut:
```
UNISYNC_SECRET_KEY=
UNISYNC_ENDPOINT=
```

Jalankan migrasi artisan untuk generate table:
```
php artisan migrate
```

Jalankan seeder untuk generate data user
```
php artisan db:seed
```
atau
```
php artisan db:seed --class=UsersSeeder
```

Jalankan aplikasi menggunakan perintah berikut:
```
php artisan serve
```

Untuk set score secara otomatis, gunakan perintah berikut:
```
php artisan db:seed --class=SetScoreSeeder
```

Untuk mereset ulang semua data, gunakan perintah berikut:
```
php artisan db:seed --class=ResetDataSeeder
```