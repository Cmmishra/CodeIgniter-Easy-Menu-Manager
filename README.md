# CodeIgniter-Easy-Menu-Manager
A library to manage menus of your web application with codeigniter. The library requires one controller, one model, one view and depends on nestle.js for nesting features.

It supports upto 4 levels of submenus per each menu but you can easily increase that by altering the codes in the controller and the model.

This library is done for my private project and hope it helps someone out! Here are the steps to working with the library

1. Insert the tblwebmenus.sql file to your database
2. Put Navmenus.php in controllers directory
3. Put Menus_model in models directory
4. Put nestle.css, navmenu.js and jquery.nestle.js in your assets folder and include the css from header.
5. Put menus.php in your views folder
6. 

The library saves the menu structure to database and saves it to views/public/incl/menu.php. That is done to avoid creating the structure over and over again from database. menu.php will store listed elements. From your header file, for e.g., you can have the following then:

<ul id="menu"><!--id could be anything-->
<?php require('menu.php');?>
</ul>

The javascript files are called from menus.php but you can call them from your header file if you wish.
