#npm install
export SYMFONY_ENV=sb
export APPLICATION_ENV=sb
export SYMFONY_DEBUG=1
php composer.phar install
php bin/console -e=sb cache:clear --no-warmup
php bin/console -e=sb assets:install
php bin/console doctrine:schema:update --force -e=sb
chmod -R 777 var/
chmod -R 777 src/
chmod -R 777 tests/