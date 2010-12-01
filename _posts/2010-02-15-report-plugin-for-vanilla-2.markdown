---
layout: post
title: "Report plugin for Vanilla 2"
---

<h1> {{ page.title }} </h1> <p class='meta'>2010-02-15 16:47:05</p>

You can find it <a href="http://vanillaforums.org/addon/520/report-system">here</a>.

Install
1. Unzip the plugin package and put it into Garden/plugins;
2. Enable it in admin panel;

Configure:
1. Add the following code into file Garden\applications\vanilla\views\discussion\index.php
//Arround line 12 ~14
[CODE]
<?php $this->FireEvent('AfterDiscussionHeaderRender'); ?>
[/CODE]

Then the code likes:
[PIECE]
<?php $this->FireEvent('AfterDiscussionHeaderRender'); ?>
&lt;h2&gt;<?php
   if (Gdn::Config('Vanilla.Categories.Use') === TRUE) {
      echo Anchor($this->Discussion->Category, 'categories/'.$this->Discussion->CategoryID.'/'.Format::Url($this->Discussion->Category));
      echo '<span>&bull;</span>';
   }
   echo Format::Text($this->Discussion->Name);
?>&lt;/h2&gt;
[/PIECE]

2.
Config pagination for admin page:
Add following line into config.php
$Configuration['Vanilla']['Report']['PerPage'] = 10;