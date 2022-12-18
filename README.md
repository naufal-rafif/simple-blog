# Aplikasi Simple Blog Admin only

## Kebutuhan Pendukung
1. Visual Studio Code
2. Composer
3. XAMPP (php versi 8)

## Cara Menjalankan Aplikasi
1. Buka folder yang akan digunakan, misalnya folder <code>D:/MiniProject/</code>
2. Jalankan terminal pada folder yang akan digunakan, bisa dengan klik kanan dan pilih `open in terminal`
3. Download sourcecode ini dengan mengetikkan perintah pada cli <code>git clone https://github.com/naufal-rafif/simple-blog.git</code>
4. Setelah sourcecode terinstall, masuk kedalam folder install dengan mengetikkan <code>cd simple-blog</code> (untuk windows)
5. Kemudian, install juga seluruh dependensi yang akan digunakan dengan mengetikkan perintah <code>composer install</code>
6. kemudian ketikkan perintah <code>code .</code> untuk membuka code editor (visual studio code)
7. copy file `.env.example` dan ubah file hasil copy tersebut menjadi `.env`
8. Buka file `.env` tersebut dan ubah `APP_URL=http://localhost:8080` dan `DB_DATABASE=laravel_simple_blog` (pastikan nama database sesuai dengan nama di file .env dan terbuat pada MySQL)
9. Buka terminal pada visual studio code dan ketikkan perintah `php artisan migrate:fresh --seed` (perintah ini digunakan untuk generate tabel dan isi tabel pada database)
10. Ketikkan perintah `php artisan key:generate` untuk menambahkan kunci pada file `.env`
11. Jalankan aplikasi dengan terminal yang berbeda dan ketikkan `php artisan serve`
12. Jangan lupa untuk menjalankan XAMPP
13. Aplikasi sudah siap digunakan

## Akses Aplikasi
### Superadmin
- email = `admin@gmail.com`
- password = `password = 123456`