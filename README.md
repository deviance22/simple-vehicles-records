# simple-vehicles-records
Records keeping for vehicles. It allows the conversion of Engine displacement values. This uses Slim PHP as its backend and JQuery as its frontend

## PRE-REQUISITES
	1. PHP 7.2^
	2. MySQL
	3. Composer
	4. Apache2

## INSTALLATION

	1. Clone or copy the repo unto the webserver
	2. open the terminal and go to the root directory of the project
	3. run "composer install"
	4. Update settings.php.default in the src folder. Change the your DB settings.
	5. Rename the file to settings.php
	6. import the database with sql dump file found in the schema folder
	7. run "php -S localhost:8080 -t public public/index.php" at the root folder. After executing this command, you can now access the website at "localhost:8080". In sending http requests, the same address can be used

	-- OR If you want to use a different domain--

	7. Edit the httpd-vhosts.conf. 
		<VirtualHost *:80>
		    DocumentRoot "path/to/project/public_folder/"
		    ServerName domainname
		</VirtualHost>
	8. edit the host files. It should have "127.0.0.1 domainname" at the end
	9. Restart apache2 service
	10. Make sure that AllowOverride All is enabled. Or Rewrite rule is enabled for the .htaccess

## NOTES

If Slim PHP throws a file not found exception, change line 21 from routes.php to 

```
require_once("app/apiv1/vehicles.php");
```

and line 30 of dependencies.php to

```
return new \Slim\Views\PhpRenderer('templates/');
```