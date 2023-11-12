
	subject_id = '';
	function handleHttpResponse()
	{
		if (http.readyState == 4)
		{

			if (subject_id != '')
			{
			if (subject_id == 'mnm1')
			{
				document.getElementById(subject_id).value = http.responseText;
			}
			else
			{

				document.getElementById(subject_id).innerHTML = http.responseText;
			}
			}

		}
	}
	function getHTTPObject()
	{
		var xmlhttp;
		/*@cc_on
		@if (@_jscript_version >= 5)
			try {
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
				try {
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (E) {
					xmlhttp = false;
				}
			}
		@else
		xmlhttp = false;
		@end @*/
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

	
	
	function getnn(id)
	{
		subject_id = 'sdtl';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		
		url = "?id="+id+"&timestamp="+timestamp;
		http.open("GET", "nname.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}	
	function nmwr(un)
	{
		subject_id = 'mnm1';
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?unm="+un+"&timestamp="+timestamp;
		http.open("GET", "nmwr.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);

		
	}	
	
		function makes(fv,cat)
	{
		subject_id = 'sdtl';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		cat = document.getElementById('tp').value;
		fv = document.getElementById('sn').value;
		url = "?cat="+cat+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "makes.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
	function ledg(fv,cat)
	{
		subject_id = 'sdtl';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		cat = document.getElementById('tp').value;
		fv = document.getElementById('sn').value;
		url = "?cat="+cat+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "ledg.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}