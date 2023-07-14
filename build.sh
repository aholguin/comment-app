#!/bin/bash

printMessage() {
  echo -e "\e[92m\e[1m$1 \e[0m"
}

cp .env.example .env

SAIL="./vendor/bin/sail"

$SAIL artisan key:generate

printMessage "Building containers..."

$SAIL up -d

printMessage "Running composer install..."

$SAIL composer install

printMessage "Running migrations..."

$SAIL artisan migrate:refresh --seed

printMessage "Running yarn install..."

$SAIL yarn install

$SAIL yarn build

