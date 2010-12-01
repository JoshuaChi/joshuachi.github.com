---
layout: post
title: "Textmate  for Ubuntu"
---

<h1> {{ page.title }} </h1> <p class='meta'>2009-11-10 12:25:33</p>

GEdit + Gmate = Textmate on Ubuntu

Install Gedit and Gedit plugins.
First you need to install the plugin extenstion for gedit
<pre name='code' class='text'>
sudo apt-get install gedit gedit-plugins
</pre>

Gmate is a usefull program (collection set of plugins and theme) transforming Gedit into a Textmate like
<pre name='code' class='text'>
cd ~
git clone git://github.com/lexrupy/gmate.git
cd gmate
sh ./install.sh
</pre>