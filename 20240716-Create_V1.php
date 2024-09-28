<?php
    //{"name":"雞腿飯", "price":"100", "num":"2", "remark":"好吃"}
    $data = file_get_contents("php://input", "r");
    $mydata = array();
    $mydata = json_decode($data, true);

    if(isset($mydata["name"]) && isset($mydata["price"]) && isset($mydata["num"]) && isset($mydata["remark"])){
        if($mydata["name"] != "" && $mydata["price"] != "" && $mydata["num"] != "" && $mydata["remark"] != ""){
            $p_name   = $mydata["name"];
            $p_price  = $mydata["price"];
            $p_num    = $mydata["num"];
            $p_remark = $mydata["remark"];

            $servername = "localhost";
            $username = "owner";
            $password = "123456";
            $dbname = "testdb";

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if(!$conn){
                die("連線失敗" . mysqli_connect_error());
            }

            $sql = "INSERT INTO product(Name, Price, Num, Remark) VALUES('$p_name', '$p_price', '$p_num', '$p_remark')";
            if(mysqli_query($conn, $sql)){
                echo '{"state" : true, "message" : "新增成功"}';
            }else{
                echo '{"state" : false, "message" : "新增失敗'.$sql.mysqli_error($conn).'"}';
            }
            mysqli_close($conn);
        }else{
            echo '{"state" : false, "message" : "欄位不得為空白"}';
        }
    }else{
        echo '{"state" : false, "message" : "欄位命名錯誤"}';
    }
?>

