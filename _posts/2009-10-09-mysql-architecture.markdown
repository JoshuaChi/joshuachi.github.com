---
layout: post
title: "MySQL Architecture"
---

<p class='meta'>2009-10-09 22:05:07</p>

1.
Each client connection gets its own thread within the server process.

2.
If it takes a lot of time on locks, why not separate read and write lock?
Q:  How to synchronise the read database and write database?

3.
When we want to keep reading and writing date clean, we try to implement two types lock in db.
Expected：
Read locks on a resource are shared, or mutually nonblocking: many clients
may read from a resource at the same time and not interfere with each other.
Write locks, on the other hand, are exclusive—i.e., they block both read locks and
other write locks—because the only safe policy is to have a single client writing to
the resource at given time and to prevent all reads when a client is writing.

MySQL way:
a. Table locks - the lowest overhead;
b. Row locks - the greatest concurrency.

4.
Transactions aren’t enough unless the system passes the ACID test.
Atomicity
Consistency
Isolation
Durability - Once committed, a transaction’s changes are permanent.

5.
Isolation Levels >
READ UNCOMMITTED - Reading uncommitted data is also known as a dirty read;
READ COMMITTED - The default isolation level for most database systems (but not MySQL!);
REPEATABLE READ - MySQL’s default transaction isolation level.
SERIALIZABLE - At this level, a lot of timeouts and lock contention may occur.

6.
Deadlock - 
The way InnoDB currently handles deadlocks is to roll back the transaction
that has the fewest exclusive row locks.
Deadlocks are a fact of life in transactional systems, and your applications
should be designed to handle them.

6.
Transaction in MySQL >
MySQL AB provides three transactional storage engines: InnoDB, NDB Cluster, and
Falcon. solidDB and PBXT.

7.
AUTOCOMMIT >
MySQL operates in AUTOCOMMIT mode by default. It automatically executes each query in a separate transaction.
MyISAM or Memory tables -  essentially always operate in AUTOCOMMIT mode.

8.
You can’t reliably mix different engines in a single transaction. If you mix transactional and nontransactional tables (for instance, InnoDB and MyISAM tables) in a transaction, the transaction will work properly if all goes well. However, if a rollback is required, the changes to the nontransactional table can’t be undone.

9.
InnoDB also supports explicit locking, which the SQL standard does not mention at all:
a. SELECT ... LOCK IN SHARE MODE
b. SELECT ... FOR UPDATE

MySQL supports the LOCK TABLES and UNLOCK TABLES commands, which are implemented in the server, not in the storage engines.

10.
MySQL’s Storage Engines >
The MyISAM Engine >>
Storage: The MyISAM format is platformneutral, meaning you can copy the data and index files from an Intel-based server to a PowerPC or Sun SPARC without any trouble.
MyISAM tables created in MySQL 5.0 with variable-length rows are configured by default to handle 256 TB of data, using 6-byte pointers to the data records.

Features:
Locking and concurrency / Automatic repair / Manual repair(You can also use the myisamchk
command-line tool to check and repair tables when the server is offline.) / Index features / Delayed key writes(However, after a server or system crash, the indexes will definitely be corrupted and will need repair.) / 

Compressed MyISAM tables:
Compressed MyISAM tables can have indexes, but they’re read-only.

The MyISAM Merge Engine >>
A Merge table is the combination of several identical MyISAM tables into one virtual table. This is particularly useful when you use MySQL in logging and data warehousing applications.

The InnoDB Engine >>
InnoDB can’t build indexes by sorting, which MyISAM can do.
Any operation that changes an InnoDB table’s structure will rebuild the entire table, including all the indexes.

The Memory Engine >>
Here are some good uses for Memory tables:
a. For “lookup” or “mapping” tables, such as a table that maps postal codes to
state names
b. For caching the results of periodically aggregated data
c. For intermediate results when analyzing data
Support only fixed-size rows, so they really store VARCHARs as CHARs, which can waste memory.

The Archive Engine >>
It causes much less disk I/O than MyISAM, because it buffers data writes and compresses each row with zlib as it’s inserted.

The CSV Engine >>

The Federated Engine >>
The Federated engine does not store data locally. Each Federated table refers to a table on a remote MySQL server, so it actually connects to a remote server for all operations.

The Blackhole Engine >>
Blackhole engine useful for fancy replication setups and audit logging.

The NDB Cluster Engine >>
An NDB database consists of data nodes, management nodes, and SQL nodes (MySQL instances).

The Falcon Engine >>

The solidDB Engine >>

The PBXT (Primebase XT) Engine >>

The Maria Storage Engine >>
The goal is to use Maria as a replacement for MyISAM, which is currently MySQL’s default storage engine.

11.
Table Conversions >
a. mysql> ALTER TABLE mytable ENGINE = Falcon;