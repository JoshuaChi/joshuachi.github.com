---
layout: post
title: "Be Careful Of Your Memcached Slab Size"
tags: -memcached
---

Recently, we found a very 'strange' bug. The memcached's evictions keep growing with 10% free memory in this instance. The memcached instance size is around 600M, and it has recached 90% percentage usage for a long time. This issue happened after we deployed a fix. 

Memcached memory allocation: a slab has many pages. One page has many chunks. Each chunk is a fixed size, based on the maximum size for the slab. So for example, there is 600Mb memory for the whole instance. And there are 540Mb has been used. Usually you store some big entries into memcache. Let's say 1500 bytes for each of them. So there are some big slabs with chunk size from 1000 bytes to 2000 bytes. And these slabs took 400Mb memory. Now you changed the size for these entries to 500 bytes. Let's call these entries 'Changed-Entries'. So memcached try to find some slabs which has 500 bytes size chunk. There are three possibilities:

1. There is no such size slabs exist. So Memcached will use the free memory to create some proper size slab for 'Changed-Entries'; There are 60Mb free memory can be used. But if these entries need 100Mb. That means some old entries will be 'kicked out' from these new slabs. Eviction happens;

2. If memcached found some used slabs which have 500 bytes chunk. It will kickout the expired items firstly. If the memroy still not enough for 'Changed-Entries', then the least used entries will be kicked out. Eviction happens;

3. If there is no free memory and there is no propel slabs can be used, then eviction happens.



References:

* <a href='http://code.google.com/p/memcached/wiki/FAQ#When_do_expired_cached_items_get_deleted_from_the_cache?'>When do expired cached items get deleted from the cache?</a> 

* <a href='http://dev.mysql.com/doc/refman/5.0/en/ha-memcached-using-memory.html'>Memory allocation within memcached</a>
