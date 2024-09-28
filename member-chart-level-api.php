<?php
// {"state" : true, "data": [{"level" : "900", "level_num": "50"}, {"level" : "100", "level_num": "50"}, {"level" : "200", "level_num": "50"}, {"level" : "300", "level_num": "50"}], "message" : "取得資料成功"}
// {"state" : false, "message" : "取得資料失敗"}
    require_once("dbtools.php");
    $link = create_connection();
    //遞增 ASC 遞減 DESC
    $sql = "SELECT count(Level) as level_num, Level as level FROM member GROUP BY Level";
    $result = execute_sql($link, "testdb", $sql);
    $mydata = array();
    while($row = mysqli_fetch_assoc($result)){
        $mydata[] = $row;
    }
    echo '{"state" : true, "data": ' . json_encode($mydata) . ', "message" : "讀取資料成功!"}';
    mysqli_close($link);
?>