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
echo "<ul>";
foreach ($data as $row) {
    echo "<li>";
    echo "順番: " . $row['sequence'] . " / ";
    echo "停留所: " . $row['stop_name'] . " / ";
    echo "到着: " . $row['arrival_time'] . " / ";
    echo "出発: " . $row['departure_time'];
    echo "</li>";
}
echo "</ul>";
