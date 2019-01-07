	Joomap 2.0 by Daniel Grothe / http://www.ko-ca.com
	Additional code and German Localization: mic / http://www.mgfi.info
	A sitemap component for Joomla! CMS (www.joomla.org)
	Project License: GNU/GPL http://www.gnu.org/copyleft/gpl.html

	Requirements: Joomla! CMS >= v1.0.0, PHP >= v4.2.0

	The Joomla!Forge Project Repository is located at:
	http://developer.joomla.org/sf/sfmain/do/viewProject/projects.joomap

Configuration
-------------
1. Go to the "Joomla Administrator" interface.
2. In the main menu go to "Components".
3. Click the menu item "Joomap".
4. Select the menus to include in the sitemap by clicking on their "Show" icons.
5. Set your needed ordering for the menus (up and down arrows).
6. All other ordering is taken from the menu settings.


Plugins
-------
Plugins enable Joomap to support all kinds of other components' content.
Plugin files need to end with ".plugin.php" and have to be placed in the Joomap
plugin-directory at "/administrator/components/com_joomap/plugins/".
For example the basic Joomla content is handled by this plugin-file:
"/administrator/components/com_joomap/plugins/content.plugin.php"


Languages
---------
Joomap will automatically choose the default Joomla language for the backend
configuration. A language file needs to be named as the general language name
and be placed in "/administrator/components/com_joomap/language/".
The language file "english.php" is always up-to-date with the current version
of Joomap so you should use it as a reference when creating a new language file.


Google sitemaps
---------------
- Go to http://www.google.com/webmasters/sitemaps/login to register for an
account.
- Go to the Joomap Configuration Menu in the Administrator backend to get the
link to the Google Sitemap.
- Add the link to your Google Sitemaps account.

The link to the Joomap generated Google Sitemap looks like this:
http://www.yoursite.com/index2.php?option=com_joomap&view=google&no_html=1


CSS Styles
----------
- Joomap wraps the sitemap inside <div class="sitemap">. The class of that div
can be set in the Admin Configuration, the default classname is "sitemap".

- The sitemap tree has a unique css class for each level, starting with
"level_0" for the root level of each seperate menu. It then goes on with
"level_1", "level_2", ... etc.

- If you set "Number of Columns" to more than 1, inline-styles are used to set
the width of each column. You might have to adapt your template to make it fit.

- Depending on your settings, there will be more css classes to adapt:
.sitemap - main <div> that wraps the whole sitemap
.menutitle - each menu-title is wrapped in <h2 class="menutitle">
.level_0 - the first menu level
.level_1 - the first sublevel
.level_2 - the 2nd sublevel ...
.level_x - sublevel x
.active - any link to the current page


Example CSS
-----------
You can edit this in the configuration backend under the tab "CSS":

.sitemap ul {
	display		: block;
	list-style	: none;
	margin		: 0;
	padding		: 0;
}
.sitemap ul li {
	margin		: 0;
	padding		: 0;
	white-space	: nowrap;
	background	: transparent;
}
.sitemap a img {
	border		: none;
}
.sitemap ul.level_0 ul {
	list-style	: inside square;
	padding		: 0;
}
.sitemap ul.level_1 li {
	padding		: 0 0 0 2em;
	white-space	: nowrap;
}
.sitemap .active {
	font-style	: italic;
}
