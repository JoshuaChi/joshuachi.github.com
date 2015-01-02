---
layout: post
title: "Restore Lost Commits After Git Hard Reset"
tags:  git
---

Sometimes, you will make mistakes. But when someone told you there still is a hope that if you try xxxxx. What feeling will you have?

The following might be one solution after 'git reset --hard' and realized you made a mistake:

<pre>
  $ git reflog
  $ git merge 7c61179
</pre>

Check the blog post <a href='http://gitready.com/advanced/2009/01/17/restoring-lost-commits.html'>here</a>.