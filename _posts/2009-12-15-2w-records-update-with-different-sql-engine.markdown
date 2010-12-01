---
layout: post
title: "2W records update with different sql engine"
---

<p class='meta'>2009-12-15 00:03:47</p>

This is just a test result:
20000 records in table animals;
<pre name='code' class='sql'>
CREATE TABLE `animals` (                                                           
           `animal_id` mediumint(8) NOT NULL auto_increment,                                
           `animal_type` varchar(25) collate utf8_unicode_ci NOT NULL,                      
           `animal_name` varchar(25) collate utf8_unicode_ci NOT NULL,                      
           `created` datetime NOT NULL default '2009-02-02 00:00:00',                       
           `doubledata` double default NULL,                                                
           PRIMARY KEY  (`animal_id`),                                                      
           KEY `typekey` (`animal_type`,`animal_name`),                                     
           KEY `datetime` (`created`),                                                      
           KEY `DOUBLE` (`doubledata`)                                                      
         ) ENGINE=MyISAM AUTO_INCREMENT=20001 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci  
</pre>
sql file looks like this:
<pre name='code' class='sql'>
update animals set animal_type = 'xxx' where animal_id = 1;
update animals set animal_type = 'xxx' where animal_id = 2;
.
.
.
update animals set animal_type = 'dog123' where animal_id = 20000;
</pre>

With Innodb engine, the update time > 5min( I just have no time to wait any more)
With MyISAM, the update time = 30 seconds.