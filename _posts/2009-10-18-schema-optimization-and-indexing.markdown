---
layout: post
title: "Schema Optimization and Indexing"
---

1.
Choosing Data Type >
a. Smaller is usually better;
b. Simple is good;
c. Avoid NULL if possible - When a nullable column is indexed, it requires an extra byte per entry and can even cause a fixed-size index;

2.
Two kinds of numbers: whole numbers and real numbers (numbers with a fractional part)
TINYINT, SMALLINT, MEDIUMINT, INT, or BIGINT. These require 8, 16, 24, 32, and 64 bits of storage space. Signed and unsigned types use the same amount of storage space and have the same performance, so use whatever’s best for your data range.

3.
MySQL lets you specify a “width” for integer types, such as INT(11). <@author:Oh, I was cheated!>This is meaningless for most applications: it does not restrict the legal range of values, but simply specifies the number of characters MySQL’s interactive tools (such as the commandline client) will reserve for display purposes. For storage and computational purposes, INT(1) is identical to INT(20).

4.
VARCHAR - helps performance because it saves space. However, because the rows are variable-length, they can grow when you update them, which can cause extra work. 

CHAR - is fixed-length: MySQL always allocates enough space for the specified number of characters. When storing a CHAR value, MySQL removes any trailing
spaces. 

5.
Binary comparisons can be much simpler than character comparisons, so they are faster.

6.
Using ENUM instead of a string type.
Note:ENUM field sorts by the internal integer values, not by the strings themselves.

7.
TIMESTAMP >
By default, MySQL will set the first TIMESTAMP column to the current time when you insert a
row without specifying a value for the column. MySQL also updates the first TIMESTAMP column’s value by default when you update the row, unless you assign a value explicitly in the UPDATE statement.

8.
What if you need to store a date and time value with subsecond resolution?
You can use the BIGINT data type and store the value as a timestamp in microseconds, or you can use a DOUBLE.

9.
Date type choose priciple:
Choose the smallest size that can hold your required range of values, and leave room for future growth if necessary.

10.
String types >
Avoid string types for identifiers if possible, as they take up a lot of space and are generally slower than integer types. Be especially cautious when using string identifiers with MyISAM tables. MyISAM uses packed indexes for strings by default, which may make lookups much slower. In our tests, we’ve noted up to six times slower performance with packed indexes on MyISAM. 

11.
Types of Indexes >
B-Tree indexes - all the values are stored in order, and each leaf page is the same distance from the root.

12.
Full-text indexes >
It finds keywords in the text instead of comparing values directly to the values in the index.

13.
Indexing Strategies for High Performance > Isolate the Column
“Isolating” the column means it should not be part of an expression or be inside a function in the query.
i).mysql> SELECT ... WHERE TO_DAYS(CURRENT_DATE) - TO_DAYS(date_col) <= 10;
ii). mysql> SELECT ... WHERE date_col >= DATE_SUB(CURRENT_DATE, INTERVAL 10 DAY);
iii). mysql> SELECT ... WHERE date_col >= DATE_SUB('2008-01-17', INTERVAL 10 DAY);

14.
If you want to make index for a long column, the best way is using the prefix.
Prefix indexes can be a great way to make indexes smaller and faster, but they have downsides too: MySQL cannot use prefix indexes for ORDER BY or GROUP BY queries, nor can it use them as covering indexes.
>
mysql> SELECT COUNT(DISTINCT city)/COUNT(*) FROM sakila.city_demo;
+-------------------------------+
| COUNT(DISTINCT city)/COUNT(*) |
+-------------------------------+
| 0.0312 |
+-------------------------------+
mysql> SELECT COUNT(DISTINCT LEFT(city, 3))/COUNT(*) AS sel3,
-> COUNT(DISTINCT LEFT(city, 4))/COUNT(*) AS sel4,
-> COUNT(DISTINCT LEFT(city, 5))/COUNT(*) AS sel5,
-> COUNT(DISTINCT LEFT(city, 6))/COUNT(*) AS sel6,
-> COUNT(DISTINCT LEFT(city, 7))/COUNT(*) AS sel7
-> FROM sakila.city_demo;
+--------+--------+--------+--------+--------+
| sel3 | sel4 | sel5 | sel6 | sel7 |
+--------+--------+--------+--------+--------+
| 0.0239 | 0.0293 | 0.0305 | 0.0309 | 0.0310 |
+--------+--------+--------+--------+--------+
mysql> ALTER TABLE sakila.city_demo ADD KEY (city(7));

15.
Clustered Indexes >
solidDB and InnoDB are the only ones that support this type index.

16.
You should strive to insert data in primary key order when using InnoDB, and you should try to use a clustering key that will give a monotonically increasing value for each new row.

17.
MySQL can use the same index for both sorting and finding rows.
Ordering the results by the index works only when the index’s order is exactly the same as the ORDER BY clause and all columns are sorted in the same direction (ascending or descending). If the query joins multiple tables, it works only when all columns in the ORDER BY clause refer to the first table. The ORDER BY clause also has the same limitation as lookup queries: it needs to form a leftmost prefix of the index.

18.
MySQL implements UNIQUE constraints and PRIMARY KEY constraints with indexes.

19.
Redundant indexes are a bit different from duplicated indexes. If there is an index on (A, B), another index on (A) would be redundant because it is a prefix of the first index. That is, the index on (A, B) can also be used as an index on (A) alone. (This type of redundancy applies only to B-Tree indexes.) However, an index on (B, A) would not be redundant, and neither would an index on (B), because B is not a leftmost prefix of (A, B).

20.
Where possible, try to extend existing indexes rather than adding new ones. It is usually more efficient to maintain one multicolumn index than several single-column indexes.

21.
?--
If you don’t yet know your query distribution, strive to make your indexes as selective as you can, because highly selective indexes are usually more beneficial. 

22.
As this example shows, InnoDB can lock rows it doesn’t really need even when it uses an index.
Note:
The problem is even worse when it can’t use an index to find and lock the rows: if there’s no index for the query, MySQL will do a full table scan and lock every row, whether it “needs” it or not.

23.
!--
If MySQL uses an index for a range criterion in a query, it cannot also use another index (or a suffix of the same index) for ordering.

24.
Run 'CHECK TABLE xxx' to see if the table is corrupt;
Fix corrupt tables with the 'REPAIR TABLE xxx' command.

25.
Two types of data fragmentation:
a). Row fragmentation
b). Intra-row fragmentation
MyISAM tables may suffer from both types of fragmentation, but InnoDB never fragments short rows.
!--To defragment data, you can either run OPTIMIZE TABLE or dump and reload the data;
!--For storage engines that don’t support OPTIMIZE TABLE, you can rebuild the table with a no-op ALTER TABLE. Just alter the table to have the same engine it currently uses:
	mysql> ALTER TABLE $table ENGINE=$engine;

26.
Example, you can change or drop a column’s default value in two ways (one fast, and one slow).
slow}mysql> ALTER TABLE sakila.film
	-> MODIFY COLUMN rental_duration TINYINT(3) NOT NULL DEFAULT 5;
In theory, MySQL could have skipped building a new table. The default value for the column is actually stored in the table’s .frm file, so you should be able to change it without touching the table itself. MySQL doesn’t yet use this optimization, however: any MODIFY COLUMN will cause a table rebuild. You can change a column’s default with ALTER COLUMN,* though:
fast}mysql> ALTER TABLE sakila.film
	-> ALTER COLUMN rental_duration SET DEFAULT 5;
	
27.
Building MyISAM Indexes Quickly >>
The usual trick for loading MyISAM tables efficiently is to disable keys, load the data, and reenable the keys:
mysql> ALTER TABLE test.load_data DISABLE KEYS;
-- load the data
mysql> ALTER TABLE test.load_data ENABLE KEYS;
