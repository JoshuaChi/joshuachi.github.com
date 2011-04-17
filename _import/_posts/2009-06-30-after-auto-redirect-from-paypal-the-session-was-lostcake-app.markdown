---
layout: post
title: After auto redirect from PayPal, the session was lost[Cake App]
---

h1. {{ page.title }} 

p(meta). 2009-06-30 14:11:42

Reproduce steps:

1. Customer login <a href="https://www.mysite.com">my site</a>;
2. Choose a product and redirect to <a href="https://developer.paypal.com/cgi-bin/devscr">Paypal sandbox site</a> to complete the payment;
3. After the payment, the customer will be auto redirected to my site;
4. And then the customer session was lost.

I found the fail reason.

<pre name="code" class="php">
function __initSession() {
	$iniSet = function_exists('ini_set');

	if ($iniSet && env('HTTPS')) {
		ini_set('session.cookie_secure', 1); 
	} 
	switch ($this->security) {
	 case 'high': $this->cookieLifeTime = 0;
	 if ($iniSet) {
	 ini_set('session.referer_check', $this->host);
	 } 
	 break;
	 case 'medium': $this->cookieLifeTime = 7 * 86400;
	 if ($iniSet) {
	 ini_set('session.referer_check', $this->host);
	 } 
	 break;
	 case 'low': default: $this->cookieLifeTime = 788940000; break;
	}
}
</pre>

If you set the security level 'high' or 'medium' , the session wil be renewed.

A piece of comment from a guy in php.net:
<pre name="code" class="html">
If you have a value specified for session.referer_check you may run into difficulty when someone accesses your site and attempts to log in with a mis-capitalized URL.  
The logon will fail because any calls to session_start() will result in the existing session being trashed and a new one being created.  This becomes a bigger problem when the logon is followed by a header("Location: ...") redirect, because the session_start() at the top of the page will fail.</pre>
So now , I have to avoid to use the refer_check.