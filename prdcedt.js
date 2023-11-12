	subject_id = '';
	amm_div='';
	dt_div='';
	function handleHttpResponse()
	{
		if (http.readyState == 4)
		{
			if (subject_id != '')
			{
				if (amm_div != '')
				{
				var str= http.responsetext;
				var stra = str.split("@")
				var fstr1 = stra.shift()
				var fstr2 = stra.shift()

				document.getElementById(subject_id).innerHTML = fstr1;
				document.getElementById(amm_div).innerHTML = fstr2;
				}
				else
				{
				
				document.getElementById(subject_id).innerHTML = http.responseText;
				
				}
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

function showedit(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		
		url = "?cc="+cc+"&fn="+fn+"&div="+div+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "sec.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}

function editcust(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fv = document.getElementById('tb').value;
		url = "?cc="+cc+"&div="+div+"&fn="+fn+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "ecust.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}



function showeditc(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		
		url = "?cc="+cc+"&fn="+fn+"&div="+div+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "secc.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}

function editcustc(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fv = document.getElementById('tb').value;
		url = "?cc="+cc+"&div="+div+"&fn="+fn+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "ecustc.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}



function showeditass(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		edtvl = document.getElementById('edtbx').value;
		if(edtvl==0){
		document.getElementById('edtbx').value=1;
		url = "?cc="+cc+"&fn="+fn+"&div="+div+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "secass.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
		}
		else
		{
		alert('Please Close the Previous One');
		}
	}

function editcustass(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fv = document.getElementById('tb').value;
		document.getElementById('edtbx').value=0;
		url = "?cc="+cc+"&div="+div+"&fn="+fn+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "ecustass.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}

function rspw(cc)
	{
		subject_id = 'cont';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?cc="+cc+"&timestamp="+timestamp;
		http.open("GET", "rspw.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
function gfld(tnm)
	{
		subject_id = 'fl';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?tnm="+tnm+"&timestamp="+timestamp;
		http.open("GET", "gfld.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
function uph(cc,file)
	{
		subject_id = 'photo';
		time =  new Date();
		file = document.getElementById('file').value;
		timestamp = time.getTime()+time.getSeconds();
		url = "?cc="+cc+"&file="+file+"&timestamp="+timestamp;
		http.open("GET", "photos.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}

function delass(cc)
	{
		subject_id = 'cont';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?cc="+cc+"&timestamp="+timestamp;
		http.open("GET", "dass.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}

function assrc(pt,fv)
	{
		subject_id = 'list';
		dt_div='dt';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		pt = document.getElementById('pt').value;
		if(pt=='jdate'){
		fv = document.getElementById('dt').value;
		}
		else
		{
		fv = document.getElementById('fv').value;
		}
		url = "?pt="+pt+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "aslst.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
function supsrc(pt,fv)
	{
		subject_id = 'list';
		dt_div='dt';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		pt = document.getElementById('pt').value;
		
		fv = document.getElementById('fv').value;
		
		url = "?pt="+pt+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "suplst.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
function prdsrc(pt,fv)
	{
		subject_id = 'list';
		dt_div='dt';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		pt = document.getElementById('pt').value;
		
		fv = document.getElementById('fv').value;
		
		url = "?pt="+pt+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "prdlst.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}	
	function prdsrc1(pt,fv)
	{
		subject_id = 'list';
		dt_div='dt';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		pt = document.getElementById('pt').value;
		
		fv = document.getElementById('fv').value;
		
		url = "?pt="+pt+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "prdlst1.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}	
function rcvsrc(pt,fv,pm)
	{
		subject_id = 'list';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		pt = document.getElementById('pt').value;
		fv = document.getElementById('fv').value;
		url = "?pt="+pt+"&fv="+fv+"&pm="+pm+"&timestamp="+timestamp;
		http.open("GET", "rcv.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
function wrqsrc(pt,fv)
	{
		subject_id = 'list';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		pt = document.getElementById('pt').value;
		fv = document.getElementById('fv').value;
		url = "?pt="+pt+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "wrqlst.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}

function showeditsvc(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		
		url = "?cc="+cc+"&fn="+fn+"&div="+div+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "secsvc.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}

function editcustsvc(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fv = document.getElementById('tb').value;
		url = "?cc="+cc+"&div="+div+"&fn="+fn+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "ecustsvc.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}


function polsrc(cat,pt,fv,oby,ord)
	{
		subject_id = 'list';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		pt = document.getElementById('pt').value;
		fv = document.getElementById('fv').value;
		cat = document.getElementById('cat').value;
		url = "?pt="+pt+"&fv="+fv+"&oby="+oby+"&ord="+ord+"&cat="+cat+"&timestamp="+timestamp;
		http.open("GET", "pollst.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}

function pold(pn)
	{
		subject_id = 'cont';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?pn="+pn+"&timestamp="+timestamp;
		http.open("GET", "poldel.php"+url, true);
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

function advsrc(fv)
	{
		subject_id = 'list';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fv = document.getElementById('fv').value;
		url = "?fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "advlst.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
function spotsrc(fv)
	{
		subject_id = 'list';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fv = document.getElementById('fv').value;
		url = "?fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "spotlst.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}

function colsrc(fdt,tdt)
	{
		subject_id = 'list';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fdt = document.getElementById('fdt').value;
		tdt = document.getElementById('tdt').value;
		url = "?fdt="+fdt+"&tdt="+tdt+"&timestamp="+timestamp;
		http.open("GET", "collst.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
function balsrc(fdt,tdt)
	{
		subject_id = 'list';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fdt = document.getElementById('fdt').value;
		tdt = document.getElementById('tdt').value;
		url = "?fdt="+fdt+"&tdt="+tdt+"&timestamp="+timestamp;
		http.open("GET", "balsht.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
function showeditpol(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		
		url = "?cc="+cc+"&fn="+fn+"&div="+div+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "secpol.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
function editcustpol(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fv = document.getElementById('tb').value;
		url = "?cc="+cc+"&div="+div+"&fn="+fn+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "ecustpol.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
function polrcv(pn,idt,rem,mn,bcd)
	{
		subject_id = 'cont';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		idt = document.getElementById('jQueryDatePicker1').value;
		rem = document.getElementById('rem').value;
		mn = document.getElementById('mnth').value;
		bcd = document.getElementById('bcd').value;
		url = "?pn="+pn+"&idt="+idt+"&rem="+rem+"&mn="+mn+"&bcd="+bcd+"&timestamp="+timestamp;
		http.open("GET", "polrcv.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}

function polwth(pno)
	{
		subject_id = 'cont';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?pno="+pno+"&timestamp="+timestamp;
		http.open("GET", "pwts.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
function paycm(ccd)
	{
		subject_id = 'pd';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?ccd="+ccd+"&timestamp="+timestamp;
		http.open("GET", "paycm.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
function coldtl(fdt,tdt,ehd,pdiv,adiv)
	{
		subject_id = pdiv;
		amm_div = adiv;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fdt = document.getElementById('fdt').value;
		tdt = document.getElementById('tdt').value;
		url = "?fdt="+fdt+"&tdt="+tdt+"&ehd="+ehd+"&timestamp="+timestamp;
		http.open("GET", "coldtl.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
function polawth(pn,idt,cif)
	{
		subject_id = 'cont';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		idt = document.getElementById('jQueryDatePicker1').value;
		cif = document.getElementById('cif').value;
		url = "?pn="+pn+"&idt="+idt+"&cif="+cif+"&timestamp="+timestamp;
		http.open("GET", "awths.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
function showeditexp(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		
		url = "?cc="+cc+"&fn="+fn+"&div="+div+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "secexp.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
function editcustexp(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fv = document.getElementById('tb').value;
		url = "?cc="+cc+"&div="+div+"&fn="+fn+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "ecustexp.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
function showeditacc(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		
		url = "?cc="+cc+"&fn="+fn+"&div="+div+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "secacc.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}

function editcustacc(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fv = document.getElementById('tb').value;
		url = "?cc="+cc+"&div="+div+"&fn="+fn+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "ecustacc.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
	
	function showeditledg(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		edtvl = document.getElementById('edtbx').value;
		if(edtvl==0){
		document.getElementById('edtbx').value=1;
		url = "?cc="+cc+"&fn="+fn+"&div="+div+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "secledg.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		}
		else
		{
		alert('Please Close the Previous One');
		}
		
	}

	function editcustledg(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fv = document.getElementById('tb').value;
		document.getElementById('edtbx').value=0;
		url = "?cc="+cc+"&div="+div+"&fn="+fn+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "ecustledg.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
		function showeditgrp(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		edtvl = document.getElementById('edtbx').value;
		if(edtvl==0){
		document.getElementById('edtbx').value=1;
		url = "?cc="+cc+"&fn="+fn+"&div="+div+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "secgrp.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		}
		else
		{
		alert('Please Close the Previous One');
		}
		
	}

	function editcustgrp(cc,fn,fv,div)
	{
		subject_id = div;
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fv = document.getElementById('tb').value;
		document.getElementById('edtbx').value=0;
		url = "?cc="+cc+"&div="+div+"&fn="+fn+"&fv="+fv+"&timestamp="+timestamp;
		http.open("GET", "ecustgrp.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
	function rcvappfee(cif)
	{
		subject_id = 'rcv';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?cif="+cif+"&timestamp="+timestamp;
		http.open("GET", "rcvapp.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
	
function ldgdtls(fdt,tdt,esl,bcd)
	{
		subject_id = 'list';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		fdt = document.getElementById('fdt').value;
		tdt = document.getElementById('tdt').value;
		ledg = document.getElementById('ledg').value;
		url = "?fdt="+fdt+"&tdt="+tdt+"&esl="+esl+"&ledg="+ledg+"&timestamp="+timestamp;
		http.open("GET", "ldgdtls.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}
function bedt(blno,svl,cvl)
	{
		subject_id = 'cont';
		time =  new Date();
		timestamp = time.getTime()+time.getSeconds();
		url = "?blno="+blno+"&svl="+svl+"&cvl="+cvl+"&timestamp="+timestamp;
		http.open("GET", "editbills.php"+url, true);
		http.onreadystatechange = handleHttpResponse;
		http.send(null);
		
	}	
