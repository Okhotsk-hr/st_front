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

$form = "
    <form method='POST' action='index.php'>
        <select name='line'>";

for ($i = 0; $i < count($lines); $i++) {
    $form .= "<option value=" . $i . ">" . $lines[$i] . "</option>";
}
$form .= "
        </select>
        <input type='submit' value='送信' />
    </form>
";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?= $form ?>
</body>

</html>