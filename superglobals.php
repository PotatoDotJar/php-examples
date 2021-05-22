<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superglobal PHP Variables</title>
    <style>
        html {
            font-family: "Consolas";
            font-size: 10pt;
        }

        table {
            width: 100%;
            table-layout: fixed;
        }

        th, td {
            padding: 5px;
            text-align: left;
        }

        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <table>
        <caption>$_SERVER</caption>
        <tr>
            <th>Key</th>
            <th>Value</th>
        </tr>
        <?php
            foreach ($_SERVER as $key => $value) {
                echo "<tr><td>$key</td><td>$value</td></tr>";
            }
        ?>
    </table>

    <br/>

    <table>
        <caption>$_GET</caption>
        <tr>
            <th>Key</th>
            <th>Value</th>
        </tr>
        <?php
            foreach ($_GET as $key => $value) {
                echo "<tr><td>$key</td><td>$value</td></tr>";
            }
        ?>
    </table>
    <br/>

    <table>
        <caption>$_POST</caption>
        <tr>
            <th>Key</th>
            <th>Value</th>
        </tr>
        <?php
            foreach ($_POST as $key => $value) {
                echo "<tr><td>$key</td><td>$value</td></tr>";
            }
        ?>
    </table>
    <br/>
</body>
</html>