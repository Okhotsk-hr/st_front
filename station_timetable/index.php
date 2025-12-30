<?php

$url = 'http://localhost:8080/timetable?stop_name=' . $_GET['station'];

$response = file_get_contents($url);
$data = json_decode($response, true);
if ($response === false) {
    die('API取得失敗');
}


// echo $response;
// echo count($data);
// echo "<br>";

$lines = [];
$days = ["平日", "土休日"];

for ($i = 0; $i < count($data); $i += 2) {
    //echo $data[$i][0][0] . "<br>";
    $lines[count($lines)] = $data[$i][0][0];
}

echo $_GET['station'] . "駅<br>";
if (isset($_POST['line'])) {
    echo "路線/方向：" . $lines[intval($_POST['line'])] . "<br>";
}
if (isset($_POST['day'])) {
    echo "曜日：" . $days[intval($_POST['day'])];
}

$form = "
    <form method='POST' action='index.php?station=" . $_GET['station'] . "'>
        <select name='line'>";

for ($i = 0; $i < count($lines); $i++) {
    $form .= "<option value=" . $i . ">" . $lines[$i] . "</option>";
}
$form .= "
        </select>
        <select name='day'>
            <option value=0>平日</option>
            <option value=1>土休日</option>
        <input type='submit' value='送信' />
    </form>
";
$table = "";
if (isset($_POST['line']) && isset($_POST['day'])) {
    $hour = 0;
    $table = '
    <table border="1">
        <tr><td>時</td><td>分';

    for ($i = 0; $i < count($data[$_POST['line'] * 2 + $_POST['day']][1]); $i++) {
        $nums =  explode(":", $data[$_POST['line'] * 2 + $_POST['day']][1][$i]);
        if ($hour != $nums[0]) {
            $hour = $nums[0];
            $table .= '</td></tr><tr><th>' . $hour . '</th><td>';
        }
        $table .= $nums[1] . " ";
    }

    $table .= '</td></tr>
    </table>
';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>各駅時刻表</title>
</head>

<body>
    <?= $form ?>
    <?= $table ?>

</body>

</html>