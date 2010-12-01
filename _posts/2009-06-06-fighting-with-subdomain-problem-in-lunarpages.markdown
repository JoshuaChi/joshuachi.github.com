---
layout: post
title: "Fighting with subdomain problem in Lunarpages"
---

<h1> {{ page.title }} </h1> <p class='meta'>2009-06-06 07:10:51</p>

HostROOT -

|- .htaccess(A)
<p style="text-align: left;">|--------------- |-subdirectory</p>
<p style="text-align: left;">|--------------- -----------|- .htaccess(B)</p>
My host domain - http://www.example.com

My sub domain - http://subdomain.example.com

Don't forget to add a .htaccess file for your subdirectory and add the following content into it.
<blockquote>.htaccess(B)

&lt;IfModule mod_rewrite.c&gt;
RewriteEngine on
RewriteBase /subdirectory/
&lt;/IfModule&gt;</blockquote>
<blockquote></blockquote>
It worked as true. When I recall the process I fight with the

Reference:http://bakery.cakephp.org/articles/view/mod-rewrite-on-godaddy-shared-hosting