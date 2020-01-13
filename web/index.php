<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Jídelní lístek</title>
</head>
<body>
<header>
    <nav>
        <ul>
            <li>one</li>
            <li>two</li>
            <li>three</li>
        </ul>
    </nav>
</header>
<main>
    <div id="menu">
        <?php

        date_default_timezone_set('utc');
        $today = new DateTime('now');
        $path = sprintf('output/%s.json', $today->format('Y-m-d'));
        $menuFile = fopen($path, "r") or die("Unable to open file!");
        $data = fread($menuFile, filesize($path));
        fclose($menuFile);

        $parsedData = json_decode($data);

        echo '<div class="date">' . $parsedData->date . '</div>';
        echo '<div class="soups">';

        foreach ($parsedData->soups as $soup) {
            echo '<div class="soup">';
            echo '<div>' . $soup->name . '</div>';
            echo '<div>' . $soup->price . '</div>';
            echo '</div>';
        }

        echo '</div>';

        ?>
    </div>
</main>
<footer>
    footer text
</footer>
</body>
</html>
