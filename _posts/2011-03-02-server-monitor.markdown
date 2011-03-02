---
layout: post
title: "Web Server Memory Monitor"
tags: -performance memory
---

<pre>
  free-m: to see how much memory you are currently using
</pre>
Output:
<code>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; total &nbsp;&nbsp;
used&nbsp;&nbsp; free&nbsp;&nbsp;&nbsp; shared buffers cached<br>
Mem:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 90&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 85
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 0
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 34<br>
-/+ buffers/cache:&nbsp; 46&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 43<br>
Swap:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 9&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 0
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 9
</code>
The top row 'used' (85) value will almost always nearly match the top row mem value (90).  Since Linux likes to use any spare memory to cache disk blocks (34).

The key used figure to look at is the buffers/cache row used value (46).  This is how much space your applications are currently using.  For best performance, this number should be less than your total (90) memory.  To prevent out of memory errors, it needs to be less than the total memory (90) and swap space (9).

If you wish to quickly see how much memory is free look at the buffers/cache row free value (43). This is the total memory (90)- the actual used (46). (90 - 46 = 44, not 43, this will just be a rounding issue)

<pre>
  ps aux: to see where all your memory is going.That will show the percentage of memory each process is using.  You can use it to identify the top memory users (usually Apache, MySQL and Java processes).
</pre>
Output:
<code>
USER PID %CPU %MEM VSZ&nbsp;&nbsp;&nbsp;&nbsp; RSS&nbsp;&nbsp; TTY&nbsp;&nbsp; STAT
&nbsp; START TIME COMMAND<br>
root 854 0.5&nbsp; 39.2 239372&nbsp; 36208 pts/0 S&nbsp;&nbsp;&nbsp;&nbsp; 22:50 0:05
/usr/local/jdk/bi<br>
n/java -Xms16m -Xmx64m -Djava.awt.headless=true -Djetty.home=/opt/jetty -cp /opt<br>
/jetty/ext/ant.jar:/opt/jetty/ext/jasper-compiler.jar:/opt/jetty/ext/jasper-runt<br>
ime.jar:/opt/jetty/ext/jcert.jar:/opt/jetty/ext/jmxri.jar:/opt/jetty/ext/jmxtool
</code>
We can see that java is using up 39.2% of the available memory.

<pre>
  vmstat:helps you to see, among other things, if your server is swapping.
</pre>
<code>
# vmstat 1 2
   procs                      memory    swap          io     system         cpu
 r  b  w   swpd   free   buff  cache  si  so    bi    bo   in    cs  us  sy  id
 0  0  0  39132   2416    804  15668   4   3     9     6  104    13   0   0 100
 0  0  0  39132   2416    804  15668   0   0     0     0   53     8   0   0 100
 0  0  0  39132   2416    804  15668   0   0     0     0   54     6   0   0 100
</code>
The first row shows your server averages.  The si (swap in) and so (swap out) columns show if you have been swapping (i.e. needing to dip into 'virtual' memory) in order to run your server's applications.  The si/so numbers should be 0 (or close to it).  Numbers in the hundreds or thousands indicate your server is swapping heavily.  This consumes a lot of CPU and other server resources and you would get a very (!) significant benefit from adding more memory to your server.

Some other columns of interest: The r (runnable) b (blocked) and w (waiting) columns help see your server load.  Waiting processes are swapped out.  Blocked processes are typically waiting on I/O.  The runnable column is the number of processes trying to something.  These numbers combine to form the 'load' value on your server.  Typically you want the load value to be one or less per CPU in your server.

The bi (bytes in) and bo (bytes out) column show disk I/O (including swapping memory to/from disk) on your server.

The us (user), sy (system) and id (idle) show the amount of CPU your server is using.  The higher the idle value, the better.