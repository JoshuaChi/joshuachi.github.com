---
layout: post
title: "CakePHP admin routing fail"
---

<h1> {{ page.title }} </h1> <p class='meta'>2009-05-21 10:15:40</p>

If your router wirte like this
<blockquote>Router::connect('/:controller/:action/*', array('controller' =&gt; 'projects', 'action' =&gt; 'index'));</blockquote>
Then when you call http://{cakeroot}/admin/{controller}/{action}, it will fail with error:
<blockquote>Please create AdminControoler.</blockquote>
But It is OK when you change the router to
<blockquote>Router::connect('/:controller/:action', array('controller' =&gt; 'projects', 'action' =&gt; 'index'));</blockquote>