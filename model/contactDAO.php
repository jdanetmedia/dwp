<?php
require_once('../includes/connection.php');

if (isset($_POST["email"])) {
    mailCheck();
}

    function mailCheck()
    {
        $ourEmail = getPageInfo();
        $email_to = $ourEmail["Email"];
        $subject = "Email from online mail form";

        function error($error)
        {
            echo "Error processing your form input<br><br>";
            echo "<b>The errors are:</b><br> ";
            echo $error . "<br>";
            die();
        }

        //Validation of null fields
        if (!isset($_POST["name"]) || !isset($_POST["email"]) || !isset($_POST["message"])) {
            error("No input to validate!");
        }

        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];
        echo $email;
        $error_message = "";

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message .= "The email is not OK!<br>";
        }

        $string_exp = "/^[A-Za-z .'-]+$/";

        if (!preg_match($string_exp, $name)) {
            $error_message .= "Your name is bad!<br>";
        }

        if (strlen($message) <= 0) {
            $error_message .= "Your message is too short!<br>";
        }

        if (strlen($error_message) > 0) {
            error($error_message);
        }

        $email_message = "Form details below:\n\n";

        function clean_string($string)
        {
            $bad = array("content-type", "bcc:", "to:", "cc:", "href");
            return str_replace($bad, "", $string);
        }

        $email_message .= "Name: " . clean_string($name) . "\n";
        $email_message .= "Email: " . clean_string($email) . "\n";
        $email_message .= "Message: " . clean_string($message) . "\n";

        $headers = "FROM: " . $email . "\r\n" . "Reply-To: " . $email . "\r\n" . "X-Mailer: PHP/" . phpversion();

        mail($email_to, $subject, $email_message, $headers);

        echo "Thank you for your message, $name. Your message was '$message' and was sent from $email";
        echo "<br>";
        echo "<a href='../view/contact.php'>Go back</a>";
}

    function getPageInfo() {
    global $connection;
        $pageInfo = mysqli_query($connection, "SELECT BasicPageInfo.* , ZipCode.City FROM `BasicPageInfo` INNER JOIN ZipCode ON ZipCode.ZipCode = BasicPageInfo.ZipCode");
        $row = mysqli_fetch_assoc($pageInfo);
        return $row;
    }
