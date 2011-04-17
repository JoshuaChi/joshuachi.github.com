---
layout: post
title: MySQL Custom Function
---

h1. {{ page.title }} 

p(meta). 2010-02-01 21:45:04

Today when I try to update a table in sql command, I didn't want to use the mysql function <a href="http://dev.mysql.com/doc/refman/5.0/en/miscellaneous-functions.html#function_uuid">uuid </a>to generate a string with middle line in it. So I try to use mysql <a href="http://dev.mysql.com/doc/refman/5.0/en/create-procedure.html">custom function</a> to generate a 32-bit length string without middle line. 

<pre name='code' class='sql'>
DELIMITER ;

DROP FUNCTION IF EXISTS uid;
DELIMITER $$

CREATE FUNCTION uid()
    RETURNS VARCHAR(32)
BEGIN
    DECLARE c VARCHAR(36) DEFAULT '';
	SET c = uuid();
	return CONCAT(substring(c,1,8) , substring(c,10,4) , substring(c,15,4) , substring(c,20,4), substring(c,25,12));
END$$

DELIMITER ;

select uid();
</pre>

I am writing this because mysql is powerful enough to handle all the issues in web software development.