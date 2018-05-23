<?php

class Slide {
  function getAllSlides() {
    try {
        $conn = DB::connect();

        $query = "SELECT * FROM FrontSlider";
        $handle = $conn->prepare($query);
        $handle->execute();

        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );

        return $result;

        $conn = DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function getCurrentSlide($id) {
    try {
        $conn = DB::connect();

        // Secure input
        $id = Security::secureString($id);

        $query = "SELECT * FROM FrontSlider WHERE SlideID = :slideID";
        $handle = $conn->prepare($query);
        $handle->bindParam(":slideID", $id);
        $handle->execute();

        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );

        return $result[0];

        $conn = DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function updateSlide($post, $id) {
    try {
        $conn = DB::connect();

        // Secure input
        $id = Security::secureString($id);
        $sliderHeader = Security::secureString($post["SliderHeader"]);
        $sliderText = Security::secureString($post["SliderText"]);
        $ctaButtonText = Security::secureString($post["CTAButtonText"]);
        $ctaURL = Security::secureString($post["CTAURL"]);
        $userEmail = Security::secureString($_SESSION["UserEmail"]);

        $query = "UPDATE FrontSlider
                  SET SliderHeader = :SliderHeader,
                  SliderText = :SliderText,
                  CTAButtonText = :CTAButtonText,
                  CTAURL = :CTAURL,
                  UserEmail = :UserEmail
                  WHERE SlideID = :slideID";
        $handle = $conn->prepare($query);
        $handle->bindParam(":slideID", $id);
        $handle->bindParam(":SliderHeader", $sliderHeader);
        $handle->bindParam(":SliderText", $sliderText);
        $handle->bindParam(":CTAButtonText", $ctaButtonText);
        $handle->bindParam(":CTAURL", $ctaURL);
        $handle->bindParam(":UserEmail", $userEmail);
        $result = $handle->execute();

        $conn = DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function deleteSlide($id) {
    try {
        $conn = DB::connect();

        // Secure input
        $id = Security::secureString($id);

        $query = "DELETE FROM FrontSlider WHERE SlideID = :slideID";
        $handle = $conn->prepare($query);
        $handle->bindParam(":slideID", $id);
        $result = $handle->execute();

        $conn = DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function createSlide($post) {
    try {
        $conn = DB::connect();

        // Secure input
        $sliderHeader = Security::secureString($post["SliderHeader"]);
        $sliderText = Security::secureString($post["SliderText"]);
        $ctaButtonText = Security::secureString($post["CTAButtonText"]);
        $ctaURL = Security::secureString($post["CTAURL"]);
        $userEmail = Security::secureString($_SESSION["UserEmail"]);

        $query = "INSERT INTO FrontSlider (
                  SliderHeader,
                  SliderText,
                  CTAButtonText,
                  CTAURL,
                  UserEmail
                ) VALUES (
                  :SliderHeader,
                  :SliderText,
                  :CTAButtonText,
                  :CTAURL,
                  :UserEmail
                )";

        $handle = $conn->prepare($query);
        $handle->bindParam(":SliderHeader", $sliderHeader);
        $handle->bindParam(":SliderText", $sliderText);
        $handle->bindParam(":CTAButtonText", $ctaButtonText);
        $handle->bindParam(":CTAURL", $ctaURL);
        $handle->bindParam(":UserEmail", $userEmail);
        $result = $handle->execute();

        if($result == true) {
          $last_id = $conn->lastInsertId();
          return $last_id;
        }

        $conn = DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }
}
