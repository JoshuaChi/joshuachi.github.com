---
layout: post
title: "How And When To Use Mysql Federated Storage Engine"
tags:  mysql
---

Learned from <a href='http://conferences.oreillynet.com/presentations/mysql06/mixi_update.pdf'>mixi update</a> that they are using mysql federated engine for db partitioning.

<pre>
Use FEDERATED TABLE from MySQL 5.
Or do SELECT twice which is faster than using FEDERATED TABLEs
</pre>

<a href='http://dev.mysql.com/doc/refman/5.0/en/federated-storage-engine.html'>Mysql Official document</a> didn't talk too much about how and when to use federated engine. You can learned more from <a href='http://www.xaprb.com/blog/2007/01/29/mysqls-federated-storage-engine-part-1/'>Mysql Federated storage engine 1</a> and <a href='http://www.xaprb.com/blog/2007/01/31/mysqls-federated-storage-engine-part-2/'>Mysql Federated storage engine 2</a>.

Finally I find some clues in <a href='http://www.xaprb.com/blog/2007/01/31/mysqls-federated-storage-engine-part-2/'>Mysql Federated storage engine 2</a>:

<pre>
Strengths:

For example, pretend you have a set of distributed servers working on small parts of a large task, and their results need to be merged back together when done without conflict. Many solutions to this problem involve modulo arithmetic for generating primary keys. This could be a good use of a FEDERATED table: just federate one central table on all the servers, have the processes INSERT into the table, and they’ll get non-conflicting primary key numbers. That’s a trivially easy way to coordinate distributed resource requests.

The way it lets you mis-define tables holds great potential. For example, Giuseppe Maxia has already noted that you can define a FEDERATED table against a view. Views don’t have indexes (yet), but that shouldn’t stop you from telling the engine it does! That way, your WHERE clauses are sent through to the remote server unharmed, where the view can execute GROUP BY queries and the like. Giuseppe even outlines a way to get the remote server to execute arbitrary commands via a FEDERATED table!

What about combinations with replication, triggers and so forth? There must be many more cool hacks waiting to be discovered.

</pre>

And in <a href='http://mysql.lamphost.net/tech-resources/articles/mysql-federated-storage.html'>Accessing Distributed Data with the Federated Storage Engine</a>, you can find a simple demo that 'merge' two partioned tables into one by creating a view. Although, this is not what I expected. It will still make sense in some cases. 


Still have some questions about how the performance looks like when use view? And what's the limitation of rows or table size when using federated storage engine?
