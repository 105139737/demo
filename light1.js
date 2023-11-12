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



function checkS(e){
// capture the mouse position
				    var posx = 0;
					var posy = 0;
    if (!e) var e = window.event;
    if (e.pageX || e.pageY)
    {
        posx = e.pageX;
        posy = e.pageY;
    }
    
	
	
				document.getElementById('sfdtl').style.left = "140px";
				document.getElementById('sfdtl').style.top = "45px";
				document.getElementById('sfdtl').style.display='block';
		
			}

	
	
function sfdtl(e)
	{	
		checkS(e);
		subject_id = 'sfdtl';
	
	
	document.getElementById('prid').value='';
		var prnm=document.getElementById('prnm').value;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?prnm="+prnm+"&timestamp="+timestamp;
		http.open("GET", "sprcp.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
	
		http.send(null);
	}
	
	
    
    function clr()
	{	subject_id = 'sfdtl';
		document.getElementById(subject_id).innerHTML = "";
		document.getElementById(subject_id).display= "None";
	}
		
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
		
	function e(cc,fn,fv,div,fnm)
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
function s(cc,fn,fv,div,fnm)
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
	
	
	
function e1(cc,fn,fv,div,fnm)
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
function s1(cc,fn,fv,div,fnm)
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
		function shec()
	{
		subject_id = 'show';


		time1 =  new Date();
		time =  new Date();	   
   timestamp1 = time1.getTime()+time1.getSeconds();
 	url ="?i="+i+"&timestamp1="+timestamp1;
		http.open("GET", "blk1.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	
	function sche()
	{
	    
		subject_id = 'show';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		
	var day=document.getElementById('day').value;
 var intm=document.getElementById('intm').value;
  var tin=document.getElementById('in').value;
   var otm=document.getElementById('otm').value;
	var o=document.getElementById('o').value;
   var nop=document.getElementById('nop').value;


	
			url = "?day="+day+"&intm="+intm+"&tin="+tin+"&otm="+otm+"&o="+o+"&nop="+nop+"&timestamp="+timestamp;
			
				document.getElementById("day").value="";
			document.getElementById("intm").value="";
			document.getElementById("in").value="";
			document.getElementById("otm").value="";
			document.getElementById("o").value="";
			document.getElementById("nop").value="";
			
	   http.open("GET", "form1_sech_add_show.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);

		
	}
	function sche1()
	{
	    
		subject_id = 'show';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		
	var day=document.getElementById('day').value;
 var intm=document.getElementById('intm').value;
  var tin=document.getElementById('in').value;
   var otm=document.getElementById('otm').value;
	var o=document.getElementById('o').value;
   var nop=document.getElementById('nop').value;


	
			url = "?day="+day+"&intm="+intm+"&tin="+tin+"&otm="+otm+"&o="+o+"&nop="+nop+"&timestamp="+timestamp;
			
				document.getElementById("day").value="";
			document.getElementById("intm").value="";
			document.getElementById("in").value="";
			document.getElementById("otm").value="";
			document.getElementById("o").value="";
			document.getElementById("nop").value="";
			
	   http.open("GET", "form1_sech_add_show1.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);

		
	}
	
	
	
		function del(sl)
	{
	    if (confirm("Are You Confirm To Delete")) 
{
		
		subject_id = 'show';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		

			url = "?sl="+sl+"&timestamp="+timestamp;
			
				
	   http.open("GET", "form1_sche_del.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);

		}
	}
	
	
	
	