---
layout: post
title: "One pixel notched corners"
tags: css
---

An interesting article <a href="http://www.askthecssguy.com/2008/03/one_pixel_notched_corners_as_u.html">One pixel notched corners as used by Google Analytics</a>.

A simple explanation of the 'why':
<a href="http://www.freetofeel.com/2009/10/one-pixel-notched-corners/one_pixel_corner/" rel="attachment wp-att-235"><img src="http://www.freetofeel.com/wp-content/uploads/2009/10/one_pixel_corner.gif" alt="one_pixel_corner" title="one_pixel_corner" width="220" height="186" class="aligncenter size-full wp-image-235" /></a>

<pre name='code' class='html'>
<style type="text/css">
/* default stuff */
.letsGiveItAFixedWidthOf200Pixels { width:200px; }

.feature {
	border:solid red;
 	border-width:0px 4px 2px;
	background:#b0c0e6;
}
.feature div {
  position:relative;
  top: -4px;
  left: 0;
  border:solid blue;
  border-width:4px 0 0;
}
</style>
</head><body>

<div class="examplesGoHere letsGiveItAFixedWidthOf200Pixels">
	<h3>A div</h3>
	<div class="feature">
		<div>
			<div>
				a
			</div>
		</div>
	</div>
</div>
</pre>
