---
layout: post
title: "Redirect a page with meta tag"
---

<p class='meta'>2009-07-26 09:34:14</p>

I have never imaged it can be so simple to redirect a page.

<strong>&lt;meta http-equiv="refresh" content="600"&gt;</strong>

&lt;meta&gt; - This is the HTML tag. It belongs in the <head> of your HTML document. You can learn more about the meta tag in my tag library.

http-equiv="refresh" - This attribute tells the browser that this meta tag is sending an HTTP command rather than a standard meta tag. Refresh is an actual HTTP header used by the Web server. It tells the server that the page is going to be reloaded or sent somewhere else.

content="600" - This is the amount of time, in seconds, until the browser should reload the current page.

<strong>
&lt;meta http-equiv="refresh" content="2;url=http://freetofeel.com"&gt;
</strong>
content="2;url=http://freetofeel.com/" - The number is the time, in seconds, until the page should be redirected. Then, separated by a semi-colon (;) is the URL that should be loaded.

<em>Meta refresh tags have some drawbacks:</em>
    * If the redirect happens quickly (less than 2-3 seconds), readers with older browsers can't hit the "Back" button. This is a usability problem.
    * If the redirect happens quickly and goes to a non-existant page, your readers won't be able to hit the "Back" button. This is a usability problem that will cause people to completely leave your site.
    * Refreshing the current page can confuse people. If they didn't request the reload, some people can get concerned about security.