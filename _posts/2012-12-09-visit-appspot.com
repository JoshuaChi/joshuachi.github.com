---
layout: post
title: "Visit Appspot.com From China"
tags:  google gfw
---

The reason behind this blog is to show you how to make <b>GAppProxy</b> work again. In China, most of people rely on <a href='https://code.google.com/p/gappproxy/'>GAppProxy</a> to access the 'outside world'. But appspot.com is blocked in China. So here is a simple tutorial to show you how to make it work.

The idea is very simple: find the workable google IP and add it to hosts file.


Step1: 

<pre>
nslookup www.google.com
</pre>

You can find something like:
<pre>
nslookup www.google.com
Server:   192.168.1.1
Address:  192.168.1.1#53

Non-authoritative answer:
Name: www.google.com
Address: 74.125.128.99
Name: www.google.com
Address: 74.125.128.105
Name: www.google.com
Address: 74.125.128.103
Name: www.google.com
Address: 74.125.128.147
Name: www.google.com
Address: 74.125.128.106
Name: www.google.com
Address: 74.125.128.104
</pre>


Basically you just need to try https://74.125.128.x/ to check which one is working. 'x' can be any number. If you can visit https://74.125.128.x/, continue to <b>Step2</b>.


Step2:


Modify /etc/hosts file and add one line:
<pre>
74.125.128.x $your_app_engine_id.appspot.com
</pre>

Replace $your_app_engine_id with your registered google app engine ID.

Hope this will help you.

