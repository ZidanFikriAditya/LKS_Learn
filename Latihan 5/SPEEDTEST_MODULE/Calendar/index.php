<?php
    date_default_timezone_set('Asia/Jakarta');

    if (isset($_GET['ym'])){
        $ym = $_GET['ym'];
    } else {
        $ym = date('Y-m', time());
    }

    $timestamp = strtotime($ym, '-01');

    $prev = date('Y-m', mktime(0,0,0,date('m', $timestamp) - 1, 1, date('Y', $timestamp)));
    $next = date('Y-m', mktime(0,0,0,date('m', $timestamp) + 1, 1, date('Y', $timestamp)));

    $title = date('Y / m', $timestamp);
    $today = date('Y-m-d', time());
    
    $str = date('w', mktime(0,0,0,date('m', $timestamp), 1, date('Y', $timestamp)));
    $count = date('t', $timestamp);

    $weeks = [];
    $week = '';
    $week = str_repeat('<td></td>', $str);

    for ($day = 1; $day <= $count ; $day++, $str++){
        $date = $day < 10 ? $ym . '-0' . $day : $ym . '-' . $day;

        if ($date === $today){
            $week .= '<td class="today">' . $day;
        } else {
            $week .= '<td>' . $day;
        }

        $week .= '</td>';

        if ($str % 7 == 6 || $day == $count){
            if ($day == $count){
                $week .= str_repeat('<td></td>', 6 - ($str % 7));
            }

            $weeks[] = '<tr>' . $week . '</tr>';

            $week = '';
        }
    }

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .today {
            background-color: pink;
        }

        body {
            position: absolute;
            top: 50%;
            left: 50%;
            font-size: 60px;
            transform: translate(-50%, -50% );
        }
    </style>
</head>
<body>
<a href="?ym=<?=$prev?>"><</a>
<span><?=$title ?></span>
<a href="?ym=<?=$next?>">></a>

<table>
    <tr>
        <th>Sun</th>
        <th>Mon</th>
        <th>Thu</th>
        <th>Wed</th>
        <th>Tue</th>
        <th>Fri</th>
        <th>Sat</th>
    </tr>

    <?php
        foreach ($weeks as $week){
            echo $week;
        }
    ?>
</table>
</body>
</html>