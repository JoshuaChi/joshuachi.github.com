---
layout: post
title: How to use Security component in your application
---

h1. {{ page.title }} 

p(meta). 2009-05-25 11:51:51

The right way is generate all your filed use form helper.

For example, the following code will prevent your app woking .
<blockquote>
<div>&lt;?php echo $form-&gt;create('User', array('action'=&gt;'signup')); ?&gt;</div>
<div>//....</div>
<div>&lt;/form&gt;</div></blockquote>
<div></div>
<div>But if you modify these codes into following,</div>
<div></div>
<div>
<blockquote>
<div>&lt;?php echo $form-&gt;create('User', array('action'=&gt;'signup')); ?&gt;</div>
<div>//....</div>
<div>&lt;?php echo $form-&gt;end();?&gt;</div></blockquote>
<div>It work again!</div>
</div>