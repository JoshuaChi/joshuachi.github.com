---
layout: post
title: "How to remove a specific value from a javascript array"
tags: javascript
---

<a href="https://developer.mozilla.org/en/Core_JavaScript_1.5_Reference/Global_Objects/Array/splice">splice</a> - Changes the content of an array, adding new elements while removing old elements.

<blockquote>array.splice(index, howMany, [element1][, ..., elementN]);
array.splice(index, [howMany, [element1][, ..., elementN]]);  // SpiderMonkey extension
</blockquote>

index 
    Index at which to start changing the array. If negative, will begin that many elements from the end.

howMany 
    An integer indicating the number of old array elements to remove. If howMany is 0, no elements are removed. In this case, you should specify at least one new element. If no howMany parameter is specified (second syntax above, which is a SpiderMonkey extension), all elements after index are removed. 

element1, ..., elementN 
    The elements to add to the array. If you don't specify any elements, splice simply removes elements from the array. 

<pre name='code' class='javascript'>
// from this
var arr = ['remove', 'specific', 'value', 'from', 'javascript', 'array']; // 6 items
 
// to this ("specific" value removed)
var arr = ['remove', 'value', 'from', 'javascript', 'array']; //  5 items
 
// use this (removes "specific")
arr.splice(arr.indexOf('specific'), 1);
 
 
// full example
var arr = ['remove', 'specific', 'value', 'from', 'javascript', 'array'];
var value_to_remove = 'specific';
arr.splice(arr.indexOf(value_to_remove), 1);
 
 
// note: to support IE (anger rising as I type), you'll need this (thanks James!):
if (!Array.prototype.indexOf)
{
  Array.prototype.indexOf = function(elt /*, from*/)
  {
    var len = this.length >>> 0;
 
    var from = Number(arguments[1]) || 0;
    from = (from < 0)
         ? Math.ceil(from)
         : Math.floor(from);
    if (from < 0)
      from += len;
 
    for (; from < len; from++)
    {
      if (from in this &&
          this[from] === elt)
        return from;
    }
    return -1;
  };
}
</pre>
