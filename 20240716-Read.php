<?php
    $servername = "localhost";
    $username = "owner";
    $password = "123456";
    $dbname = "testdb";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if(!$conn){
        die("連線失敗".mysqli_connect_error());
    }

    $sql = "SELECT * FROM product ORDER BY ID DESC";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $mydata = array();
        while($row = mysqli_fetch_assoc($result)){
            $mydata[] = $row;
        }
        echo '{"state" : true, "data": ' . json_encode($mydata) . ' ,"message" : "讀取所有產品成功"}';
    }else{
        echo '{"state" : false, "message" : "讀取失敗和錯誤代碼等"}';
    }
    mysqli_close($conn);
?>