

jQuery(document).ready(function(){
	jQuery(".spEntriesListCell").hover(function(){	//toggles on and of vcard description when hovered over
		jQuery(':nth-child(2)', jQuery(this)).toggleClass('hide');
	});
			
	jQuery('.item-121').attr({id: "txtHint"});		//create id to receive js menu

	jQuery.ajax({
		'type': 'post',
	  	'url': SobiProUrl.replace( '%task%', 'definition.sideMenu' ),
		'data': {'sid': SobiProSection,
				'format': 'raw'},
	  	'dataType': 'html',
	  	beforeSend: function( xhr ) {
	    	xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
	  	}
	})
	.done(function(data){
		if ( console && console.log ) {
			jQuery("#txtHint").html(data );			//prints menu on class txtHint
	    }
	})
	
	
	jQuery.ajax({									//gets json object
		'type': 'post',
	  	'url': SobiProUrl.replace( '%task%', 'definition.searchResults' ),
		'data': {'sid': SobiProSection,
				'format': 'raw'},
	  	'dataType': 'html',
	  	beforeSend: function( xhr ) {
	    	xhr.overrideMimeType( "text/plain; charset=x-user-defined" );
	  	}
	})
	.done(function(data){
		if ( console && console.log ) {
			var searchObj = jQuery.parseJSON( data );
			console.log( searchObj);
	    }
	})
	
	
	var spEntriesListRow = jQuery('.spEntriesListRow');
	console.log( spEntriesListRow);
	
	jQuery('#txtHint').click(function(){
		
		// jQuery('.spEntriesListContainer').html('');
		// jQuery('.spEntriesListContainer').html(spEntriesListRow);
		
	})
	
});
