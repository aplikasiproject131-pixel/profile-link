( function( api ) {

	// Extends our custom "trendy-storefront" section.
	api.sectionConstructor['trendy-storefront'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );