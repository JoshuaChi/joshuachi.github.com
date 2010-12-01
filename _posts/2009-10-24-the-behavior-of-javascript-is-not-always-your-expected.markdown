---
layout: post
title: "The behavior of javascript is not always your expected"
---

<h1> {{ page.title }} </h1> <p class='meta'>2009-10-24 09:58:35</p>

Let's raise the issue '07 + 08 = 07' firstly from <a href="http://www.debuggable.com/posts/7+8===7-in-javascript:4acba016-d204-489b-b5a0-1fd0cbdd56cb">this guy's article</a>.
<pre name='code' class='javascript'>
var a = '07';
var b = '08'

alert(a + b); //'0708';
</pre>

OK. We knew the result. What we will do is using the 'parseInt' method.
<pre name='code' class='javascript'>
var a = '07';
var b = '08'

alert(parseInt(a) + parseInt(b)); //'07';
</pre>
The result is not our expected this time.

So boys give a lot of solutions.
solution 1:
<pre name='code' class='javascript'>
var a = '07';
var b = '08'

alert(parseInt(a, 10) + parseInt(b, 10)); //'15';
</pre>

solution 2:
<pre name='code' class='javascript'>
var a = '07';
var b = '08'

alert(Number(a) + Number(b)); //'15';
</pre>
I like this solution. If the variable is a number, transform it to 'Number' directly to keep it safe. If the variable is a string, transform it to 'String' directly. 
The same issue occurred in Date function too.
<pre name='code' class='javascript'>
var d = new Date(2009, 08, 02); //It's 2nd of JULY
</pre>
The <a href="https://developer.mozilla.org/en/Core_JavaScript_1.5_Reference/Global_Objects/Date">reason</a>.
<blockquote>year
    Integer value representing the year. For compatibility (in order to avoid the Y2K problem), you should always specify the year in full; use 1998, rather than 98.

month
    Integer value representing the month, beginning with 0 for January to 11 for December.

date
    Integer value representing the day of the month (1-31). </blockquote>

