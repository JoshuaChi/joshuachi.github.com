---
layout: post
title: "isBig5 function"
---

<p class='meta'>2009-08-10 22:05:10</p>

<pre name='code' class='php'>
/**
 * isBig5:Determine whether the sentence contain the entire phrase in Chinese (The mixture of Chinese and English is not the scope of this deal)
 *
 * @param $String target string
 *
 * @return 0:it is a chinese string;1-english string
 */
 function isBig5($String){
  $str=iconv("utf-8","big5",$String);
  if (mb_strlen($str,"Big5") == strlen($str))
    return 0;//non-Chinese
   else
    return 1;//Chinese
 }
</pre>
Reprint from <a href="http://tdy.erufa.com/Blog/?p=32">tdy's blog</a>