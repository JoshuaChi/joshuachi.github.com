---
layout: post
title: "Replace MySql Table with NoSQL DB"
tags:  mysql,nosql,mongodb
---


<h4>Backgroud:</h4>

I am not nosql fans. I don't have the habit to replace whole mysql db with nosql db. But if a mysql table can be replaced with nosql db and expensive queries are generated againest this table, I will give a try of nosql DB.

In our product, we have a unique user login log table to know how many users logined in a specify date. Here is the table structure:

<pre>
  unique_login_logs: 
    _attributes:  {phpName: UniqueLoginLog}
    id:
    user_id: { type: integer }
    date: { type: date, index: true }
    created_at:
    _uniques:
      unique_date_type: [user_id, date]
</pre>

The expensive query looks like:

<pre>
select date, count(`user_id`) from unique_login_logs group by date order by date desc;'
</pre>

And the other related operations will be save an entry into this table or check the user entry for a specify date is in the table or not. Nothing more.


<h4>Choose NoSQL DB from <a href='http://en.wikipedia.org/wiki/NoSQL'>wiki page</a>: </h4>

<pre>
...
Key-value cache in RAM

    Citrusleaf database
    memcached
    Oracle Coherence
    Redis
    Tuple space
    Velocity

Key-value stores implementing the Paxos algorithm

    Keyspace

Key-value stores on disk

    BigTable
    CDB
    Citrusleaf database
    Dynomite
    Keyspace
    membase
    Memcachedb
    Redis
    Tokyo Cabinet
    TreapDB
    Tuple space
    MongoDB
...
</pre>

For my feature request, I need a disk stored key-value system. I just spend 1 minute to take a look the MongoDB features. It meet my feature requirements. That's enough. If you know more about the other nosql DBs, of course you should choose the one which suit yours best.

<h4>Try MongoDB</h4>

Step 1: Install MongoDB(http://www.mongodb.org/display/DOCS/Quickstart+Unix);

Step 2: Simple demo testing:

create a new db:

<pre>
use mydb;
</pre>


Save an entry:

<pre>
db.uniqueLoginLog.save({date: '2011-06-09', user_id: 101});
db.uniqueLoginLog.save({date: '2011-06-09', user_id: 111});
db.uniqueLoginLog.save({date: '2011-06-09', user_id: 102});
..
db.uniqueLoginLog.save({date: '2011-06-11', user_id: 100});
db.uniqueLoginLog.save({date: '2011-06-11', user_id: 101});
db.uniqueLoginLog.save({date: '2011-06-11', user_id: 102});
</pre>


Group entries by date:

<pre>
db.uniqueLoginLog.group(
           {key: { date:true },
            reduce: function(obj,prev) { prev.count ++; },
            initial: { count: 0 }
            });
            
</pre>

The output looks like:

<pre>
[
	{
		"date" : "2011-01-01",
		"count" : 3
	},
	{
		"date" : "2011-01-02",
		"count" : 3
	},
	{
		"date" : "2011-01-03",
		"count" : 1
	},
	{
		"date" : "2011-01-04",
		"count" : 1
	}
]
</pre>  

With the output, I can do the order in client. 


<h4>Install PHP Mongo Extension</h4>

You can install Mongo PHP extension with pecl command line or install it <a href='http://pecl.php.net/package/mongo'>manually</a>

<pre>
> pecl search mongo
Retrieving data...0%
Matched packages, channel pecl.php.net:
=======================================
Package Stable/(Latest) Local
mongo   1.1.4 (stable)        MongoDB database driver

> pecl install mongo
</pre>

<h4>Get stored items with php function</h4>

PHP code:

<pre>
$m = new Mongo();

$db = $m->mydb;

$collection = $db->uniqueLoginLog;


$obj = array('date'=> '2011-06-09', 'user_id'=> 101);
$collection->insert($obj);



$keys = array("date" => 1);
$initial = array("count" => 0);
$reduce = "function(obj,prev) { prev.count ++; }";
$g = $collection->group($keys, $initial, $reduce);

echo '<pre>';
var_dump($g);

</pre>

Output looks like:

<pre>
array(4) {
  ["retval"]=>
  array(3) {
    [0]=>
    array(2) {
      ["date"]=>
      string(10) "2011-06-09"
      ["count"]=>
      float(17)
    }
    [1]=>
    array(2) {
      ["date"]=>
      string(10) "2011-06-11"
      ["count"]=>
      float(10)
    }
    [2]=>
    array(2) {
      ["date"]=>
      string(10) "2011-06-10"
      ["count"]=>
      float(7)
    }
  }
  ["count"]=>
  float(34)
  ["keys"]=>
  int(3)
  ["ok"]=>
  float(1)
}
</pre>

<h4>Deploy to production?</h4>

Until now, the demo is still a toy. If you want to deploy it to production, there are more work need to to be done. Take a look at the <a href='http://www.mongodb.org/display/DOCS/Admin+Zone'>admin zone</a>

For my feature implemention, I will consider <a href='http://www.mongodb.org/display/DOCS/Replication'>Replication</a> next step.

Summary:

This is not a <a href='http://www.mongodb.org/display/DOCS/Tutorial'>toturial</a> about how to use MongoDB. It is just a example that can use nosql db in your production.

Reference:

* <a href='http://try.mongodb.org/'>A Tiny MongoDB Browser Shell (mini tutorial included)</a>
* <a href='https://github.com/mongodb/mongo/tree/master/jstests/'>JsTest</a>
