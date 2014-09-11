<?php
 /*
        Name: Jose Ramirez
        Purpose: This file the Name of the blog and also a menu of options.
        Curse: INT322_A
    */
 
    session_start();
    require 'jmramirez1_a3_db.php'; 
?>

<div class="banner">
    <h1>Web "ON" Technology Blog</h1>
    <h2>Everything About Technology, Commputer Programming, and little more... </h2>
</div>
<?php

function menu(){
?>
<div class="menu">
    <div class="info">
    <table>
<?php if($_SESSION) {?>
        <tr><td><a href="jmramirez1_a3_logout.php">Log Out</a></td><td></tr>
<?php } else{?>
        <tr><td><a href="jmramirez1_a3_login.php">Log In</a></td></tr>
<?php } ?>
    </table>
    </div>
</div>
<?php
}
?>