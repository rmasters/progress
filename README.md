# Goal Tracker

This is a simple little goal tracker written in PHP, using a MySQL database. It
shows you a list of your goals, and your progress towards completing them.

**If you don't know how to install or run a PHP/MySQL web app** I will be
creating (and hosting) a multi-user version - meaning you can sign-up and get
your own page without doing any technical stuff.

## Configuring

### Get the code

Using git, check the code out onto your computer:

    git clone git://github.com/rmasters/progress.git
    
### Set-up the database

Import install.sql into a database (using a mysql prompt):

    create database goals;
    use goals;
    source /path/to/install.sql
    
### Configure

Edit index.php to set your name, database connection settings and location of
/includes if you decide to put it elsewhere.

## Hacker's Guide

* The data can be accessed via json by appending `?json` to the URI, for example
`localhost/goals/?json`.
* The HTML layout is stored in `/includes/layout.phtml`

## Todo

* Add goal page.
* Remove goal/edit goal/update status actions.
* A few more colour schemes.
* Use SQLite instead (can handle the complex queries?)
* Chooseable layouts (based on theme?)
