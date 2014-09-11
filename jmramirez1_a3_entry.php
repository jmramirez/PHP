
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
    
    
   if($_SESSION["isLoggedIn"]){ 
   
    if (isset($_POST['submit'])) {
        switch ($_POST['submit']) {
            case 'insert':
                publish();
            break;
            case 'edit':
                entry_post();
            break;
            case 'cancel':
                $_POST=array();
                entry();
            break;
        }
    }
    else{
        entry();
    }
   }
   else{
    header("Location:jmramirez1_a3_index.php");
   }
?>


<?php
      
    function valid_title($title){ //This funtion is to validate the title
        $error_m="";
        
        if(strlen($title)==0){ //To check that the field is not empty
                $error_m .= 'The Title can not be empty, please fill the field';
        }
        
        elseif(preg_match("/^ +$/",$title)){ //To check that there is not only spaces
                $error_m .= 'There is only spaces in the title please complete the information';
        }
        
        elseif(!preg_match("/^[-a-zA-Z 0-9<>]+$/",$title)){ //Characteres allowed
                $error_m .= 'This field only allowes lower and upper case letters, digits, and " " "-" for Title';
        }
        
        else{   //Removing leading and trailing spaces
                $title=preg_replace('/ +/',' ',$title);
                $title=preg_replace('/^ /','',$title);
                $title=preg_replace('/ $/','',$title);
                if(strlen($title)>50){
                    $error_m .= 'The Title can not be longer than 50 characters';
                }
        }
        return $error_m;
    }
    
    function valid_post($post){ //This function is to validate the entry
        $error_m="";
        
        if(strlen($post)==0){ //To check that the field is not empty
                $error_m .= 'The Post can not be empty, please fill the field';
        }
        
        elseif(preg_match("/^ +$/",$post)){ //To check that there is not only spaces
                $error_m .= 'There is only spaces in the post please complete the information';
        }
        
        elseif(!preg_match("/^['a-zA-Z \s0-9<>\-]+$/",$post)){ //Characters allowed
                $error_m .= 'This field only allowes lower and upper case letters, digits, and " " "-" for Entry';
        }
        
        else{    //Remove leading and trailing spaces
                $title=preg_replace('/ +/',' ',$post);
                $title=preg_replace('/^ /','',$post);
                $title=preg_replace('/ $/','',$post);
                if(strlen($post)>500){
                    $error_m .= 'The Post can not be longer than 500 characters';
                }
        }
        return $error_m;
    }
    
    function entry_post(){  //function to show the entry program
        $valid=false;
        
        if(isset($_GET['id'])){
            head("Modify Post");
            $es=get_post($_GET['id']);
            if(isset($es['id'])){
                $valid=true;
            }
        }
        else{
        head("Entry Post");
        }
?>
    <div class="container">
            <form method=post>
                <fieldset>
                    <legend>New Entry</legend>
                        <div class="info">
                            <table>
                                <tr>
                                    <td><label for="t">Title: </label></td><td><input type=text id="t" name="title" size="64px" value='<?php if($valid)echo $es['title']; else{echo "{$_POST['title']}";}?>'></td>
                                </tr>
                                <tr>
                                    <td valign="top" ><label for="e">Entry:</label></td><td><textarea name="entry" id="e" rows="10" cols="55"><?php if($valid)echo $es['text']; else{echo "{$_POST['entry']}";}?></textarea></td>    
                                </tr>
                                <tr>
                                    <td><label><input type="radio" name="c" value="red"<?php if($valid){echo $es['color'] =="1" ? "checked":"";}else{echo $_POST['c'] =="" ? "checked":($_POST['c'] =="red" ? "checked":"");}?>>Red</label></td><td></td>
                                </tr>
                                <tr>
                                    <td><label><input type="radio" name="c" value="blue" <?php if($valid){echo $es['color'] =="2" ? "checked":"";}else{echo $_POST['c'] =="blue" ? "checked":"";}?>>Blue</label></td><td></td>
                                </tr>
                                <tr>
                                    <td><label><input type="radio" name="c" value="yellow" <?php if($valid){echo $es['color'] =="3" ? "checked":"";}else{echo $_POST['c'] =="yellow" ? "checked":"";}?>>Yellow</label></td><td></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right"><input type=submit class="submit" value="Submit Entry"></td>
                                    <input type="hidden" name="id" value='<?php echo $es['id']?>'>
                                </tr>
     <?php
        
    }
    
     function entry(){ //funtion to show the correspondent section after validation, it show the entry if it is a problem or the post if not.  
        if($_POST){
            $valid_title= valid_title($_POST['title']);
            $valid_post= valid_post($_POST['entry']);
            
             if(strlen($valid_title)>0 or strlen($valid_post)>0){
                        entry_post();
                        ?>
                        <tr>
                                <td colspan="2" class="error">
                                        <?php
                        echo $valid_title.'<br>';
                        echo $valid_post;
                        ?>
                            </td>
                        </tr>
                    </table>
                    </div>
                </fieldset>        
                </form>
                </div>
        <?php
        include('jmramirez1_a3_footer.php');
             } else {
                    post();
             }
        }
        else{
                entry_post();
                ?>
                </table>
                    </div>
                </fieldset>        
                </form>
                </div><?php
                   include('jmramirez1_a3_footer.php');
 
        }
     }

    function post(){  //function to show the post after validate the information 
            head("Post Preview");
        ?>
        <div class="container">
            <form method=post>
                <fieldset>
                    <legend>Entry Posted</legend>
                        <div class="info">
                            <table border="1px solid" >
                                <tr>
                                    <td>
                                        <label for="t">Title: </label></td><td class="text"><font color='<?php echo $_POST['c']?>'><?php echo "{$_POST['title']}"?></font>
                                        <input type="hidden" name="title" value='<?php echo "{$_POST['title']}"?>'>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <label for="e">Entry:</label></td><td class=="text"><font color='<?php echo $_POST['c']?>'><?php echo $_POST['entry']?></font>
                                        <input type="hidden" name="entry" value='<?php echo "{$_POST['entry']}"?>'>
                                    </td>    
                                </tr>
                            </table>
                            <input type="hidden" name="c" value='<?php echo $_POST['c']?>'>
                            <input type="hidden" name="id" value='<?php echo $_POST['id']?>'>
                            <input type="submit" class="submit" name="submit" value="insert">
                            <input type="submit" class="submit" name="submit" value="edit">
                            <input type="submit" class="submit" name="submit" value="cancel">    
                        </div>
                </fieldset>
                </form>
        </div>
<?php
    include('jmramirez1_a3_footer.php');
    }
    
    function publish(){ // Function that insert the post in Database   
        if($_POST['c']=="blue"){
            $color=2;
        }
        elseif($_POST['c']=="yellow"){
            $color=3;
        }
        elseif($_POST['c']=="red"){
            $color=1;
        }  
        $update=get_post($_POST['id']);
        if(isset($update['id'])){
            echo 'va a actu';
            update_post($_POST['id'],$_POST['title'],$_POST['entry'],$color);
        }
        else{
            echo 'va a insert';
            echo $_POST['pass'];
            insert_post($_POST['title'],$_POST['entry'],$color);
        }
    }

?>