<?php

     /*
        Name: Jose Ramirez
        Purpose: This file contains the code regarding logging i, it destroyes the session and regenetate_id.
        Curse: INT322_A
    */

    include('jmramirez1_a3_header.php');
    include('jmramirez1_a3_top.php');
    error_reporting(E_ERROR|E_PARSE|E_WARNING);
    
    session_start();
    valid_user();


    function show_form(){
        head("LogIn");
?>
    <div class="container">
        <form method="post">
        <fieldset>
            <legend>Sing In</legend>
                <div class="info">
                    <table>
                        <tr>
                            <td><label for="u">User Name: </label><input type="text" name="username" id="username" value='<?php echo $_POST["username"];?>' ></td>
                        </tr>
                        <tr>
                            <td><label for="p">Password:</label><input type="password" name="password" id="password"></td>
                        </tr>
                        <tr>
                           <td><input type="submit" class="submit" name="submit" value="SignIn"></td> 
                        </tr>
<?php
    }
    
    function valid_user(){
        if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['submit'])){
            $username=$_POST["username"];
            $password=$_POST["password"];
            if(login($username,$password)){
                $_SESSION["isLoggedIn"]=true;
                session_regenerate_id();
                header("Location:jmramirez1_a3_index.php");
            }
            else{
                show_form();
                ?>
                        <tr><td class="error"><?php echo "Username or Password invalid"; ?></td></tr>
                        </table>
                    </div>
                </fieldset>
            </form>
        </div>
<?php
            include('jmramirez1_a3_footer.php');
            }
        }
        else{
            show_form();
?>
                    </table>
                </div>
        </fieldset>
        </form>
    </div>
<?php
        include('jmramirez1_a3_footer.php');
        }
    }
    
?>


    
