# FashionablyLate(お問い合わせフォーム)

## 環境構築

Docker ビルド

    1.git clone git@github.com:jun-kikuchi-7221/confi-test2.git
    2.DockerDesktopアプリを立ち上げる
    3.docker compose up -d --build
    MacのM1チップのPCだったのでdocker-compose.ymlファイルの内容をそのままに
    docker compose up -d --buildをすると"no matching manifest for linux/arm64/v8 in the manifest list entries"というエラーが出るので下記のようにコンテナ毎に"platform: linux/x86_64"を追記した。
    またファイル先頭の"version '3.8'"の記述"も不必要だった為、削除した。

    例：
    mysql:
    platform: linux/x86_64(この文追加)
    image: mysql:8.0.26
    environment:

Laravel 環境構築

    ※docker composeコマンドは今のバージョンでは間のハイフンが不必要になり半角スペースで良くなった。
    仮にハイフンを入れるとエラーが出るので注意。
    1.docker compose exec php bash
    2.composer install
    3.「.env.example」ファイルから内容をコピーし「.env」ファイルに内容をペースト。
    4.下記の部分の環境変数の値を変更

    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=laravel_db
    DB_USERNAME=laravel_user
    DB_PASSWORD=laravel_pass

    5.アプリケーションキーの作成

    php artisan key:generate

    6.マイグレーションの実行

    php artisan migrate

    7.シーディングの実行
    現在は、"DatabaseSeeder.php"への登録は"factory"で"ContactsTableSeeder.php"が登録されている。もし"CategoriesTableSeeder.php"のシーディングが必要な場合は"DatabaseSeeder.php"にコメントアウトで残してあるのでそちらを活かして"ContactsTableSeeder.php"はコメントアウトして使い分けるのが望ましいと思われる。

    php artisan db:seed

## 使用技術

    ・PHP 7.4.9
    ・Laravel Framework 8.83.8
    ・Mysql 8.0.26

## ER 図

![confi test](https://github.com/user-attachments/assets/63bf7262-779a-4c08-8e30-4dbb79a63c1c)

## URL

    ・開発環境:http://localhost/home
    ・phpMyAdmin：http://localhost:8080/
