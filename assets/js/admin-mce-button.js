(function() {
	tinymce.PluginManager.add('my_mce_button', function( editor, url ) {
		editor.addButton( 'my_mce_button', {
			text: '',
			icon: 'pc-icon',
			type: 'menubutton',
			menu: [
					{
						text: 'Add carousel',
						onclick: function() {
							editor.windowManager.open( {
							title: 'Insert your carousel shortcode',
							body: [
								{
									type: 'listbox',
									name: 'select_carousel',
									label: 'select carousel',
									values: post_id
								}
							
								
								
									],
									onsubmit: function( e ) {
										editor.insertContent(e.data.select_carousel );
									}
								});
							}
						}

						
			]
		});
	});
})();
