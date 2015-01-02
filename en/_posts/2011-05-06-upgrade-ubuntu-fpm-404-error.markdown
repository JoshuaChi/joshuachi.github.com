---
layout: post
title: "Nginx, PHP-FPM, 404 error after upgrading to Ubuntu 11.04"
tags:  ubuntu php-fpm
---

After upgrading from ubuntu 10.10 to ubuntu 11.04 my local site didn't work anymore. It reponsed with a 404 page.

After researcing for a while, I found the root should be put outside the location property:
Before:

<pre>
server {
  server_name  localhost;

  location / {
		root   /var/www;
		index  index.php index.html index.htm;
	}
 ....
}

</pre>

After:

<pre>
server {

  root   /var/www;
  index  index.php index.html index.htm;
  server_name  localhost;

 ....
}
</pre>

Now it works, but have no idea what has been changed since Ubuntu upgrade.
