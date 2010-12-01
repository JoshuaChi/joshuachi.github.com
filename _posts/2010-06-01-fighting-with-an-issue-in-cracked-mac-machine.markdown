---
layout: post
title: "Fighting with an issue in cracked mac machine"
---

Problem: There is always a black border for every window in a cracked mac, including 'Finder', 'Terminal', even the icon on the desktop.

Solution: Delete 'com.apple.universalaccess.plist' in /Usr/$YOURNAME/Library/Preferences/. And then Logout and login.

It can fixed in my cracked mac machine.
And the main idea was back up your mac preferences
<pre name='code' class='css'>
cp -R /Usr/$YOURNAME/Library/Preferences/ /Usr/$YOURNAME/backup/
</pre>

And then when you login again, the preferences will be recreated again, like a new user.
For you, you just try to copy some plist from /Usr/$YOURNAME/backup/ to /Usr/$YOURNAME/Library/Preferences/. And then you can check which plist file was the fail reason