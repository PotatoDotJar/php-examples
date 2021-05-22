<?php $TITLE = "PHP MySQL Testing"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $TITLE; ?></title>
    <style>
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
	<h1><?php echo $TITLE; ?></h1>

    <?php
    $servername = "";
    $username = "phptesting";
    $password = "password";
    $database = "PhpTesting";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // If there is a form submission, add it to the database
    $name = $email = $error = $message = "";
    $search = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST["name"]) && !empty($_POST["email"])) {
            $name = sterilize_input($_POST["name"]);
            $email = sterilize_input($_POST["email"]);

            $sql = "INSERT INTO Users (name, email) VALUES ('$name', '$email')";
            if ($conn->query($sql) === TRUE) {
                $last_id = $conn->insert_id;
                $message = "Added new user! ID=" . $last_id;
                
                // Clear name and email on success
                $name = "";
                $email = "";
            } else {
                $error = "Error adding user. " . $conn->error;
            }

        } else {
            $error = "Invalid input.";
        }

    }

    if($_SERVER["REQUEST_METHOD"] == "GET") {
        if(!empty($_GET["search"])) {
            $search = sterilize_input($_GET["search"]);
        }
    }

    function sterilize_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Name: <input type="text" name="name" value="<?php echo "$name"; ?>">
        <br/>
        E-mail: <input type="text" name="email" value="<?php echo "$email"; ?>">
        <br/>
        <span style="color: green;"><?= $message ?></span>
        <span style="color: red;"><?= $error ?></span>
        <br/>
        <input type="submit">
    </form>

    
    <?php
    // Get users from database
    if(!empty($search)) {
        $sql = "SELECT id, name, email FROM Users WHERE name LIKE '" . $search . "%' OR email LIKE '" . $search . "%'";
    } else {
        $sql = "SELECT id, name, email FROM Users";
    }
    
    $result = $conn->query($sql);
    ?>
    <br/>
    <br/>
    <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Search Users: <input type="text" name="search" value="<?php echo "$search"; ?>">
        <input type="submit" value="Search">
    </form>
    <table>
        <caption>Users</caption>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        <?php
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td></tr>";
            }
        ?>
    </table>

</body>
</html>
