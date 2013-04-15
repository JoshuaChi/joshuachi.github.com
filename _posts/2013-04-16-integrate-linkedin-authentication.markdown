---
layout: post
title: "网站集成linkedin登录"
tags:  linkedin oauth2.0 authentication LeanProfile.com
---

<a href='http://www.linkedin.com'>Linkedin</a>提供了几种方法供你集成登录验证到自己的网站。

一种是<a href='https://developer.linkedin.com/documents/sign-linkedin'>JS plugin</a>的方式。这种方式用起来特别简单，只需要申请您的 app_key 就直接可以使用。
这种方式的缺点就是从linkedin返回的数据没有办法定制，它就只能返回以下五条属性：

<pre>
"Field" - "Parent Node" - "Description"
first-name - person - the member's first name
last-name - person - the member's last name
headline - person - the member's headline (often "Job Title at Company")
site-standard-profile-request/url - person - the URL to the member's authenticated profile on LinkedIn (requires a login to be viewed, unlike public profiles)
</pre>

第二种就是<a href='https://developer.linkedin.com/documents/authentication'>oauth2.0</a>的方式。

通过这种方式，你可以除了可以从linkedin拿你想拿的数据，而且可以随心所欲的嵌入到你的业务逻辑里面。

<p>
</p>
我就是用的第二种。可以通过<a href='http://www.leanprofile.com'>LeanProfile</a>查看。

具体实现可以参考<a href='https://developer.linkedin.com/documents/authentication'>Linkedin 文档</a>。 不过需要说明就是，你需要保留一份用户的token，这个token可以方便你在它的失效期内（60天）向linkedin索要用户的信息。之所以是60天，也是Linkedin从数据安全角度考虑。

当然用户也可以自己选择是否绑定Linkedin。

当然更人性化点，<a href='http://www.leanprofile.com'>我们</a>还提供用户也可以选择绑定和取消绑定Linkedin的功能。


在验证通过后，您就可以使用linkedin提供的其它的功能，比如：分享，等等
