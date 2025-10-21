#!/bin/bash

# Prompt for user input
read -p "Enter the username (e.g., nonroot): " USERNAME
read -p "Enter the website name (e.g., insight): " WEBSITE_NAME
read -p "Enter the domain name (e.g., insight.thathsara.lk): " DOMAIN_NAME

# Update and upgrade system
sudo apt update
sudo apt upgrade -y

# Install nginx
sudo apt install nginx -y


# Install PHP and required extensions
sudo apt install php8.4-fpm php8.4-curl php8.4-mbstring php8.4-bcmath php8.4-sqlite3 php8.4-zip php8.4-xml -y

# Install Composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer


bullshit

