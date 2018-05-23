<?php

class Settings {
  // Basic info
  function getBasicPageInfo() {
    try {
      $conn = DB::connect();

      $handle = $conn->prepare("SELECT * FROM BasicPageInfo");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      return $result[0];

      DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function saveBasicPageInfo($post) {
    try {
      $conn = DB::connect();

      // Secure input
      $cvr = Security::secureString($post["CVR"]);
      $shopName = Security::secureString($post["ShopName"]);
      $aboutUsText = Security::secureString($post["AboutUsText"]);
      $email = Security::secureString($post["Email"]);
      $phone = Security::secureString($post["Phone"]);
      $street = Security::secureString($post["Street"]);
      $housenumber = Security::secureString($post["HouseNumber"]);
      $zipCode = Security::secureString($post["ZipCode"]);
      $stripeToken = Security::secureString($post["StripeToken"]);
      $homeSeoTitle = Security::secureString($post["HomeSeoTitle"]);
      $homeMetaDescription = Security::secureString($post["HomeMetaDescription"]);
      $contactSeoTitle = Security::secureString($post["ContactSeoTitle"]);
      $contactMetaDescription = Security::secureString($post["ContactMetaDescription"]);
      $productsSeoTitle = Security::secureString($post["ProductsSeoTitle"]);
      $productsMetaDescription = Security::secureString($post["ProductsMetaDescription"]);
      $blogSeoTitle = Security::secureString($post["BlogSeoTitle"]);
      $blogSeoTitle = Security::secureString($post["BlogSeoTitle"]);
      $blogMetaDescription = Security::secureString($post["BlogMetaDescription"]);


      $query = "UPDATE BasicPageInfo
                SET CVR = :CVR,
                ShopName = :ShopName,
                AboutUsText = :AboutUsText,
                Email = :Email,
                Phone = :Phone,
                Street = :Street,
                HouseNumber = :HouseNumber,
                ZipCode = :ZipCode,
                StripeToken = :StripeToken,
                HomeSeoTitle = :HomeSeoTitle,
                HomeMetaDescription = :HomeMetaDescription,
                ContactSeoTitle = :ContactSeoTitle,
                ContactMetaDescription = :ContactMetaDescription,
                ProductsSeoTitle = :ProductsSeoTitle,
                ProductsMetaDescription = :ProductsMetaDescription,
                BlogSeoTitle = :BlogSeoTitle,
                BlogMetaDescription = :BlogMetaDescription";

      $handle = $conn->prepare($query);
      $handle->bindParam(":CVR", $cvr);
      $handle->bindParam(":ShopName", $shopName);
      $handle->bindParam(":AboutUsText", $aboutUsText);
      $handle->bindParam(":Email", $email);
      $handle->bindParam(":Phone", $phone);
      $handle->bindParam(":Street", $street);
      $handle->bindParam(":HouseNumber", $housenumber);
      $handle->bindParam(":ZipCode", $zipCode);
      $handle->bindParam(":StripeToken", $stripeToken);
      $handle->bindParam(":HomeSeoTitle", $homeSeoTitle);
      $handle->bindParam(":HomeMetaDescription", $homeMetaDescription);
      $handle->bindParam(":ContactSeoTitle", $contactSeoTitle);
      $handle->bindParam(":ContactMetaDescription", $contactMetaDescription);
      $handle->bindParam(":ProductsSeoTitle", $productsSeoTitle);
      $handle->bindParam(":ProductsMetaDescription", $productsMetaDescription);
      $handle->bindParam(":BlogSeoTitle", $blogSeoTitle);
      $handle->bindParam(":BlogMetaDescription", $blogMetaDescription);
      $handle->execute();

      DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function getCity($zip) {
    try {
      $conn = DB::connect();

      // Secure input
      $zip = Security::secureString($zip);

      $query = "SELECT City FROM ZipCode WHERE ZipCode = :ZipCode";
      $handle = $conn->prepare($query);
      $handle->bindParam(":ZipCode", $zip);
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      return $result[0]["City"];

      DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  // Hours
  function getHours() {
    try {
        $conn = DB::connect();

        $query = "SELECT * FROM Hours";
        $handle = $conn->prepare($query);
        $handle->execute();

        $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
        return $result;

        DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function addHours($post) {
    try {
        $conn = DB::connect();

        $post["Day"] = Security::secureString($post["Day"]);
        $post["Open"] = Security::secureString($post["Open"]);
        $post["Close"] = Security::secureString($post["Close"]);

        $query = "INSERT INTO Hours (Day, Open, Close) VALUES (:Day, :Open, :Close)";

        $handle = $conn->prepare($query);
        $handle->bindParam(":Day", $post["Day"]);
        $handle->bindParam(":Open", $post["Open"]);
        $handle->bindParam(":Close", $post["Close"]);
        $handle->execute();

        DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function updateHours($post, $id) {
    try {
        $conn = DB::connect();

        $post["Day"] = Security::secureString($post["Day"]);
        $post["Open"] = Security::secureString($post["Open"]);
        $post["Close"] = Security::secureString($post["Close"]);
        $id = Security::secureString($id);

        $query = "UPDATE Hours
                  SET Day = :Day,
                  Open = :Open,
                  Close = :Close
                  WHERE HoursID = :id";

        $handle = $conn->prepare($query);
        $handle->bindParam(":Day", $post["Day"]);
        $handle->bindParam(":Open", $post["Open"]);
        $handle->bindParam(":Close", $post["Close"]);
        $handle->bindParam(":id", $id);
        $handle->execute();

        DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function deleteHours($id) {
    try {
        $conn = DB::connect();

        // Secure input
        $id = Security::secureString($id);

        $query = "DELETE FROM Hours WHERE HoursID = :id";

        $handle = $conn->prepare($query);
        $handle->bindParam(":id", $id);
        $handle->execute();

        DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  // Shipping
  function getShippingMethods() {
    try {
      $conn = DB::connect();

      $handle = $conn->prepare("SELECT * FROM DeliveryMethod");
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      return $result;

      DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function addShippingMethod($post) {
    try {
        $conn = DB::connect();

        $query = "INSERT INTO DeliveryMethod (Method, MethodDescription, DeliveryPrice) VALUES (:Method, :MethodDescription, :DeliveryPrice)";

        $handle = $conn->prepare($query);
        $handle->bindParam(":Method", $post["Method"]);
        $handle->bindParam(":MethodDescription", $post["MethodDescription"]);
        $handle->bindParam(":DeliveryPrice", $post["DeliveryPrice"]);
        $handle->execute();

        $conn = DB::connect();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function updateShippingMethod($post, $id) {
    try {
        $conn = DB::connect();

        // Secure input
        $post["Method"] = Security::secureString($post["Method"]);
        $id = Security::secureString($id);

        $query = "UPDATE DeliveryMethod
                  SET Method = :Method,
                  MethodDescription = :MethodDescription,
                  DeliveryPrice = :DeliveryPrice
                  WHERE DeliveryMethodID = :id";

        $handle = $conn->prepare($query);
        $handle->bindParam(":Method", $post["Method"]);
        $handle->bindParam(":MethodDescription", $post["MethodDescription"]);
        $handle->bindParam(":DeliveryPrice", $post["DeliveryPrice"]);
        $handle->bindParam(":id", $id);
        $handle->execute();

        DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }

  function deleteShippingMethod($id) {
    try {
        $conn = DB::connect();

        // Secure input
        $id = Security::secureString($id);

        $query = "DELETE FROM DeliveryMethod WHERE DeliveryMethodID = :id";

        $handle = $conn->prepare($query);
        $handle->bindParam(":id", $id);
        $handle->execute();

        DB::close();
    }
    catch(\PDOException $ex) {
      print($ex->getMessage());
    }
  }
}
