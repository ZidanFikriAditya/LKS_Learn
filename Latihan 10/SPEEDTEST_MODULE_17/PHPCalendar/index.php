<?php
    date_default_timezone_set('Asia/Jakarta');

    if(isset($_GET['ym']))
    {
        $ym = $_GET['ym'];
    } else {
        $ym = date('Y-m', time());
    }

    $timestamp = strtotime($ym, '-01');

    $prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) - 1, 1, date('Y', $timestamp)));
    $next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp) + 1, 1, date('Y', $timestamp)));

    $html_title = date('Y / m', $timestamp);

    $today = date('Y-m-d', time());

    $day_count = date('t', $timestamp);

    $str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));

    $weeks = [];
    $week = '';

    $week = str_repeat('<td></td>', $str);

    for ($day = 1; $day <= $day_count; $day++, $str++){
        $date = $day < 10 ? $ym . '-0' . $day : $ym . '-' . $day;

        if ($date === $today){
            $week .= '<td class="today">' . $day;
        } else {
            $week .= '<td>' . $day;
        }

        $week .= '</td>';
        if ($str % 7 == 6 || $day_count == $day){
            if($day === $day_count){
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
    <title>Calendar</title>
    <style>
        .today {
            background-color: pink;
        }
    </style>
</head>
<body>
<a href="?ym=<?= $prev ?>"><</a>
<a ><?= $html_title ?></a>
<a href="?ym=<?= $next ?>">></a>
    <table>
        <tr>
            <th>SUN</th>
            <th>MON</th>
            <th>TUE</th>
            <th>WED</th>
            <th>THU</th>
            <th>FRI</th>
            <th>SAT</th>
        </tr>

        <?php
            foreach ($weeks as $week){
                echo $week;
            }
        ?>
    </table>
</body>
</html>