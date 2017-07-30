---
layout: post
title: "PROXYPASS Evil"
tags: nginx proxypass amazon ec2 cpu-credit aliyun oss cdn budget
---

You are forced to invent new solution for your business, otherwise you are going to kick your own ass. :-)

Although the post is targed with name "proxypass evil", it is not true.
I like [proxypass](http://nginx.org/en/docs/http/ngx_http_proxy_module.html), it hides(protects) backend services from outside, especially when we are practicing [Microservices](http://martinfowler.com/articles/microservices.html) nowdays.

The post here is explainning a new solution to implement your heavy user experience website, with light backend service and Aliyun services.

## Background

[Aliyun(China)](http://www.aliyun.com) service becomes more and more popular since more and more none-technical company transfer their website from their own hosting to Aliyun, the same as Amazon's.

[OSS](https://cn.aliyun.com/product/oss) could be used to store static resource.

[CDN](https://cn.aliyun.com/product/cdn) could be used to speed up the resoure loading, by binding with your domain [CNAME](https://en.wikipedia.org/wiki/CNAME_record) and uploading website file object to OSS.

## Context

1. You are giving a Amazon EC2 T2 medium node. Website is full of images and videos for around 1GB.
2. You are told to make the site loading speed with a duration which human could accept, let's say 30s[1], with an expect a high traffic coming in following days.
3. There are some small backend services, which frontend needs to talk with.


### Let's compare two solutions:

**A**. EC2 node to host site and all static resource requests are proxypassed to Aliyun OSS CDN;

**B**. Aliyun OSS CDN to host site and it will talk to backend service hosted at EC2 node;

If you choose **A**, you have to prepare a powerful EC2 node, no matter of bandwidth or CPU, considering your node need to accept all traffic and pass back and forth from OSS/CDN.

If you find solution **B**, you are binding your website with Aliyun service. Binding, I mean, actually your website experience is provided by Aliyun. Only if Aliyun dies, your website is going to die. The only tricky part is if you have backend services need to be integrated, you have to provide CORS in your backend services, considering www.example.com has a CNAME record bound with CDN already. 

Is this a cool idea? For me, yes! I can have a good sleep without worrying about our marketing team traffic plan.


### Pains from EC2 or your own hosting.

In my first day implementing solution **A** in a EC2 node(T2 medium), the site is really fast, let's say 10s. After one day, nothing changes, when I load speed test the website again, it loads for around 1m. Unbelievable that it is "NOT STABLE" for Aliyun CDN. After comparing with solution **B**, it is not the CDN fault.

Amazon EC2 T2 instances has a feature named "[CPU Credits](http://docs.aws.amazon.com/AWSEC2/latest/UserGuide/t2-instances.html)"

> When a T2 instance uses fewer CPU resources than its base performance level allows (such as when it is idle), the unused CPU credits (or the difference between what was earned and what was spent) are stored in the credit balance for up to 24 hours, building CPU credits for bursting. When your T2 instance requires more CPU resources than its base performance level allows, it uses credits from the CPU credit balance to burst up to 100% utilization. The more credits your T2 instance has for CPU resources, the more time it can burst beyond its base performance level when more performance is needed.

Something to prove it.
![EC2 T2 Left CPU Credits](http://freetofeel.com/images/left-cpu-credits.jpg =800x)

![EC2 T2 CPU Credits](http://freetofeel.com/images/cpu-credits.jpg =800x)


`2016.09.12 3:00 UTC` - the time the website is really fast, comparing with following days(e.g. 09.13, 09.14), the CPU credits usage never exceeds 0.2.

It is the same reason if you have a poor server hosting by yourself, unless you could prepare a powerful CPU and memory.



## REFs

1. 30s - yes, since I joined this new company, this number is exciting all the creative guys. Sadly to say that we are using more and more cool technologies[e.g. [WebGL](https://en.wikipedia.org/wiki/WebGL)] nowdays, but with slower and slower website load speed.


