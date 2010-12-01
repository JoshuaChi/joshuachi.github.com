---
layout: post
title: "Using JSONP to do the cross domain request "
---

<p class='meta'>2010-02-26 11:57:36</p>

JSONP (script insertion)

How does it work?

Lets assume, that we have a textarea iResponse and we want to set its value to something that we will receive from the server. And that we have some server in a different domain. With script insertion we can send a HTTP-GET request to the server like this:
<pre name='code' class='javascript'>
function insertScript( url){
    var script = document.createElement("script");
    script.setAttribute("src",url);
    script.setAttribute("type","text/javascript");
    document.body.appendChild(script);
}
</pre>
url in the request is a proper HTTP-GET request with the parameters. Hence server can receive input to work with. The trick with JSONP is how the output is passed back to the client. The newly downloaded “script” will be evaluated on load. Hence, if the script contains:
<pre name='code' class='javascript'>
call_me( value );
</pre>
A method call_me() will be called with the value as a parameter. Hence we should have another bit of script in our client to have a callback:
<pre name='code' class='javascript'>
function call_me( vParam ){
        document.getElementsByName("iResponse")[0].value = vParam;
}
</pre>
Finally, JSONP-based services are (if they are not tailored to a single client when the callback is predefined) should take the callback name as a parameter:
<pre name='code' class='javascript'>
url = "http://dummy.server.org/Create_a_Script.php?callback=call_me&......
</pre>
