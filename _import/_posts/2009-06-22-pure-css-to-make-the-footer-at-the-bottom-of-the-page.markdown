---
layout: post
title: Pure CSS to make the footer at the bottom of the page
---

h1. {{ page.title }} 

p(meta). 2009-06-22 20:20:42

Pure CSS, no javascript to make the footer at the bottom of the page.
Imaging you have the html layout like the following:
<pre name="code" class="php">&lt;body&gt;

&lt;div id="container"&gt;
&lt;div id="header"&gt;&lt;/div&gt;
&lt;div id="body"&gt;&lt;/div&gt;
&lt;div id="footer"&gt;&lt;/div&gt;

&lt;/body&gt;</pre>

What you will do is simple.
<pre  name="code" class="css">html,
body {
margin:0;
padding:0;
height:100%;
}
#container {
min-height:100%;
position:relative;
}
#footer {
position:absolute;
bottom:0;
width:100%;
height:60px;/* Height of the footer */
background:#6cf;
}
</pre>
Thanks to <a href="http://matthewjamestaylor.com/">Matthew James Taylor</a> who gives the idea how to implement this.