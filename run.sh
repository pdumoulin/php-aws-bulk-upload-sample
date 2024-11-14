#!/bin/bash

set -e

php -i
php /var/app/composer.phar show

php -v
curl -V
openssl version

sysctl -a | grep net.ipv4

php run.php
