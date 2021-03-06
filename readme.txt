=== My Github ===
Plugin Name: My Github
Version: 1.2.2
Author: Ratul Hasan
Contributors: ratulhasan, rajankarmakar
Tags: github, profile, portfolio, developer, development, embed, oembed
Requires at least: 5.2
Tested up to: 5.7.1
Requires PHP: 5.6
Stable tag: trunk
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-3.0.en.html

A simple and nice WordPress plugin that can track your github's profile.

== Description ==
A simple and nice WordPress plugin that can track your GitHub's profile. You can showcase your Followers, Following, Company, Location, Blog URL, Twitter Account, Public Repositories, Public Repository's Used Language.
If the installation is okay, go  and create a page and/or post or update a page and/or post and insert a Shortcode 👉 [my_github] to show your profile.
You can also find Quick Tags in your editor. You can also setup your settings from My GitHub under Settings page. That's it.
**Currently supports:**
- Editor ShortCode support
- GitHub Widget Profile View
- User profiles
- Repositories
- Used Main Language
- Repository Star Count
- Repository Watcher Count
- Repository Fork Count
- Repository License
- Repository's Last Pushed Time
- Add custom template option.

Developers can also add their custom header name by using the hook `git_name_header`  like this

    ``
    add_filter('git_name_header', function($url){
        return "My Github Showcase";
    });
    ``

Developers can also add their custom template by using the hook `my_github_custom_template`  like this

    ``
    add_filter('my_github_custom_template', function($url){
        return /template_path/file.php";
    });
    ``
The plugin provides very basic styling. If anyone has any ideas for a better styling - pull requests are welcome!
The development repo is [GitHub Repo](https://github.com/RatulHasan/my-github).

== Installation ==
Installation is fairly straight forward. Install it from the WordPress plugin repository.

= Bugs, technical hints or contribute =
Please give us feedback, contribute and file technical bugs on [GitHub Repo](https://github.com/RatulHasan/my-github).

== Frequently Asked Questions ==
= Can I change the layout? =
Yes! we added custom template, but it's style is very basic - [Contribute](https://github.com/RatulHasan/my-github)!

== Screenshots ==
1. GitHub Profile
2. GitHub Widget Setup
3. GitHub Widget Profile View

== Changelog ==
= 1.2.2 =
* Add custom template option.
= 1.2.1 =
* Add Classic Editor ShortCode support.
= 1.2.0 =
* Add GitHub Widget Profile View.

= 1.1.0 =
* Add Personal Access Token to authenticate a user [Token](https://github.com/settings/tokens).

= 1.0.0 =
* Initial Release
