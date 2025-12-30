<?php
$url = 'http://localhost:8080/timetable?stop_name=大通';

$response = file_get_contents($url);
$data = json_decode($response, true);
if ($response === false) {
    die('API取得失敗');
}


// echo $response;
echo count($data);
echo "<br>";

$lines = [];
$days = ["平日", "土休日"];

for ($i = 0; $i < count($data); $i += 2) {
    echo $data[$i][0][0] . "<br>";
    $lines[count($lines)] = $data[$i][0][0];
}

if (isset($_POST['line'])) {
    echo "選択中：" . $lines[intval($_POST['line'])];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form method='POST' action='index.php'>
        <select name='line'>
            <option value=0><?= $lines[0] ?></option>
            <option value=1><?= $lines[1] ?></option>
            <option value=2><?= $lines[2] ?></option>
        </select>
        <input type='submit' value='送信' />
    </form>

</body>

</html>