---
layout: post
title: "Format PHP Code integrated with VIM"
---

I like this post <a href="http://shadsplace.org/beautify-php/">Command line PHP Code Formatter for use with VIM</a>. It really save me a lot of time on format the past code in VIM.
1. 
download the <a href="http://shadsplace.org/beautify-php/beautify.php.gz">beautify.php.gz</a>

2. Copy the beautify.php into your user bin directory 
<strong>cp beautify.php /usr/local/bin</strong>
<strong>chmod 755 /usr/local/bin/beautify.php</strong>

3. Select the code and then format it using the php script.
Selecting code in visual mode (<strong>shift-v</strong> while in command mode) and then sending it to beautify.php by
<strong>:! beautify.php</strong>