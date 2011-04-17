---
layout: post
title: Solution:ERROR 2006 (HY000) at line 140: MySQL server has gone away
---

h1. {{ page.title }} 

p(meta). 2009-05-26 15:28:21

Add a line into your my.ini
<blockquote>max_allowed_packet = 12M</blockquote>
Give a bigger size if you need.