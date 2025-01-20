# authentication

## Persyaratan

- PHP >= 8
- Composer
- Web server seperti Apache atau Nginx
- Database

## Langkah-langkah Instalasi

1. **Clone repositori**

   Gunakan perintah berikut untuk meng-clone repositori ke komputer lokal Anda:

   ```bash
   git clone https://github.com/haikalirhamna/authentication.git
   cd repo-name
   ```

2. **Import Database**

    Setelah berhasil meng-clone repositori pindah ke folder direktori:

    ```bash
    cd nama-folder
    ```

    Lalu import database dari backups.sql

    ```bash
    mysql -u username-database -p nama-database < backups.sql
    ```

3. **Jalankan App**
  
     Pastikan folder telah ada didalam folder www pada laragon atau htdocs pada xampp, lalu jalankan laragon atau xampp, untuk mengakses app anda dapat mengecek pada url berikut:

     ```bash
     http://localhost/nama-folder/index.php
     ```
