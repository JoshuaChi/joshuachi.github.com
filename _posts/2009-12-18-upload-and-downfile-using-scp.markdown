---
layout: post
title: "Upload and downfile using scp"
---

<h1> {{ page.title }} </h1> <p class='meta'>2009-12-18 14:41:48</p>

The <a href="http://www.linuxtutorialblog.com/post/ssh-and-scp-howto-tips-tricks">scp</a> command allows you to copy files over ssh connections. This is pretty useful if you want to transport files between computers, for example to backup something.

Upload local file to remote server:
scp localfile username@tohostname:/dir/

Download remote file to local system:
scp username@tohostname:/remotefile /localdir/