<?php
    $data = file_get_contents("php://input", "r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["username"])){
        if($mydata["username"] != ""){
            $p_username = $mydata["username"];

            require_once("dbtools.php");
            $link = create_connection();

            $sql = "SELECT Username FROM member WHERE Username = '$p_username'";
            $result = execute_sql($link, "testdb", $sql);
            if(mysqli_num_rows($result) == 0){
                //帳號不存在, 可以使用
                echo '{"state" : true, "message" : "帳號不存在, 可以使用"}';
            }else{
                //帳號已存在, 不可以使用
                echo '{"state" : false, "message" : "帳號已存在, 不可以使用"}';
            }
            mysqli_close($link);
        }else{
            echo '{"state" : false, "message" : "欄位不得為空白"}';
        }
    }else{
        echo '{"state" : false, "message" : "欄位命名錯誤"}';
    }
?>