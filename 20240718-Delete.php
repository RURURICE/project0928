<?php
    $data = file_get_contents("php://input", "r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["ID"])){
        if($mydata["ID"] != ""){
            $p_ID = $mydata["ID"];

            $servername = "localhost";
            $username = "owner";
            $password = "123456";
            $dbname = "testdb";

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if(!$conn){
                die("連線錯誤" . mysqli_connect_error());
            }

            $sql = "DELETE FROM product WHERE ID = '$p_ID'";
            if(mysqli_query($conn, $sql)){
                if(mysqli_affected_rows($conn) == 1){
                    echo '{"state" : true, "message" : "刪除成功"}';
                }else{
                    echo '{"state" : false, "message" : "刪除失敗, ID不存在, 請聯絡管理人員"}';
                }          
            }else{
                echo '{"state" : false, "message" : "刪除失敗' . $sql . mysqli_error($conn) .'"}';
            }
            mysqli_close($conn);
        }else{
            echo '{"state" : false, "message" : "欄位不得為空白"}';
        }
    }else{
        echo '{"state" : false, "message" : "欄位命名錯誤"}';
    }


?>