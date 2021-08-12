# Reactdo Api Symfony
Basic Api build using [symfony php framework](https://symfony.com/).





# How to create database?
Run `php bin/console doctrine:database:create`

# How to create necessary tables?
run `php bin/console doctrine:schema:update --force`

# How to deploy/run?
1. Clone the repository.
2. If necessary change database configuration into .env file.
3. Run `composer dump-env prod`. (download all dependencies and prepare to prod mode)
4. Run `composer install --no-dev --optimize-autoloader`.
5. Run `APP_ENV=prod APP_DEBUG=0 php bin/console cache:clear` **ONLY  IN LINUX SYSTEMS**
6. Point your web serve to public folder.
7. Enjoy.