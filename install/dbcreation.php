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

  require_once("../admin/class/DB.php");
  require_once("../admin/class/Security.php");

  try {
      $conn = DB::connect();

      $statement = "SELECT UserEmail FROM User";

      $handle = $conn->prepare($statement);
      $handle->execute();

      $result = $handle->fetchAll( \PDO::FETCH_ASSOC );
      if($result > 0) {
        header('Location: ../index.php');
        die;
      }
  }
  catch(\PDOException $ex) {
      //print($ex->getMessage());
  }

  function createDBtables() {
    try {
        $conn = DB::connect();

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
          UserEmail varchar(255) NOT NULL -- Foreign Key, set later
        );

        CREATE TABLE PromoCode (
          PromoCode varchar(255) NOT NULL PRIMARY KEY,
          DiscountAmount int(2) NOT NULL,
          StartDate DATE NULL,
          EndDate DATE NULL,
          NumberOfUses int NULL,
          UserEmail varchar(255) NOT NULL -- Foreign Key, set later
        );

        CREATE TABLE Hours (
          HoursID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
          Open varchar(255) NOT NULL,
          Close varchar(255) NOT NULL,
          Day varchar(255) NULL
        );

        CREATE TABLE BasicPageInfo (
          CVR int NOT NULL PRIMARY KEY,
          LogoURL varchar(255) NOT NULL,
          ShopName varchar(255) NOT NULL,
          AboutUsText TEXT NULL,
          Email varchar(255) NULL,
          Phone int NULL,
          Street varchar(255) NULL,
          HouseNumber varchar(255) NULL,
          StripeToken varchar(255) NULL,
          ProductsSeoTitle varchar(255) NULL,
          ProductsMetaDescription varchar(255) NULL,
          BlogSeoTitle varchar(255) NULL,
          BlogMetaDescription varchar(255) NULL,
          ContactSeoTitle varchar(255) NULL,
          ContactMetaDescription varchar(255) NULL,
          HomeSeoTitle varchar(255) NULL,
          HomeMetaDescription varchar(255) NULL,
          ZipCode int(20) NOT NULL -- Foreign Key, set later
        );

        CREATE TABLE Product (
          ItemNumber varchar(255) NOT NULL PRIMARY KEY,
          ProductName varchar(255) NOT NULL,
          StockStatus int NOT NULL,
          ShortDescription varchar(255) NOT NULL,
          LongDescription TEXT NOT NULL,
          Price FLOAT(2) NOT NULL,
          OfferPrice FLOAT(2) NULL,
          SeoTitle varchar(255) NULL,
          MetaDescription varchar(255) NULL,
          ProductStatus boolean NOT NULL,
          CreationDate DATE NOT NULL,
          UserEmail varchar(255) NOT NULL, -- Foreign Key, set later
          ProductCategoryID int NOT NULL -- Foreign Key, set later
        );

        CREATE TABLE User (
          UserEmail varchar(255) NOT NULL PRIMARY KEY,
          Password varchar(255) NOT NULL,
          FirstName varchar(255) NOT NULL,
          LastName varchar(255) NOT NULL,
          ResetKey varchar(255) NULL,
          AccessLevel int NOT NULL
        );

        CREATE TABLE Review (
          ReviewID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
          ReviewDate TIMESTAMP NOT NULL,
          Rating int(1) NOT NULL,
          ReviewTitle varchar(255) NOT NULL,
          ReviewName varchar(255) NULL,
          ReviewContent TEXT NULL,
          ItemNumber varchar(255) NOT NULL -- Foreign Key, set later
        );

        CREATE TABLE ProductCategory (
          ProductCategoryID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
          CategoryName varchar(255) NOT NULL,
          Description TEXT NULL,
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
          ZipCode int(20) NULL, -- Foreign Key, set later
          ResetKey varchar(255) NULL
        );

        CREATE TABLE BlogPost (
          BlogPostID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
          Title varchar(255) NOT NULL,
          SeoTitle varchar(255) NULL,
          MetaDescription varchar(255) NULL,
          BlogContent TEXT NOT NULL,
          BlogDate TIMESTAMP NOT NULL,
          UserEmail varchar(255) NOT NULL, -- Foreign Key, set later
          BlogCategoryID int(20) NOT NULL, -- Foreign Key, set later
          RelatedProducts int NULL -- Foreign Key, set later
        );

        CREATE TABLE BlogCategory (
          BlogCategoryID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
          CategoryName varchar(255) NOT NULL,
          Description TEXT NULL,
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
          ZipCode int(20) NOT NULL, -- Foreign Key, set later
          CustomerEmail varchar(255) NOT NULL, -- Foreign Key, set later
          DeliveryMethodID int NOT NULL, -- Foreign Key, set later
          OrderStatusID int NOT NULL, -- Foreign Key, set later
          PromoCode varchar(255) NULL -- Foreign Key, set later
        );

        CREATE TABLE OrderMessage (
          OrderMessageID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
          OrderMessage TEXT NOT NULL,
          OrderMessageDate TIMESTAMP NOT NULL,
          OrderNumber int NOT NULL -- Foreign Key, set later
        );

        CREATE TABLE DeliveryMethod (
          DeliveryMethodID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
          Method varchar(255) NOT NULL,
          MethodDescription varchar(255) NOT NULL,
          DeliveryPrice FLOAT(2) NOT NULL
        );

        CREATE TABLE OrderStatus (
          OrderStatusID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
          Status varchar(255) NOT NULL
        );

        -- Add foreign keys
        ALTER TABLE FrontSlider
        ADD FOREIGN KEY (UserEmail) REFERENCES User (UserEmail);

        ALTER TABLE PromoCode
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

        -- Many-to-many relations

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
          CONSTRAINT PK_DisplaysOnBlog PRIMARY KEY (BlogPostID, ImgID),
          FOREIGN KEY (BlogPostID) REFERENCES BlogPost (BlogPostID),
          FOREIGN KEY (ImgID) REFERENCES ImgGallery (ImgID)
        );

        CREATE TABLE OrderDetails (
          OrderNumber int NOT NULL,
          ItemNumber varchar(255) NOT NULL,
          Amount int NOT NULL,
          FinalPrice FLOAT(2) NOT NULL,
          CONSTRAINT PK_ProductOnOrder PRIMARY KEY (OrderNumber, ItemNumber),
          FOREIGN KEY (OrderNumber) REFERENCES CustomerOrder (OrderNumber),
          FOREIGN KEY (ItemNumber) REFERENCES Product (ItemNumber)
        );

        -- Add test data below

        -- Insert Product Categories
        INSERT INTO ProductCategory
        VALUES (NULL, 'Normal Ducks', 'This is the first description', 'SeoTitle for Cat1', 'This is the Metadescription for category 1');

        INSERT INTO ProductCategory
        VALUES (NULL, 'SuperHero Ducks', 'This is the Second description', 'SeoTitle for Cat2', 'This is the Metadescription for category 2');

        INSERT INTO ProductCategory
        VALUES (NULL, 'Sport Ducks', 'This is the Third description', 'SeoTitle for Cat3', 'This is the Metadescription for category 3');

        -- Insert Users
        INSERT INTO User
        VALUES ('rasmus.andreas96@gmail.com', '$2a$10$74zsjq9/Tv6Ydq.QLlKeju.bwxXfs8GUSN051E1EeMIi4L/beo1Li', 'Rasmus Andreas', 'Nielsen', NULL, 1);

        -- Insert Products
        INSERT INTO Product
        VALUES ('1111', 'Green Duck', 1000, 'Short Description of Green Duck', 'Longer Description Green Duck',
        10, NULL, NULL, NULL, true, '2018-4-1', 'rasmus.andreas96@gmail.com', 1);

        INSERT INTO Product
        VALUES ('1112', 'Red Duck', 1000, 'Short Description of Red Duck', 'Longer Description Red Duck',
        18, 10, NULL, NULL, true, '2018-4-2', 'rasmus.andreas96@gmail.com', 1);

        INSERT INTO Product
        VALUES ('1113', 'Yellow Duck', 1000, 'Short Description of Yellow Duck', 'Longer Description Yellow Duck',
        8, NULL, NULL, NULL, true, '2017-4-3', 'rasmus.andreas96@gmail.com', 1);

        INSERT INTO Product
        VALUES ('2221', 'Batman Duck', 50, 'Short Description of Batman Duck', 'Longer Description Batman Duck',
        10, 8, NULL, NULL, true, '2016-4-4', 'rasmus.andreas96@gmail.com', 2);

        INSERT INTO Product
        VALUES ('2222', 'Deadpool Duck', 49, 'Short Description of Deadpool Duck', 'Longer Description Deadpool Duck',
        12, NULL, NULL, NULL, true, '2018-11-5', 'rasmus.andreas96@gmail.com', 2);

        INSERT INTO Product
        VALUES ('3331', 'EfB Duck', 1000, 'Short Description of EfB Duck', 'Longer Description EfB Duck',
        15, 1, NULL, NULL, true, '2012-12-24', 'rasmus.andreas96@gmail.com', 3);

        INSERT INTO Product
        VALUES ('3332', 'Chelsea Duck', 2, 'Short Description of Chelsea Duck', 'Longer Description Chelsea Duck',
        20, NULL, NULL, NULL, true, '2018-1-15', 'rasmus.andreas96@gmail.com', 3);

        INSERT INTO Product
        VALUES ('3333', 'United Duck', 1000, 'Short Description of United Duck', 'Longer Description United Duck',
        25, NULL, NULL, NULL, true, '2014-9-20', 'rasmus.andreas96@gmail.com', 3);

        INSERT INTO Product
        VALUES ('3334', 'Arsenal Duck', 1000, 'Short Description of Arsenal Duck', 'Longer Description Arsenal Duck',
        25, NULL, NULL, NULL, true, '2018-4-10', 'rasmus.andreas96@gmail.com', 3);

        INSERT INTO Product
        VALUES ('3335', 'Liverpool Duck', 10, 'Short Description of Liverpool Duck', 'Longer Description Liverpool Duck',
        22, NULL, NULL, NULL, false, '2008-5-20', 'rasmus.andreas96@gmail.com', 3);

        -- Insert Reviews
        INSERT INTO Review
        VALUES (NULL, '2008-11-11 13:23:44', 3, 'ReviewTitle', 'ReviewersName', 'This is the review content', '1111');

        INSERT INTO Review
        VALUES (NULL, '2008-11-11 13:23:44', 4, 'ReviewTitle', 'ReviewersName', 'This is the review content', '1111');

        INSERT INTO Review
        VALUES (NULL, '2008-11-11 13:23:44', 4, 'ReviewTitle', 'ReviewersName', 'This is the review content', '1111');

        INSERT INTO Review
        VALUES (NULL, '2008-11-11 13:23:44', 5, 'ReviewTitle', 'ReviewersName', 'This is the review content', '1111');

        INSERT INTO Review
        VALUES (NULL, '2008-11-11 13:23:44', 3, 'ReviewTitle', 'ReviewersName', 'This is the review content', '1112');

        INSERT INTO Review
        VALUES (NULL, '2008-11-11 13:23:44', 4, 'ReviewTitle', 'ReviewersName', 'This is the review content', '1113');

        INSERT INTO Review
        VALUES (NULL, '2008-11-11 13:23:44', 5, 'ReviewTitle', 'ReviewersName', 'This is the review content', '2221');

        INSERT INTO Review
        VALUES (NULL, '2008-11-11 13:23:44', 4, 'ReviewTitle', 'ReviewersName', 'This is the review content', '2222');

        INSERT INTO Review
        VALUES (NULL, '2008-11-11 13:23:44', 5, 'ReviewTitle', 'ReviewersName', 'This is the review content', '3331');

        INSERT INTO Review
        VALUES (NULL, '2008-11-11 13:23:44', 5, 'ReviewTitle', 'ReviewersName', 'This is the review content', '3332');

        INSERT INTO Review
        VALUES (NULL, '2008-11-11 13:23:44', 1, 'ReviewTitle', 'ReviewersName', 'This is the review content', '3333');

        INSERT INTO Review
        VALUES (NULL, '2008-11-11 13:23:44', 1, 'ReviewTitle', 'ReviewersName', 'This is the review content', '3334');

        INSERT INTO Review
        VALUES (NULL, '2008-11-11 13:23:44', 1, 'ReviewTitle', 'ReviewersName', 'This is the review content', '3335');

        -- Insert ImgGallery
        INSERT INTO ImgGallery
        VALUES (NULL, 'http://via.placeholder.com/200x200');

        INSERT INTO ImgGallery
        VALUES (NULL, 'http://via.placeholder.com/400x400');

        INSERT INTO ImgGallery
        VALUES (NULL, 'http://via.placeholder.com/600x600');

        INSERT INTO ImgGallery
        VALUES (NULL, 'http://via.placeholder.com/800x800');

        INSERT INTO ImgGallery
        VALUES (NULL, 'http://via.placeholder.com/1920x1080');

        INSERT INTO ImgGallery
        VALUES (NULL, 'http://via.placeholder.com/800x800');

        -- Insert ProductImg
        INSERT INTO ProductImg
        VALUES ('1111', 1, true);

        INSERT INTO ProductImg
        VALUES ('1111', 6, false);

        INSERT INTO ProductImg
        VALUES ('1112', 2, true);

        INSERT INTO ProductImg
        VALUES ('1113', 3, true);

        INSERT INTO ProductImg
        VALUES ('2221', 4, true);

        INSERT INTO ProductImg
        VALUES ('2222', 2, true);

        INSERT INTO ProductImg
        VALUES ('3331', 2, true);

        INSERT INTO ProductImg
        VALUES ('3332', 2, true);

        INSERT INTO ProductImg
        VALUES ('3333', 2, true);

        INSERT INTO ProductImg
        VALUES ('3334', 2, true);

        INSERT INTO ProductImg
        VALUES ('3335', 2, true);

        -- Insert DeliveryMethods
        INSERT INTO DeliveryMethod
        VALUES (NULL, 'Shipping to postoffice', 'This is the description for the shipping to postoffice', 5);

        INSERT INTO DeliveryMethod
        VALUES (NULL, 'Shipping to home address', 'This is the description for the shipping to home address', 8);

        INSERT INTO DeliveryMethod
        VALUES (NULL, 'Express shipping', 'This is the description for the Express shipping', 15);

        -- Insert BlogCategories
        INSERT INTO BlogCategory
        VALUES (NULL, 'Company News', 'Here you will find some of our company news.', 'SeoTitle', 'MetaDescription');

        INSERT INTO BlogCategory
        VALUES (NULL, 'Top 10s', 'Here you will find top 10s lists', 'SeoTitle', 'MetaDescription');

        -- Insert BlogPosts
        INSERT INTO BlogPost
        VALUES (NULL, 'New employee', 'SeoTitle', 'MetaDescription', 'This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee', '2008-12-12 15:23:44', 'rasmus.andreas96@gmail.com', 1, NULL);

        INSERT INTO BlogPost
        VALUES (NULL, 'Top 10 sports rubber ducks', 'SeoTitle', 'MetaDescription', 'This is blogcontent for the post Top 10 sports rubber ducks This is blogcontent for the post Top 10 sports rubber ducks This is blogcontent for the post Top 10 sports rubber ducksThis is blogcontent for the post Top 10 sports rubber ducks This is blogcontent for the post Top 10 sports rubber ducks This is blogcontent for the post Top 10 sports rubber ducks This is blogcontent for the post Top 10 sports rubber ducks This is blogcontent for the post Top 10 sports rubber ducks This is blogcontent for the post Top 10 sports rubber ducks ', '2008-10-10 09:23:44', 'rasmus.andreas96@gmail.com', 2, 3);

        INSERT INTO BlogPost
        VALUES (NULL, 'Another new employee', 'SeoTitle', 'MetaDescription', 'This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee', '2008-11-11 10:23:44', 'rasmus.andreas96@gmail.com', 1, NULL);

        INSERT INTO BlogPost
        VALUES (NULL, 'Top 10 rubber ducks', 'SeoTitle', 'MetaDescription', 'This is blogcontent for the post Top 10 rubber ducks This is blogcontent for the post Top 10 rubber ducks This is blogcontent for the post Top 10 rubber ducks This is blogcontent for the post Top 10 rubber ducks This is blogcontent for the post Top 10 rubber ducks This is blogcontent for the post Top 10 rubber ducks This is blogcontent for the post Top 10 rubber ducks This is blogcontent for the post Top 10 rubber ducks This is blogcontent for the post Top 10 rubber ducks', '2008-01-26 22:23:44', 'rasmus.andreas96@gmail.com', 2, 1);

        -- Insert BlogImg
        INSERT INTO BlogImg
        VALUES (1,5);

        INSERT INTO BlogImg
        VALUES (2,5);

        -- insert zipcodes and cities
        INSERT INTO ZipCode VALUES
        (914,'København K')
        ,(1000,'København K')
        ,(1001,'København K')
        ,(1002,'København K')
        ,(1003,'København K')
        ,(1004,'København K')
        ,(1005,'København K')
        ,(1006,'København K')
        ,(1007,'København K')
        ,(1008,'København K')
        ,(1009,'København K')
        ,(1010,'København K')
        ,(1011,'København K')
        ,(1012,'København K')
        ,(1013,'København K')
        ,(1014,'København K')
        ,(1015,'København K')
        ,(1016,'København K')
        ,(1017,'København K')
        ,(1018,'København K')
        ,(1019,'København K')
        ,(1020,'København K')
        ,(1021,'København K')
        ,(1022,'København K')
        ,(1023,'København K')
        ,(1024,'København K')
        ,(1025,'København K')
        ,(1026,'København K')
        ,(1045,'København K')
        ,(1050,'København K')
        ,(1051,'København K')
        ,(1052,'København K')
        ,(1053,'København K')
        ,(1054,'København K')
        ,(1055,'København K')
        ,(1056,'København K')
        ,(1057,'København K')
        ,(1058,'København K')
        ,(1059,'København K')
        ,(1060,'København K')
        ,(1061,'København K')
        ,(1062,'København K')
        ,(1063,'København K')
        ,(1064,'København K')
        ,(1065,'København K')
        ,(1066,'København K')
        ,(1067,'København K')
        ,(1068,'København K')
        ,(1069,'København K')
        ,(1070,'København K')
        ,(1071,'København K')
        ,(1072,'København K')
        ,(1073,'København K')
        ,(1074,'København K')
        ,(1092,'København K')
        ,(1093,'København K')
        ,(1095,'København K')
        ,(1098,'København K')
        ,(1100,'København K')
        ,(1101,'København K')
        ,(1102,'København K')
        ,(1103,'København K')
        ,(1104,'København K')
        ,(1105,'København K')
        ,(1106,'København K')
        ,(1107,'København K')
        ,(1110,'København K')
        ,(1111,'København K')
        ,(1112,'København K')
        ,(1113,'København K')
        ,(1114,'København K')
        ,(1115,'København K')
        ,(1116,'København K')
        ,(1117,'København K')
        ,(1118,'København K')
        ,(1119,'København K')
        ,(1120,'København K')
        ,(1121,'København K')
        ,(1122,'København K')
        ,(1123,'København K')
        ,(1124,'København K')
        ,(1125,'København K')
        ,(1126,'København K')
        ,(1127,'København K')
        ,(1128,'København K')
        ,(1129,'København K')
        ,(1130,'København K')
        ,(1131,'København K')
        ,(1140,'København K')
        ,(1147,'København K')
        ,(1148,'København K')
        ,(1150,'København K')
        ,(1151,'København K')
        ,(1152,'København K')
        ,(1153,'København K')
        ,(1154,'København K')
        ,(1155,'København K')
        ,(1156,'København K')
        ,(1157,'København K')
        ,(1158,'København K')
        ,(1159,'København K')
        ,(1160,'København K')
        ,(1161,'København K')
        ,(1162,'København K')
        ,(1163,'København K')
        ,(1164,'København K')
        ,(1165,'København K')
        ,(1166,'København K')
        ,(1167,'København K')
        ,(1168,'København K')
        ,(1169,'København K')
        ,(1170,'København K')
        ,(1171,'København K')
        ,(1172,'København K')
        ,(1173,'København K')
        ,(1174,'København K')
        ,(1175,'København K')
        ,(1200,'København K')
        ,(1201,'København K')
        ,(1202,'København K')
        ,(1203,'København K')
        ,(1204,'København K')
        ,(1205,'København K')
        ,(1206,'København K')
        ,(1207,'København K')
        ,(1208,'København K')
        ,(1209,'København K')
        ,(1210,'København K')
        ,(1211,'København K')
        ,(1212,'København K')
        ,(1213,'København K')
        ,(1214,'København K')
        ,(1215,'København K')
        ,(1216,'København K')
        ,(1217,'København K')
        ,(1218,'København K')
        ,(1219,'København K')
        ,(1220,'København K')
        ,(1221,'København K')
        ,(1240,'København K')
        ,(1250,'København K')
        ,(1251,'København K')
        ,(1253,'København K')
        ,(1254,'København K')
        ,(1255,'København K')
        ,(1256,'København K')
        ,(1257,'København K')
        ,(1259,'København K')
        ,(1260,'København K')
        ,(1261,'København K')
        ,(1263,'København K')
        ,(1264,'København K')
        ,(1265,'København K')
        ,(1266,'København K')
        ,(1267,'København K')
        ,(1268,'København K')
        ,(1270,'København K')
        ,(1271,'København K')
        ,(1300,'København K')
        ,(1301,'København K')
        ,(1302,'København K')
        ,(1303,'København K')
        ,(1304,'København K')
        ,(1306,'København K')
        ,(1307,'København K')
        ,(1308,'København K')
        ,(1309,'København K')
        ,(1310,'København K')
        ,(1311,'København K')
        ,(1312,'København K')
        ,(1313,'København K')
        ,(1314,'København K')
        ,(1315,'København K')
        ,(1316,'København K')
        ,(1317,'København K')
        ,(1318,'København K')
        ,(1319,'København K')
        ,(1320,'København K')
        ,(1321,'København K')
        ,(1322,'København K')
        ,(1323,'København K')
        ,(1324,'København K')
        ,(1325,'København K')
        ,(1326,'København K')
        ,(1327,'København K')
        ,(1328,'København K')
        ,(1329,'København K')
        ,(1350,'København K')
        ,(1352,'København K')
        ,(1353,'København K')
        ,(1354,'København K')
        ,(1355,'København K')
        ,(1356,'København K')
        ,(1357,'København K')
        ,(1358,'København K')
        ,(1359,'København K')
        ,(1360,'København K')
        ,(1361,'København K')
        ,(1362,'København K')
        ,(1363,'København K')
        ,(1364,'København K')
        ,(1365,'København K')
        ,(1366,'København K')
        ,(1367,'København K')
        ,(1368,'København K')
        ,(1369,'København K')
        ,(1370,'København K')
        ,(1371,'København K')
        ,(1400,'København K')
        ,(1401,'København K')
        ,(1402,'København K')
        ,(1403,'København K')
        ,(1404,'København K')
        ,(1406,'København K')
        ,(1407,'København K')
        ,(1408,'København K')
        ,(1409,'København K')
        ,(1410,'København K')
        ,(1411,'København K')
        ,(1412,'København K')
        ,(1413,'København K')
        ,(1414,'København K')
        ,(1415,'København K')
        ,(1416,'København K')
        ,(1417,'København K')
        ,(1418,'København K')
        ,(1419,'København K')
        ,(1420,'København K')
        ,(1421,'København K')
        ,(1422,'København K')
        ,(1423,'København K')
        ,(1424,'København K')
        ,(1425,'København K')
        ,(1426,'København K')
        ,(1427,'København K')
        ,(1428,'København K')
        ,(1429,'København K')
        ,(1430,'København K')
        ,(1431,'København K')
        ,(1432,'København K')
        ,(1433,'København K')
        ,(1434,'København K')
        ,(1435,'København K')
        ,(1436,'København K')
        ,(1437,'København K')
        ,(1438,'København K')
        ,(1439,'København K')
        ,(1440,'København K')
        ,(1441,'København K')
        ,(1448,'København K')
        ,(1450,'København K')
        ,(1451,'København K')
        ,(1452,'København K')
        ,(1453,'København K')
        ,(1454,'København K')
        ,(1455,'København K')
        ,(1456,'København K')
        ,(1457,'København K')
        ,(1458,'København K')
        ,(1459,'København K')
        ,(1460,'København K')
        ,(1461,'København K')
        ,(1462,'København K')
        ,(1463,'København K')
        ,(1464,'København K')
        ,(1465,'København K')
        ,(1466,'København K')
        ,(1467,'København K')
        ,(1468,'København K')
        ,(1470,'København K')
        ,(1471,'København K')
        ,(1472,'København K')
        ,(1473,'København K')
        ,(1500,'København V')
        ,(1501,'København V')
        ,(1502,'København V')
        ,(1503,'København V')
        ,(1504,'København V')
        ,(1505,'København V')
        ,(1506,'København V')
        ,(1507,'København V')
        ,(1508,'København V')
        ,(1509,'København V')
        ,(1510,'København V')
        ,(1512,'København V')
        ,(1513,'København V')
        ,(1532,'København V')
        ,(1533,'København V')
        ,(1550,'København V')
        ,(1551,'København V')
        ,(1552,'København V')
        ,(1553,'København V')
        ,(1554,'København V')
        ,(1555,'København V')
        ,(1556,'København V')
        ,(1557,'København V')
        ,(1558,'København V')
        ,(1559,'København V')
        ,(1560,'København V')
        ,(1561,'København V')
        ,(1562,'København V')
        ,(1563,'København V')
        ,(1564,'København V')
        ,(1566,'København V')
        ,(1567,'København V')
        ,(1568,'København V')
        ,(1569,'København V')
        ,(1570,'København V')
        ,(1571,'København V')
        ,(1572,'København V')
        ,(1573,'København V')
        ,(1574,'København V')
        ,(1575,'København V')
        ,(1576,'København V')
        ,(1577,'København V')
        ,(1592,'København V')
        ,(1599,'København V')
        ,(1600,'København V')
        ,(1601,'København V')
        ,(1602,'København V')
        ,(1603,'København V')
        ,(1604,'København V')
        ,(1605,'København V')
        ,(1606,'København V')
        ,(1607,'København V')
        ,(1608,'København V')
        ,(1609,'København V')
        ,(1610,'København V')
        ,(1611,'København V')
        ,(1612,'København V')
        ,(1613,'København V')
        ,(1614,'København V')
        ,(1615,'København V')
        ,(1616,'København V')
        ,(1617,'København V')
        ,(1618,'København V')
        ,(1619,'København V')
        ,(1620,'København V')
        ,(1621,'København V')
        ,(1622,'København V')
        ,(1623,'København V')
        ,(1624,'København V')
        ,(1630,'København V')
        ,(1631,'København V')
        ,(1632,'København V')
        ,(1633,'København V')
        ,(1634,'København V')
        ,(1635,'København V')
        ,(1650,'København V')
        ,(1651,'København V')
        ,(1652,'København V')
        ,(1653,'København V')
        ,(1654,'København V')
        ,(1655,'København V')
        ,(1656,'København V')
        ,(1657,'København V')
        ,(1658,'København V')
        ,(1659,'København V')
        ,(1660,'København V')
        ,(1661,'København V')
        ,(1662,'København V')
        ,(1663,'København V')
        ,(1664,'København V')
        ,(1665,'København V')
        ,(1666,'København V')
        ,(1667,'København V')
        ,(1668,'København V')
        ,(1669,'København V')
        ,(1670,'København V')
        ,(1671,'København V')
        ,(1672,'København V')
        ,(1673,'København V')
        ,(1674,'København V')
        ,(1675,'København V')
        ,(1676,'København V')
        ,(1677,'København V')
        ,(1699,'København V')
        ,(1700,'København V')
        ,(1701,'København V')
        ,(1702,'København V')
        ,(1703,'København V')
        ,(1704,'København V')
        ,(1705,'København V')
        ,(1706,'København V')
        ,(1707,'København V')
        ,(1708,'København V')
        ,(1709,'København V')
        ,(1710,'København V')
        ,(1711,'København V')
        ,(1712,'København V')
        ,(1713,'København V')
        ,(1714,'København V')
        ,(1715,'København V')
        ,(1716,'København V')
        ,(1717,'København V')
        ,(1718,'København V')
        ,(1719,'København V')
        ,(1720,'København V')
        ,(1721,'København V')
        ,(1722,'København V')
        ,(1723,'København V')
        ,(1724,'København V')
        ,(1725,'København V')
        ,(1726,'København V')
        ,(1727,'København V')
        ,(1728,'København V')
        ,(1729,'København V')
        ,(1730,'København V')
        ,(1731,'København V')
        ,(1732,'København V')
        ,(1733,'København V')
        ,(1734,'København V')
        ,(1735,'København V')
        ,(1736,'København V')
        ,(1737,'København V')
        ,(1738,'København V')
        ,(1739,'København V')
        ,(1749,'København V')
        ,(1750,'København V')
        ,(1751,'København V')
        ,(1752,'København V')
        ,(1753,'København V')
        ,(1754,'København V')
        ,(1755,'København V')
        ,(1756,'København V')
        ,(1757,'København V')
        ,(1758,'København V')
        ,(1759,'København V')
        ,(1760,'København V')
        ,(1761,'København V')
        ,(1762,'København V')
        ,(1763,'København V')
        ,(1764,'København V')
        ,(1765,'København V')
        ,(1766,'København V')
        ,(1770,'København V')
        ,(1771,'København V')
        ,(1772,'København V')
        ,(1773,'København V')
        ,(1774,'København V')
        ,(1775,'København V')
        ,(1777,'København V')
        ,(1780,'København V')
        ,(1782,'København V')
        ,(1785,'København V')
        ,(1786,'København V')
        ,(1787,'København V')
        ,(1790,'København V')
        ,(1799,'København V')
        ,(1800,'Frederiksberg C')
        ,(1801,'Frederiksberg C')
        ,(1802,'Frederiksberg C')
        ,(1803,'Frederiksberg C')
        ,(1804,'Frederiksberg C')
        ,(1805,'Frederiksberg C')
        ,(1806,'Frederiksberg C')
        ,(1807,'Frederiksberg C')
        ,(1808,'Frederiksberg C')
        ,(1809,'Frederiksberg C')
        ,(1810,'Frederiksberg C')
        ,(1811,'Frederiksberg C')
        ,(1812,'Frederiksberg C')
        ,(1813,'Frederiksberg C')
        ,(1814,'Frederiksberg C')
        ,(1815,'Frederiksberg C')
        ,(1816,'Frederiksberg C')
        ,(1817,'Frederiksberg C')
        ,(1818,'Frederiksberg C')
        ,(1819,'Frederiksberg C')
        ,(1820,'Frederiksberg C')
        ,(1822,'Frederiksberg C')
        ,(1823,'Frederiksberg C')
        ,(1824,'Frederiksberg C')
        ,(1825,'Frederiksberg C')
        ,(1826,'Frederiksberg C')
        ,(1827,'Frederiksberg C')
        ,(1828,'Frederiksberg C')
        ,(1829,'Frederiksberg C')
        ,(1835,'Frederiksberg C')
        ,(1850,'Frederiksberg C')
        ,(1851,'Frederiksberg C')
        ,(1852,'Frederiksberg C')
        ,(1853,'Frederiksberg C')
        ,(1854,'Frederiksberg C')
        ,(1855,'Frederiksberg C')
        ,(1856,'Frederiksberg C')
        ,(1857,'Frederiksberg C')
        ,(1860,'Frederiksberg C')
        ,(1861,'Frederiksberg C')
        ,(1862,'Frederiksberg C')
        ,(1863,'Frederiksberg C')
        ,(1864,'Frederiksberg C')
        ,(1865,'Frederiksberg C')
        ,(1866,'Frederiksberg C')
        ,(1867,'Frederiksberg C')
        ,(1868,'Frederiksberg C')
        ,(1870,'Frederiksberg C')
        ,(1871,'Frederiksberg C')
        ,(1872,'Frederiksberg C')
        ,(1873,'Frederiksberg C')
        ,(1874,'Frederiksberg C')
        ,(1875,'Frederiksberg C')
        ,(1876,'Frederiksberg C')
        ,(1877,'Frederiksberg C')
        ,(1878,'Frederiksberg C')
        ,(1879,'Frederiksberg C')
        ,(1900,'Frederiksberg C')
        ,(1901,'Frederiksberg C')
        ,(1902,'Frederiksberg C')
        ,(1903,'Frederiksberg C')
        ,(1904,'Frederiksberg C')
        ,(1905,'Frederiksberg C')
        ,(1906,'Frederiksberg C')
        ,(1908,'Frederiksberg C')
        ,(1909,'Frederiksberg C')
        ,(1910,'Frederiksberg C')
        ,(1911,'Frederiksberg C')
        ,(1912,'Frederiksberg C')
        ,(1913,'Frederiksberg C')
        ,(1914,'Frederiksberg C')
        ,(1915,'Frederiksberg C')
        ,(1916,'Frederiksberg C')
        ,(1917,'Frederiksberg C')
        ,(1920,'Frederiksberg C')
        ,(1921,'Frederiksberg C')
        ,(1922,'Frederiksberg C')
        ,(1923,'Frederiksberg C')
        ,(1924,'Frederiksberg C')
        ,(1925,'Frederiksberg C')
        ,(1926,'Frederiksberg C')
        ,(1927,'Frederiksberg C')
        ,(1928,'Frederiksberg C')
        ,(1931,'Frederiksberg C')
        ,(1950,'Frederiksberg C')
        ,(1951,'Frederiksberg C')
        ,(1952,'Frederiksberg C')
        ,(1953,'Frederiksberg C')
        ,(1954,'Frederiksberg C')
        ,(1955,'Frederiksberg C')
        ,(1956,'Frederiksberg C')
        ,(1957,'Frederiksberg C')
        ,(1958,'Frederiksberg C')
        ,(1959,'Frederiksberg C')
        ,(1960,'Frederiksberg C')
        ,(1961,'Frederiksberg C')
        ,(1962,'Frederiksberg C')
        ,(1963,'Frederiksberg C')
        ,(1964,'Frederiksberg C')
        ,(1965,'Frederiksberg C')
        ,(1966,'Frederiksberg C')
        ,(1967,'Frederiksberg C')
        ,(1970,'Frederiksberg C')
        ,(1971,'Frederiksberg C')
        ,(1972,'Frederiksberg C')
        ,(1973,'Frederiksberg C')
        ,(1974,'Frederiksberg C')
        ,(2000,'Frederiksberg')
        ,(2100,'København Ø')
        ,(2150,'Nordhavn')
        ,(2200,'København N')
        ,(2300,'København S')
        ,(2400,'København NV')
        ,(2450,'København SV')
        ,(2500,'Valby')
        ,(2600,'Glostrup')
        ,(2605,'Brøndby')
        ,(2610,'Rødovre')
        ,(2620,'Albertslund')
        ,(2625,'Vallensbæk')
        ,(2630,'Taastrup')
        ,(2635,'Ishøj')
        ,(2640,'Hedehusene')
        ,(2650,'Hvidovre')
        ,(2660,'Brøndby Strand')
        ,(2665,'Vallensbæk Strand')
        ,(2670,'Greve')
        ,(2680,'Solrød Strand')
        ,(2690,'Karlslunde')
        ,(2700,'Brønshøj')
        ,(2720,'Vanløse')
        ,(2730,'Herlev')
        ,(2740,'Skovlunde')
        ,(2750,'Ballerup')
        ,(2760,'Måløv')
        ,(2765,'Smørum')
        ,(2770,'Kastrup')
        ,(2791,'Dragør')
        ,(2800,'Kongens Lyngby')
        ,(2820,'Gentofte')
        ,(2830,'Virum')
        ,(2840,'Holte')
        ,(2850,'Nærum')
        ,(2860,'Søborg')
        ,(2870,'Dyssegård')
        ,(2880,'Bagsværd')
        ,(2900,'Hellerup')
        ,(2920,'Charlottenlund')
        ,(2930,'Klampenborg')
        ,(2942,'Skodsborg')
        ,(2950,'Vedbæk')
        ,(2960,'Rungsted Kyst')
        ,(2970,'Hørsholm')
        ,(2980,'Kokkedal')
        ,(2990,'Nivå')
        ,(3000,'Helsingør')
        ,(3050,'Humlebæk')
        ,(3060,'Espergærde')
        ,(3070,'Snekkersten')
        ,(3080,'Tikøb')
        ,(3100,'Hornbæk')
        ,(3120,'Dronningmølle')
        ,(3140,'Ålsgårde')
        ,(3150,'Hellebæk')
        ,(3200,'Helsinge')
        ,(3210,'Vejby')
        ,(3220,'Tisvildeleje')
        ,(3230,'Græsted')
        ,(3250,'Gilleleje')
        ,(3300,'Frederiksværk')
        ,(3310,'Ølsted')
        ,(3320,'Skævinge')
        ,(3330,'Gørløse')
        ,(3360,'Liseleje')
        ,(3370,'Melby')
        ,(3390,'Hundested')
        ,(3400,'Hillerød')
        ,(3450,'Allerød')
        ,(3460,'Birkerød')
        ,(3480,'Fredensborg')
        ,(3490,'Kvistgård')
        ,(3500,'Værløse')
        ,(3520,'Farum')
        ,(3540,'Lynge')
        ,(3550,'Slangerup')
        ,(3600,'Frederikssund')
        ,(3630,'Jægerspris')
        ,(3650,'Ølstykke')
        ,(3660,'Stenløse')
        ,(3670,'Veksø Sjælland')
        ,(3700,'Rønne')
        ,(3720,'Aakirkeby')
        ,(3730,'Nexø')
        ,(3740,'Svaneke')
        ,(3751,'Østermarie')
        ,(3760,'Gudhjem')
        ,(3770,'Allinge')
        ,(3782,'Klemensker')
        ,(3790,'Hasle')
        ,(4000,'Roskilde')
        ,(4030,'Tune')
        ,(4040,'Jyllinge')
        ,(4050,'Skibby')
        ,(4060,'Kirke Såby')
        ,(4070,'Kirke Hyllinge')
        ,(4100,'Ringsted')
        ,(4129,'Ringsted')
        ,(4130,'Viby Sjælland')
        ,(4140,'Borup')
        ,(4160,'Herlufmagle')
        ,(4171,'Glumsø')
        ,(4173,'Fjenneslev')
        ,(4174,'Jystrup Midtsj')
        ,(4180,'Sorø')
        ,(4190,'Munke Bjergby')
        ,(4200,'Slagelse')
        ,(4220,'Korsør')
        ,(4230,'Skælskør')
        ,(4241,'Vemmelev')
        ,(4242,'Boeslunde')
        ,(4243,'Rude')
        ,(4244,'Agersø')
        ,(4245,'Omø')
        ,(4250,'Fuglebjerg')
        ,(4261,'Dalmose')
        ,(4262,'Sandved')
        ,(4270,'Høng')
        ,(4281,'Gørlev')
        ,(4291,'Ruds Vedby')
        ,(4293,'Dianalund')
        ,(4295,'Stenlille')
        ,(4296,'Nyrup')
        ,(4300,'Holbæk')
        ,(4305,'Orø')
        ,(4320,'Lejre')
        ,(4330,'Hvalsø')
        ,(4340,'Tølløse')
        ,(4350,'Ugerløse')
        ,(4360,'Kirke Eskilstrup')
        ,(4370,'Store Merløse')
        ,(4390,'Vipperød')
        ,(4400,'Kalundborg')
        ,(4420,'Regstrup')
        ,(4440,'Mørkøv')
        ,(4450,'Jyderup')
        ,(4460,'Snertinge')
        ,(4470,'Svebølle')
        ,(4480,'Store Fuglede')
        ,(4490,'Jerslev Sjælland')
        ,(4500,'Nykøbing S')
        ,(4520,'Svinninge')
        ,(4532,'Gislinge')
        ,(4534,'Hørve')
        ,(4540,'Fårevejle')
        ,(4550,'Asnæs')
        ,(4560,'Vig')
        ,(4571,'Grevinge')
        ,(4572,'Nørre Asmindrup')
        ,(4573,'Højby')
        ,(4581,'Rørvig')
        ,(4583,'Sjællands Odde')
        ,(4591,'Føllenslev')
        ,(4592,'Sejerø')
        ,(4593,'Eskebjerg')
        ,(4600,'Køge')
        ,(4621,'Gadstrup')
        ,(4622,'Havdrup')
        ,(4623,'Lille Skensved')
        ,(4632,'Bjæverskov')
        ,(4640,'Fakse')
        ,(4652,'Hårlev')
        ,(4653,'Karise')
        ,(4654,'Fakse Ladeplads')
        ,(4660,'Store Heddinge')
        ,(4671,'Strøby')
        ,(4672,'Klippinge')
        ,(4673,'Rødvig Stevns')
        ,(4681,'Herfølge')
        ,(4682,'Tureby')
        ,(4683,'Rønnede')
        ,(4684,'Holmegaard')
        ,(4690,'Haslev')
        ,(4700,'Næstved')
        ,(4720,'Præstø')
        ,(4733,'Tappernøje')
        ,(4735,'Mern')
        ,(4736,'Karrebæksminde')
        ,(4750,'Lundby')
        ,(4760,'Vordingborg')
        ,(4771,'Kalvehave')
        ,(4772,'Langebæk')
        ,(4773,'Stensved')
        ,(4780,'Stege')
        ,(4791,'Borre')
        ,(4792,'Askeby')
        ,(4793,'Bogø By')
        ,(4800,'Nykøbing F')
        ,(4840,'Nørre Alslev')
        ,(4850,'Stubbekøbing')
        ,(4862,'Guldborg')
        ,(4863,'Eskilstrup')
        ,(4871,'Horbelev')
        ,(4872,'Idestrup')
        ,(4873,'Væggerløse')
        ,(4874,'Gedser')
        ,(4880,'Nysted')
        ,(4891,'Toreby L')
        ,(4892,'Kettinge')
        ,(4894,'Øster Ulslev')
        ,(4895,'Errindlev')
        ,(4900,'Nakskov')
        ,(4912,'Harpelunde')
        ,(4913,'Horslunde')
        ,(4920,'Søllested')
        ,(4930,'Maribo')
        ,(4941,'Bandholm')
        ,(4942,'Askø og Lilleø')
        ,(4943,'Torrig L')
        ,(4944,'Fejø')
        ,(4945,'Femø')
        ,(4951,'Nørreballe')
        ,(4952,'Stokkemarke')
        ,(4953,'Vesterborg')
        ,(4960,'Holeby')
        ,(4970,'Rødby')
        ,(4983,'Dannemare')
        ,(4990,'Sakskøbing')
        ,(4992,'Midtsjælland USF P')
        ,(5000,'Odense C')
        ,(5029,'Odense C')
        ,(5100,'Odense C')
        ,(5200,'Odense V')
        ,(5210,'Odense NV')
        ,(5220,'Odense SØ')
        ,(5230,'Odense M')
        ,(5240,'Odense NØ')
        ,(5250,'Odense SV')
        ,(5260,'Odense S')
        ,(5270,'Odense N')
        ,(5290,'Marslev')
        ,(5300,'Kerteminde')
        ,(5320,'Agedrup')
        ,(5330,'Munkebo')
        ,(5350,'Rynkeby')
        ,(5370,'Mesinge')
        ,(5380,'Dalby')
        ,(5390,'Martofte')
        ,(5400,'Bogense')
        ,(5450,'Otterup')
        ,(5462,'Morud')
        ,(5463,'Harndrup')
        ,(5464,'Brenderup Fyn')
        ,(5466,'Asperup')
        ,(5471,'Søndersø')
        ,(5474,'Veflinge')
        ,(5485,'Skamby')
        ,(5491,'Blommenslyst')
        ,(5492,'Vissenbjerg')
        ,(5500,'Middelfart')
        ,(5540,'Ullerslev')
        ,(5550,'Langeskov')
        ,(5560,'Aarup')
        ,(5580,'Nørre Aaby')
        ,(5591,'Gelsted')
        ,(5592,'Ejby')
        ,(5600,'Faaborg')
        ,(5601,'Lyø')
        ,(5602,'Avernakø')
        ,(5603,'Bjørnø')
        ,(5610,'Assens')
        ,(5620,'Glamsbjerg')
        ,(5631,'Ebberup')
        ,(5642,'Millinge')
        ,(5672,'Broby')
        ,(5683,'Haarby')
        ,(5690,'Tommerup')
        ,(5700,'Svendborg')
        ,(5750,'Ringe')
        ,(5762,'Vester Skerninge')
        ,(5771,'Stenstrup')
        ,(5772,'Kværndrup')
        ,(5792,'Årslev')
        ,(5800,'Nyborg')
        ,(5853,'Ørbæk')
        ,(5854,'Gislev')
        ,(5856,'Ryslinge')
        ,(5863,'Ferritslev Fyn')
        ,(5871,'Frørup')
        ,(5874,'Hesselager')
        ,(5881,'Skårup Fyn')
        ,(5882,'Vejstrup')
        ,(5883,'Oure')
        ,(5884,'Gudme')
        ,(5892,'Gudbjerg Sydfyn')
        ,(5900,'Rudkøbing')
        ,(5932,'Humble')
        ,(5935,'Bagenkop')
        ,(5943,'Strynø')
        ,(5953,'Tranekær')
        ,(5960,'Marstal')
        ,(5965,'Birkholm')
        ,(5970,'Ærøskøbing')
        ,(5985,'Søby Ærø')
        ,(6000,'Kolding')
        ,(6040,'Egtved')
        ,(6051,'Almind')
        ,(6052,'Viuf')
        ,(6064,'Jordrup')
        ,(6070,'Christiansfeld')
        ,(6091,'Bjert')
        ,(6092,'Sønder Stenderup')
        ,(6093,'Sjølund')
        ,(6094,'Hejls')
        ,(6100,'Haderslev')
        ,(6200,'Aabenraa')
        ,(6210,'Barsø')
        ,(6230,'Rødekro')
        ,(6240,'Løgumkloster')
        ,(6261,'Bredebro')
        ,(6270,'Tønder')
        ,(6280,'Højer')
        ,(6300,'Gråsten')
        ,(6310,'Broager')
        ,(6320,'Egernsund')
        ,(6330,'Padborg')
        ,(6340,'Kruså')
        ,(6360,'Tinglev')
        ,(6372,'Bylderup Bov')
        ,(6392,'Bolderslev')
        ,(6400,'Sønderborg')
        ,(6430,'Nordborg')
        ,(6440,'Augustenborg')
        ,(6470,'Sydals')
        ,(6500,'Vojens')
        ,(6510,'Gram')
        ,(6520,'Toftlund')
        ,(6534,'Agerskov')
        ,(6535,'Branderup J')
        ,(6541,'Bevtoft')
        ,(6560,'Sommersted')
        ,(6580,'Vamdrup')
        ,(6600,'Vejen')
        ,(6621,'Gesten')
        ,(6622,'Bække')
        ,(6623,'Vorbasse')
        ,(6630,'Rødding')
        ,(6640,'Lunderskov')
        ,(6650,'Brørup')
        ,(6660,'Lintrup')
        ,(6670,'Holsted')
        ,(6682,'Hovborg')
        ,(6683,'Føvling')
        ,(6690,'Gørding')
        ,(6700,'Esbjerg')
        ,(6701,'Esbjerg')
        ,(6705,'Esbjerg Ø')
        ,(6710,'Esbjerg V')
        ,(6715,'Esbjerg N')
        ,(6720,'Fanø')
        ,(6731,'Tjæreborg')
        ,(6740,'Bramming')
        ,(6752,'Glejbjerg')
        ,(6753,'Agerbæk')
        ,(6760,'Ribe')
        ,(6771,'Gredstedbro')
        ,(6780,'Skærbæk')
        ,(6792,'Rømø')
        ,(6800,'Varde')
        ,(6818,'Årre')
        ,(6823,'Ansager')
        ,(6830,'Nørre Nebel')
        ,(6840,'Oksbøl')
        ,(6851,'Janderup Vestj')
        ,(6852,'Billum')
        ,(6853,'Vejers Strand')
        ,(6854,'Henne')
        ,(6855,'Outrup')
        ,(6857,'Blåvand')
        ,(6862,'Tistrup')
        ,(6870,'Ølgod')
        ,(6880,'Tarm')
        ,(6893,'Hemmet')
        ,(6900,'Skjern')
        ,(6920,'Videbæk')
        ,(6933,'Kibæk')
        ,(6940,'Lem St')
        ,(6950,'Ringkøbing')
        ,(6960,'Hvide Sande')
        ,(6971,'Spjald')
        ,(6973,'Ørnhøj')
        ,(6980,'Tim')
        ,(6990,'Ulfborg')
        ,(7000,'Fredericia')
        ,(7007,'Fredericia')
        ,(7017,'Taulov Pakkecenter')
        ,(7018,'Pakker TLP')
        ,(7029,'Fredericia')
        ,(7080,'Børkop')
        ,(7100,'Vejle')
        ,(7120,'Vejle Øst')
        ,(7130,'Juelsminde')
        ,(7140,'Stouby')
        ,(7150,'Barrit')
        ,(7160,'Tørring')
        ,(7171,'Uldum')
        ,(7173,'Vonge')
        ,(7182,'Bredsten')
        ,(7183,'Randbøl')
        ,(7184,'Vandel')
        ,(7190,'Billund')
        ,(7200,'Grindsted')
        ,(7250,'Hejnsvig')
        ,(7260,'Sønder Omme')
        ,(7270,'Stakroge')
        ,(7280,'Sønder Felding')
        ,(7300,'Jelling')
        ,(7321,'Gadbjerg')
        ,(7323,'Give')
        ,(7330,'Brande')
        ,(7361,'Ejstrupholm')
        ,(7362,'Hampen')
        ,(7400,'Herning')
        ,(7429,'Herning')
        ,(7430,'Ikast')
        ,(7441,'Bording')
        ,(7442,'Engesvang')
        ,(7451,'Sunds')
        ,(7470,'Karup J')
        ,(7480,'Vildbjerg')
        ,(7490,'Aulum')
        ,(7500,'Holstebro')
        ,(7540,'Haderup')
        ,(7550,'Sørvad')
        ,(7560,'Hjerm')
        ,(7570,'Vemb')
        ,(7600,'Struer')
        ,(7620,'Lemvig')
        ,(7650,'Bøvlingbjerg')
        ,(7660,'Bækmarksbro')
        ,(7673,'Harboøre')
        ,(7680,'Thyborøn')
        ,(7700,'Thisted')
        ,(7730,'Hanstholm')
        ,(7741,'Frøstrup')
        ,(7742,'Vesløs')
        ,(7752,'Snedsted')
        ,(7755,'Bedsted Thy')
        ,(7760,'Hurup Thy')
        ,(7770,'Vestervig')
        ,(7790,'Thyholm')
        ,(7800,'Skive')
        ,(7830,'Vinderup')
        ,(7840,'Højslev')
        ,(7850,'Stoholm Jyll')
        ,(7860,'Spøttrup')
        ,(7870,'Roslev')
        ,(7884,'Fur')
        ,(7900,'Nykøbing M')
        ,(7950,'Erslev')
        ,(7960,'Karby')
        ,(7970,'Redsted M')
        ,(7980,'Vils')
        ,(7990,'Øster Assels')
        ,(7992,'Sydjylland/Fyn USF P')
        ,(7993,'Sydjylland/Fyn USF B')
        ,(7996,'Fakturaservice')
        ,(7997,'Fakturascanning')
        ,(7998,'Statsservice')
        ,(7999,'Kommunepost')
        ,(8000,'Aarhus C')
        ,(8100,'Aarhus C')
        ,(8200,'Aarhus N')
        ,(8210,'Aarhus V')
        ,(8220,'Brabrand')
        ,(8229,'Risskov Ø')
        ,(8230,'Åbyhøj')
        ,(8240,'Risskov')
        ,(8245,'Risskov Ø')
        ,(8250,'Egå')
        ,(8260,'Viby J')
        ,(8270,'Højbjerg')
        ,(8300,'Odder')
        ,(8305,'Samsø')
        ,(8310,'Tranbjerg J')
        ,(8320,'Mårslet')
        ,(8330,'Beder')
        ,(8340,'Malling')
        ,(8350,'Hundslund')
        ,(8355,'Solbjerg')
        ,(8361,'Hasselager')
        ,(8362,'Hørning')
        ,(8370,'Hadsten')
        ,(8380,'Trige')
        ,(8381,'Tilst')
        ,(8382,'Hinnerup')
        ,(8400,'Ebeltoft')
        ,(8410,'Rønde')
        ,(8420,'Knebel')
        ,(8444,'Balle')
        ,(8450,'Hammel')
        ,(8462,'Harlev J')
        ,(8464,'Galten')
        ,(8471,'Sabro')
        ,(8472,'Sporup')
        ,(8500,'Grenaa')
        ,(8520,'Lystrup')
        ,(8530,'Hjortshøj')
        ,(8541,'Skødstrup')
        ,(8543,'Hornslet')
        ,(8544,'Mørke')
        ,(8550,'Ryomgård')
        ,(8560,'Kolind')
        ,(8570,'Trustrup')
        ,(8581,'Nimtofte')
        ,(8585,'Glesborg')
        ,(8586,'Ørum Djurs')
        ,(8592,'Anholt')
        ,(8600,'Silkeborg')
        ,(8620,'Kjellerup')
        ,(8632,'Lemming')
        ,(8641,'Sorring')
        ,(8643,'Ans By')
        ,(8653,'Them')
        ,(8654,'Bryrup')
        ,(8660,'Skanderborg')
        ,(8670,'Låsby')
        ,(8680,'Ry')
        ,(8700,'Horsens')
        ,(8721,'Daugård')
        ,(8722,'Hedensted')
        ,(8723,'Løsning')
        ,(8732,'Hovedgård')
        ,(8740,'Brædstrup')
        ,(8751,'Gedved')
        ,(8752,'Østbirk')
        ,(8762,'Flemming')
        ,(8763,'Rask Mølle')
        ,(8765,'Klovborg')
        ,(8766,'Nørre Snede')
        ,(8781,'Stenderup')
        ,(8783,'Hornsyld')
        ,(8789,'Endelave')
        ,(8799,'Tunø')
        ,(8800,'Viborg')
        ,(8830,'Tjele')
        ,(8831,'Løgstrup')
        ,(8832,'Skals')
        ,(8840,'Rødkærsbro')
        ,(8850,'Bjerringbro')
        ,(8860,'Ulstrup')
        ,(8870,'Langå')
        ,(8881,'Thorsø')
        ,(8882,'Fårvang')
        ,(8883,'Gjern')
        ,(8900,'Randers C')
        ,(8920,'Randers NV')
        ,(8930,'Randers NØ')
        ,(8940,'Randers SV')
        ,(8950,'Ørsted')
        ,(8960,'Randers SØ')
        ,(8961,'Allingåbro')
        ,(8963,'Auning')
        ,(8970,'Havndal')
        ,(8981,'Spentrup')
        ,(8983,'Gjerlev J')
        ,(8990,'Fårup')
        ,(9000,'Aalborg')
        ,(9029,'Aalborg')
        ,(9100,'Aalborg')
        ,(9200,'Aalborg SV')
        ,(9210,'Aalborg SØ')
        ,(9220,'Aalborg Øst')
        ,(9230,'Svenstrup J')
        ,(9240,'Nibe')
        ,(9260,'Gistrup')
        ,(9270,'Klarup')
        ,(9280,'Storvorde')
        ,(9293,'Kongerslev')
        ,(9300,'Sæby')
        ,(9310,'Vodskov')
        ,(9320,'Hjallerup')
        ,(9330,'Dronninglund')
        ,(9340,'Asaa')
        ,(9352,'Dybvad')
        ,(9362,'Gandrup')
        ,(9370,'Hals')
        ,(9380,'Vestbjerg')
        ,(9381,'Sulsted')
        ,(9382,'Tylstrup')
        ,(9400,'Nørresundby')
        ,(9430,'Vadum')
        ,(9440,'Aabybro')
        ,(9460,'Brovst')
        ,(9480,'Løkken')
        ,(9490,'Pandrup')
        ,(9492,'Blokhus')
        ,(9493,'Saltum')
        ,(9500,'Hobro')
        ,(9510,'Arden')
        ,(9520,'Skørping')
        ,(9530,'Støvring')
        ,(9541,'Suldrup')
        ,(9550,'Mariager')
        ,(9560,'Hadsund')
        ,(9574,'Bælum')
        ,(9575,'Terndrup')
        ,(9600,'Aars')
        ,(9610,'Nørager')
        ,(9620,'Aalestrup')
        ,(9631,'Gedsted')
        ,(9632,'Møldrup')
        ,(9640,'Farsø')
        ,(9670,'Løgstør')
        ,(9681,'Ranum')
        ,(9690,'Fjerritslev')
        ,(9700,'Brønderslev')
        ,(9740,'Jerslev J')
        ,(9750,'Øster Vrå')
        ,(9760,'Vrå')
        ,(9800,'Hjørring')
        ,(9830,'Tårs')
        ,(9850,'Hirtshals')
        ,(9870,'Sindal')
        ,(9881,'Bindslev')
        ,(9900,'Frederikshavn')
        ,(9940,'Læsø')
        ,(9970,'Strandby')
        ,(9981,'Jerup')
        ,(9982,'Ålbæk')
        ,(9990,'Skagen')
        ,(9992,'Jylland USF P')
        ,(9993,'Jylland USF B')
        ,(9996,'Fakturaservice')
        ,(9997,'Fakturascanning')
        ,(9998,'Borgerservice')
        ,(2412,'Santa Claus/Julemanden')
        ,(3900,'Nuuk')
        ,(3905,'Nuussuaq')
        ,(3910,'Kangerlussuaq')
        ,(3911,'Sisimiut')
        ,(3912,'Maniitsoq')
        ,(3913,'Tasiilaq')
        ,(3915,'Kulusuk')
        ,(3919,'Alluitsup Paa')
        ,(3920,'Qaqortoq')
        ,(3921,'Narsaq')
        ,(3922,'Nanortalik')
        ,(3923,'Narsarsuaq')
        ,(3924,'Ikerasassuaq')
        ,(3930,'Kangilinnguit')
        ,(3932,'Arsuk')
        ,(3940,'Paamiut')
        ,(3950,'Aasiaat')
        ,(3951,'Qasigiannguit')
        ,(3952,'Ilulissat')
        ,(3953,'Qeqertarsuaq')
        ,(3955,'Kangaatsiaq')
        ,(3961,'Uummannaq')
        ,(3962,'Upernavik')
        ,(3964,'Qaarsut')
        ,(3970,'Pituffik')
        ,(3971,'Qaanaaq')
        ,(3972,'Staon Nord')
        ,(3980,'Ioqqortoormiit')
        ,(3982,'Mestersvig')
        ,(3984,'Danmarkshavn')
        ,(3985,'Constable Pynt')
        ,(3992,'Slædepatruljen Sirius')
        ,(100,'Tórshavn')
        ,(110,'Tórshavn')
        ,(160,'Argir')
        ,(165,'Argir')
        ,(175,'Kirkjubøur')
        ,(176,'Velbastadur')
        ,(177,'Sydradalur, Streymoy')
        ,(178,'Nordradalur')
        ,(180,'Kaldbak')
        ,(185,'Kaldbaksbotnur')
        ,(186,'Sund')
        ,(187,'Hvitanes')
        ,(188,'Hoyvík')
        ,(210,'Sandur')
        ,(215,'Sandur')
        ,(220,'Skálavík')
        ,(230,'Húsavík')
        ,(235,'Dalur')
        ,(236,'Skarvanes')
        ,(240,'Skopun')
        ,(260,'Skúvoy')
        ,(270,'Nólsoy')
        ,(280,'Hestur')
        ,(285,'Koltur')
        ,(286,'Stóra Dimun')
        ,(330,'Stykkid')
        ,(335,'Leynar')
        ,(336,'Skællingur')
        ,(340,'Kvívík')
        ,(350,'Vestmanna')
        ,(355,'Vestmanna')
        ,(358,'Válur')
        ,(360,'Sandavágur')
        ,(370,'Midvágur')
        ,(375,'Midvágur')
        ,(380,'Sørvágur')
        ,(385,'Vatnsoyrar')
        ,(386,'Bøur')
        ,(387,'Gásadalur')
        ,(388,'Mykines')
        ,(400,'Oyrarbakki')
        ,(405,'Oyrarbakki')
        ,(410,'Kollafjørdur')
        ,(415,'Oyrareingir')
        ,(416,'Signabøur')
        ,(420,'Hósvík')
        ,(430,'Hvalvík')
        ,(435,'Streymnes')
        ,(436,'Saksun')
        ,(437,'Nesvík')
        ,(438,'Langasandur')
        ,(440,'Haldarsvík')
        ,(445,'Tjørnuvík')
        ,(450,'Oyri')
        ,(460,'Nordskáli')
        ,(465,'Svináir')
        ,(466,'Ljósá')
        ,(470,'Eidi')
        ,(475,'Funningur')
        ,(476,'Gjógv')
        ,(477,'Funningsfjørdur')
        ,(478,'Elduvík')
        ,(480,'Skáli')
        ,(485,'Skálafjørdur')
        ,(490,'Strendur')
        ,(494,'Innan Glyvur')
        ,(495,'Kolbanargjógv')
        ,(496,'Morskranes')
        ,(497,'Selatrad')
        ,(510,'Gøta')
        ,(511,'Gøtugjógv')
        ,(512,'Nordragøta')
        ,(513,'Sydrugøta')
        ,(515,'Gøta')
        ,(520,'Leirvík')
        ,(530,'Fuglafjørdur')
        ,(535,'Fuglafjørdur')
        ,(600,'Saltangará')
        ,(610,'Saltangará')
        ,(620,'Runavík')
        ,(625,'Glyvrar')
        ,(626,'Lambareidi')
        ,(627,'Lambi')
        ,(640,'Rituvík')
        ,(645,'Æduvík')
        ,(650,'Toftir')
        ,(655,'Nes, Eysturoy')
        ,(656,'Saltnes')
        ,(660,'Søldarfjørdur')
        ,(665,'Skipanes')
        ,(666,'Gøtueidi')
        ,(690,'Oyndarfjørdur')
        ,(695,'Hellur')
        ,(700,'Klaksvík')
        ,(710,'Klaksvík')
        ,(725,'Nordoyri')
        ,(726,'Ánir')
        ,(727,'Árnafjørdur')
        ,(730,'Norddepil')
        ,(735,'Depil')
        ,(736,'Nordtoftir')
        ,(737,'Múli')
        ,(740,'Hvannasund')
        ,(750,'Vidareidi')
        ,(765,'Svinoy')
        ,(766,'Kirkja')
        ,(767,'Hattarvík')
        ,(780,'Kunoy')
        ,(785,'Haraldssund')
        ,(795,'Sydradalur, Kalsoy')
        ,(796,'Húsar')
        ,(797,'Mikladalur')
        ,(798,'Trøllanes')
        ,(800,'Tvøroyri')
        ,(810,'Tvøroyri')
        ,(825,'Frodba')
        ,(826,'Trongisvágur')
        ,(827,'Øravík')
        ,(850,'Hvalba')
        ,(860,'Sandvík')
        ,(870,'Fámjin')
        ,(900,'Vágur')
        ,(910,'Vágur')
        ,(925,'Nes, Vágur')
        ,(926,'Lopra')
        ,(927,'Akrar')
        ,(928,'Vikarbyrgi')
        ,(950,'Porkeri')
        ,(960,'Hov')
        ,(970,'Sumba');


        -- Insert BasicPageInfo
        INSERT INTO BasicPageInfo
        VALUES (11223344, 'uploads/rubberducklogo.png', 'Rubber Duck', 'This is the about us text.', 'r@rasmusandreas.dk', 11223344, 'Kongensgade', '58C', 'sk_test_YZzzQg82HA6EdEV0aEDmlWzS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6700);

        -- Insert Frontslides
        INSERT INTO FrontSlider
        VALUES (NULL, 'Save 50% on all sports related ducks!', 'Sports sale!', 'Go to products', 'products.php?cat=3', 'http://via.placeholder.com/1920x1080', 'rasmus.andreas96@gmail.com');

        INSERT INTO FrontSlider
        VALUES (NULL, 'Save 25% on all superhero related ducks!', 'Hero sale!', 'Go to products', 'products.php?cat=2', 'http://via.placeholder.com/1920x1080', 'rasmus.andreas96@gmail.com');

        INSERT INTO FrontSlider
        VALUES (NULL, 'Save 75% on the yellow ducks!', 'Yellow duck sale!', 'Go to product', 'product.php?item=1113', 'http://via.placeholder.com/1920x1080', 'rasmus.andreas96@gmail.com');

        -- Insert orderstatus
        INSERT INTO OrderStatus
        VALUES (NULL, 'Awaiting');

        INSERT INTO OrderStatus
        VALUES (NULL, 'In progress');

        INSERT INTO OrderStatus
        VALUES (NULL, 'Sent');

        INSERT INTO OrderStatus
        VALUES (NULL, 'Delivered');

        -- Insert PromoCode
        INSERT INTO PromoCode
        VALUES ('virker', 50, '2009-11-11', '2020-11-11', 100, 'rasmus.andreas96@gmail.com');

        INSERT INTO PromoCode
        VALUES ('gammel', 50, '2009-11-11', '2009-12-11', 100, 'rasmus.andreas96@gmail.com');

        INSERT INTO PromoCode
        VALUES ('ny', 50, '2020-11-11', '2020-12-11', 100, 'rasmus.andreas96@gmail.com');

        INSERT INTO PromoCode
        VALUES ('ingendato', 50, NULL, NULL, 100, 'rasmus.andreas96@gmail.com');

        INSERT INTO PromoCode
        VALUES ('intetantal', 50, '2009-11-11', '2020-11-11', NULL, 'rasmus.andreas96@gmail.com');

        INSERT INTO Hours
        VALUES (NULL, '9:00', '17:00', 'Weekdays');

        INSERT INTO Hours
        VALUES (NULL, '10:00', '14:00', 'Weekends');
");
        $handle->execute();

        DB::close();
    }
    catch(\PDOException $ex) {
        //print($ex->getMessage());
    }
  }

  createDBtables();
  header('Location: usercreate.php');

} else {
  header('Location: ../index.php');
}
?>
