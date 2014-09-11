<?php
    
     /*
        Name: Jose Ramirez
        Purpose: This file contains the openning tags, css code, the beginning of the body, and also contains a function that chage the title of the page depending on
        which section on the page is shown.
        Curse: INT322_A
    */    
        
    function head($title="place title here"){
      
?>        
    <!DOCTYPE html>
    <html>
        <head>
            <style>
                body{
                    background-color: #EEEEEE;
                }
                h1{
                    font-family: "Comic Sans MS", arial,helvetica,sans-serif;
                    font-size: 26px;
                    font-weight: bold;
                }

                h2{
                    font-size: 16px;
                    font-weight: lighter;
                }
                
                label{
                    font-size: 16px;
                    font-weight: bold;
                }

                fieldset{
                    border-radius:5px;
                    border: 2px solid;
                    padding: 10px;
                    margin: 5px auto;
                    background-color: #A8A8A8;
                    width: 750px;
                }

                legend{
                    border-radius: 5px;
                    border: 2px solid;
                    background-color: #ffffff;
                    font-family: "Comic Sans MS",arial, helvetica,sans-serif;
                    font-size: 18px;
                }
                
                .container{
                    margin: 10px auto 10px auto;
                    width: 900px;
                    background: #FFF;
                    border: 1px dotted #000;
                   
                }
                
                .banner{
                    width:900px;
                    background: #FFF;
                    border: 1px dotted #000;
                    
                    margin: 5px auto;
                    text-align: center;
                }
                
                .menu{
                    width:900px;
                    background-color: #A8A8A8;
                    border: 1px dotted;
                    border-radius:5px;
                    margin: auto;
                    text-align: "center";
                }
                
                .info{
                    width: 600px;
                    margin: 5px auto;
                }
                
                table{
                    width: 100%;   
                }
                .submit{
                    border: 5px double;
                    background: #FFF;
                }
                
                .error{
                    color: #AA0000;
                    font-weight: bold;
                }
                
                .lin{
                    font-size: 12px;
                }
                ul
                {
                    list-style-type:disc;
                    list-style-position: outside;
                }
                
                td.title{
                    width: 500px;
                    word-break:break-all;
                }
                
            </style>
            <title><?php echo isset($title)?$title:'Assing1';?></title>
        </head>
        <body>
<?php
    }
?>