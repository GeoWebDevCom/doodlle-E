

jQuery(document).ready(function(){
	jQuery(".spEntriesListCell").hover(function(){
		jQuery(':nth-child(2)', jQuery(this)).toggleClass('hide');
	});
	
	// // function to parse string returned by showCustomer ajax request
	// function aFindString(sourceString, pattern){
	// 	var aResult = new Array();
	// 	var dPos = 0, counter = 0;
	// 	var sTemp = new String(sourceString);
	// 	while((dPos = sTemp.search(pattern)) != -1){
	// 		var aCurCat = sTemp.match(pattern)[2];
	// 		counter ++;
	// 		if (aCurCat.search(/Category/)!= -1){
	// 			var indexCat = counter -1;
	// 		}
	// 		if (aCurCat.search(/City/)!= -1){
	// 			var indexCit = counter -1;
	// 		}
	// 		if (aCurCat.search(/State/)!= -1){
	// 			var indexSta = counter -1;
	// 		}
	// 		aResult.push(sTemp.match(pattern)[2]);
	// 		dPos += sTemp.match(pattern).length;
	// 		sTemp = sTemp.substr(dPos);
	// 	}
	// 	var aCategory = aResult.slice(indexCat +2, indexCit);
	// 	var aCity = aResult.slice(indexCit +1, indexSta);
	// 	var aState = aResult.slice(indexSta +1, -1);
	// 	return aState;
	// }
	
	function showCustomer()
	{
		var request = {
		   	'option':'com_sobipro',
		   	'task':'definition.method2',
		   	'sid': SobiProSection,
			'format': 'raw'
		}
		
		jQuery.ajax({
			'type': 'post',
		  	'url': "index.php",
			'data': request,
		  	'dataType': 'html',
		  	beforeSend: function( xhr ) {
		    	xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
		  	}
		})
		.done(function( data ) {
		//	var array = aFindString(data, /(<option)([.]*>)([a-zA-Z0-9]+)(<\/option>)/);
		//	var array = aFindString(data, /(<option.*>)(.*)(<\/option>)/);
			if ( console && console.log ) {
		      	console.log( data );
				jQuery("#txtHint").html(data );
		    }
		});
		// var xmlhttp;
		// if (str=="")
		//   {
		//   document.getElementById("txtHint").innerHTML="";
		//   return;
		//   }
		// if (window.XMLHttpRequest)
		//   {// code for IE7+, Firefox, Chrome, Opera, Safari
		//   xmlhttp=new XMLHttpRequest();
		//   }
		// else
		//   {// code for IE6, IE5
		//   xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		//   }
		// xmlhttp.onreadystatechange=function()
		//   {
		//   if (xmlhttp.readyState==4 && xmlhttp.status==200)
		//     {
		//     document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
		// 	console.log(xmlhttp.responseText);
		//     }
		//   }
		// xmlhttp.open("GET","index.php?option=com_sobipro&task=search&sid=40&Itemid=121&format=raw",true);
		// xmlhttp.send();
		
	}
	
	jQuery('.item-121').attr({id: "txtHint", onchange: "showCustomer()"});
	showCustomer();
	
});
