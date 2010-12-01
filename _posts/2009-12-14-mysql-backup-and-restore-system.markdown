---
layout: post
title: "MySQL Database Backup and Restore"
---

<strong>Backup</strong>
I was trying to find some backup and restore system for our product mysql database. There are a lot of tools can do this. But I think the simple way is using <a href="https://help.ubuntu.com/community/CronHowto">crontab</a> + <a href="http://www.ntchosting.com/mysql/database-dump.html">mysqldump</a>.

So I write a simple script
<pre name='code' class='sql'>
$ mysqldump -u [uname] -p[pass] [dbname] | gzip -9 > [backupfile.sql.gz]
example:

15 2 * * * root mysqldump -u root -pPASSWORD --all-databases | gzip > /usr/local/bk/database_`data '+%m-%d-%Y'`.sql.gz 
</pre>
If you want to extract the .gz file, use the command below:
<pre name='code' class='html'>
$ gunzip [backupfile.sql.gz]
</pre>
This script will vardump all my database into the database_`data '+%m-%d-%Y'`.sql.gz zip file at 2::15am on every day of every month. 

<strong>Restoring</strong>
Restore the databases is simple.
<pre name='code' class='sql'>
$ mysql -u [uname] -p[pass] [db_to_restore] < [backupfile.sql]
</pre>
To restore from a compress sql:
<pre name='code' class='sql'>
gunzip < [backupfile.sql.gz] | mysql -u [uname] -p[pass] [dbname]
</pre>
If you need to restore a database that already exists, you'll need to use mysqlimport command. The syntax for mysqlimport is as follows
<pre name='code' class='sql'>
mysqlimport -u [uname] -p[pass] [dbname] [backupfile.sql]
</pre>