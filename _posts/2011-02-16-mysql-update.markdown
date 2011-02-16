---
layout: post
title: "Same update query only update once"
tags: -mysql
---

Just learned more about the mysql update statement.
I am very curious with this query: 
<pre>
UPDATE `table_name` SET `column3` = (`column1` | (`column2` * 2) ;
</pre>

The first time, there are 10,000 items were updated. When I execute it again, 0 affected.

So there is no where condition, how can this happen?
Learn it from <a href='http://dev.mysql.com/doc/refman/5.1/en/update-speed.html'>mysql doc: Speed of UPDATE Statements</a>.

Yes, it is because of the index.
<pre>
  ...The speed of the write depends on the amount of data being updated and the number of indexes that are updated. Indexes that are not changed do not get updated. 
</pre>