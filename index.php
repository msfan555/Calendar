<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>線上月曆</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@1,500&family=Roboto+Slab&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0 auto;
            overflow: hidden;
        }

        body {
            width: 100vh;
            height: 100vh;
            /* background-image: linear-gradient(to right, #f5df4d, #939597); */
            font-family: 'Roboto Mono', monospace;
            /* font-family: 'Roboto Slab', serif; */
            background: linear-gradient(-70deg, #939597 40%, #f5df4d 30%);
        }

        .section {
            background-color: rgba(244, 245, 240, .3);
            border-radius: 20px;
            margin-top: 20px;
        }


        .calendar {
            width: 560px;
            height: 560px;
            /* border:1px solid green; */
            display: flex;
            align-content: space-between;
            flex-wrap: wrap;
            margin: auto;
            margin-top: 10px;
            text-align: center;
        }

        .calendar div {
            /* border: 1px solid #999; */
            display: inline-block;
            width: 80px;
            height: 80px;
            box-sizing: border-box;
            /* margin-left: -1px; */
            margin-top: -1px;
            padding: 10px;
        }

        .calendar div:hover {
            font-size: 22px;
        }

        .calendar div.week {
            border-bottom: 1px solid #333;
            font-weight: 800;
            color: #333;
            height: 50px;
            font-size: 16px;
            padding: 15px 10px;
        }

        .weekend {
            font-weight: bold;
            color: #c8102e;
        }

        .workday {
            color: #333;
        }

        .today {
            background: lightseagreen;
        }

        .wrapper {
            width: 600px;
            margin: 2rem auto;
        }

        .nav {
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 60px;
        }

        span>a {
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }

        span>a {
            color: #333;
        }


        .header {
            font-size: 30px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>

<div class="wrapper">

    <?php

    if (isset($_GET['month'])) {
        $month = $_GET['month'];
        $year = $_GET['year'];
    } else {
        $month = date('n');
        $year = date("Y");
    }

    if ($month == 1) {
        $prevMonth = 12;
        $prevYear = $year - 1;
        $nextMonth = $month + 1;
        $nextYear = $year;
    } else if ($month == 12) {
        $prevMonth = $month - 1;
        $prevYear = $year;
        $nextMonth = 1;
        $nextYear = $year + 1;
    } else {
        $prevMonth = $month - 1;
        $prevYear = $year;
        $nextMonth = $month + 1;
        $nextYear = $year;
    }


    ?>
    <?php


    $firstDay = $year . "-" . $month . "-1";
    $firstWeekday = date("w", strtotime($firstDay));
    $monthDays = date("t", strtotime($firstDay));
    $lastDay =  $year . "-"  . $month . "-" . $monthDays;
    $today = date("Y-m-d");
    $lastWeekday = date("w", strtotime($lastDay));
    $dateHouse = [];

    for ($i = 0; $i < $firstWeekday; $i++) {
        $dateHouse[] = "";
    }

    for ($i = 0; $i < $monthDays; $i++) {
        $date = date("Y-m-d", strtotime("+$i days", strtotime($firstDay)));
        $dateHouse[] = $date;
    }

    for ($i = 0; $i < (6 - $lastWeekday); $i++) {
        $dateHouse[] = "";
    }

    ?>
<select name="month" id="">
<option value="1">JAN</option>
<option value="2">FEB</option>
</select>

    <div class="section">
        <div class="nav">
            <span>
                <a href="index.php?year=<?= $prevYear; ?>&month=<?= $prevMonth; ?>"><<</a>
            </span>
            <span class="header"><?= $year; ?> / <?= $month; ?></span>
            <span>
                <a href="index.php?year=<?= $nextYear; ?>&month=<?= $nextMonth; ?>">>></a>
            </span>
        </div>

        <div class="calendar">
            <div class='week'>SUN</div>
            <div class='week'>MON</div>
            <div class='week'>TUE</div>
            <div class='week'>WED</div>
            <div class='week'>THU</div>
            <div class='week'>FRI</div>
            <div class='week'>SAT</div>
            <?php
            foreach ($dateHouse as $k => $day) {
                $hol = ($k % 7 == 0 || $k % 7 == 6) ? 'weekend' : "";

                if (!empty($day)) {
                    $dayFormat = date("j", strtotime($day));
                    echo "<div class='{$hol}'>{$dayFormat}</div>";
                } else {
                    echo "<div class='{$hol}'></div>";
                }
            }

            ?>


        </div>
    </div>
</div>

</body>

</html>