---
layout: post
title: "Network Sharing Between Ubuntu And IPhone4(China Unicom Contract Version)"
tags:  wifi ubuntu iphone4
---

Find a solution from Internet that can make network sharing between Ubuntu And IPhone4.

<pre>
sudo add-apt-repository ppa:pmcenery/ppa

sudo apt-get update

sudo apt-get install gvfs ipheth-dkms ipheth-utils
</pre>

If you can pass all these steps, and then restart your machine. Bingo!

You can find more information <a href='http://ivkin.net/2010/05/tethering-ubuntu-lucid-lynx-and-iphone-os/#comment-4790' >here</a>.
