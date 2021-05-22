<?php $TITLE = "PHP Form Example"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $TITLE; ?></title>

    <style>
        .error {
            color: red;
            font-size: 8pt;
        }
    </style>
</head>
<body>
    <h1><?php echo $TITLE; ?></h1>

    <?php
    $nameErr = $emailErr = $code_editorErr = "";
    $name = $email = $code_editor = "";
    $valid = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = test_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }
      
        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            $email = test_input($_POST["email"]);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }
      
        if (empty($_POST["code_editor"])) {
            $code_editorErr = "Favorite Code Editor is required";
        } else {
            $code_editor = test_input($_POST["code_editor"]);
        }
    }
    ?>


	<?php // Use htmlspecialchars to prevent Cross-site scripting (XSS) attacks. ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Name: <input type="text" name="name" value="<?php echo "$name"; ?>">
        <span class="error"><?php echo $nameErr;?></span>
        <br/>
        E-mail: <input type="text" name="email" value="<?php echo "$email"; ?>">
        <span class="error"><?php echo $emailErr;?></span>
        <br/>
        Favorite Code Editor:
        <input type="radio" name="code_editor" value="vscode" <?php if (isset($code_editor) && $code_editor == "vscode") echo "checked";?>>VS Code
        <input type="radio" name="code_editor" value="atom" <?php if (isset($code_editor) && $code_editor == "atom") echo "checked";?>>Atom
        <input type="radio" name="code_editor" value="notepadpp" <?php if (isset($code_editor) && $code_editor == "notepadpp") echo "checked";?>>Notepad++
        <span class="error"><?php echo $code_editorErr;?></span>
        <br/>
        <input type="submit">
    </form>

    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($nameErr) && empty($emailErr) && empty($code_editorErr)) {
                echo "<p>Form submitted!</p>";
                echo "<p><strong>Your name is</strong> " . $name . "</p>";
                echo "<p><strong>Your email is</strong> " . $email . "</p>";
                echo "<p><strong>Your favorite code editor is</strong> " . $code_editor . "</p>";
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>

</body>
</html>
