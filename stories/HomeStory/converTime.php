<?php

//Function definition

function timeAgo($time_ago)
{
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed;
    $minutes    = round($time_elapsed / 60);
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400);
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640);
    $years      = round($time_elapsed / 31207680);
    // Seconds
    if ($seconds <= 60) {
        echo "mới đăng";
    }
    //Minutes
    else if ($minutes <= 60) {
        if ($minutes == 1) {
            echo "1 phút trước";
        } else {
            echo "$minutes phút trước";
        }
    }
    //Hours
    else if ($hours <= 24) {
        if ($hours == 1) {
            echo "1 giờ trước";
        } else {
            echo "$hours giờ trước";
        }
    }
    //Days
    else if ($days <= 7) {
        if ($days == 1) {
            echo "1 ngày trước";
        } else {
            echo "$days ngày trước";
        }
    }
    //Weeks
    else if ($weeks <= 4.3) {
        if ($weeks == 1) {
            echo "1 tuần trước";
        } else {
            echo "$weeks tuần trước";
        }
    }
    //Months
    else if ($months <= 12) {
        if ($months == 1) {
            echo "1 tháng trước";
        } else {
            echo "$months tháng trước";
        }
    }
    //Years
    else {
        if ($years == 1) {
            echo "1 năm trước";
        } else {
            echo "$years năm trước";
        }
    }
}
