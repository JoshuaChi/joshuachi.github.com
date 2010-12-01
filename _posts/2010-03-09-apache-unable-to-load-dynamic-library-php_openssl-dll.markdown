---
layout: post
title: "Apache Unable to load dynamic library php_openssl.dll"
---

As a windows user, sometimes you have to face and handle this kind of problems. 

The error: “PHP Startup: Unable to load dynamic library php_openssl.dll. The operating system cannot run %1“, when you are trying to start the apache server in the error.log file.

Basically what this error is trying to mention that there is an issue with your php_openssl.dll and a possible mismatch with other depending libraries. To resolve this, follow the below steps:

1. Rename ’ssleay32.dll’ and ‘libeay32.dll’ in c:\windows\system32 to ’ssleay32.dll.old’ and ‘libeay32.dll.old’ respectively.

2. Copy ’ssleay32.dll’ and ‘libeay32.dll’ from your PHP folder to the system32.

3. Restart the apache webserver.


Even I resolve it finally , I can learn nothing from it. This such a damn rule("copy the dll file from PHP folder to system32") was made by Microsoft? I don't know. You couldn't find the solution even in php document. The solution was passed from one developer to another. But no matter how I can stay away this kind of damn things for a while.