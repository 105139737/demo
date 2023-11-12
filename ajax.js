
	subject_id = '';
	function handleHttpResponse()
	{
		if (http.readyState == 4)
		{
			if (subject_id != '')
			{
				document.getElementById(subject_id).innerHTML = http.responseText;
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

	function hideEdit()
	{
		document.getElementById('window').style.display = 'none';

		
	}
	
	function light(id,action)
	{
		if(action=="1")
		{
			document.getElementById(id).style.border = "1px solid red";
			document.getElementById(id).style.color = "red";
		}
		else
		{
			document.getElementById(id).style.border = "1px solid #525252";
			document.getElementById(id).style.color = "black";
		}
	}







function adduser(unm,nm,mob,eml,desg,brn,cc,vl,un)
	{
		subject_id = 'list';
		unm=document.getElementById('unm').value
		nm=document.getElementById('nm').value
		mob=document.getElementById('mob').value
		eml=document.getElementById('eml').value
		desg=document.getElementById('desg').value
		brn=document.getElementById('brn').value
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
	

		url = "?unm="+unm+"&nm="+nm+"&mob="+mob+"&eml="+eml+"&brn="+brn+"&desg="+desg+"&cc="+cc+"&vl="+vl+"&un="+un+"&timestamp="+timestamp;
		http.open("GET", "aduser.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);

		
	}

function vcr(un)
	{
		subject_id = 'con';
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?unm="+un+"&timestamp="+timestamp;
		http.open("GET", "vcr.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
                print();
		
	}

function actd(div,pno)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		
		url = "?pno="+pno+"&timestamp="+timestamp;
		http.open("GET", "upd.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}

function showeditst(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		
		url = "?cc="+cc+"&fn="+fn+"&div="+div+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "secst.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}

function editcustst(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fv = document.getElementById('tb').value;
		url = "?cc="+cc+"&div="+div+"&fn="+fn+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "ecustst.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
	
	function sbx(pt)
	{
		subject_id = 'stp';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?pt="+pt+"&timestamp="+timestamp;
		http.open("GET", "sbx.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
	
	function stdntsrc(pt,fv)
	{
		subject_id = 'list';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		pt = document.getElementById('pt').value;
		fv = document.getElementById('fv').value;
		url = "?pt="+pt+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "slst.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
		function pcatlst(fv,cat)
	{
		subject_id = 'sdtl';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		cat = document.getElementById('tp').value;
		fv = document.getElementById('sn').value;
		document.getElementById('tp').value='';
		document.getElementById('sn').value='';
		url = "?cat="+cat+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "pcatlst.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
	function tmppr()
	{
		subject_id = 'wb_Text13';
		document.getElementById('custnm').focus();
		document.getElementById('custnm').select();
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?timestamp="+timestamp;
		http.open("GET", "tmppr.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	pay1();
		h();
	
	}
	
		function tmppr1_()
	{
		subject_id = 'wb_Text13';
		document.getElementById('spnm').focus();
		document.getElementById('spnm').select();
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?timestamp="+timestamp;
		http.open("GET", "tmppr1.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		pay1();
h();

		
	}
	
	
function adtmppr(pid,qty,unt,prc,runt)
	{
		subject_id = 'wb_Text13';
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		pid=document.getElementById('prid').value;
		prnm=document.getElementById('prnm').value;
		qty=document.getElementById('qnty').value;
		prc=document.getElementById('prc').value;
		unt=document.getElementById('unt').value;
		runt=document.getElementById('runt').value;
		betno=document.getElementById('betno').value;
		expdt=document.getElementById('expdt').value;
		lttl=document.getElementById('lttl').value;
		usl=document.getElementById('usl').value;
		document.getElementById('betno').value='';
		document.getElementById('expdt').value='';
		document.getElementById('qnty').value='0';
		document.getElementById('prc').value='0';
		document.getElementById('lttl').value='';
	    document.getElementById('prnm').value='';
		document.getElementById('qnty').focus();
		url = "?pid="+pid+"&qty="+qty+"&unt="+unt+"&prc="+prc+"&runt="+runt+"&betno="+betno+"&expdt="+expdt+"&prnm="+prnm+"&lttl="+lttl+"&usl="+usl+"&timestamp="+timestamp;
		http.open("GET", "adtmppr.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		vat=document.getElementById('vat').value;
		car=document.getElementById('car').value;
		dis=document.getElementById('dis').value;
		$('#pay').load('vat1.php?vat='+vat+'&car='+car+'&dis='+dis).fadeIn('fast');
h();

		
	}
	
	
	
	function adtmppr1_(pid,qty,unt,prc,runt)
	{
		subject_id = 'wb_Text13';
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		pid=document.getElementById('prid').value;
		qty=document.getElementById('qnty').value;
		prc=document.getElementById('prc').value;
		pprc=document.getElementById('pprc').value;
		unt=document.getElementById('unt').value;
		runt=document.getElementById('runt').value;
		betno=document.getElementById('betno').value;
		expdt=document.getElementById('expdt').value;
		prnm=document.getElementById('prnm').value;
		lttl=document.getElementById('lttl').value;
		usl=document.getElementById('usl').value;
		document.getElementById('betno').value='';
		document.getElementById('expdt').value='';
		document.getElementById('qnty').value='0';
		document.getElementById('prc').value='0';
		document.getElementById('lttl').value='';
		document.getElementById('pprc').value='';
		document.getElementById('qnty').focus();
		url = "?pid="+pid+"&qty="+qty+"&unt="+unt+"&prc="+prc+"&runt="+runt+"&betno="+betno+"&expdt="+expdt+"&pprc="+pprc+"&prnm="+prnm+"&lttl="+lttl+"&usl="+usl+"&timestamp="+timestamp;
		http.open("GET", "adtmppr1.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);

		
	}
	
	function deltpr_(un,sl)
	{
	
		subject_id = 'wb_Text13';

		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?sl="+sl+"&tsl="+un+"&timestamp="+timestamp;
		http.open("GET", "deltpr.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	
	}
	
		function deltpr1_(un)
	{
	
		subject_id = 'wb_Text13';
		var sl=document.getElementById('sl').value
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?sl="+sl+"&tsl="+un+"&timestamp="+timestamp;
		http.open("GET", "deltpr1.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);

	}