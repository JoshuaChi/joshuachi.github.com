---
layout: post
title: "What RabbitMQ Cluster Can Do"
tags:  -rabbitmq
---

<h3>What RabbitMQ cluster can do - Scaling and Reliability</h3>


* <b>Example 1</b>: 

All data/state required for the operation of a RabbitMQ broker is replicated across all nodes.

Let's take an example to help you understand better. 

There is a publisher which publish 10 messages to RabbitMQ broker(*1).

|Publisher| --> |10 Messages| --> |Broker( = Node_A + Node_B)|

So Node_A will receive Message 1, Message 3, 5, 7, 9; Node_B will receive Message 2, Message 4, 6, 8, 10.

* <b>Example 2</b>:

We still use the above example. If the Node_A crashed when it is consuming the messages, what happens?

Before Node_A crashed (I simply powered off this machine):

Node_A finished Message 1, Message 3, and it is starting to consume Message 5;

Node_B finished Message 2, Message 4 and it is starting to consume Message 6.

After Node_A crashed:

Node_A stopped working;

Node_B finished Message 6, Message 7, Message 8, Message 9, Message 10 and Message 5.

Yes, as you can see, even Node_A dies unexpected. Broker still can get the status of Message 5 and send it to Node_B. 
And you can find following explanation:

<pre>
  If a node goes down or becomes unreachable what effects can this have on the cluster? Do things 'hang' for a bit?
  
  Topology change operations (see above) could potentially pause operation for a brief time but they will complete eventually. We use the net_kernel erlang module to do monitoring between nodes. The default "tick" time there is 60 seconds but this can be reduced. Further, in the event of a failure, any communication between the nodes will likely result in an error being generated and detected immediately: i.e. the only time at which you would not know about a node failure for 60 seconds is if there was no communication between the nodes for that amount of time.
  
  ....
  
</pre>


<h3>What RabbitMQ cluster can not do - High Availability</h3>

So the 60 seconds is what RabbitMQ can not do. We call it high availability. 

<pre>
...
Whilst RabbitMQ also supports clustering, clustering is intended to facilitate scalability, not availability. Thus in a cluster, if a node fails, queues which were on the failed node are lost. With the high availability setup described in this guide, when a node fails, the durable queues and the persistent messages within them can be recovered by a different node.
...
</pre>

To build a high availability and scalable application, you can take a look <a href='http://www.rabbitmq.com/pacemaker.html'>RabbitMQ Placemaker</a>


References:

1. RabbitMQ broker - a logical grouping of one or several Erlang nodes, each running the RabbitMQ application and sharing users, virtual hosts, queues, exchanges, etc. Sometimes we refer to the collection of nodes as a cluster. 
