#!/bin/bash

if ! type "docker-compose" > /dev/null; then
  echo Docker-compose not installed.
  exit 1
fi

if [ ! -f ".env" ]; then
  echo ".env file does not exist"
  exit 1
fi

source .env

export DOCKER_USER="$UID:$GID"
export SERVER_PATH="$PWD/app/server"
export CLIENT_PATH="$PWD/app/client"
export NGINX_CONFIGS="./docker/nginx"

docker network create e1on_web_network

# Build nginx configs
if [ ! -d "docker/nginx/working" ]; then
  cp -r "$NGINX_CONFIGS/original" "$NGINX_CONFIGS/working"
fi

sed -ri "s/server_name[^;]*;/server_name ${SERVER_NAME_CLIENT};/" "$NGINX_CONFIGS/working/client.conf"
sed -ri "s/server_name[^;]*;/server_name ${SERVER_NAME_SERVER};/" "$NGINX_CONFIGS/working/server.conf"

# Build nginx configs end

# Прокидывание адреса сервера в конфиг клиента
echo "export const API_ADDRESS = '${SERVER_NAME_SERVER}'" > app/client/src/config/apiAddress.js

# Прокидывание данных в конфигурацию Sphix для доступа к базе данных
sed -ri "s/name[^;]*/name: '${MYSQL_DATABASE}'/" "$SERVER_PATH/phinx.yml"
sed -ri "s/user[^;]*/user: '${MYSQL_USER}'/" "$SERVER_PATH/phinx.yml"
sed -ri "s/pass[^;]*/pass: '${MYSQL_PASSWORD}'/" "$SERVER_PATH/phinx.yml"

# Сборка сервера, установка зависимостей в отдельном composer контейнере
docker run --rm --interactive --tty \
  -u "${UID}:${GID}" \
  -v "$SERVER_PATH":/app \
  composer install --ignore-platform-reqs

# Запуск и сборка контейнеров
docker-compose down
docker-compose build
docker-compose up