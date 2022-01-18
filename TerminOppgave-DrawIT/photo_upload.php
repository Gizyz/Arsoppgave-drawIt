<?php

$sql="insert into table_name(photo) values(:photo)";

// INSERT with named parameters
$conn = new PDO('mysql:host=localhost;dbname=myDB', "root", "myPassword");
$stmt = $conn->prepare($sql);
$stmt->bindValue(":photo",$_POST["photo"]);
$stmt->execute();
$affected_rows = $stmt->rowCount();
echo $affected_rows;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>