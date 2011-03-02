---
layout: post
title: "Web Server Memory Monitor"
tags: -performance memory
---

<h2>free-m</h2>
<pre>
free-m: to see how much memory you are currently using
</pre>
Output:
<code>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; total &nbsp;&nbsp; used&nbsp;&nbsp; free&nbsp;&nbsp;&nbsp; shared buffers cached<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mem:&nbsp;90&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 85 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 0 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 34<br>
-/+ buffers/cache:&nbsp; 46&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 43<br> &nbsp;&nbsp;&nbsp;&nbsp;Swap:&nbsp;&nbsp; 9&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 0 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 9 </code>
The top row 'used' (85) value will almost always nearly match the top row mem value (90).  Since Linux likes to use any spare memory to cache disk blocks (34).

The key used figure to look at is the buffers/cache row used value (46).  This is how much space your applications are currently using.  For best performance, this number should be less than your total (90) memory.  To prevent out of memory errors, it needs to be less than the total memory (90) and swap space (9).

If you wish to quickly see how much memory is free look at the buffers/cache row free value (43). This is the total memory (90)- the actual used (46). (90 - 46 = 44, not 43, this will just be a rounding issue)


<h2>ps aux</h2>
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


<h2>vmstat</h2>
<pre>
vmstat:helps you to see, among other things, if your server is swapping.
</pre>
<code>
- vmstat 1 2
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

<h2>Resolving: High Java Memory Usage</h2>
Java processes can often consume more memory than any other application running on a server.

Java processes can be passed a -Xmx option.  This controls the maximum Java memory heap size.  It is important to set a limit on the heap size, otherwise the heap will keep increasing until you get out of memory errors on your VPS (resulting in the Java process - or even some other, random, process - dying.

Usually the setting can be found in your /usr/local/jboss/bin/run.conf or /usr/local/tomcat/bin/setenv.sh config files.  And your RimuHosting default install should have a reasonable value in there already.

If you are running a custom Java application, check there is a -XmxNNm (where NN is a number of megabytes) option on the Java command line.

The optimal -Xmx setting value will depend on what you are running.  And how much memory is available on your server.

From experience we have found that Tomcat often runs well with an -Xmx between 48m and 64m.  JBoss will need a -Xmx of at least 96m to 128m.  You can set the value higher.  However, you should ensure that there is memory available on your server.

To determine how much memory you can spare for Java, try this: stop your Java process; run free -m; subtract the 'used' value from the "-/+ cache" row from the total memory allocated to your server and then subtract another 'just in case' margin of about 10% of your total server memory.  The number you come up with is a rough indicator of the largest -Xmx setting you can use on your server.

<h2>Resolving: High Apache Memory Usage</h2>
Apache can be a big memory user.  Apache runs a number of 'servers' and shares incoming requests among them.  The memory used by each server grows, especially when the web page being returned by that server includes PHP or Perl that needs to load in new libraries.  It is common for each server process to use as much as 10% of a server's memory.

To reduce the number of servers, you can edit your httpd.conf file.  There are three settings to tweak: StartServers, MinSpareServers, and MaxSpareServers.  Each can be reduced to a value of 1 or 2 and your server will still respond promptly, even on quite busy sites.  Some distros have multiple versions of these settings depending on which process model Apache is using.  In this case, the 'prefork' values are the ones that would need to change.

To get a rough idea of how to set the MaxClients directive, it is best to find out how much memory the largest apache thread is using. Then stop apache, check the free memory and divide that amount by the size of the apache thread found earlier. The result will be a rough guideline that can be used to further tune (up/down) the MaxClients directive. The following script can be used to get a general idea of how to set MaxClients for a particular server:
<pre class="codebox"><code>
#!/bin/bash
echo "This is intended as a guideline only!"
if [ -e /etc/debian_version ]; then
    APACHE="apache2"
elif [ -e /etc/redhat-release ]; then
    APACHE="httpd"
fi
RSS=`ps -aylC $APACHE |grep "$APACHE" |awk '{print $8'} |sort -n |tail -n 1`
RSS=`expr $RSS / 1024`
echo "Stopping $APACHE to calculate free memory"
/etc/init.d/$APACHE stop &amp;amp;ampamp&gt; /dev/null
MEM=`free -m |head -n 2 |tail -n 1 |awk '{free=($4); print free}'`
echo "Starting $APACHE again"
/etc/init.d/$APACHE start &amp;amp;&gt; /dev/null
echo "MaxClients should be around" `expr $MEM / $RSS`
</code></pre>
Note: httpd.conf should be tuned correctly on our newer WBEL3 and FC2 distros.  Apache is not installed by default on our Debian distros (since some people opt for Apache 2 and others prefer Apache 1.3).  So this change should only be necessary if you have a Debian distro.

from http://modperlbook.org/html/11-2-Setting-the-MaxRequestsPerChild-Directive.html: "Setting MaxRequestsPerChild to a non-zero limit solves some memory-leakage problems caused by sloppy programming practices and bugs, whereby a child process consumes a little more memory after each request. In such cases, and where the directive is left unbounded, after a certain number of requests the children will use up all the available memory and the server will die from memory starvation."

<h2>Resolving: High MySQL Memory Usage</h2>

<code>
-- if your are not using the innodb table manager, then just skip it to save some memory
-- skip-innodb
innodb_buffer_pool_size = 16k
key_buffer_size = 16k
myisam_sort_buffer_size = 16k
query_cache_size = 1M
</code>


<h2>Troubleshooting Irregular Out Of Memory Errors</h2>
Sometimes a server's regular memory usage is fine.  But it will intermittently run out of memory.  And when that happens you may lose trace of what caused the server to run out of memory.

In this case you can setup a script (see below) that will regularly log your server's memory usage.  And if there is a problem you can check the logs to see what was running.
<code>
wget http://proj.ri.mu/memmon.sh -O /root/memmon.sh
chmod +x /root/memmon.sh
<code>
<pre>
-- create a cronjob that runs every few minutes to log the memory usage
echo '0-59/10 * * * * root /root/memmon.sh >> /root/memmon.txt' > /etc/cron.d/memmon
/etc/init.d/cron* restart 

-- create a logrotate entry so the log file does not get too large
echo '/root/memmon.txt {}' > /etc/logrotate.d/memmon

</pre>

--
This article was copied from http://rimuhosting.com/howto/memory.jsp.

