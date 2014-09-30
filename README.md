## rsound::rsnd.php  

Using a raspberry pi as a remote sound player for Halloween Haunts

PHP and sockets

#Installation

Required:

PHP-cli

PHP

Apache

Clone to a users location such as ~/bin


Soft links from ~/bin/rsound/web into /var/www/rsound ( or location of your web files ) 

Change permissions for www-data 

rsnd.php can be run as root but the soft links must be as a standard user

#Usage 

Adjust rsnd.ini 

Start the daemon rsnd.php -D debug mode rsnd.php -r

From a browser use websound.php


Still rough

