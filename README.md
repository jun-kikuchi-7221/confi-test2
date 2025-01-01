# お問い合わせフォーム

## 環境構築

Docker ビルド

    1.git clone git@github.com:coachtech-material/laravel-docker-template.git
    2.docker compose up -d --build

Laravel 環境構築

    1.docker compose exec php bash
    2.composer install
    3..env.exampleファイルから.envを作成し、環境変数を変更
    4.php artisan key:generate
    5.php artisan migrate
    6.php artisan db:seed

## 使用技術

    ・PHP 7.4.9
    ・Laravel Framework 8.83.8
    ・Mysql 8.0.26

## ER図

![confi test](https://github.com/user-attachments/assets/63bf7262-779a-4c08-8e30-4dbb79a63c1c)

    

## URL

    ・開発環境：http://localhost/HOME
    ・phpMyAdmin：http://localhost:8080/
