---
layout: post
title: "Linode Facility Migration to Fremont"
tags:  linode, vps, fremont
---

After using <a href='www.linode.com'>linode</a> host center at Tokyo for a while, I decided to migrate my node to Fremont.

Linode provide you a <a href='http://www.linode.com/speedtest/'>speedtest page</a>

Here is my speed testing result. Those two tasks are started at the same time.

<pre>
100MB-tokyo.bin 1.2/100MB, 47 min left
100MB-fremont.bin 66.5/100MB, 22 secs left
</pre>

But If I ping the speed test domain:
<pre>
$ ping speedtest.tokyo.linode.com
PING speedtest.tokyo.linode.com (106.187.96.148): 56 data bytes
64 bytes from 106.187.96.148: icmp_seq=0 ttl=51 time=82.885 ms
64 bytes from 106.187.96.148: icmp_seq=1 ttl=51 time=77.757 ms
64 bytes from 106.187.96.148: icmp_seq=2 ttl=51 time=77.919 ms

$ ping speedtest.fremont.linode.com
PING speedtest.fremont.linode.com (50.116.14.9): 56 data bytes
64 bytes from 50.116.14.9: icmp_seq=0 ttl=51 time=146.268 ms
Request timeout for icmp_seq 1
64 bytes from 50.116.14.9: icmp_seq=2 ttl=51 time=146.403 ms
64 bytes from 50.116.14.9: icmp_seq=3 ttl=51 time=145.409 ms
64 bytes from 50.116.14.9: icmp_seq=4 ttl=51 time=146.396 ms
64 bytes from 50.116.14.9: icmp_seq=5 ttl=51 time=148.467 ms
</pre>

As you can see the result is totaly different. So which one you can trust?

The response from linode support:

<pre>
Individual packets take less time to travel between our Tokyo datacenter and your location than our Fremont datacenter, but that our Fremont datacenter is able to provide you with faster download speeds to your location. Which location is better for you depends on whether your use case likes decreased latency, or better download speeds.
</pre>

At last I decide to switch to Fremont anyhow. So Linode provide me a new ip address. The interesting thing comes. My ISP blocked this ip address for some reason. You can find the fail point by using either "traceroute" or <a href='http://library.linode.com/linux-tools/mtr/'>MTR</a>.

So I asked for a new ip address and reboot my node. 

Don't forget to update your hosts file with new ip address to make your application work again. Good luck!

