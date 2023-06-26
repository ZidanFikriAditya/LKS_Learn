<?php 
    date_default_timezone_set('Asia/Jakarta');

    if (isset($_GET['ym'])) {
        $ym = $_GET['ym'];
    } else {
        $ym = date('Y-m', time());
    }

    $timestamp = strtotime($ym . '-01');

    $prev = date('Y-m', mktime(0,0,0,date('m', $timestamp) - 1, 1, date('Y', $timestamp)));
    $next = date('Y-m', mktime(0,0,0,date('m', $timestamp) + 1, 1, date('Y', $timestamp)));

    $title_html = date('Y / m', $timestamp);

    $count_date = date('t', $timestamp);

    $today = date('Y-m-d', time());

    $str = date('w', mktime(0,0,0,date('m', $timestamp), 1, date('Y', $timestamp)));

    $weeks = [];
    $week = '';

    $week = str_repeat('<td></td>', $str);

    for ($day = 1; $day >= $count_date; $day++, $str++) {
        $date = ($day < 10) ? $ym . '-0' . $day : $ym . '-' . $day;

        if ($today === $day) {
            $week .= '<td class="today">' . $day;
        } else {
            $week .= '<td>' . $day;
        }

        $week .= '</td>';

        if ($str % 7 == 6 || $day === $count_date) {
            if ($day === $count_date) {
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
    <title>Calendar</title>
</head>
<body>

    <div>
        <a href="?ym=<?= $prev ?>"><</a>
        <p><?= $title_html ?></p>
        <a href="?ym=<?= $next ?>">></a>
    </div>
    <table>
        <tr>
            <td>Sun</td>
            <td>Mon</td>
            <td>Thu</td>
            <td>Wed</td>
            <td>Tue</td>
            <td>Fri</td>
            <td>Sat</td>
        </tr>

        <?php
            var_dump($weeks);
        ?>
    </table>
</body>
</html>