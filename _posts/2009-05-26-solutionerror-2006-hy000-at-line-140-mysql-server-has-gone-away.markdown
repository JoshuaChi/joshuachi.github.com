---
layout: post
title: "Solution:ERROR 2006 (HY000) at line 140: MySQL server has gone away"
---

Add a line into your my.ini
<blockquote>max_allowed_packet = 12M</blockquote>
Give a bigger size if you need.