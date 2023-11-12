	in_dtls = '';
	in_type = '';
	in_typee = '';
	numb = 0;
	st=1;
	pid = '';
	j_ttl="";
	function handleHttpResponse()
	{
		if (http.readyState == 4)
		{
			if (in_dtls != '')
			{
			switch (in_dtls){
              	case 'abcd':
                 	var str=http.responseText;
				 	var stra=str.split("!")
				 	var st1=stra.shift()
				 	var st2=stra.shift()
				 	var st3=stra.shift()
				 	var st4=stra.shift()
				 	var st5=stra.shift()
				 	var st6=stra.shift()
				 	var st7=stra.shift()

				 	document.getElementById('nm').value = st1;
				 	document.getElementById('nm2').value = st2;
				 	document.getElementById('nm11').value = st3;
				 	document.getElementById('typ').innerHTML = st4;
				 	document.getElementById('typ2').innerHTML = st5;
				 	document.getElementById('nm6').value = st6;
				 	document.getElementById('cid').value = st7;                        
				break;
	          	case 'abcde':
                 	var str=http.responseText;
				 	var stra=str.split("!")
						for (i=st; i<= numb; i++)
								{
								var st1=stra.shift()
								document.getElementById(i).innerHTML = st1;
								}
				break;
				case 'sfdtls':
					document.getElementById(in_dtls).innerHTML = http.responseText;
				break;
				
				case 'cspdact':
					alert("Deactiveted Successfuly.");
					location.reload();
				break;
				case 'cspact':
					alert("Activeted Successfuly.");
					location.reload();
				break;
				case 'crbl':
					document.getElementById(in_dtls).innerHTML = http.responseText;
				break;
				case 'drbl':
					document.getElementById(in_dtls).innerHTML = http.responseText;
				break;
				case 'dybook':
					document.getElementById(in_dtls).innerHTML = http.responseText;
				break;
				case 'list':
					document.getElementById(in_dtls).innerHTML = http.responseText;
				break;
				case 'inex':
					document.getElementById(in_dtls).innerHTML = http.responseText;
				break;
				case 'balst':
					document.getElementById(in_dtls).innerHTML = http.responseText;
				break;
				case 'abc':
					document.getElementById('ag_nm').value = http.responseText;
					
				break;
				case 'mob':
					document.getElementById('mob1').value = http.responseText;
					
				break;
				case 'aaa':
					document.getElementById('ag_code').value = http.responseText;
				break;
				case 'rgabc':
					document.getElementById('r_id').value = http.responseText;
				break;
				case 'dt_du':
					document.getElementById('f3').value = http.responseText;

				break;
				case 'cupn-add':
					var str=http.responseText;
				 	var stra=str.split("!")
				 	var st1=stra.shift()
				 	var st2=stra.shift()
					
					document.getElementById(in_typee).value = st1;
				 	document.getElementById('c_indx').value = st2;
				break;
				case 'pan9':
					document.getElementById('pan9').value = http.responseText;
					document.getElementById('pan59').value = http.responseText;
				break;
		
				
				default : 
					document.getElementById(in_dtls).innerHTML = http.responseText;
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
    
	
	
				document.getElementById('sfdtl').style.left = "200px";
				document.getElementById('sfdtl').style.top = 5+posy+"px";
				document.getElementById('sfdtl').style.display='block';
		
			}
			
	function cspsrch(sl)
	{	in_dtls = 'cspcon';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&timestamp="+timestamp;
		http.open("GET", "csp_form_srch.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}

	function sfdtlcsp(sl,e)
	{	
		checkS(e);
		in_dtls = 'sfdtl';
		
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&timestamp="+timestamp;
		http.open("GET", "csp_form_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	
	function cspdact(sl)
	{	in_dtls = 'cspdact';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&timestamp="+timestamp;
		http.open("GET", "csp_form_deact.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	function cspact(sl)
	{	in_dtls = 'cspact';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&timestamp="+timestamp;
		http.open("GET", "csp_form_act.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	
function sfdtl(sl,e)
	{	
		checkS(e);
		in_dtls = 'sfdtl';
		
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&timestamp="+timestamp;
		http.open("GET", "acgrp_form_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	function sfdtlproj(sl,e)
	{	
		checkS(e);
		in_dtls = 'sfdtl';
		
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&timestamp="+timestamp;
		http.open("GET", "project_form_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	
	function sfdtl1(sl,e)
	{	
		checkS(e);
		in_dtls = 'sfdtl';
		
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&timestamp="+timestamp;
		http.open("GET", "acldgr_form_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	
	function gtcrvl(sl)
	{	
		
		in_dtls = 'crbl';
		proj = document.getElementById('proj').value;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&pno="+proj+"&timestamp="+timestamp;
		http.open("GET", "jrnl_form_gtcrvl.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	
	function gtcrvlfi_(sl)
	{	
		
		in_dtls = 'crbl';
		proj = document.getElementById('proj').value;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&pno="+proj+"&timestamp="+timestamp;
		http.open("GET", "jrnl_form_gtcrvlfi.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	function gtcrvl1_(sl)
	{	
		
		in_dtls = 'drbl';
		proj = document.getElementById('proj').value;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&pno="+proj+"&timestamp="+timestamp;
		http.open("GET", "jrnl_form_gtdrvl.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	
	function sfdtl2(sl,e)
	{	
		checkS(e);
		in_dtls = 'sfdtl';
		
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&timestamp="+timestamp;
		http.open("GET", "acpayid_form_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	
	function sfdtl3(sl,e)
	{	
		checkS(e);
		in_dtls = 'sfdtl';
		
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&timestamp="+timestamp;
		http.open("GET", "jrnl_form_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	
		function sfdtlsale(sl,e)
	{	
		checkS(e);
		in_dtls = 'sfdtl';
		
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&timestamp="+timestamp;
		http.open("GET", "sale_ser_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	
	function sfdtlpr(sl,e)
	{	
		checkS(e);
		in_dtls = 'sfdtl';
		
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&timestamp="+timestamp;
		http.open("GET", "pur_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	
			function sfdtl3income(sl,e)
	{	
		checkS(e);
		in_dtls = 'sfdtl';
		
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&timestamp="+timestamp;
		http.open("GET", "income_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
				function sfdtlrecv(sl,e)
	{	
		checkS(e);
		in_dtls = 'sfdtl';
		
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&timestamp="+timestamp;
		http.open("GET", "recv_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
				function sfdtlpay(sl,e)
	{	
		checkS(e);
		in_dtls = 'sfdtl';
		
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&timestamp="+timestamp;
		http.open("GET", "pay_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	
			function sfdtlrecvrefund(sl,e)
	{	
		checkS(e);
		in_dtls = 'sfdtl';
		
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&timestamp="+timestamp;
		http.open("GET", "refund_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
				function sfdtl3expn(sl,e)
	{	
		checkS(e);
		in_dtls = 'sfdtl';
		
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&timestamp="+timestamp;
		http.open("GET", "expn_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	
	function sfdtl4(sl,e)
	{	
		checkS(e);
		in_dtls = 'sfdtl';
		
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?sl="+sl+"&timestamp="+timestamp;
		http.open("GET", "projectop_form_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	
	function showbl(cc,dt,dt1,pno,e)
	{	
		checkS(e);
		
		in_dtls = 'sfdtl';
	
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
	
		url = "?cc="+cc+"&dt="+dt+"&dt1="+dt1+"&pno="+pno+"&timestamp="+timestamp;
		http.open("GET", "tbal_form_det1.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	
	function showbl1(cc,dt,dt1,e)
	{	
		checkS(e);
		
		in_dtls = 'sfdtl';
	
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
	
		url = "?cc="+cc+"&dt="+dt+"&dt1="+dt1+"&timestamp="+timestamp;
		http.open("GET", "tbal_form_det2.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	function gtdybook()
	{	
		
		in_dtls = 'dybook';
		dt = document.getElementById('dt').value;
		proj = document.getElementById('proj').value;
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?dt="+dt+"&proj="+proj+"&timestamp="+timestamp;
		http.open("GET", "dybook_form_get.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	}
	
	function ldgdtls()
	{
		in_dtls = 'list';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fdt = document.getElementById('fdt').value;
		tdt = document.getElementById('tdt').value;
		ledg = document.getElementById('ledg').value;
		proj = document.getElementById('proj').value;
		url = "?fdt="+fdt+"&tdt="+tdt+"&ledg="+ledg+"&pno="+proj+"&timestamp="+timestamp;
		http.open("GET", "tbal_form_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
	
	function balstdtls()
	{
		in_dtls = 'balst';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fdt = document.getElementById('fdt').value;
		tdt = document.getElementById('tdt').value;
		proj = document.getElementById('proj').value;
		url = "?fdt="+fdt+"&tdt="+tdt+"&pno="+proj+"&timestamp="+timestamp;
		http.open("GET", "balst_form_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
	
	function mainbalstdtls()
	{
		in_dtls = 'balst';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fdt = document.getElementById('fdt').value;
		tdt = document.getElementById('tdt').value;
		url = "?fdt="+fdt+"&tdt="+tdt+"&timestamp="+timestamp;
		http.open("GET", "balst_form_main_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
	
	function inexdtls()
	{
		in_dtls = 'inex';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fdt = document.getElementById('fdt').value;
		tdt = document.getElementById('tdt').value;
		proj = document.getElementById('proj').value;
		url = "?fdt="+fdt+"&tdt="+tdt+"&pno="+proj+"&timestamp="+timestamp;
		http.open("GET", "inex_form_det.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
	
	function show3(cc,dt,dt1,pno)
	{	
		in_dtls= cc;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		
		url = "?cc="+cc+"&dt="+dt+"&dt1="+dt1+"&pno="+pno+"&timestamp="+timestamp;
		http.open("GET", "inex_form_det_sw1.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
	
	function show4(cc,dt,dt1,pno)
	{	
		in_dtls= cc;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		
		url = "?cc="+cc+"&dt="+dt+"&dt1="+dt1+"&pno="+pno+"&timestamp="+timestamp;
		http.open("GET", "inex_form_det_sw2.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}

function clr()
	{	subject_id = 'sfdtl';
		document.getElementById(subject_id).innerHTML = "";
		document.getElementById(subject_id).display= "None";
	}

function new_req(a,b,c,d,e,f,g,h,i)
{
	    in_dtls = h;
		a=document.getElementById(a).value;
		b=document.getElementById(b).value;
		c=document.getElementById(c).value;
		d=document.getElementById(d).value;
		e=document.getElementById(e).value;
		f=document.getElementById(f).value;
		g=document.getElementById(g).value;
		i=document.getElementById(i).value;

		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?dt="+a+"&ag_code="+b+"&nm="+c+"&r_id="+d+"&fnm="+e+"&dob="+f+"&type="+g+"&pno="+i+"&timestamp="+timestamp;
		http.open("GET", "pan_req.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);		
}
function new_req2(a,b,c,d,e,f,g,h,i)
{
	    in_dtls = h;
		a=document.getElementById(a).value;
		b=document.getElementById(b).value;
		c=document.getElementById(c).value;
		d=document.getElementById(d).value;
		e=document.getElementById(e).value;
		f=document.getElementById(f).value;
		g=document.getElementById(g).value;
		i=document.getElementById(i).value;

		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?dt="+a+"&ag_code="+b+"&nm="+c+"&r_id="+d+"&fnm="+e+"&dob="+f+"&type="+g+"&pno="+i+"&timestamp="+timestamp;
		http.open("GET", "pan_req2.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);		
}

function new_coupon()
{
	    in_dtls = 'd';
		a=document.getElementById('st_cu_no').value;
		b=document.getElementById('end_cu_no').value;
		c=document.getElementById('dt').value;


		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?st_cu_no="+a+"&end_cu_no="+b+"&dt="+c+"&timestamp="+timestamp;
		http.open("GET", "coupon_ntry.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);		
}

function agntmob(a)
{
	    in_dtls = 'mob';
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?a="+a+"&timestamp="+timestamp;
		http.open("GET", "acpayidmob.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);		
}

function gt_id(a,b)
{
	    in_dtls = 'aaa';
		a=document.getElementById(a).value;
		

		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?nm="+a+"&timestamp="+timestamp;
		http.open("GET", "gt_id.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);		
}
function gt_nm(a,b)
{
	    in_dtls = 'abc';
		a=document.getElementById(a).value;
		

		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?id="+a+"&timestamp="+timestamp;
		http.open("GET", "gt_nm.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);		
}
function gt_rg_id(a,b)
{
	    in_dtls = 'rgabc';
		a=document.getElementById(a).value;
		b=document.getElementById(b).value;

		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?id="+a+"&dt="+b+"&timestamp="+timestamp;
		http.open("GET", "gt_rg_id.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);		
}
function gt_pan_id(a,b)
{
	    in_dtls = 'rgabc';
		a=document.getElementById(a).value;
		b=document.getElementById(b).value;

		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?typ="+a+"&dt="+b+"&timestamp="+timestamp;
		http.open("GET", "gt_pan_id.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);		
}
function gt_rg_id_on_ld()
{
	    in_dtls = 'rgabc';


		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?timestamp="+timestamp;
		http.open("GET", "gt_rg_id.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);		
}



function r_list(a,b,c,d,e)
{
        in_dtls = d;
		a=document.getElementById(a).value;
		b=document.getElementById(b).value;
		c=document.getElementById(c).value;
		e=document.getElementById(e).value;
		

		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?dt="+a+"&tp="+b+"&type="+c+"&stts="+e+"&timestamp="+timestamp;
		http.open("GET", "gt_rg_lst.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
}
function a_pndng(a,b,c,d,e,f)
{
        in_dtls = e;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?rid="+a+"&dt="+b+"&tp="+c+"&type="+d+"&timestamp="+timestamp;
		http.open("GET", "a_pndng.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	  //  ass_cu(f,d);
}
function b_pndng(a,b,c,d,e,f)
{
        in_dtls = e;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?rid="+a+"&dt="+b+"&tp="+c+"&type="+d+"&timestamp="+timestamp;
		http.open("GET", "b_pndng.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
	  //  ass_cu(f,d);
}
function ass_cu(a,b)
{
        in_dtls = 'abcde';
		numb = a;

		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?num="+a+"&ty="+b+"&timestamp="+timestamp;
		http.open("GET", "ass_cu.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
}
function cu_final(a,b,c,d)
{
        in_dtls = 'rslt';

		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();

		url = "?dt="+a+"&tp="+b+"&type="+c+"&stts="+d+"&timestamp="+timestamp;
		http.open("GET", "cu_final.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
}
function b_p_list(a,b)
{
        in_dtls = b;

		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		a=document.getElementById(a).value;
		
		url = "?type="+a+"&timestamp="+timestamp;
		http.open("GET", "b_pndng_list.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
}
function a_pndng_lst(a,b)
{
        in_dtls = 'rslt';

		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		b=document.getElementById(b).value;
		a=document.getElementById(a).value;
		
		url = "?type="+b+"&agc="+a+"&timestamp="+timestamp;
		http.open("GET", "a_pndng_list.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
}
function cu_txt(a,b,p,c)
{
        
       	in_dtls = 'rslt';
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
				
		url = "?rid="+b+"&type="+a+"&p="+p+"&ag_cd="+c+"&timestamp="+timestamp;
		http.open("GET", "cu_txt.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
}
function cu_txt1(a,b,p,c)
{
        
       	in_dtls = 'rslt';
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
				
		url = "?rid="+b+"&type="+a+"&p="+p+"&ag_cd="+c+"&timestamp="+timestamp;
		http.open("GET", "cu_txt1.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
}
function src_ass_lst(a,b,p)
{
        
       	in_dtls = p;
		a=document.getElementById(a).value;
		b=document.getElementById(b).value;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
				
		url = "?fld="+a+"&vl="+b+"&timestamp="+timestamp;
		http.open("GET", "src_ass_lst.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
}

function new_rgs(a,b,c,p)
{
        
       	in_dtls = p;
		a=document.getElementById(a).value;
		b=document.getElementById(b).value;
		c=document.getElementById(c).value;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
				
		url = "?nm="+a+"&id="+b+"&dob="+c+"&timestamp="+timestamp;
		http.open("GET", "new_rgs.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
}
function new_pass(a,b,c,p)
{
        
       	in_dtls = p;
		a=document.getElementById(a).value;
		b=document.getElementById(b).value;
		c=document.getElementById(c).value;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
				
		url = "?id="+a+"&pass1="+b+"&pass2="+c+"&timestamp="+timestamp;
		http.open("GET", "new_pass.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
}
function mnu(p)
{
        
       	in_dtls = p;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
				
		url = "?timestamp="+timestamp;
		http.open("GET", "mnu.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
}
function nmoncard(a,b,c,d)
{
        
       	in_dtls = d;
		a=document.getElementById(a).value;
		b=document.getElementById(b).value;
		c=document.getElementById(c).value;
		
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
				
		url = "?lnm="+a+"&fnm="+b+"&mnm="+c+"&timestamp="+timestamp;
		http.open("GET", "nmoncard.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
}
