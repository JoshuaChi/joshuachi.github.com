---
layout: post
title: "mysql ERROR 1005 (ER_CANT_CREATE_TABLE)"
tags: mysql
---

To deal with this error, there are a lot of <a href='http://verysimple.com/2006/10/22/mysql-error-number-1005-cant-create-table-mydbsql-328_45frm-errno-150/'>suggestions</a>.
In my case, it is because of:
<pre>
  Make sure that the Charset and Collate options are the same both at the table level as well as individual field level for the key columns. (Thanks to FRR for this tip)
</pre>
