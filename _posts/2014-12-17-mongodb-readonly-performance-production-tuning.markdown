---

layout: post
title: "Mongodb Read-only Performance Production Tuning"
tags:  mongodb tokumx cowboy erlang bson tsung performance concurrency
keywords: mongodb tokumx cowboy erlang bson tsung performance concurrency
description: "Tuning mongodb read-only performance on production ENV."

---

### MongoDB VS Tokumx
Check this post [Tokumx VS mongodb read-only performance](http://stackoverflow.com/questions/27359394/tokumx-vs-mongodb-read-performance) @stackoverflow firstly, which I have already described the context when comparing MongoDB and Tokumx read-only performance.

[TokuMX 2.0.0 Community Edition for MongoDB](http://www.tokutek.com/tokumx-for-mongodb/download-community/) is still built on MongoDB 2.4 which doesn't have GEO [2dsphere](http://docs.mongodb.org/manual/core/2dsphere/) index yet. So the post@stackoverflow might not be fair for [Tokumx](http://www.tokutek.com/tokumx-for-mongodb/). Personally, I like tokumx. 

- storage compress
- document level write lock
- concurrency write performance
- do not have to worry about emebeded document size change
- ...

A lot of those cool features you can find in [TOKUMX™ BENCHMARK VS. MONGODB – HDD](http://www.tokutek.com/tokumx-for-mongodb/hdd-benchmarks/) and [Tokumx Documentation](http://docs.tokutek.com/tokumx/)

### 2d index VS 2dsphere index

> 2d indexes support:

> - Calculations using flat geometry 
> - Legacy coordinate pairs (i.e., geospatial points on a flat coordinate system)
> - Compound indexes with only one additional field, as a suffix of the 2d index field

> 2dsphere indexes support:

> - Calculations on a sphere
> - GeoJSON objects and include backwards compatibility for legacy coordinate pairs
> - Compound indexes with scalar index fields (i.e. ascending or descending) as a prefix or suffix of the 2dsphere index field

So basically if you have multiple fields need to be compound together, you need use 2dshpere index.

Nothing is perfect, if you are doing sorting some fields, like `id desc`, you will have the [geo query with sort performance] issue(http://stackoverflow.com/questions/12908871/mongodb-geospatial-query-with-sort-performance-issues).


### geoWithin VS near
So we choose 2dsphere index for our case. But performance matters if you are using [geoWithin](http://docs.mongodb.org/manual/reference/operator/query/geoWithin/#op._S_geoWithin) and [near](http://docs.mongodb.org/manual/reference/operator/query/near/#op._S_near).


	db.collection.find(
	   {
	   $query: {
	     geo:
	     {
	       $near :
	        {
	          $geometry: img.geo,
	          $maxDistance: 100000
	        }
	     },
	     gender: 3
	   },
	   $orderby: { '_pid' : -1 },
	   $limit: 3,
	   $skip: 1
	  }
	);

     "cursor" : "S2NearCursor",
     "isMultiKey" : false,
     "n" : 54,
     "nscannedObjects" : 502,
     "nscanned" : 502,
     "nscannedObjectsAllPlans" : 502,
     "nscannedAllPlans" : 502,
     "scanAndOrder" : true,
     "indexOnly" : false,
     "nYields" : 4,
     "nChunkSkips" : 0,
     "millis" : 3,
     "indexBounds" : {
     },


	db.collection.find(
	  {
	    $query: {
	      geo : {
	        $geoWithin : {
	          $centerSphere : [ img.geo.coordinates , 100/3959 ]
	        }
	      },
	      gender:3
	    },
	    $orderby: { '_pid' : -1 },
	    $limit: 3,
	    $skip: 1
	  }
	);

     "cursor" : "BtreeCursor geo_2dsphere_gender_1",
     "isMultiKey" : false,
     "n" : 159,
     "nscannedObjects" : 249,
     "nscanned" : 337,
     "nscannedObjectsAllPlans" : 249,
     "nscannedAllPlans" : 337,
     "scanAndOrder" : true,
     "indexOnly" : false,
     "nYields" : 3,
     "nChunkSkips" : 0,
     "millis" : 3,
     "indexBounds" : {
          "geo" : [],
          "gender" : [
               [
                    3,
                    3
               ]
          ]

You can see they are using two different cursor `S2NearCursor` and `BtreeCursor`. In our case `S2NearCursor` works better than `BtreeCursor`.

### MongoDB and NUMA Hardware

- [What's Non-uniform memory access (NUMA)](http://en.wikipedia.org/wiki/Non-uniform_memory_access)?
- [What's Interleaved memory](http://en.wikipedia.org/wiki/Interleaved_memory)

NUMA and Interleaved Memory affect MongoDB perofmrnace, you can find below in [Production notes](http://docs.mongodb.org/manual/administration/production-notes/).

> - Running MongoDB on a system with Non-Uniform Access Memory (NUMA) can cause a number of operational problems, including slow performance for periods of time and high system process usage.

> - When running MongoDB servers and clients on NUMA hardware, you should configure a memory interleave policy so that the host behaves in a non-NUMA fashion. MongoDB checks NUMA settings on start up when deployed on Linux (since version 2.0) and Windows (since version 2.6) machines, and prints a warning if the NUMA configuration may degrade performance.

> - See The [MySQL “swap insanity” problem and the effects of NUMA](http://jcole.us/blog/archives/2010/09/28/mysql-swap-insanity-and-the-numa-architecture/) post, which describes the effects of NUMA on databases. This blog post addresses the impact of NUMA for MySQL, but the issues for MongoDB are similar. The post introduces NUMA and its goals, and illustrates how these goals are not compatible with production databases.

### Tunning client performance 
In the /etc/sysctl.conf file:

> - net.ipv4.tcp_tw_recycle = 1
> - net.ipv4.tcp_tw_reuse = 1

- TCP_TW_RECYCLE Description: Enables fast recycling of TIME_WAIT sockets. Use with caution and ONLY in internal network where network connectivity speeds are “faster”.

- TCP_TW_REUSE Description: Allows for reuse of sockets in TIME_WAIT state for new connections, only when it is safe from the network stack’s perspective.

