#!/bin/bash
# tanaryo-cloud/scripts/setup.sh

set -e

# 環境変数ファイルの作成
create_env_files() {
    for service in auth-service lottery-service; do
        if [ ! -f "services/$service/.env" ]; then
            cp "services/$service/.env.example" "services/$service/.env"

            # データベース設定の更新
            if [ "$service" = "auth-service" ]; then
                sed -i 's/DB_DATABASE=.*/DB_DATABASE=tanaryo_auth/' "services/$service/.env"
            else
                sed -i 's/DB_DATABASE=.*/DB_DATABASE=tanaryo_lottery/' "services/$service/.env"
            fi
        fi
    done
}

# Composerの依存関係インストール
install_dependencies() {
    # 共有ライブラリ
    cd shared && composer install && cd ..

    # 各サービス
    for service in auth-service lottery-service; do
        cd "services/$service"
        composer install
        php artisan key:generate
        cd ../..
    done
}

echo "Starting setup..."
create_env_files
install_dependencies

echo "Setup completed!"
