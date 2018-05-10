##Installation for local development

###requirements local dev

- Apache / nginx
- PHP >=7.1.3
- MYSQL
- node
- npm

###local installation

1. configure hosts

        cd /etc
        vi hosts
        
        add e.g.
        127.0.0.1   xintegro.local
        
2. configure vhosts

        cd /etc/apache2/extra
        vi httpd-vhosts.conf
        
        add e.g.
        
        <VirtualHost *:80>
            ServerAdmin ilenvo@me.com
            DocumentRoot "/Library/WebServer/Documents/xIntegro/web/"
            ServerName xintegro.local
            ServerAlias xintegro.local
            SetEnv SYMFONY_ENV sb
        <Directory "/Library/WebServer/Documents/xIntegro/web/">
         </Directory>
            ErrorLog "/private/var/log/apache2/lazy_log"
            CustomLog "/private/var/log/apache2/lazy-access_log" common
        </VirtualHost>
        
        please change SYMFONY_ENV sb
        
3. create new config files in the project app/config

        e.g. 
        
        create config_sb.yml (e.g. for ENV sb)
        
        create parameters_sb.yml (e.g. for ENV sb)
        
        (copy a existing file and change it)
        
4. add your env to the AppKernel.php

         search this line...
         if (in_array($this->getEnvironment(), ['dev', 'test', 'sb'], true)) {
         
5. add your ENV entry point to web folder

        e.g.
        create app_sb.php
        and change this line to your ENV
        $kernel = new AppKernel('sb', true); 
        
6. configure your parameters for DB connection

        open your created parameter_sb.yml
        change the parameters to your local mysql
        
        parameters:
            database_host: 127.0.0.1
            database_port: null
            database_name: yourDBName
            database_user: yourDBUser
            database_password: yourDBPassword
        
7. install npm packages

        go to terminal
        npm install
        
8. now install the whole project
        
        export SYMFONY_ENV=sb
        export APPLICATION_ENV=sb
        export SYMFONY_DEBUG=1
        
        php composer.phar install
        php bin/console -e=sb cache:clear --no-warmup
        php bin/console -e=sb assets:install
        
9. create the database from your configuration

        php bin/console doctrine:database:create -e=sb
        
10. create the tables

        php bin/console doctrine:schema:update --force -e=sb
        
11. create a superuser for the backend

        php app/console fos:user:create adminuser --super-admin -e=sb
        
        
