---
layout: post
title: Cake Tips from my App
---

h1. {{ page.title }} 

p(meta). 2009-07-17 22:12:34

1. If you turn on cache in core.php, everytime when you modify your model , don't forget to clear the files under /tmp/cache/models/.

2. Don't cache the element which has include the pagination logic. Because the sort and pagination will fail to work.

3. If there is anonymous role in your ACL model, don't divide your ACL model like this:
All --
-----Anonymous
-----Member--
---------------Admin
---------------Normal

There is a <a href="http://groups.google.com/group/cake-php/browse_thread/thread/cdc817b4ee5de4d5/824fccaad92bfca6?hl=en&lnk=gst&q=use+Auth+component+in+AppController%3F#">thread</a> explained this.

The following will be fine:
All --
-----Member--
---------------Admin
---------------Normal

If you want 'post/view' page can be visited by anonymous user, just add it into $this->Auth->allowedActions = array(//....);

4.  If you want to use Auth component, you should decide you will use it entirely in your application or use it a little.
For example, If you want to implement your ACL like cake <a href="http://book.cakephp.org/view/641/Simple-Acl-controlled-Application">demo</a>. You should remember, there is no need to write users/login action code. Cake will help you do the left including login and redirect, if you has set the auth property.
<pre name="code" class="php">
    $this->Auth->allowedActions = array(//...);
    $this->Auth->loginAction = array('controller' => 'controller_a', 'action' => 'action_a');
    $this->Auth->loginRedirect = array('controller' => 'controller_b', 'action' => 'action_b');
    $this->Auth->loginError = 'Username and password do not match. Please try again.';
    $this->Auth->fields = array(
     //...
    );
    $this->Auth->allowedControllers = array(//...);

</pre>
And I think Miles <a href="http://www.milesj.me/blog/read/5/using-cakephps-auth-component">post</a> will help you a lot.

5. If you want to send email through Gmail, take a look at this <a href="http://groups.google.com/group/cake-php/browse_thread/thread/8573140b2e72d1aa/839b6f576077ed18?hl=en&lnk=gst&q=Need+Help+of+Email+component+-+fail+to+send+email#839b6f576077ed18">thread</a>. And Marc has wrote an <a href="http://marcgrabanski.com/article/cakephp-email-google-apps-gmail">article</a> to implement this in another way.

6. It is easy to customize all the error pages, copying the files you needed under cake\libs\view\errors into app\views\errors. And then you can customize it to what you want.

7. Optimize your site performance
I don't want to write a lot about this. Because you can find there are a lot of resources[1] about this.



*resource[1]:
1. <a href="http://www.pseudocoder.com/archives/2009/03/17/8-ways-to-speed-up-cakephp-apps/">8 Ways to Speed Up the Performance of CakePHP Apps</a>
2. <a href="http://debuggable.com/posts/how-to-save-half-a-second-on-every-request-of-your-cakephp-app:49a69610-8648-4d65-815d-754c4834cda3">How To Save Half A Second On Every CakePHP Request</a>
3. <a href="http://www.samaxes.com/2008/04/htaccess-gzip-and-cache-your-site-for-faster-loading-and-bandwidth-saving/">Learn more about cakephp with .htaccess</a> and <a href="http://www.askapache.com/htaccess/apache-htaccess.html">another</a> one about .htaccess
4. <a href="http://www.g-loaded.eu/2006/12/04/optimize-and-compress-css-files">CSS Compress</a>