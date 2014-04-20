---

layout: post
title: "Use Solr Correctly"
tags:  solr tsung performance

---

## Background
Since we deploy solr to production, it was running fine for first few days, and then some day it will slow to response. It happened at least several times like this. We can start this analyzing from this graphite screenshot.

![Solr Graphite screenshot](http://freetofeel.com/images/solr-prod-slow.png)


### The whole server strucuture:

- We have three solr instances: one master and two slave, which managed by zookeeper 
- All client requests will be queued into `queue.size.solr` firstly

(`Notice: we will not discuss the strucuture correct or wrong, I just want to focus on solr itself.`)

### More info about this graphite

- `queue.size.solr` was increased since `solr.request.time.avg` increased, which is obvious;
- The increasing of `solr.request.time.avg` was not caused by `solr.requests` which is quite stable during `Fri 12PM` to `Fri 8PM`;
- Please ignore the drop of `system.memory.Memfree` which is caused by a restart of solr instance on master(BTW, we stored index in RAM);

### A warning from production solr log

> PERFORMANCE WARNING: Overlapping onDeckSearchers=X

You will find an explanation from [solr wiki](http://wiki.apache.org/solr/FAQ#What_does_.22PERFORMANCE_WARNING:_Overlapping_onDeckSearchers.3DX.22_mean_in_my_logs.3F) page:

> This warning means that at least one searcher hadn't yet finished warming in the background, when a commit was issued and another searcher started warming. This can not only eat up a lot of ram (as multiple on deck searches warm caches simultaneously) but it can can create a feedback cycle, since the more searchers warming in parallel means each searcher might take longer to warm.
> 
Typically the way to avoid this error is to either reduce the frequency of commits, or reduce the amount of warming a searcher does while it's on deck (by reducing the work in newSearcher listeners, and/or reducing the autowarmCount on your caches)
>
See also the <maxWarmingSearchers/> option in SolrConfig.xml.

I want to add addtional information before we start analyzing. The warning was always there in production log. We saw around double size this warning type entries comparing with the ones day before.

## Too early conclusion

From the graphite screenshot I thought it must be something wrong with solr itself. The things which we can control might only be solr configure and JVM. After playing all those two factors and several round tsung stress testings, I kept getting this warning. 
I failed to get rid of this waring, which put me back to find more articles about this issue.

## Conclusion
It is very possible that we use it wrong which was obvious if I had paied more attention to `...to avoid this error is to either reduce the frequency of commits, or reduce the amount of warming a searcher does...`. 

* Solr is not for realtime search;
* Solr is not for replacement of RDB(e.g. mysql);
* Solr rely on much of RAM if you have a big index size;
* `Read`(`Search`) and `Write`(`Update`) should be treated differently;

So the solution could be batch the `write` requests. 

Solrj client provides [ConcurrentUpdateSolrServer](https://lucene.apache.org/solr/4_7_2/solr-solrj/org/apache/solr/client/solrj/impl/ConcurrentUpdateSolrServer.html) which contained a queue. So we can queued all requests firstly with `commitWithin` enabled.

More tips about how to optimize your index performance if you also have the `write` issue:

* [How to make indexing faster](http://wiki.apache.org/lucene-java/ImproveIndexingSpeed)
* [SolrPerformanceFactors](http://wiki.apache.org/solr/SolrPerformanceFactors)

