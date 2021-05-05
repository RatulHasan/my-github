/**
 * For Browser tags.
 *
 * @package My GitHub
 */

;(function ($) {
    QTags.addButton( 'my-github-tag-button', 'github', '[my_github]' );
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
})( jQuery );
