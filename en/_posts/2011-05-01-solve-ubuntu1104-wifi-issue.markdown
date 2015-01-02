---
layout: post
title: "Solve Wireless Issue When Upgrading From 10.10 to 11.04"
tags:  ubuntu wireless
---

After upgrading from ubuntu 10.10 to ubuntu 11.04 the wireless stop working.

The first step, I was using <a href="https://help.ubuntu.com/community/WifiDocs/WirelessTroubleShootingGuide">ubuntu trouble shooting</a> to detect the issue.

a. Detail whether there are software or hardware blocks on your rf devices. To get a list of devices and their hardware and software status, try "sudo rfkill list".

<pre>
~$ sudo rfkill list
0: hp-wifi: Wireless LAN
	Soft blocked: yes
	Hard blocked: yes
</pre>

Unblock your devices by "sudo rfkill unblock 0".

b. Check for Device Recognition for my HP laptop(amd64)

<pre>
~$ sudo lshw -C network
  *-network UNCLAIMED     
       description: Network controller
       product: BCM4311 802.11a/b/g
       vendor: Broadcom Corporation
       physical id: 0
       bus info: pci@0000:30:00.0
       version: 01
       width: 32 bits
       clock: 33MHz
       capabilities: pm msi pciexpress bus_master cap_list
       configuration: latency=0
       resources: memory:c8000000-c8003fff
  *-network
       description: Ethernet interface
       product: NetXtreme BCM5788 Gigabit Ethernet
       vendor: Broadcom Corporation
       physical id: 1
       bus info: pci@0000:02:01.0
       logical name: eth0
       version: 03
       serial: 00:17:08:37:6a:64
       size: 100Mbit/s
       capacity: 1Gbit/s
       width: 32 bits
       clock: 66MHz
       capabilities: pm vpd msi bus_master cap_list ethernet physical tp 10bt 10bt-fd 100bt 100bt-fd 1000bt 1000bt-fd autonegotiation
       configuration: autonegotiation=on broadcast=yes driver=tg3 driverversion=3.116 duplex=full firmware=5788-v3.26 ip=192.168.1.103 latency=64 link=yes mingnt=64 multicast=yes port=twisted pair speed=100Mbit/s
       resources: irq:23 memory:d4000000-d400ffff
</pre>

Here I can see 'tg3' driver was using. And by checking the loaded module the tg3 is there.

<pre>
~$ sudo lsmod
</pre>

If your driver was not loaded, you can load it by "sudo modprobe <module>"

c. Identify PCI devices with PCI ID.

<pre>
~$ sudo lspci -v | grep Ethernet
02:01.0 Ethernet controller: Broadcom Corporation NetXtreme BCM5788 Gigabit Ethernet (rev 03)

~$ sudo lspci -v | grep Network
30:00.0 Network controller: Broadcom Corporation BCM4311 802.11a/b/g (rev 01)
</pre>

d. Check the addtional drivers, I found "Broadcom STA wireless driver" was using.

Everything looks good until now. Driver was working and was recognized. So I guess the issue might be the compatibility with new kernel?

e. With the help from google.

i). Someone solve it by install <a herf="http://ubuntuforums.org/showthread.php?t=1653157">linux-backports-modules-wireless-maverick-generic</a>. It is interesting to know what <a hef="https://help.ubuntu.com/community/UbuntuBackports">backports</a> is.

Unfortunately it didn't work for me. 

ii). So I tried the solution in this <a href="http://ubuntuforums.org/showthread.php?t=1653157&page=2">thread</a> by disable my "Broadcom STA wireless driver" and install b43.

<pre>
Removing "bcmwl-kernel-source" by using Synaptic Package Manager
Then installing "firmware-b43-installer" and "b43-fwcutter" again by Synaptic Package Manager. 
</pre>

At the end of step e, and by rebooting laptop, the wifi issue was fixed. If you still has the issue, I suggest check the trouble shooting tutorial again. It is really helpful.

Reference:

1.http://linuxfans.keryxproject.org/?page_id=27

2.http://www.ubuntumini.com/2009/11/broadcom-wireless-driver-fix-in-karmic.html 
