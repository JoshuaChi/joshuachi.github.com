---
layout: post
title: "Mysql : Avoid Filesort"
---

<ul>
	<li>You can avoid the filesort by making order by column appear in the where clause</li>

	<li>When using join, make sure the left side join table column is used in the ORDER BY clause or change the join type</li>
</ul>

<a href="http://venublog.com/2007/11/29/mysql-how-to-avoid-filesort/">Reference</a>