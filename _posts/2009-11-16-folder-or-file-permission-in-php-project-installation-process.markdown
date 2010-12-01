---
layout: post
title: "Folder or file permission in php project installation process"
---

<p class='meta'>2009-11-16 20:21:23</p>

Most projects will add notes like '..don't forget to change the "cache" folder permission: $chmod -R 777 xxx' in their project install guide.
But have you noticed that there are still a lot of users will ask the same question in their project forums? Yes, the solution is simple and easier. but why not make the simple thing more easier?
<pre name='code' class='php'>
chmod($options['file'], isset($options['file_mode']) ? $options['file_mode'] : 0666);
mkdir($dir, isset($options['dir_mode']) ? $options['dir_mode'] : 0777, true);
</pre
These code comes from symfony source code. It make me feels good in the installation process.
It is easier to make this permission modification process transparent for your user. 