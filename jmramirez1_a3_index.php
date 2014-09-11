<?php
    
    /*
        Name: Jose Ramirez
        Purpose: This file contains the code that shows a list with the last 10 post and also a link to view_post.php.
        Curse: INT322_A
    */
    
    include('jmramirez1_a3_header.php');
    include('jmramirez1_a3_top.php');

    error_reporting(E_ERROR|E_PARSE|E_WARNING);
    menu();

?>

    <div class="container">
        <fieldset>
            <legend>Posts</legend>
                <div class="info">
                    <ul>
<?php
    head("Index");
    index();
?>
             </ul>
                </div>
        </fieldset>
    </div>
<?php
include('jmramirez1_a3_footer.php');
?>
