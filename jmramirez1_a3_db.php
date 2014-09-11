<?php

     /*
        Name: Jose Ramirez
        Purpose: This file contains the code regarding the access to the data base, selects, insert, and update functions.
        Curse: INT322_A
    */
    
    
    
    
    
    require "PasswordHash.php";
    
    function insert_use($username,$pass){ // Function used to insert users in Database
        include "database.config.php";
        $dbh = new PDO("mysql:host=" . $database_config_host . ";dbname=" . $database_config_database,$database_config_username,$database_config_password);
        include "database.config.php";
        $new_pass= create_hash($pass);
    
        $stmt = $dbh->prepare("INSERT INTO user(username, password) VALUES (?, ?)");
        try {
            $stmt->execute(array($username, $new_pass));
        }
        catch (PDOException $pdoe) {
            $showForm = true;
            $errors["general"] = "Database error";
        }
    }
    
    function login($username,$pass){ //Function used to login 
        include "database.config.php";
        $dbh = new PDO("mysql:host=" . $database_config_host . ";dbname=" . $database_config_database,$database_config_username,$database_config_password);
        $valid= false;
        $stmt= $dbh->prepare("SELECT * FROM user WHERE  username = ?");
        $stmt->execute(array($username));
        
        try{
            $rows=$stmt->fetch();
            if(count($rows) AND validate_password($pass,$rows["password"])){
                $valid=true;
            }
        }
        catch (PDOException $pdoe){
?>
            <label class="error"><?php print_r($pdoe)?></label><br>
<?php        
        }
        return $valid;
    }
    
    function index(){ //function that shows the post in index.php
        include "database.config.php";
        $dbh = new PDO("mysql:host=" . $database_config_host . ";dbname=" . $database_config_database,$database_config_username,$database_config_password);
        $stmt = $dbh->prepare("SELECT * FROM BlogPost ORDER BY id DESC LIMIT 10");
        $stmt->execute();
        while($row=$stmt->fetch()){
?>
        <li>
            <font color='<?php if($row['color']==3){echo 'yellow';}elseif($row['color']==1){echo 'red';}else{echo 'blue';} ?>'>
                <?php echo substr($row['text'],0,100); ?>
            </font><br><a class="lin" href="jmramirez1_a3_view_post.php?id=<?php echo $row['id']?>">View Post</a>
            <?php if($_SESSION["isLoggedIn"]){
                ?><a class="lin" href="jmramirez1_a3_entry.php?id=<?php echo $row['id']?>">Edit Post</a><?php
                } ?>
        </li>
<?php
        }
        
    }
    
    function get_post($id){ //Function used to find a post in the database given the id
        include "database.config.php";
        $dbh = new PDO("mysql:host=" . $database_config_host . ";dbname=" . $database_config_database,$database_config_username,$database_config_password);
        $valid=false;
       
        $row=array();
        $stmt= $dbh->prepare("SELECT * FROM BlogPost WHERE  id = ?");
        $stmt->execute(array($id));
        
        try{
            $rows=$stmt->fetch(PDO::FETCH_ASSOC);
            if(count($rows)){
                $valid=true;
            }
        }
        catch (PDOException $pdoe){
?>
            <label class="error"><?php print_r($pdoe)?></label><br>
<?php        
        }
        if($valid){
            return $rows;
        }
        
    }
    
    function update_post($id,$title,$entry,$color){ //Function used to update the information of the post
        require "database.config.php";
        $dbh = new PDO("mysql:host=" . $database_config_host . ";dbname=" . $database_config_database,$database_config_username,$database_config_password);
        $stmt = $dbh->prepare("UPDATE BlogPost SET title=?, text=?,color=? WHERE id=?");
        try {
            $stmt->execute(array($title,$entry,$color,$id));
            $url='jmramirez1_a3_view_post.php?id='.$id;
            echo $url;
            header("Location:$url");
        }
        catch (PDOException $pdoe) {
            $showForm = true;
            $errors["general"] = "Database error";
        }
    }
    
    function insert_post($title,$entry,$color){ //Function used to insert a post into the database
        require "database.config.php";
        $dbh = new PDO("mysql:host=" . $database_config_host . ";dbname=" . $database_config_database,$database_config_username,$database_config_password);
        $stmt = $dbh->prepare("INSERT INTO BlogPost(title, text,color) VALUES (?, ?, ?)");
        try {
            $stmt->execute(array($title,$entry,$color));
            $stmt = $dbh->prepare("SELECT * FROM BlogPost ORDER BY id DESC LIMIT 1");
            $stmt->execute();
            $row=$stmt->fetch();
            $url='jmramirez1_a3_view_post.php?id='.$row['id'];
            echo $url;
            header("Location:$url");
        }
        catch (PDOException $pdoe) {
            $showForm = true;
            $errors["general"] = "Database error";
        }
    }
    
    function view_post($id){
        require_once "database.config.php";
        $dbh = new PDO("mysql:host=" . $database_config_host . ";dbname=" . $database_config_database,$database_config_username,$database_config_password);
        $stmt = $dbh->prepare("SELECT * FROM BlogPost WHERE id = ?"); //This is to search the post in the database
        $stmt->execute(array($id));
        $rows= $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($rows)){ //If it is in the database it shows the post
                foreach ($rows as $field){
?>                
                    <table border="1px solid">
                        <tr>
                        <td><label for="t">Title: </label></td><td class="title"><font color='<?php if($field['color']==3){echo 'yellow';}elseif($field['color']==1){echo 'red';}else{echo 'blue';} ?>'><?php echo $field['title'] ?></font></td>
                        </tr>
                        <tr>
                        <td><label for="t">Post: </label></td><td class="title"><font color='<?php if($field['color']==3){echo 'yellow';}elseif($field['color']==1){echo 'red';}else{echo 'blue';} ?>'><?php echo $field['text'] ?></font></td>
                        </tr>
                    </table>
                    <a href='jmramirez1_a3_index.php'>Back to index</a>
<?php
                if($_SESSION) {?>
                <a href="jmramirez1_a3_entry.php?id=<?php echo $field['id']?>">Edit Post</a><?php }
                }
        }
        else{          
?>
        <Label class="error">Sorry, could not find that post.</Label><br>
        <a href='jmramirez1_a3_index.php'>Back to index</a>
<?php
        }
    }
?>