<?php
// small loader fix by sb easier loading no .htacces changes required
if (false === ($enviroment = getenv("SYMFONY_ENV") )) {
    // load dev as default
    require 'app_prod.php';
    
    //header("HTTP/1.0 500 Internal Server Error!");
    //die("Internal Server Error. No enviroment configuration found! Please check your vhosts and set APPLICATION_ENV!");
} else {

require 'app_' . $enviroment . '.php';
}