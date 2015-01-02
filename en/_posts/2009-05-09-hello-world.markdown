---
layout: post
title: "JQuery validate password function can not work on Firefox3.1.10"
---

When I use JQuery(Revision: 6246) with firefox 3.0.10, I found it is difficulty to validate the password field.
//js code
"data[User][password]": {
required: true,
minlength: 6,
maxlength: 15
},
"data[User][confirmPassword]": {
required: true,
minlength: 6,
maxlength: 15,
equalTo: "#UserPassword"
},
//code end
The error happened at line 1040 of jquery.validate.js
//code
equalTo: function(value, element, param) {
return value == $(param).val();
}
//end
The '$(param).val()' here is always empty. I test this on Chrome, it works fine there.