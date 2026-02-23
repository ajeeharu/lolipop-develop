# 開発環境
- PHPフレームワークのLaravelを使用したWebアプリの開発環境を構築する。

## 本番サーバー構成（レンタルサーバー：Lolipop）

- **OS**： Linux(Ubuntu)
- **PHP**： 8.4（LightSpeed版）
- **Web Server**： Apache 2.4.x
- **Database**： MySQL 8.0

## 開発環境（PC：Windows11）

### 開発環境構築
- **目的**：次の項目に対応するために、本番環境と同等の開発環境をPC上で構築することを目的とする。
  - 本番環境との差異（OSや各ツールのVersion)で発生する、開発環境では再現できない不具合
  - 常に本番サーバー側で開発をおこなうと、作業のオーバーヘッド及び、コンフリクト（DB、修正箇所の競合）が発生
  - PC上でのDebugの簡易
- **システム構成**：Windows11に下記のシステムを導入することにより、開発環境を構築していく
  - WSL2：Microsoftが提供する、Windows上でWindowsとLinux（Ubuntu）の両環境を同時に利用できる開発環境
  - Docker：アプリケーションの実行環境（ライブラリ、ツール、コードなど）を「コンテナ」という独立した単位にパッケージ化し、開発・テスト・本番など、どこでも同じ環境を高速・軽量に再現できるオープンソースの仮想化プラットフォーム であり、Linuxカーネルの機能を活用するコンテナ管理ツール
  - Docker Compose：複数のDockerコンテナで構成されるアプリケーションを、単一のYAMLファイル（compose.yaml）で定義・共有・一括操作（起動、停止、構築）できるツール
- **開発ツール**：Editor、バージョン管理、JavaScript
  - VSCODE：Microsoftが提供するEDITOR、整形、GIT等のプラグインが充実
  - TailwindCSS：機能単位（ユーティリティ）のクラスをHTMLに直接記述してデザインする、ユーティリティファーストのモダンなCSSフレームワーク
  - phpMyAdmin：Lolipopと同じMySQL用データベース管理ツール
  - Git：バージョン管理ツール 
  - Node.js：JavaScriptを動かすための 「プラットフォーム（基盤）」
  - npm：JavaScriptのライブラリ管理ツール（Node.jsをインストールすると同梱されている。）

### 各種ツールのインストール
  - ### WSL2のインストール  
    1. PowerShell を管理者権限で起動
	1. PowerShell 上で以下のコマンドを実行 
   
		```bash
		wsl --install
		# このコマンドで、WSL2 と Ubuntu が自動的にインストールされる
		```
	1. インストール完了後、パソコンを再起動
   - ### Ubuntu の初期設定とアップデート
     1. Ubuntu の初回起動時、以下の設定を求められる
		- ユーザー名：任意のユーザー名を入力（小文字の英数字のみ）
		- パスワード：任意のパスワードを入力（入力中は画面に表示されません）
		- パスワードの再入力：

		---
			⚠️ このパスワードは重要です。必ず覚えておいてください。  sudo コマンド実行時に必要になります。
     1. Ubuntu のアップデート
         - Ubuntu で以下のコマンドを実行して、システムを最新の状態にする
   
		```bash
		sudo apt update && sudo apt upgrade -y
		# パスワードの入力を求められたら、先ほど設定したパスワードを入力
		```
     1. インストールの確認
         - PowerShell で以下のコマンドを実行
   
		```bash
		wsl --list --verbose
		# Ubuntu が表示され、VERSION が 2 になっていれば成功
		```
  - ### Node.js と npm のインストール（Ubuntu内）
    1. Ubuntuを起動し、以下のコマンドを実行
		```bash
		sudo apt install nodejs npm -y
		```
     1. インストールの確認
         - Ubuntu で以下のコマンドを実行
   
		```bash
		node -v 
		# バージョン番号が表示されれば成功(例：v18.19.1)
		```
		```bash
		npm -v 
		# バージョン番号が表示されれば成功(例：9.2.0)
		```
  - ### Git のインストール（Ubuntu内）
    1. Ubuntuで以下のコマンドを実行
		```bash
		sudo apt install git -y
		```
     1. インストールの確認
         - Ubuntu で以下のコマンドを実行
   
		```bash
		git --version
		# バージョン番号が表示されれば成功(例：git version 2.43.0)
		```
     1. Gitの初期設定
         - Ubuntu で以下のコマンドを実行
   
		```bash
		# ユーザー名を設定
		git config --global user.name "あなたの名前"

		# メールアドレスを設定
		git config --global user.email "your.email@example.com"

		# 設定確認
		git config --list
		```
  - ### Docker Desktop for Windows のインストール
    - インストール手順
    1. 公式サイトにアクセス: https://www.docker.com/products/docker-desktop/
	1. 「Download for Windows」をクリック
	1. ダウンロードした .exe ファイルを実行
	1. インストーラーの指示に従ってインストール
	1. インストール完了後、パソコンを再起動
    - Docker Desktop の起動
     1. スタートメニューから「Docker Desktop」を起動します。
	---
		 💡 Docker Desktop for Windows は、初回起動時に自動的にWSL2との統合設定を行います。
    - Docker Desktop の設定（Ubuntuで動作する設定）
    1. 右上の Settings（歯車アイコン） をクリック
    1. 左メニューの Resources > WSL Integration を開く
    1. Enable integration with my default WSL distro にチェックが入っているか確認
    1. さらにその下にある Ubuntu（使用しているディストリビューション）のスイッチを ON
    1. Apply & Restart をクリックして保存

    - インストールの確認
         - Ubuntu で以下のコマンドを実行
   
		```bash
		docker --version
		# バージョン番号が表示されれば成功(例：Docker version 29.2.0, build 0b9d198)
		```
		- Docker Composeのバージョンも確認できます。
		```bash
		docker compose version
		# バージョン番号が表示されれば成功(例：Docker Compose version v5.0.2)
		```
### 開発環境のフォルダー構成
```bash

lolipop-develop/
├── docker-compose.yml         # Docker全体の設計図
├── docker/                    # Docker設定ファイル専用フォルダ
│   ├── apache/
│   │   └── 000-default.conf   # Apacheのサイト設定（VirtualHost）
│   └── php/
│       ├── Dockerfile         # PHP 8.3 + Node.js + 各種拡張の導入
│       └── php.ini            # ロリポップの制限に合わせたPHP設定
└── src/                       # ★Laravel 12 本体（この中身を本番へ）
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── database/
    ├── public/                # ← ロリポップの「public_html」に対応
    │   ├── index.php
    │   ├── .htaccess          # ← セキュリティ設定を記述
    │   └── build/             # ← npm run build で生成される公開用ファイル
    ├── resources/             # Tailwind CSSの元ファイルなど
    ├── routes/
    ├── storage/               # 本番で書き込み権限が必要な場所
    ├── .env                   # ★PC開発用の環境設定（DB接続先など）
    ├── vite.config.js         # Vite（JIT/ビルド）の設定
    └── package.json
```


### 開発環境（Lolipopと同等）の構築
- ### docker-compose.yml の作成 
#### PHP + MySQL + phpmyAdmin + apache の設定
```bash
services:
  # PHP 8.4 + Apache 
  app:
    build:
      context: .
      dockerfile: ./docker/php/Dockerfile
    ports:
      - "8080:80"
    volumes:
      - ./src:/var/www/html
      - ./docker/apache/000-default.conf:/etc/apache2/sites-available/000-default.conf
      - ./docker/php/php.ini:/usr/local/etc/php/php.ini
    networks:
      - lolipop-network

  # MySQL 8.0
  db:
    image: mysql:8.0
    command: --default-authentication-plugin=mysql_native_password
    environment:
      MYSQL_DATABASE: laravel_db
      MYSQL_USER: loli_user
      MYSQL_PASSWORD: loli_password
      MYSQL_ROOT_PASSWORD: root_password
    volumes:
      - db-store:/var/lib/mysql
    networks:
      - lolipop-network

  # ★ phpMyAdmin を追加
  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    ports:
      - "8081:80"
    environment:
      PMA_HOST: db
      PMA_USER: root
      PMA_PASSWORD: root_password
    networks:
      - lolipop-network

networks:
  lolipop-network:
    driver: bridge

volumes:
  db-store:
```

- ### docker/php/Dockerfile の作成 
```bash
FROM php:8.4-apache

# Litespeed（ロリポップ本番）の挙動に近づけるため mod_rewrite を有効化
RUN a2enmod rewrite

# PHP 8.4 に必要な拡張と Node.js, Composer をインストール
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev libzip-dev zip unzip git curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo_mysql gd bcmath zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
```
- ### docker/php/php.ini の作成 
```bash
[PHP]
memory_limit = 256M
post_max_size = 100M
upload_max_filesize = 100M
date.timezone = "Asia/Tokyo"
mbstring.language = "Japanese"
```
- ### docker/apache/000-default.conf の作成 
```bash
<VirtualHost *:80>
    # ロリポップの公開ディレクトリ構造に合わせた設定
    DocumentRoot /var/www/html/public

    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

- ### コンテナ関連の起動

```bash
# 1. コンテナのビルドと起動（初回は少し時間がかかります）
docker compose up -d --build
```
- ### Laravelのインストール

```bash
# 2. Laravel 12 のインストール（srcフォルダが空であることを確認してください）
md src
docker compose exec app composer create-project laravel/laravel:^12.0 .
```
- ### 権限の調整
```bash
# 3. 権限の調整（書き込みエラーを防ぐため）
docker compose exec app chmod -R 777 storage bootstrap/cache
```
- ### npm(Node.js)のインストール
```bash
# 4. フロントエンド（Tailwind等）の準備
docker compose exec app npm install
docker compose exec app npm run build
```

- ### src/.env のDataBase部分を変更

```bash
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=loli_user
DB_PASSWORD=root_password
```


- ### docker/php/php.ini の設定 (ロリポップ同等にするため)
#### ロリポップの高速・大容量プランに近づける設定
```bash
[PHP]
memory_limit = 512M ; LiteSpeed版の恩恵を受けるために少し多めに
post_max_size = 100M
upload_max_filesize = 100M
date.timezone = "Asia/Tokyo"

# PHP 8.4 用の最適化設定（任意）
opcache.enable=1
opcache.jit=tracing
opcache.jit_buffer_size=128M
```

### 2. 開発環境の起動

```bash
# Databaseの初期化　(migrate)
docker compose exec app php artisan migrate
# docker の起動
docker-compose up -d
```
### 3. アクセス

[Laravel のスタート画面](http://localhost:8080)  
[phpMyAdmin のDB管理画面](http://localhost:8081) 

## よく使うコマンド

```bash
# コンテナの状況確認
docker-compose ps

# ログの確認
docker-compose logs -f

# PHPコンテナに入る
docker-compose exec app bash

# Composer実行
docker-compose exec app composer install

# Artisanコマンド実行
docker-compose exec app php artisan migrate

# 環境の停止
docker-compose down

# 環境の完全削除（データベースも削除）
docker-compose down -v
```

### TailwindCSSの動作確認
```bash
```

- ### TailwindCSS を含むすべての依存関係をダウンロード
```bash
docker compose exec app npm install
```


```bash
# Dockerコンテナの中でTailwindの初期化コマンドを叩く
docker compose exec app npx tailwindcss init -p
```

- ### src/resources/views/welcome.blade.phpの書き換え
```bash
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailwind Test</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-10 rounded-2xl shadow-2xl transform hover:scale-105 transition-all duration-300">
        <h1 class="text-4xl font-black text-blue-600 mb-4">
            Tailwind CSS 動作確認！
        </h1>
        <p class="text-gray-600 text-lg">
            この文字が青く、背景がグレーなら成功です。
        </p>
        <button class="mt-6 px-6 py-2 bg-pink-500 text-white font-bold rounded-full hover:bg-pink-600">
            ロリポップへ一歩前進
        </button>
    </div>
</body>
</html>
```


## 本番環境

本番環境では以下を想定：

- Aurora MySQL（ローカルの MySQL は使用しないケースを想定）

```bash
# 本番環境での起動
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d
```

## ディレクトリ構成

```
.
├── infra/
│   ├── mysql/          # MySQL設定
│   ├── nginx/          # nginx設定
│   └── php/            # PHP設定
├── src/                # Laravelプロジェクトを配置
├── docker-compose.yml  # 開発環境設定
├── docker-compose.prod.yml # 本番環境設定
└── .env.example        # 環境変数テンプレート
```

## 注意事項

- `src/` ディレクトリは空の状態です
- 本番環境では CloudFront と ACM を使用することを推奨
- データベースの永続化は `db-store` ボリュームで行われます

## tailwind CSS ver4 を使用する場合

vite.config.js を下記のコードで 5173 ポートを Docker のコンテナの外からもアクセスできるように開ける

```js
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [
    laravel({
      input: ["resources/css/app.css", "resources/js/app.js"],
      refresh: true,
    }),
    tailwindcss(),
  ],
  server: {
    host: "0.0.0.0",
    port: 5173,
    strictPort: true,
    hmr: {
      host: "localhost",
      port: 5173,
    },
  },
});
```
