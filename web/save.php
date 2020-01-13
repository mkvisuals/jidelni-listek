<?php

if (isset($_POST['data'])) {
    $rawData = $_POST['data'];
    $data = json_decode($rawData);
    print_r($data);

    $menuFile = fopen(sprintf('output/%s.json', $data->date), "w") or die("Unable to open file!");
    fwrite($menuFile, $rawData);
    fclose($menuFile);
}
