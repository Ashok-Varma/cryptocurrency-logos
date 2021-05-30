<?php

set_time_limit(7200);

$i = 0;
// $i = 7700;

$files = scandir('coins/64x64/', SCANDIR_SORT_DESCENDING);
if (sizeof($files) > 2) {
    foreach ($files as $file) {
        if ((int)$file > $i) {
            $i = (int)$file;
        }
    }
    $i = $i - 20;
}

$errors = 0;
while ($i < 11000) {

    // Using the CMC ID build the link for logo
    $file_url = "https://s2.coinmarketcap.com/static/img/coins/64x64/" . $i . ".png";

    // Get file logo, rename it and save
    $image = file_get_contents($file_url);

    // Save logo
    $img_path = "coins/64x64/" . $i . ".png";
    file_put_contents($img_path, $image);

    // Check saved logo size
    $file = 'coins/64x64/' . $i . '.png';
    if (filesize($file) == 0) {
        $image = file('coins/dummy/coin_64x64.png');
        file_put_contents($file, $image);
        $errors++;
    }
    else {
        $errors = 0;
    }

    if ($errors == 20) {
        $i = 100000;
    }
    else {
        $i++;
    }

}


?>