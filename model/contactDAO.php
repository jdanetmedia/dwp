<?php


if (isset($_POST["email"])) {
    mailCheck();
}

    function mailCheck()
    {
      //var_dump($_POST["g-recaptcha-response"]);
      $errMsg = "";
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
          //your site secret key
          $secret = '6LfRflkUAAAAANg0eaCe2bfDQ4w_khZq5xPDKMy0';
          //get verify response data
          $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
          $responseData = json_decode($verifyResponse);
          if($responseData->success){
              //contact form submission code goes here
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

              header('Location: ../view/contact.php');
              $succMsg = 'Your contact request have submitted successfully.';
              //echo $succMsg;
          }else{
              $errMsg .= 'Robot verification failed, please try again.';
          }
        }else{
          $errMsg .= 'Please click on the reCAPTCHA box.';
        }
        //echo $errMsg;
}

    function getPageInfo() {
        try {
            $conn = DB::connect();

            $handle = $conn->prepare("SELECT BasicPageInfo.* , ZipCode.City FROM `BasicPageInfo` INNER JOIN ZipCode ON ZipCode.ZipCode = BasicPageInfo.ZipCode");
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
            $conn = DB::close();
            return $result;

        }
        catch(\PDOException $ex) {
            return print($ex->getMessage());
        }

        /*global $connection;
        $pageInfo = mysqli_query($connection, "SELECT BasicPageInfo.* , ZipCode.City FROM `BasicPageInfo` INNER JOIN ZipCode ON ZipCode.ZipCode = BasicPageInfo.ZipCode");
        $row = mysqli_fetch_assoc($pageInfo);
        return $row;*/
    }

    function getHours() {
        try {
            $conn = DB::connect();

            $handle = $conn->prepare("SELECT * FROM Hours");
            $handle->execute();

            $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
            $conn = DB::close();
            return $result;
        }
        catch(\PDOException $ex) {
            return print($ex->getMessage());
        }

        /*global $connection;
        $hours = mysqli_query($connection, "SELECT * FROM Hours");
        return $hours;*/
    }
