<?php
    date_default_timezone_set('Asia/Jakarta');

    if (isset($_GET['ym'])) {
        $ym = $_GET['ym'];
    } else {
        $ym = date('Y-m', time());
    }


    $timestamp = strtotime($ym, '-01');

    $prev = date('Y-m', mktime(0,0,0,date('m', $timestamp) - 1, 1, date('Y', $timestamp)));
    $next = date('Y-m', mktime(0,0,0,date('m', $timestamp) + 1, 1, date('Y', $timestamp)));

    $html_title = date('Y-m', mktime(0,0,0,date('m', $timestamp), 1, date('Y', $timestamp)));

    $today = date('Y-m-d', time());

    $day_count = date('t', $timestamp);

    $str = date('w', mktime(0,0,0,date('m', $timestamp), 1, date('Y', $timestamp)));

    $weeks = [];
    $week = '';
    $week = str_repeat('<td></td>', $str);

    for ($day=1; $day <= $day_count ; $day++, $str++) { 
        $date = ($day < 10) ? $ym . '-0' . $day : $ym . '-' . $day;

        if ($today === $date) {
            $week .= '<td class="today">' . $day;
        } else {
            $week .= '<td>' . $day;
        }

        if (($str % 7) == 6 || $day == $day_count) {
            if ($day == $day_count) {
                $week .= str_repeat('<td></td>', 6 - ($str % 7));
            }

            $weeks[] = '<tr>' . $week . '</tr>';

            $week = '';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calendar</title>
    <style>
        .today {
            color: green;
        }

        .red {
            background-color: red;
            color: white;
        }

        .flex {
            display: flex;
            gap: 1rem;
        }
    </style>
<body>
    <div class="flex">
        <a href="?ym=<?= $prev ?>"><</a>
        <div><?= $html_title ?></div>
        <a href="?ym=<?= $next ?>">></a>
    </div>
    <table style="text-align: center;">
        <tr>
            <th class="red">Sun</th>
            <th>Mon</th>
            <th>Thu</th>
            <th>Wed</th>
            <th>Tue</th>
            <th>Fri</th>
            <th>Sat</th>
        </tr>
        <?php 
            foreach($weeks as $week){
                echo $week;
            }

        ?>
    </table>
</body>
</html>