---
layout: post
title: "ERROR:  While executing gem ... (Gem::GemNotFoundException)"
tags: gem
---

Try
<pre name='code' class='php'>
gem clean
</pre>

<a href="http://stackoverflow.com/questions/2273503/ruby-gem-package-manager-failing-with-gemgemnotfoundexception">reference</a>

If you got 
<pre name='code' class='php'>
/usr/bin/gem:10: undefined method `manage_gems' for Gem:Module (NoMethodError)
</pre>

Check if there are two gem under /usr/bin/ directory.
