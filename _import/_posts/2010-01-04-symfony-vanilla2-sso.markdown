---
layout: post
title: Symfony + Vanilla2 + SSO
---

h1. {{ page.title }} 

p(meta). 2010-01-04 00:42:45

Vanilla2 is really really cool! Both the interface and functionality are very good.
I give a implementation of integrating the vanilla forum into a symfony project with SSO.
I have given some investigation of the SSO. If you have a lot of applications deployed in different domains, <a href="http://www.jasig.org/cas">CAS</a> is a better choice. But it will take you a lot of time to implement. As I can think, there is a CAS server using 8080 port that you should deploy.
And I found an interesting post <a href="http://www.adaniels.nl/articles/simple-single-sign-on-for-php/">"Simple Single Sign-On for PHP"</a>. I really like this idea. 

<img src="http://www.adaniels.nl/wp-content/uploads/sso-diagram_binck.png" alt="simple SSO" width="300" height="213" />

The main idea is using the <a href="http://learn.clemsonlinux.org/wiki/Symlink">symlinks</a> in Linux system to link one session file in domain aaa.domain.com to another in bb.domain.com. To implementation this idea into your application is simple. But there is not so many security test for this idea. I have given a integration of <a href="http://bbpress.org/">bbpress</a> into my symfony project. But there is a lot of interface should be modified in bbpress, like login, auth_user and so on. And I didn't want to spend so much time on it. So I almost give up.

After I installed the <a href="http://vanillaforums.org/">vanilla 2</a>, I was shocked by its UI. 
<a href="http://www.freetofeel.com/2010/01/symfony-vanilla2-sso/screenshot/" rel="attachment wp-att-346"><img src="http://www.freetofeel.com/wp-content/uploads/2010/01/screenshot-300x213.png" alt="screenshot" title="screenshot" width="300" height="213" class="aligncenter size-medium wp-image-346" /></a>
And there is a <a href="http://vanillaforums.org/page/SingleSignOn">SSO plugin</a> for vanilla 2. The main idea to implement vanilla-SSO is sharing the domain cookie and sharing the current user information in the main site. That the vanilla will try to get the current user information. If there is, the user will sign in the vanilla. But this only limit to these sites have the same domain. For example, your main application was deployed on xx.domain.com and the vanilla should be deployed on yy.domain.com.
