# docker/php/Dockerfile
FROM php:8.2-fpm

# システムパッケージのインストール
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# PHP拡張のインストール
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composerのインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ワーキングディレクトリの設定
WORKDIR /var/www

# PHP設定のカスタマイズ
RUN echo "memory_limit=2G" > /usr/local/etc/php/conf.d/memory-limit.ini
