---
layout: post
title: "Find Ubuntu Wireless Icon"
tags: ubuntu
---

My network-manager works fine. You can test by <code>sudo service network-manager start/stop</code>. And my wireless network can be found by <code>sudo iwlist  scan</code>.
So there are two solutions:
<ul>
<li>Right click the top panel and click 'add to panel' and select 'notifications area'. If this didn't work,then netstep:
</li>
<li>
<code>sudo vim /etc/NetworkManager/nm-sysmte-settings.conf</code>. Modify false to true.
<code>sudo service network-manager restart</code>

In my ubuntu 10.10, after these trys, the wireless icon displayed in the panel again. Good luck to you.
