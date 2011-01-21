---
layout: post
title: "Deal with mysql ERROR 1005 (HY000)"
tags: -mysql
---

How to deal with 'mysql ERROR 1005 (HY000): Can't create table '' (errno: 150)'? Usuall it was caused by mysql foreign key. But how you know which foreign key is wrong? Or why it is incorrect? To get more information, you can execute: <pre>SHOW ENGINE INNODB STATUS\G</pre>.
In my case:
<pre>
CREATE TABLE `table3`
(
  `id` INTEGER  NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255),
  `author_id` INTEGER  NOT NULL,
  `is_published` TINYINT default 0,
  `identifier` VARCHAR(100),
  `path` VARCHAR(255),
  `description` TEXT,
  PRIMARY KEY (`id`),
  KEY `books_I_1`(`is_published`),
  INDEX `books_FI_1` (`author_id`),
  CONSTRAINT `books_FK_1`
    FOREIGN KEY (`author_id`)
    REFERENCES `users` (`id`)
    ON DELETE SET NULL
)Type=InnoDB
</pre>
I get mysql 1005 error with above sql, if I execute show innodb status, I will get:
<pre>
=====================================
110121 16:11:12 INNODB MONITOR OUTPUT
=====================================
Per second averages calculated from the last 13 seconds
----------
SEMAPHORES
----------
OS WAIT ARRAY INFO: reservation count 28, signal count 28
Mutex spin waits 0, rounds 81, OS waits 4
RW-shared spins 38, OS waits 19; RW-excl spins 5, OS waits 5
------------------------
LATEST FOREIGN KEY ERROR
------------------------
110121 16:05:56 Error in foreign key constraint of table table3:

   FOREIGN KEY (`author_id`)
   REFERENCES `users` (`id`)
   ON DELETE SET NULL
)Type=InnoDB:
You have defined a SET NULL condition though some of the
columns are defined as NOT NULL.
</pre>

Yes, as you can see, the last sentence is what I want. Actually, I define author_id can not be null. Good luck to you.
