---
layout: post
title: "Code Smell"
---

There is a <a href="http://www.cnblogs.com/idior/archive/2006/06/13/424592.html">code smell list</a> that we can then as a reference.


<blockquote>
In computer programming, code smell is any symptom in the source code of a computer program that indicates something may be wrong. It generally indicates that the code should be refactored or the overall design should be reexamined. The term appears to have been coined by Kent Beck on WardsWiki. Usage of the term increased after it was featured in Refactoring. Improving the Design of Existing Code.</blockquote>


Interesting Discussion about '<a href="http://stackoverflow.com/questions/114342/what-are-code-smells-what-is-the-best-way-to-correct-them">What are Code Smells? What is the best way to correct them?</a>'.

A question is flying on my head:
<pre name='code' class='php'>
class Person{
 var $name;
 var $age;
//....
}

function calculateEmployeeAverageAge($employee){
//...
}

calculateEmployeeAverageAge(new Person());
</pre>

If there is a function like 'calculateEmployeeAverageAge', is it a code smell? I have met this before in our own product code. I mean the function must know much about the Person structure. But actually, we didn't want to a function rely on too much outside. I always avoid this way in my application. But the guy said 'Methods with a ridiculous (e.g. 7+) amount of parameters. This usually means that there should be a new class introduced (which, when passed, is called an indirect parameter.)' in this <a href="http://stackoverflow.com/questions/114342/what-are-code-smells-what-is-the-best-way-to-correct-them">discussion</a>.