---
layout: post
title: SQL Optimization
---

h1. {{ page.title }} 

p(meta). 2009-10-13 21:16:41

Two tables:
city
id,name,country_id
1,xx,21
2,tt,22
3,tts,21
4,ss,31

country
id,name
21,AA
22,BB
31,CC
41,EE
51,TT

The question is selecting the country name which has not attached with any city.

>select * from country where id is not in (select id from country right join city where city.country_id = country.id);

But we can optimize this SQL like this:
>select * from country left join city where city.country_id is null;