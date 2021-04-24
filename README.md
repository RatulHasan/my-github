# My Github

### Description
A simple and nice WordPress plugin that can track your GitHub's profile. You can showcase your Followers, Following, Company, Location, Blog URL, Twitter Account, Public Repositories, Public Repository's Used Language.
If the installation is okay, go  and create a page and/or post or update a page and/or post and insert a Shortcode 👉 [my_github] to show your profile.
You can also find Quick Tags in your editor. You can also setup your settings from My GitHub under Settings page. That's it.
* Currently supports:
    * Editor ShortCode support
    * GitHub Widget Profile View
    * User profiles
    * Repositories
    * Used Main Language
    * Repository Star Count
    * Repository Watcher Count
    * Repository Fork Count
    * Repository License
    * Repository's Last Pushed Time

Developers can also add their custom header name by using the hook `git_name_header`  like this

    ``
    add_filter('git_name_header', function($url){
        return "My Github Showcase";
    });
    ``
#### Changelog
= 1.2.1 =
* Add Editor ShortCode support.

= 1.2.0 =
* Add GitHub Widget Profile View.

= 1.1.0 =
* Add Personal Access Token to authenticate a user [Token](https://github.com/settings/tokens).

= 1.0.0 =
* Initial Release
