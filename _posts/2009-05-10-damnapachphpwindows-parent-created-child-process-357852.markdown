---
layout: post
title: "Damn!Apach+PHP+Windows = Parent: Created child process 357852"
---

<p class='meta'>2009-05-10 04:20:58</p>

<strong>Parent: Created child process 357852</strong>

C:\Program Files\Apache Software Foundation\Apache2.2\logs\error.log
<blockquote>[Sun May 10 10:55:35 2009] [warn] pid file C:/Program Files/Apache Software Foundation/Apache2.2/logs/httpd.pid overwritten -- Unclean shutdown of previous Apache run?
[Sun May 10 10:55:35 2009] [notice] Apache/2.2.6 (Win32) PHP/5.2.6 configured -- resuming normal operations
[Sun May 10 10:55:35 2009] [notice] Server built: Sep  5 2007 08:58:56
[Sun May 10 10:55:35 2009] [notice] Parent: Created child process 357852
[Sun May 10 10:55:36 2009] [notice] Child 357852: Child process is running
[Sun May 10 10:55:36 2009] [notice] Child 357852: Acquired the start mutex.
[Sun May 10 10:55:36 2009] [notice] Child 357852: Starting 250 worker threads.
[Sun May 10 10:55:36 2009] [notice] Child 357852: Starting thread to listen on port 80.
[Sun May 10 10:57:28 2009] [notice] Parent: Received restart signal -- Restarting the server.
[Sun May 10 10:57:28 2009] [notice] Child 357852: Exit event signaled. Child process is ending.
[Sun May 10 10:57:29 2009] [notice] Child 357852: Released the start mutex
[Sun May 10 10:57:30 2009] [notice] Child 357852: Waiting for 250 worker threads to exit.
[Sun May 10 10:57:30 2009] [notice] Child 357852: All worker threads have exited.
[Sun May 10 10:57:30 2009] [notice] Child 357852: Child process is exiting</blockquote>
To resolve this , take a look at this:
<blockquote>If you are getting this error, you are probably trying to use Apache, MySQL and PHP in a windows system. Just do this simple step to solve this issue.

It is quite frustrating to see that all your PHP pages suddenly doesn't seem to work. If you check your Apache log file you will see this error: Parent: child process exited with status 3221225477 -- Restarting

Don't worry just goto the PHP installation folder and look for libmysql.dll file.<span class="Apple-converted-space"> </span>

Just copy this file and save it to your windows\system32 folder.

Now restart MySQL and Apache servers.

Everything should be fine now and all your PHP pages will work as normal.</blockquote>