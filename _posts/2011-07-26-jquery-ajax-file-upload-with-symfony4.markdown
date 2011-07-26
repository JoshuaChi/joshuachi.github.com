---
layout: post
title: "Form Ajax Submit With Jquery Form Plugin"
tags:  jquery file symfony ajax form
---

I can't remember how I make file ajax upload work last time. So a blog might be the best place to record it.

Because <a href='http://en.wikipedia.org/wiki/Xmlhttprequest'>XMLHttpRequest</a> didn't support file upload, and I didn't want to spend much time to hack it. So it might be simple to find a plugin to do it. I compared several plugins supporting file ajax upload. 

At last I choose <a href='http://malsup.com/jquery/form/'>Jquery Form Plugin</a>. Althrough it didn't sound like it supposed to be. Especially there is file field in your form. And the data format that client communicate with server is <a href='http://en.wikipedia.org/wiki/Json'>json</a>

So what does it look like?

JS Client:

<pre>
							var options = {
								beforeSubmit: function(formData, jqForm, options) { 
								  var queryString = $.param(formData);
									alert('About to submit: \n\n' + queryString); 
									
									for (var i=0; i < formData.length; i++) { 
										if (!formData[i].value) { 
										  return false; 
								    } 
									} 
								},
								success: function(data) {
										if(data && typeof data == 'object'){
											//...
										}
								},
                url:       '/action', 
                dataType:  'json',
                clearForm: true
              }; 
              
							$('#form').ajaxSubmit(options);
						  return false; 
</pre>



Symfony Backend:

<pre>

		$json = json_encode($data);
		if(!$request->isXmlHttpRequest()){
		  echo '&lt;textarea&gt;'.$json.'&lt;/textarea&gt;';
		  return sfView::NONE;
		}else{
  		echo $json;
		  return sfView::NONE;
		}
</pre>


You can check <a href='http://malsup.com/jquery/form/#file-upload'>plugin document</a> to know why you need 'echo "&lt;textarea&gt;"'.  :-D
