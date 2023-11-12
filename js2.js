	subject_id = '';
	function handleHttpResponse()
	{
		if (http.readyState == 4)
		{if ( subject_id == 'd1')
			{  
				document.getElementById(subject_id).innerHTML = http.responseText;
					subject_id='';			
			}
			else
			{
				document.getElementById(subject_id).innerHTML = http.responseText;
			}
			
		}else
if (http.readyState == 3)
		{
			if (subject_id != '')
			{
				document.getElementById(subject_id).innerHTML = "Loading...";
				
			}
		}
	}
	function getHTTPObject()
	{
		var xmlhttp;
		
		if (!xmlhttp && typeof XMLHttpRequest != 'undefined')
		{
			try
			{
				xmlhttp = new XMLHttpRequest();
			}
			catch (e)
			{
				xmlhttp = false;
			}
		}
		return xmlhttp;
	}
	var http = getHTTPObject(); // We create the HTTP Object



	
	function c1(i)
	{
		subject_id = 'd1';
	

				time1 =  new Date();
		time =  new Date();	   
   timestamp1 = time1.getTime()+time1.getSeconds();
	url ="?i="+i+"&timestamp1="+timestamp1;
		http.open("GET", "blk.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	


function c2(i)
	{
		subject_id = 'd1';
	

				time1 =  new Date();
		time =  new Date();	   
   timestamp1 = time1.getTime()+time1.getSeconds();
 	url ="?i="+i+"&timestamp1="+timestamp1;
		http.open("GET", "blk.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	function c3(i)
	{
		subject_id = 'd1';
	

				time1 =  new Date();
		time =  new Date();	   
   timestamp1 = time1.getTime()+time1.getSeconds();
 	url ="?i="+i+"&timestamp1="+timestamp1;
		http.open("GET", "blk1.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	

   
	
	function edit(cc,fn,fv,div,fnm)
	{
		
	
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fv = document.getElementById('tb').value;
			if(fv=='')
		{
			alert("Please Enter Update Value ???");
			}
			else
				{	

		document.getElementById("edtt").value="0";
		url = "?cc="+cc+"&div="+div+"&fn="+fn+"&fv="+fv+"&fnm="+fnm+"&timestamp="+timestamp;
		http.open("GET", fnm+".php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	
		}
	}
function sedit(cc,fn,fv,div,fnm)
	{

		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		edtt = document.getElementById('edtt').value;
	
		if(edtt==1)
		{
		alert("Please Save the previous Value");
		}
		else
		{
		
		document.getElementById("edtt").value="1";
		url = "?cc="+cc+"&div="+div+"&fn="+fn+"&fv="+fv+"&fnm="+fnm+"&timestamp="+timestamp;
	
	   http.open("GET", fnm+".php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);

		}
	
		
	}
	
	function edit1(cc,fn,fv,div,fnm)
	{
		
	
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fv = document.getElementById('tb').value;
			if(fv=='')
		{
			alert("Please Enter Update Value ???");
			}
			else
				{	

		document.getElementById("edtt").value="0";
		url = "?cc="+cc+"&div="+div+"&fn="+fn+"&fv="+fv+"&fnm="+fnm+"&timestamp="+timestamp;
		http.open("GET", fnm+".php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	
		}
	}
function sedit1(cc,fn,fv,div,fnm)
	{

		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		edtt = document.getElementById('edtt').value;
	
		if(edtt==1)
		{
		alert("Please Save the previous Value");
		}
		else
		{
		
		document.getElementById("edtt").value="1";
		url = "?cc="+cc+"&div="+div+"&fn="+fn+"&fv="+fv+"&fnm="+fnm+"&timestamp="+timestamp;
	
	   http.open("GET", fnm+".php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);

		}
	
		
	}
		


	


	


	
	

	
	
	
	