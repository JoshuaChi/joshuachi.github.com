---
layout: post
title: "Be careful when using propel-build-schema"
tags: propel symfony
---

Tip1:
The generated schema.yml will has the duplicated table when you are using propel-build-schema to generate the yml file based on Symfony Version 1.
<pre class='yml' name='code'>
propel:
  duplicated_table_name:
</pre>


Tip 2:
In config/propel.ini, the propel.database means the database engine.
<pre class='php' name='code'>
propel.database            = mysql
</pre>
