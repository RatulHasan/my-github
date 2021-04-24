QTags.addButton( 'my-github-tag-button', 'github', '[my_github]' );

// For TinyMC.
;(function () {
    tinyMCE.PluginManager.add(
        'my_github_shortcode_mc_button',
        function (editor, url) {
			editor.addButton(
                'my_github_shortcode_button',
                {
					image: url + "/git.svg",
					onclick: function () {
						editor.insertContent( "[my_github]" );
					}
                }
			);
		}
    );
})();
