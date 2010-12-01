---
layout: post
title: "Query Performance Optimization"
---

<p class='meta'>2009-10-25 20:42:40</p>

1.
Simple Treatment Method for a bad query is accessing less data and fecting less columns.

2.
In MySQL, the simplest query cost metrics are:
a. Execution time
b. Number of rows examined
c. Number of rows returned

3.
The access types range from a full table scan to index scans, range scans, unique index lookups, and constants. Each of these is faster than the one before it. If you aren’t getting a good access type, the best way to solve the problem is usually by adding an appropriate index.

4.
Duplicated test record with a cool SQL:
Assuming there was serval record in your table 'animals[id,animal_type , animal_name]'
>>insert into animals(animal_type , animal_name ) select animal_type , animal_name from animals.

5.
'The traditional approach to database design emphasizes doing as much work as possible with as few queries as possible.' - This advice doesn’t apply as much to MySQL. MySQL can run more than 50,000 simple queries per second on commodity server hardware and over 2,000 queries per second from a single correspondent on a Gigabit network.

6.
Summary: When Application Joins May Be More Efficient >>
Not doing joins in the application may be more efficient when:
You cache and reuse a lot of data from earlier queries
You use multiple MyISAM tables
You distribute data across multiple servers
You replace joins with IN( ) lists on large tables
A join refers to the same table multiple times

7.
Follow along with the illustration to see what happens when you send MySQL a query:
1). The client sends the SQL statement to the server.
2). The server checks the query cache. If there’s a hit, it returns the stored result from the cache; otherwise, it passes the SQL statement to the next step.
3). The server parses, preprocesses, and optimizes the SQL into a query execution plan.
4). The query execution engine executes the plan by making calls to the storage engine API.
5). The server sends the result to the client.

8.
Fetching result directly without buffering:
[code]
#!/usr/bin/perl
use DBI;
my $dbh = DBI->connect('DBI:mysql:;host=localhost', 'user', 'p4ssword');
my $sth = $dbh->prepare('SELECT * FROM HUGE_TABLE', { mysql_use_result => 1 });
$sth->execute( );
while ( my $row = $sth->fetchrow_array( ) ) {
# Do something with result
}
[/code]
Notice that the call to prepare( ) specified to “use” the result instead of “buffering” it. You can also specify this when connecting, which will make every statement unbuffered:
[code]
my $dbh = DBI->connect('DBI:mysql:;mysql_use_result=1', 'user', 'p4ssword');
[/code]
This will be usfully when your fetching data is too big.

9.
Query states:
Sleep -
	The thread is waiting for a new query from the client.
Query -
	The thread is either executing the query or sending the result back to the client.
Locked -
	The thread is waiting for a table lock to be granted at the server level.
Analyzing and statistics -
	The thread is checking storage engine statistics and optimizing the query.
Copying to tmp table [on disk] -
	The thread is processing the query and copying results to a temporary table, probably for a GROUP BY, for a filesort, or to satisfy a UNION. If the state ends with “on disk,” MySQL is converting an in-memory table to an on-disk table.
Sorting result -
	The thread is sorting a result set.
Sending data -
	This can mean several things: the thread might be sending data between stages of the query, generating the result set, or returning the result set to the client.

10.
MySQL uses the term “join” more broadly than you might be used to. In sum, it considers every query a join—not just every query that matches rows from two tables, but every query.
