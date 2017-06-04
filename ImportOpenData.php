<?php
include 'sql.php';
if (isset($_REQUEST['url'])) {
    $url       = $_REQUEST['url'];
    $tableName = $_REQUEST['tableName'];
//$url = "http://data.coa.gov.tw/Service/OpenData/ODwsv/ODwsvAttractions.aspx";
//$tableName = "food";
//$url = "http://www.railway.gov.tw/Upload/UserFiles/%E8%BB%8A%E7%AB%99%E5%9F%BA%E6%9C%AC%E8%B3%87%E6%96%992.json";
//$tableName = "rail";
    /*---------Change sql.php $url & $tableName------------------------------------------*/
    $pdo = new pdo($dsn, $user, $passwd, $opt);
    $json = file_get_contents($url);
    if (mb_detect_encoding($json, 'BIG-5', true) == 'BIG-5') {
        $json = mb_convert_encoding($json, "UTF-8",'BIG-5');
    }
    $root = json_decode($json);
    var_dump($root);


    $isCreate = false;
    foreach ($root as $row) {
        // Once
        if ($isCreate == false) {
            // Create SQL
            $sql = "CREATE TABLE $tableName (";
            // Insert SQL
            $sqlTable  = "INSERT INTO $tableName(";
            $sqlValues = "VALUES(";
            foreach ($row as $key => $value) {
                // Create SQL
                $sql .= "`{$key}` varchar(255),";
                // Insert SQL
                $sqlTable  .= "`{$key}`, ";
                $sqlValues .= "?, ";
            }
            // Create
            $sql = substr($sql,0,strlen($sql)-1) . ')';
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $isCreate = true;
            // Insert Prepare Stetement
            $sqlTable  = substr($sqlTable,0,strlen($sqlTable)-2) . ')';
            $sqlValues = substr($sqlValues,0,strlen($sqlValues)-2) . ')';
            $sql = $sqlTable . ' ' . $sqlValues;
            $stmt = $pdo->prepare($sql);
        }
        // Unload Open Data
        $para = Array();
        unset($para);
        $para = Array();
        foreach ($row as $key => $value) {
            $para[] = $value;
        }
        $stmt->execute($para);
    }
}
?>
<form>
<h2>Load data from Open Data URL</h2>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
       URL:<input type="url" name="url" placeholder="Open Data URL with JSON" size="150"><br>
Table Name:<input name="tableName" placeholder="Table Name">
<input type="submit" Value="Load">
</form>

