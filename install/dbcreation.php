<?php
if (isset($_POST["submitdbinfo"])) {
  // create constants.php file
  $constantsfile = fopen("../includes/constants.php", "w") or die("Unable to open file!");
  $txt = "<?php\n";
  fwrite($constantsfile, $txt);
  $server = $_POST["server"];
  $user = $_POST["username"];
  $pass = $_POST["password"];
  $db = $_POST["dbname"];
  $txt = "define('DB_SERVER', '$server');
  define('DB_USER', '$user');
  define('DB_PASS', '$pass');
  define('DB_NAME', '$db');\n";
  fwrite($constantsfile, $txt);
  $txt = "?>";
  fwrite($constantsfile, $txt);
  fclose($constantsfile);

  // create DB
  require_once("connection.php");

  function createDBtables() {
    try {
        $conn = connectToDB();

        $handle = $conn->prepare("CREATE TABLE ZipCode (
  ZipCode int(20) NOT NULL PRIMARY KEY,
  City varchar(255)
);

CREATE TABLE FrontSlider (
  SlideID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  SliderText varchar(255) NULL,
  SliderHeader varchar(255) NULL,
  CTAButtonText varchar(255) NULL,
  CTAURL varchar(255) NULL,
  SliderImg varchar(255) NOT NULL,
  UserEmail varchar(255) NOT NULL
);

CREATE TABLE PromoCode (
  PromoCode varchar(255) NOT NULL PRIMARY KEY,
  DiscountAmount int(2) NOT NULL,
  StartDate TIMESTAMP NULL,
  EndDate TIMESTAMP NULL,
  NumberOfUses int NULL,
  UserEmail varchar(255) NOT NULL
);

CREATE TABLE Page (
  PageID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  Title varchar(255) NOT NULL,
  SeoTitle varchar(255) NULL,
  Metadescription varchar(255) NULL,
  PageContent varchar(255) NOT NULL,
  UserEmail varchar(255) NOT NULL
);

CREATE TABLE Hours (
  HoursID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  Open int NOT NULL,
  Close int NOT NULL,
  Day varchar(255) NULL
);

CREATE TABLE BasicPageInfo (
  CVR int NOT NULL PRIMARY KEY,
  LogoURL varchar(255) NOT NULL,
  ShopName varchar(255) NOT NULL,
  MinimumDelivery int NULL,
  AboutUsText varchar(255) NULL,
  Email varchar(255) NULL,
  Phone int NULL,
  Street varchar(255) NULL,
  HouseNumber varchar(255) NULL,
  ZipCode int(20) NOT NULL
);

CREATE TABLE Product (
  ItemNumber varchar(255) NOT NULL PRIMARY KEY,
  ProductName varchar(255) NOT NULL,
  StockStatus int NOT NULL,
  ShortDescription varchar(255) NOT NULL,
  LongDescription varchar(255) NOT NULL,
  Price int NOT NULL,
  OfferPrice int NULL,
  SeoTitle varchar(255) NULL,
  MetaDescription varchar(255) NULL,
  ProductStatus boolean NOT NULL,
  CreationDate DATE NOT NULL,
  UserEmail varchar(255) NOT NULL,
  ProductCategoryID int NOT NULL
);

CREATE TABLE User (
  UserEmail varchar(255) NOT NULL PRIMARY KEY,
  Password varchar(255) NOT NULL,
  FirstName varchar(255) NOT NULL,
  LastName varchar(255) NOT NULL
);

CREATE TABLE Review (
  ReviewID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  ReviewDate TIMESTAMP NOT NULL,
  Rating int(1) NOT NULL,
  ReviewTitle varchar(255) NOT NULL,
  ReviewName varchar(255) NULL,
  ReviewContent varchar(255) NULL,
  ItemNumber varchar(255) NOT NULL
);

CREATE TABLE ProductCategory (
  ProductCategoryID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  CategoryName varchar(255) NOT NULL,
  Description varchar(255) NULL,
  SeoTitle varchar(255) NULL,
  MetaDescription varchar(255) NULL
);

CREATE TABLE ImgGallery (
  ImgID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  URL varchar(255) NOT NULL
);

CREATE TABLE Customer (
  CustomerEmail varchar(255) NOT NULL PRIMARY KEY,
  Password varchar(255) NOT NULL,
  Street varchar(255) NULL,
  HouseNumber varchar(255) NULL,
  Phone int null,
  FirstName varchar(255) NOT NULL,
  LastName varchar(255) NOT NULL,
  ZipCode int(20) NULL
);

CREATE TABLE BlogPost (
  BlogPostID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  Title varchar(255) NOT NULL,
  SeoTitle varchar(255) NULL,
  MetaDescription varchar(255) NULL,
  BlogContent TEXT NOT NULL,
  BlogDate TIMESTAMP NOT NULL,
  UserEmail varchar(255) NOT NULL,
  BlogCategoryID int(20) NOT NULL,
  RelatedProducts int NULL
);

CREATE TABLE BlogCategory (
  BlogCategoryID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  CategoryName varchar(255) NOT NULL,
  Description varchar(255) NULL,
  SeoTitle varchar(255) NULL,
  MetaDescription varchar(255) NULL
);

CREATE TABLE CustomerOrder (
  OrderNumber int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  Comment varchar(255) NULL,
  StripeChargeID varchar(255) NOT NULL,
  OrderDate TIMESTAMP NOT NULL,
  ShippingStreet varchar(255) NOT NULL,
  ShippingHouseNumber varchar(255) NOT NULL,
  ZipCode int(20) NOT NULL,
  CustomerEmail varchar(255) NOT NULL,
  DeliveryMethodID int NOT NULL,
  OrderStatusID int NOT NULL,
  PromoCode varchar(255) NULL
);

CREATE TABLE OrderMessage (
  OrderMessageID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  OrderMessage varchar(255) NOT NULL,
  OrderMessageDate TIMESTAMP NOT NULL,
  OrderNumber int NOT NULL
);

CREATE TABLE DeliveryMethod (
  DeliveryMethodID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  Method varchar(255) NOT NULL,
  MethodDescription varchar(255) NOT NULL,
  DeliveryPrice int NOT NULL
);

CREATE TABLE OrderStatus (
  OrderStatusID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  Status varchar(255) NOT NULL
);

ALTER TABLE FrontSlider
ADD FOREIGN KEY (UserEmail) REFERENCES User (UserEmail);

ALTER TABLE PromoCode
ADD FOREIGN KEY (UserEmail) REFERENCES User (UserEmail);

ALTER TABLE Page
ADD FOREIGN KEY (UserEmail) REFERENCES User (UserEmail);

ALTER TABLE BasicPageInfo
ADD FOREIGN KEY (ZipCode) REFERENCES ZipCode (ZipCode);

ALTER TABLE Product
ADD FOREIGN KEY (UserEmail) REFERENCES User (UserEmail);

ALTER TABLE Product
ADD FOREIGN KEY (ProductCategoryID) REFERENCES ProductCategory (ProductCategoryID);

ALTER TABLE Review
ADD FOREIGN KEY (ItemNumber) REFERENCES Product (ItemNumber);

ALTER TABLE Customer
ADD FOREIGN KEY (ZipCode) REFERENCES ZipCode (ZipCode);

ALTER TABLE BlogPost
ADD FOREIGN KEY (UserEmail) REFERENCES User (UserEmail);

ALTER TABLE BlogPost
ADD FOREIGN KEY (BlogCategoryID) REFERENCES BlogCategory (BlogCategoryID);

ALTER TABLE BlogPost
ADD FOREIGN KEY (RelatedProducts) REFERENCES ProductCategory (ProductCategoryID);

ALTER TABLE CustomerOrder
ADD FOREIGN KEY (ZipCode) REFERENCES ZipCode (ZipCode);

ALTER TABLE CustomerOrder
ADD FOREIGN KEY (CustomerEmail) REFERENCES Customer (CustomerEmail);

ALTER TABLE CustomerOrder
ADD FOREIGN KEY (DeliveryMethodID) REFERENCES DeliveryMethod (DeliveryMethodID);

ALTER TABLE CustomerOrder
ADD FOREIGN KEY (OrderStatusID) REFERENCES OrderStatus (OrderStatusID);

ALTER TABLE CustomerOrder
ADD FOREIGN KEY (PromoCode) REFERENCES PromoCode (PromoCode);

ALTER TABLE OrderMessage
ADD FOREIGN KEY (OrderNumber) REFERENCES CustomerOrder (OrderNumber);

CREATE TABLE PageImg (
    PageID int NOT NULL,
    ImgID int NOT NULL,
    IsPrimary boolean NULL,
    CONSTRAINT PK_DisplaysOnPage PRIMARY KEY (PageID, ImgID),
    FOREIGN KEY (PageID) REFERENCES Page (PageID),
    FOREIGN KEY (ImgID) REFERENCES ImgGallery (ImgID)
);

CREATE TABLE ProductImg (
  ItemNumber varchar(255) NOT NULL,
  ImgID int NOT NULL,
  IsPrimary boolean NULL,
  CONSTRAINT PK_DisplaysOnProduct PRIMARY KEY (ItemNumber, ImgID),
  FOREIGN KEY (ItemNumber) REFERENCES Product (ItemNumber),
  FOREIGN KEY (ImgID) REFERENCES ImgGallery (ImgID)
);

CREATE TABLE BlogImg (
  BlogPostID int NOT NULL,
  ImgID int NOT NULL,
  IsPrimary boolean NULL,
  CONSTRAINT PK_DisplaysOnBlog PRIMARY KEY (BlogPostID, ImgID),
  FOREIGN KEY (BlogPostID) REFERENCES BlogPost (BlogPostID),
  FOREIGN KEY (ImgID) REFERENCES ImgGallery (ImgID)
);

CREATE TABLE OrderDetails (
  OrderNumber int NOT NULL,
  ItemNumber varchar(255) NOT NULL,
  Amount int NOT NULL,
  CONSTRAINT PK_ProductOnOrder PRIMARY KEY (OrderNumber, ItemNumber),
  FOREIGN KEY (OrderNumber) REFERENCES CustomerOrder (OrderNumber),
  FOREIGN KEY (ItemNumber) REFERENCES Product (ItemNumber)
);");
        $handle->execute();

        $conn = null;
    }
    catch(\PDOException $ex) {
        //print($ex->getMessage());
    }
  }

  createDBtables();
  header('Location: usercreate.php');

}
?>
