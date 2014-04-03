
jQuery(document).ready(function(){



	jQuery(document).on('change', ".btn", (function(){							//makes checkbox buttons active when clicked
				jQuery(this).toggleClass('active');
	}));
	
	jQuery('.moduletable').html('<div id="searchSP"></div>');						//create id to receive js menu
	
	jQuery('#sobiProSearchFormContainer').html('');
	jQuery('#content').attr({class: "span9"});
	
	function xhr_post($task, $async, $dataType){								//ajax request function
		if (typeof($async)==='undefined')	{$async = 'true'};
		if (typeof($dataType)==='undefined'){$async = 'html'};
	
		return jQuery.ajax({
			type: 'post',
			async: false,
		  	url: SobiProUrl.replace( '%task%', $task ),
			data: {'sid': SobiProSection,
					format: 'raw'},
		  	dataType: $dataType,
		  	beforeSend: function( xhr ) {
		    	xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
		  	}
		})
	}
	// console.log(spCatListIcon);
	
	xhr_post('definition.sideMenu').done(function(data){ 						//create side menu on class txtHint
		jQuery("#searchSP").html(data );							
	});
	
	
	var searchResultsObj = 			xhr_post('definition.searchResults', false, 'json');		
	var searchObj = 				jQuery.parseJSON( searchResultsObj.responseText);	//gets json object	
														
	var exSpEntriesListContainer = 	jQuery('.spEntriesListContainer').clone(true);
	var aSpEntriesListCell = 		jQuery('.spEntriesListCell').clone(true);
	var spEntriesListRow = 			jQuery('<div/>', { 'class' : 'spEntriesListRow'});
	
	
	jQuery('#searchSP').on('change',(function(){										// on checkbox click - change searched items
		var valuesCheckbox = jQuery('input:checkbox:checked').map(function(){
			return this.id;
		});	

		spEntriesListRow = jQuery('<div/>', { 'class' : 'spEntriesListRow'});			//clears var val after each click
		
		// console.log(valuesCheckbox)
		if (valuesCheckbox.length > 0){
			var $aCurrentSid = [];
			jQuery.each(valuesCheckbox, function(key, id){
				jQuery.each(searchObj, function(sid, aObjects){
					if (jQuery.inArray(id, aObjects.cid) > -1 || jQuery.inArray(id, aObjects.states) > -1){
						if (jQuery.inArray(sid, $aCurrentSid) === -1){
							$aCurrentSid.push(sid);
							
						}
					}
				})	
				jQuery.each($aCurrentSid, function(index, iSid){
					jQuery.each(aSpEntriesListCell, function(index2, SpEntriesListCell){
						if (jQuery(this).attr('id')=== iSid ){
							spEntriesListRow.append(this);
							// console.log(spEntriesListRow.clone());
							jQuery('.spEntriesListContainer').html('');					//clears existing content
							jQuery('.spEntriesListContainer').append(spEntriesListRow);
						}
					})
				})
				
			})
		} else{
			jQuery('.spEntriesListContainer').replaceWith(exSpEntriesListContainer.clone(true));		//clears existing content
		}		
	}))
	
});
