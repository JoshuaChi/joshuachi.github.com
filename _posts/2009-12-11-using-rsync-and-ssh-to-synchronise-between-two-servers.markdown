---
layout: post
title: "Using Rsync and SSH to synchronise between two servers"
---

<h1> {{ page.title }} </h1> <p class='meta'>2009-12-11 16:11:19</p>

$ rsync -avz -e ssh remoteuser@remotehost:/remote/dir /this/dir/ 

<a href="http://troy.jdmz.net/rsync/index.html">refs</a>