<?php
$url = 'http://localhost:8080/timetable?bin=9300656';

$response = file_get_contents($url);
if ($response === false) {
    die('API取得失敗');
}

// 前後の空白を除去
$response = trim($response);

// JSON配列として補正
if ($response !== '' && $response[0] !== '[') {
    $response = '[' . $response . ']';
}

// JSON → 配列
$data = json_decode($response, true);
if (!is_array($data)) {
    die('JSON解析失敗');
}

// 中身をリスト表示
$list = "";
// echo "<ul>";
foreach ($data as $row) {
    $list .= "<div class='stoplist'>";
    $list .= "<p>番号: " . $row['sequence'] . "<br>";
    $list .= "停留所: " . $row['stop_name'] . "<br>";
    $list .= "到着: " . $row['arrival_time'] . "<br>";
    $list .= "出発: " . $row['departure_time'] . "</p>";
    $list .= "</div>";
}
// echo "</ul>";

// echo $list;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>時刻表</title>
    <style>
        .stoplist {
            background: red;
            width: 200px;
            height: 100px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <?= $list ?>
</body>

</html>