---
layout: post
title: "Generate a friendly URLS for your site"
---

<p class='meta'>2009-07-21 14:37:52</p>

'We are fighting with SEO everyday ...'
It is true! If you want Google 'know' more about you, it is time to give a friendly URLS to him.
There are two main method that we can make a friendly URLS for our site. And we will take blog as example:
1. The simple way
Append a friendly title after your original URL.
e.g.
Your original post url : <strong>http://xxx.com/blog/1254</strong>
After appending the post title after the original title, it will looks like <strong>http://xxx.com/blog/1254/blog_post_title_about_iron_man</strong>
But there is a disadvantage of this. It would look like blog_post_title_about_iron_man is a sub-item of 1254 for search engines. You can take <a href="http://twitter.com/felixge">Felix</a>'s <a href="http://debuggable.com/posts/dessert-11-welcome-back-friendly-urls:480f4dd5-8dac-414b-b329-4dd5cbdd56cb">post</a> as an example. I think it will be possible to modify the url like what you want, no matter which framework you are using.

2. The final solution
You can take wordpress article as an example. If you take a look at your wordpress database, there is a column named 'url' in posts table. Yes, it is the solution. What you need to do is generating a unique url for every post in your table. It is the same thing we generate an id for every record in our table. You can take the method 'getUniqueUrl' in article <a href="http://bakery.cakephp.org/articles/view/adding-friendly-urls-to-the-cake-blog-tutorial">'Adding friendly URLs to The Cake Blog Tutorial'</a> for example.

I believe it will not take you half an hour to give a friendly URLS for your website. Why not give a try? :-]