---
layout: post
title: "Import Big InnoDB Tables"
---

<h1> {{ page.title }} </h1> <p class='meta'>2010-07-28 21:09:41</p>

1. turn off the logs;
2. turn off unique key check if the table has;
3. turn off foreign key check;
<ul>
	<li>
When importing data into InnoDB, make sure that MySQL does not have autocommit mode enabled because that requires a log flush to disk for every insert. To disable autocommit during your import operation, surround it with SET autocommit and COMMIT statements:

<code>SET autocommit=0;
... SQL import statements ...
COMMIT;</code>

If you use the mysqldump option --opt, you get dump files that are fast to import into an InnoDB  table, even without wrapping them with the SET autocommit and COMMIT statements. </li>
	<li>If you have UNIQUE constraints on secondary keys, starting from MySQL 3.23.52 and 4.0.3, you can speed up table imports by temporarily turning off the uniqueness checks during the import session:

<code>SET unique_checks=0;
... SQL import statements ...
SET unique_checks=1;</code>

For big tables, this saves a lot of disk I/O because InnoDB can use its insert buffer to write secondary index records in a batch. Be certain that the data contains no duplicate keys.</li>
	<li>#

If you have FOREIGN KEY constraints in your tables, starting from MySQL 3.23.52 and 4.0.3, you can speed up table imports by turning the foreign key checks off for a while in the import session:
<code>
SET foreign_key_checks=0;
... SQL import statements ...
SET foreign_key_checks=1;</code>

For big tables, this can save a lot of disk I/O.
</li>

If the above solution still can not quick your import process. Try <a href="http://dev.mysql.com/doc/refman/5.0/en/mysqlimport.html">mysqlimport</a>.  You can use mysqldump to dump a sql file and a text file. There is an example, look like this:
<pre name='code' class='sql'>
shell> mysql -e 'CREATE TABLE imptest(id INT, n VARCHAR(30))' test
shell> ed
a
100     Max Sydow
101     Count Dracula
.
w imptest.txt
32
q
shell> od -c imptest.txt
0000000   1   0   0  \t   M   a   x       S   y   d   o   w  \n   1   0
0000020   1  \t   C   o   u   n   t       D   r   a   c   u   l   a  \n
0000040
shell> mysqlimport --local test imptest.txt
test.imptest: Records: 2  Deleted: 0  Skipped: 0  Warnings: 0
shell> mysql -e 'SELECT * FROM imptest' test
+------+---------------+
| id   | n             |
+------+---------------+
|  100 | Max Sydow     |
|  101 | Count Dracula |
+------+---------------+

</pre>


