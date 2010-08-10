Goal Tracker
============
This is a simple little goal tracker written in PHP, using a MySQL database. It
shows you a list of your goals, and your progress towards completing them.

Configuring
-----------
1. Using git, check the code out onto your computer:

    git clone git://github.com/rmasters/progress.git
    
2. Import `install.sql` into a database (using a mysql prompt):

    create database goals;
    use goals;
    source /path/to/install.sql
    
3. Edit `index.php` to set your name, database connection settings and location
   of /includes if you decide to put it elsewhere.

The data can be accessed via json by appending `?json` to the URI, for example
`localhost/goals/?json`.

Todo
----
* Add goal page.
* Remove goal/edit goal/update status actions.
* A few more colour schemes.
* Use SQLite instead (can handle the complex queries?)
