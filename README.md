CodeIgniter Navigation Menu Manager Plugin
-----------------------------------------------------------------------------

Purpose
--------------------------------------------------------------------

The plugin is part of a custom in-house CMS developed with CI 3. It is meant to make the management and inclusion of navigation menus easy.

Approach
----------------------------------------------------------------

The plugin approachs the management of navigation menus naturally: location and language. Menus could be placed in various locations. A website could be multilinqual too. Hence, a menu must have a location and a language. There are five locations for the menus, meaning any single page can have maximum five menu locations:

Top Left
Top Right
Top Navigation Bar (Main Navigation Bar)
Bottom Navigation bar
Bottom end navigation bar

The language is depedent on the languages installed by the application, theoritically speaking. However, it currently does not apply a mechanism to get list of installed languages automatically. Basically, the language you specifiy should match a language directory in application/languages directory of your CI installation.


Installation
-----------------------------------------------------------------

If your application follows the traditional MVC design of CI, then the installation should be very easy. The menu strucuture is expected to be for administrators. Hence, this instructions consider the use of "admin" zone.

SQL:

run menus.sql to install the two tables


Controller:

Put Navmenus.php in application/controller/admin directory
Put Contentsearch.php in application/controller/admin directory (Optional but demonstrates how you can search for contents from the menu designer)

Model:

Put Menus_model in application/models directory
Put Contentsearch_model in application/models directory (Optional. You can see how data is returned when search for contents to auto-include to menu designer)

Views:

Put menus.php in application/views/admin directory

Language:

Put menus_lang.php in application/language/english directory



As far as CI is concerned, that's enough. However, the application needs javascript and jquery plugins as well.

Jquery.nestable

paste the jquery.nestable plugin directory (both js and css file) in your location. Include the css from the head of your views, typically in header.php

Paste navmenu_lang.js (client language file) and navmenu.js files in your assets directory.

Edit application/views/admin/menus.php to include the scripts properly. To make my life easy, I do like this typically:

 <script src="<?php echo currentlanguagefolder();?>navmenu_lang.js"></script>
<script src="<?php echo currentjsfolder();?>navmenu.js"></script>
<script src="<?php echo currentpluginsfolder();?>nestle/jquery.nestable.js"></script>

Add them in the exact order they are in based on your requirements.


Adding Languages
------------------------------------------------------------------------------

To do that, go to application/views/admin/menus.php and find:

<select id="menu_languages" class="form-control">
   <option value="english">English</option>
   <option value="it">Italian</option> 
   <option value="nl">Dutch</option>
</select>

Populate the options either manually or automatically in the way that fits your application.


Security
---------------------------------------------------------------------------------

Since there is only one gate way to the plugin, the Navmenus controller, you can write your security in its constructor checking for login state or rights of the currently logged in user or any othe method you want.


Paths
--------------------------------------------------------------------------------

navmenu.js and application/views/admin/menus.php make ajax calls. For example:

SiteRoot+"admin/navmenus/producemenus",


Where SiteRoot is equal to base_url() and set at the head to make it avaliable to all javascript files and functions. Adjust the paths in both files as necessary. A simple Search-and-Replace will do the trick.



Displaying Menus in Clients
------------------------------------------------------
To display the menus for clients, you need to load my_publicmenus_helper helper file is manually or automatically from autoload.php. Once loaded, you simply call the menus from your public views. For example, to display the main navigation bar:

<nav>
<?php echo topnavbar('','english');?>
</nav>

That is the minimal set up. You have five ready-made functions:

topnavbar: to include the top main navigation bar
topleft: to include the top left menu
topright: to include the top right menu
bottomnavbar: to include the bottom/footer main navigation menu
bottomendnavbar: to include the bottom end main navigation menu

The functions generate the required structure in the form of a <ul> element along with any possible submenus. It is your job to decorate them with CSS properly. The functions take four arguements in the following order:

1.Classname : provide a CSS class for the main/top <ul> element. Optional.

2. Language: the language of the requested menu. It can be manual ('english') or a value from session or cookie. Required.

3. ID: provide an ID for the main/top <ul> element. Optional.

4. Submenus CSS Class: CSS name for submenus of the menu. Optional.


That way, you can decorate the menu using the CSS or ID.



