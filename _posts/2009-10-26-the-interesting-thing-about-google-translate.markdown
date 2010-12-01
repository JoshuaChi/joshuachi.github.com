---
layout: post
title: "The interesting thing about Google Translate"
---

Have you noticed that when you open the <a href="http://translate.google.com">Google Translate page</a>, and you enter some simple words or a sentence you want to translate.
The translated URL in your address bar looks like 
'http://translate.google.com/translate_t#el|en|%CE%9C%CE%BF%CF%85%20%CE%B1%CF%81%CE%AD%CF%83%CE%B5%CE%B9%20%CE%B1%CF%85%CF%84%CE%AE%20%CE%B7%20%CE%BC%CE%BF%CF%85%CF%83%CE%B9%CE%BA%CE%AE'
Here we take the example, 
Translate sentence 'Μου αρέσει αυτή η μουσική' -> 'I like this music'
Greek -> English
As we seen, the sentence was encoded and appended as a parameter in the URL.
But if you try to translate some longer sentence, like,
'Μου αρέσει αυτή η μουσική.Μου αρέσει αυτή η μουσική.Μου αρέσει αυτή η μουσική.Μου αρέσει αυτή η μουσική.Μου αρέσει αυτή η μουσική.Μου αρέσει αυτή η μουσική.Μου αρέσει αυτή η μουσική.Μου αρέσει αυτή η μουσική.Μου αρέσει αυτή η μουσική.Μου αρέσει αυτή η μουσική.Μου αρέσει αυτή η μουσική.Μου αρέσει αυτή η μουσική.Μου αρέσει αυτή η μουσική.Μου αρέσει αυτή η μουσική.Μου αρέσει αυτή η μουσική.Μου αρέσει αυτή η μουσική.Μου αρέσει αυτή η μουσική.'

Now your address bar will look like 'http://translate.google.com/translate_t#'. 
No matter which case, the translation words will be stored in cache. The next time, the translation words will be searched in cache firstly. 
But why the translation words was added into Get parameter in first case? The only convenient that I can think is that we can copy and past the link from one browser to another. This convenient can not be achieved in the second case for the Get Parameter Length Limit. Is there any other secrets you know?