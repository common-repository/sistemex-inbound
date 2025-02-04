(function($) {

	// we create a copy of the WP inline edit post function
	var $wp_inline_edit = inlineEditPost.edit;
	
	// and then we overwrite the function with our own code
	inlineEditPost.edit = function( id ) {
		// "call" the original WP edit function
		// we don't want to leave WordPress hanging
		$wp_inline_edit.apply( this, arguments );
		
		// now we take care of our business
		
		// get the post ID
		var $post_id = 0;
		if ( typeof( id ) == 'object' )
			$post_id = parseInt( this.getId( id ) );
			
		if ( $post_id > 0 ) {
		
			// define the edit row
			var $edit_row = $( '#edit-' + $post_id );
			
			// get the release date
			var $release_date = $( '#featured-checkbox2-' + $post_id ).text();
			
			// set the release date
			$edit_row.find( 'select[name="featured-checkbox2"]' ).val( $release_date );
			
			// save the data
		$.ajax({
			url: ajaxurl, // this is a variable that WordPress has already defined for us
			type: 'GET',
			async: false,
			cache: false,
			data: {
				action: 'get_sistemex_post_meta', // this is the name of our WP AJAX function that we'll set up next
				post_ids: $post_id, // and these are the 2 parameters we're passing to our function
				
			
			},
    success: function( response ) {
        
        console.log(response.data);
        
            var $edit_row2 = $( '#edit-' + $post_id );
			// set the release date
			$edit_row2.find( 'select[name="featured-checkbox"]' ).val( response.data.id );
        
        
    }
		});
			
			
		
			
		}
		
	};
	
	$( '#bulk_edit' ).live( 'click', function() {

	
		// define the bulk edit row
		var $bulk_row = $( '#bulk-edit' );
		
		// get the selected post ids that are being edited
		var $post_ids = new Array();
		$bulk_row.find( '#bulk-titles' ).children().each( function() {
			$post_ids.push( $( this ).attr( 'id' ).replace( /^(ttle)/i, '' ) );
		});
		
		// get the custom fields
	
		var $release_date = $bulk_row.find( 'select[name="featured-checkbox2"]' ).val();
		
		console.log($release_date);
		
		// save the data
		$.ajax({
			url: ajaxurl, // this is a variable that WordPress has already defined for us
			type: 'POST',
			async: false,
			cache: false,
			data: {
				action: 'manage_sistemex_posts_using_bulk_quick_save_bulk_edit2', // this is the name of our WP AJAX function that we'll set up next
				post_ids: $post_ids, // and these are the 2 parameters we're passing to our function
				release_date: $release_date
			
			}
		});
		
	});
	

	
	
	
})(jQuery);
