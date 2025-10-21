#!/bin/bash

# Prompt for user input
read -p "Enter the username (e.g., nonroot): " USERNAME
read -p "Enter the website name (e.g., insight): " WEBSITE_NAME
read -p "Enter the domain name (e.g., insight.thathsara.lk): " DOMAIN_NAME

# Update and upgrade system
sudo apt update
sudo apt upgrade -y

# Install PHP and required extensions
sudo apt install php8.3-fpm php8.3 php8.3-curl php8.3-mbstring php8.3-bcmath php8.3-sqlite3 php8.3-zip php8.3-xml -y

# Install additional tools
sudo apt install nginx -y

# Install Composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer

# Set up Git repository
mkdir -p /home/$USERNAME/repo/${WEBSITE_NAME}.git
cd /home/$USERNAME/repo/${WEBSITE_NAME}.git
git init --bare
git branch -m main

cd hooks

# Create post-receive hook
cat << EOF > post-receive
#!/bin/sh
sudo /sbin/deploy
sudo /sbin/post-deploy
EOF

sudo chmod +x post-receive

# Create deployment script
cat << EOF | sudo tee /sbin/deploy
#!/bin/sh
git --work-tree=/srv/$WEBSITE_NAME --git-dir=/home/$USERNAME/repo/${WEBSITE_NAME}.git checkout -f
EOF

sudo chmod +x /sbin/deploy

# Create post-deploy script
cat << EOF | sudo tee /sbin/post-deploy
#!/bin/sh
cd /srv/$WEBSITE_NAME
cp ./nginx.conf /etc/nginx/sites-available/$WEBSITE_NAME
sudo ln -sf /etc/nginx/sites-available/$WEBSITE_NAME /etc/nginx/sites-enabled/$WEBSITE_NAME
sudo certbot --nginx --reinstall -d $DOMAIN_NAME
sudo nginx -s reload
sudo chown -R :www-data /srv/$WEBSITE_NAME
sudo chmod -R 775 /srv/$WEBSITE_NAME/storage
sudo chmod -R 775 /srv/$WEBSITE_NAME/bootstrap/cache
sudo chmod -R 775 /srv/$WEBSITE_NAME/database
cp --update=none ./.env.example ./.env
COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader
sudo npm i
sudo npm run build
EOF


sudo chmod +x /sbin/post-deploy

# Create application directory
sudo mkdir -p /srv/$WEBSITE_NAME

# Configure sudoers
echo "$USERNAME ALL=NOPASSWD: /sbin/deploy, /sbin/post-deploy" | sudo EDITOR='tee -a' visudo

# Set up Nginx
sudo rm -f /etc/nginx/sites-enabled/default

# Install Node.js
curl -fsSL https://deb.nodesource.com/setup_20.x -o nodesource_setup.sh
sudo -E bash nodesource_setup.sh
sudo apt-get install -y nodejs

# Set up Laravel environment
cd /srv/$WEBSITE_NAME
sudo php artisan key:generate
sudo php artisan migrate

# Install and configure Certbot
sudo snap install --classic certbot
sudo ln -s /snap/bin/certbot /usr/bin/certbot
sudo certbot --nginx -d $DOMAIN_NAME --email thathsaramadhhusha@gmail.com --agree-tos --eff-email

sudo certbot renew --dry-run

echo "Setup complete!"

