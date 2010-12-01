---
layout: post
title: "require_once case sensitive in PHP5.1.6 on WIN32 platform"
---

<p class='meta'>2009-05-13 12:28:32</p>

require_once('a.php');
require_once('A.php');
This two lines will require the file a.php twice in WIN32 platform and give a declare twice fatal error;
