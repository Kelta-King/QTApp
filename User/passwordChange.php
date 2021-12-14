<?php
    session_start();
    
    require("../Common/url_details.php");
    require("../Common/globals.php");
    require("../Common/kelta_functions.php");

    if(isset($_SESSION['login_admin'])){
        $data = base64_decode($_SESSION['login_admin']);
        $data = explode("#", $data);
        if(count($data) != 2){
            echo "Something went wrong";
            header("Location:../logout"+$url_extension);
        }
        else{
            $admin_id = $data[1];
            $admin_name = $data[0];
            $_SESSION['db_join'] = "yes, join";
            require_once("../DB/dbconnect.php");
            
            $level = 1;
            $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $_SESSION['lvl1'] = array("name"=>"Change Password", "url"=>$link);
            
            // Data of the page
            
            $conn->close();
			unset($_SESSION['db_join']);
            require("Views/passwordChangeView.php");
        }
    }
    else{
        echo "Something went wrong";
        header("Location:../logout"+$url_extension);
    }
?>
