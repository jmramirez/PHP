<?php
    
    /*
        Name: Jose Ramirez
        Purpose: This file contains the code regarding the form of the apliction, as well as the functions necessary to validate the information given by the user.
        Curse: INT322_A
    */
    
    include('jmramirez1_a3_header.php');
    include('jmramirez1_a3_top.php');
    error_reporting(E_ERROR|E_PARSE|E_WARNING);
    menu();
?>

<div class="container">
        <fieldset>
            <legend>Post</legend>
                <div class="info">
<?php
        head("Index");
        view_post($_GET['id']);       
?>
                </div>
        </fieldset>
    </div>
<?php
include('jmramirez1_a3_footer.php');
?>