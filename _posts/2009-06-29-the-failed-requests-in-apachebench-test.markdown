---
layout: post
title: "The Failed requests in ApacheBench Test"
---

<p class='meta'>2009-06-29 09:47:30</p>

Problem: I run <a href="http://httpd.apache.org/docs/2.0/programs/ab.html">ab </a>test<ab -c 10 -t 60 http://www.xxx.com> for my website yesterday, and there are so many failed request. 
And I found the following explanation from <a href="http://fixunix.com/linux/269587-apache-benchmark.html">fixunix</a>:
<pre  name="code" class="html">
May not actually be a problem. Reason? It might be a site that serves dynamic context (such as different cookie IDs mentioned) where the file size changes between each query. 

Easy way to verify: 

Code:	 $ wget <url>	

Repeat that twice, then: 

Code:	 $ diff <retrieved filename> <retrieved filename>.1	

See if there are differences. If yes, then you can ignore the length-related failures. If no, it's some other cause and need to investigate further.
</pre>

I hope it will help you too if you have the same problem.