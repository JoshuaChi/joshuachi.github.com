---
layout: post
title: "check your current php.ini path"
---

<h1> {{ page.title }} </h1> <p class='meta'>2009-10-31 23:51:11</p>

You might have two different PHP versions installed: one for the command line, and another for the web. So use this function which was provided by symfony that can be easily judge.
<pre name='code' class='php'>
/**
 * Gets the php.ini path used by the current PHP interpretor.
 *
 * @return string the php.ini path
 */
function get_ini_path()
{
  if ($path = get_cfg_var('cfg_file_path'))
  {
    return $path;
  }

  return 'WARNING: not using a php.ini file';
}
</pre>