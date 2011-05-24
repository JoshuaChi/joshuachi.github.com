---
layout: post
title: "Why The Combine Index Was Not Used"
tags:  mysql
---

There are already a lot of posts which gave a introduction of what index merge is in MySQL. One of them is:

<a href='http://brian.moonspot.net/2008/04/22/playing-with-mysql-index-merge/'>Playing with MySQL's index merge</a>

Today I just noticed the combined index also can be affected by the single column index. For example:

1. Let's say we have a table named table1 which have 100,000 items. The size of this table is 35MB.

Table structure:

<pre>
CREATE TABLE `table1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `status1` int(11) DEFAULT NULL,
  `status2` int(11) DEFAULT NULL,
  `status3` int(11) DEFAULT NULL,
  `status4` int(11) DEFAULT NULL,
  `status5` int(11) DEFAULT NULL,
  `status6` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `table1_name_unique` (`name`),
  KEY `table1_status1` (`status1`),
  KEY `table1_status2` (`status2`),
  KEY `table1_status3` (`status3`),
  KEY `table1_status4` (`status4`),
  KEY `table1_status5` (`status5`),
  KEY `table1_status6` (`status6`),
  KEY `table1_combine_index` (`status1`,`status2`,`status3`,`status4`,`status5`,`status6``)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
</pre>

We have a query need to select items from table1 table with checking all the status columns in where clause. Let's do a explain:

<pre>
explain select * from table1 where status1=1 and status2=1 and status3=1 and status4=1 and status5=1 and status6=1  
</pre>

Explain result:

<pre>
  select_type: SIMPLE
  table: table1
  type: index_merge
  possible_keys: PRIMARY,table1_status1,table1_status2,table1_status3,table1_status4,table1_status5,table1_status6,table1_combine_index
  key: table1_status1,table1_status2,table1_status3,table1_status4,table1_status5,table1_status6
  key_len: 1,1,4,4,4,5
  refs: NULL
  rows: 1955
  Extra: Using intersect(table1_status1,table1_status2,table1_status3,table1_status4,table1_status5,table1_status6); Using where
</pre>

The select query takes <b>3.5ms</b> by intersecting indexes.

What happened if we force index to use table1_combine_index:

<pre>
explain select * from table1 force index (table1_combine_index)  where status1=1 and status2=1 and status3=1 and status4=1 and status5=1 and status6=1  
</pre>

Explain result:

<pre>
  select_type: SIMPLE
  table: table1
  type: ref
  possible_keys: table1_combine_index
  key: table1_combine_index
  key_len: 9
  refs: const,const
  rows: 62590
  Extra: Using where
</pre>

The select query takes <b>10.5ms</b> by using combine index.

In this example, intersecting index is more useful than combine index. There is an article give a more detailed explanation why it works like this:

<a href='http://www.mysqlperformanceblog.com/2009/09/19/multi-column-indexes-vs-index-merge/'>Multi Column indexes vs Index Merge</a>


2. Now it's time to make this example a little complicated.

We have another table named table2, the structure looks like:

<pre>
CREATE TABLE `table2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table1_id` int(11) NOT NULL,
  `column1` datetime NOT NULL,
  `column2` varchar(255) NOT NULL,
  `column3` text,
  `column4` tinyint(4) NOT NULL,
  `column5 ` tinyint(4) NOT NULL,
  `column6 ` tinyint(4) NOT NULL,
  `column7` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `column7 ` (`column7 `),
  KEY `table2_FI_1` (`table1_id `)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
</pre>

There are 20,000 rows in table2, with size 11MB. We have a feature request need to join table1 with table2 and sort by table2's id.

<pre>
SELECT sql_no_cache * FROM table2 LEFT JOIN table1 ON (table2.table1_id = table1.id) WHERE table1.status1=1 and table1.status2=1 and table1.status3=1 and table1.status4=1 and table1.status5=1 and table1.status6=1 ORDER BY table2.id DESC LIMIT 10;
</pre>

It takes <b>3s</b> to finish the query. The explain tells you:

<pre>
  select_type: SIMPLE
  table: table1
  type: index_merge
  possible_keys: PRIMARY,`table1_status1`,`table1_status2`,`table1_status3`,`table1_status4`,`table1_status5`,`table1_status6`,`table1_combine_index`
  key: `table1_status1`,`table1_status2`,`table1_status3`,`table1_status4`,`table1_status5`,`table1_status6`
  key_len: 1,1,4,4,4,5
  refs: NULL
  rows: 1955
  Extra: Using intersect(`table1_status1`,`table1_status2`,`table1_status3`,`table1_status4`,`table1_status5`,`table1_status6`); Using where
  
  ---
  select_type: SIMPLE
  table: table2
  type: ref
  possible_keys: table2_FI_1
  key: table2_FI_1
  key_len: 4
  refs: table1.id
  rows: 1
  Extra:  
</pre>

Now I want to remove these single column indexes in table1 to see what will happen:

<pre>
  select_type: SIMPLE
  table: table2
  type: index
  possible_keys: table2_FI_1
  key: PRIMARY
  key_len: 4
  refs: 
  rows: 10
  Extra:
  
  ---
  
  select_type: SIMPLE
  table: table1
  type: eq_ref
  possible_keys: PRIMARY,table1_combine_index
  key: PRIMARY
  key_len: 4
  refs: table2.table1_id
  rows: 1
  Extra: Using where
</pre>


After removing the single column indexes in table 1, this select query only takes <b>2.4ms</b>. To explain this, we can simply treat (status1,status2,status3,status4,status5,status6) as one column in table1. I think the single columns indexes affected the 'join' performance. MySQL need to use these single indexes to filter the table1 firstly and then make a join with table2.

