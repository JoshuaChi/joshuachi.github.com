---
layout: post
title: "Push and pull mode "
---

<h1> {{ page.title }} </h1> <p class='meta'>2009-11-03 21:11:03</p>

Push and pull are two data transfer mode in Internet. At the beginning of my studying of web development four years ago, there is only pull mode in fact. Everything is pull. When client send a request to server, it is pulling data from server actually. The result can be null or not null.  That means the response depend on server, not the pull object. We all know it is resource-wasting. If each time pull, the client can get something back, or the client pull the data when there should be response data in server side. So the geek invent many ways to achieve this. The following <a href="http://code.google.com/p/pubsubhubbub/">pubsubhubbub</a> is one of them. It can be used to replace the traditional Feed 'pull' mode.

<iframe src="http://docs.google.com/present/embed?id=ajd8t6gk4mh2_34dvbpchfs&size=m" frameborder="0" width="555" height="451"></iframe>