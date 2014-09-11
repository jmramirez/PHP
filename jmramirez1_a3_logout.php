<?php

     /*
        Name: Jose Ramirez
        Purpose: This file contains the code regarding logging out, it destroyes the session and regenetate_id.
        Curse: INT322_A
    */

         
    include('jmramirez1_a3_header.php');
    include('jmramirez1_a3_top.php');
    error_reporting(E_ERROR|E_PARSE|E_WARNING);
        
    session_start();
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        session_destroy();
        session_start();
        session_regenerate_id();
        header("Location:jmramirez1_a3_login.php");
    }
    else{
        
    
    head("Log In");
    
    if($_SESSION["isLoggedIn"]){
?>

 <div class="container">
    <form method="post">
        <fieldset>
            <legend>Posts</legend>
                <div class="info">
                    <table>
                        <tr>
                            <td><input type="submit" class="submit" name="submit" value="LogOut"></td>
                        </tr>
                    </table>
                </div>
        </fieldset>
    </form>
 </div>
 
 <?php include('jmramirez1_a3_footer.php');
    }
    else{
        header("Location:jmramirez1_a3_index.php");
    }
    }
 ?>
 

