---
layout: post
title: Mysql : Avoid Filesort
---

h1. {{ page.title }} 

p(meta). 2010-06-03 10:34:28

<ul>
	<li>You can avoid the filesort by making order by column appear in the where clause</li>

	<li>When using join, make sure the left side join table column is used in the ORDER BY clause or change the join type</li>
</ul>

<a href="http://venublog.com/2007/11/29/mysql-how-to-avoid-filesort/">Reference</a>