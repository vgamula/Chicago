#!/usr/bin/env bash

apt-get update
apt-get install -y python-software-properties curl git
add-apt-repository ppa:ondrej/php5
apt-get update

###
### custom:
###

# install mysql
echo mysql-server mysql-server/root_password password root | debconf-set-selections
echo mysql-server mysql-server/root_password_again password root | debconf-set-selections
apt-get -y install mysql-server mysql-client libmysqlclient-dev
mysql -e 'create database chicago;' --user=root --password=root

#install php with apache
apt-get -y install php5 libapache2-mod-php5 php5-mysql

#install composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

#install dependencies
cd /www/Chicago && composer install
cd /www/Chicago && cp .env.example .env

# setup apache2 configuration
cp /www/Chicago/apache.conf /etc/apache2/sites-available/000-default.conf
a2enmod rewrite
/etc/init.d/apache2 restart


cd /www/Chicago && \
    php yii migrate --interactive=0 && \
    php yii fixture/load User --interactive=0 \
    php yii fixture/load Topic --interactive=0 \
    php yii fixture/load Project --interactive=0 \
