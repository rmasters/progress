<?php
/**
 * Goals-web
 * Track progress of goals
 */

// Set your name!
$name = "Ross";
// Ignore this, we're just determining the plural form of your name
$name .= substr($name, -1, 1) == "s" ? "'" : "'s";

// Data connection - specify your own database connection values here
$db = new MySQLi(
    "localhost",
    "root",
    "",
    "goals"
);

// Path to /includes - change this if you're storing it somewhere else, above 
// the web root, for example.
define("PATH", realpath(dirname(__FILE__) . "/includes"));

require PATH . "/data.php";
$goals = getGoals($db);

/**
 * Output
 *   If ?json is appended to the URI then we return JSON data
 *   Otherwise we use the layout (@todo: choosable layouts?)
 */
if (isset($_GET["json"])) {
    echo json_encode($goals);
} else {
    require PATH . "/layout.phtml";
}
