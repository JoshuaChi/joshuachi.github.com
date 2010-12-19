---
layout: post
title: "Dig Into Nodejs"
tags: -nodejs -js
---

Just find a beautiful and simplest javascript code:
<pre>
  // In both HTTP servers and clients it is possible to queue up several
  // outgoing messages. This is easiest to imagine in the case of a client.
  // Take the following situation:
  //
  //    req1 = client.request('GET', '/');
  //    req2 = client.request('POST', '/');
  //
  // The question is what happens when the user does
  //
  //   req2.write("hello world\n");
  //
  // It's possible that the first request has not been completely flushed to
  // the socket yet. Thus the outgoing messages need to be prepared to queue
  // up data internally before sending it on further to the socket's queue.
  //
  // This function, outgoingFlush(), is called by both the Server
  // implementation and the Client implementation to attempt to flush any


  while (message.output.length) {
    if (!socket.writable) return; // XXX Necessary?

    var data = message.output.shift();
    var encoding = message.outputEncodings.shift();

    ret = socket.write(data, encoding);
  }
</pre>

Now I know how nodejs talk with server, which is using <a href='http://socket.io/'>Socket.IO</a> - multi-transport socket server.
