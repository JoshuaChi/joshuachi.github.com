---
layout: post
title: "Javascript value copy and reference copy"
---

<p class='meta'>2009-08-28 08:22:34</p>

I will take an example in &lt;JavaScript: The Definitive Guide&gt;
<pre name='code' class='javascript'>
var a= 3.14;
var b = a; // copy the variable's value to a new variable
a = 4;
alert(b); //Displays 3.14; The copy has not changed
</pre>
<br />
<pre name='code' class='javascript'>
var a= [1,2,3];
var b = a; // copy that reference into a new variable
a[0] = 4;
alert(b); //Displays [4,2,3]; The copy has not changed
</pre>

Actually,the basic data type is value copy, like string, number, etc. But others , like Object, Array and Function are copy reference. In its fundamental nature, there is no Object and Function in Javascript language, all of them are a type of Array.