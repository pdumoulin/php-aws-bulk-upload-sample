#!/bin/bash

set -e

php -i
php /var/app/composer.phar show

php -v
curl -V
openssl version

php run.php
