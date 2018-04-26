DROP DATABASE IF EXISTS rasmusandreas_dk_db3;
CREATE DATABASE rasmusandreas_dk_db3;
USE rasmusandreas_dk_db3;

-- Create tables
CREATE TABLE ZipCode (
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
  DiscoutAmount int(2) NOT NULL,
  StartDate TIMESTAMP NULL,
  EndDate TIMESTAMP NULL,
  NumberOfUses int NULL,
  UserEmail varchar(255) NOT NULL -- Foreign Key, set later
);

CREATE TABLE Page (
  PageID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  Title varchar(255) NOT NULL,
  SeoTitle varchar(255) NULL,
  Metadescription varchar(255) NULL,
  PageContent varchar(255) NOT NULL,
  UserEmail varchar(255) NOT NULL -- Foreign Key, set later
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
  ZipCode int(20) NOT NULL -- Foreign Key, set later
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
  UserEmail varchar(255) NOT NULL, -- Foreign Key, set later
  ProductCategoryID int NOT NULL -- Foreign Key, set later
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
  ItemNumber varchar(255) NOT NULL -- Foreign Key, set later
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
  ZipCode int(20) NULL -- Foreign Key, set later
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
  Description varchar(255) NULL,
  SeoTitle varchar(255) NULL,
  MetaDescription varchar(255) NULL
);

CREATE TABLE CustomerOrder (
  OrderNumber int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  Comment varchar(255) NULL,
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
  OrderMessage varchar(255) NOT NULL,
  OrderMessageDate TIMESTAMP NOT NULL,
  OrderNumber int NOT NULL -- Foreign Key, set later
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

-- Add foreign keys
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

-- Many-to-many relations
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
);

-- Add test data below

-- Insert Product Categories
INSERT INTO ProductCategory
VALUES (NULL, "Normal Ducks", "This is the first description", "SeoTitle for Cat1", "This is the Metadescription for category 1");

INSERT INTO ProductCategory
VALUES (NULL, "SuperHero Ducks", "This is the Second description", "SeoTitle for Cat2", "This is the Metadescription for category 2");

INSERT INTO ProductCategory
VALUES (NULL, "Sport Ducks", "This is the Third description", "SeoTitle for Cat3", "This is the Metadescription for category 3");

-- Insert Users
INSERT INTO User
VALUES ("rasmus.andreas96@gmail.com", "$2a$10$74zsjq9/Tv6Ydq.QLlKeju.bwxXfs8GUSN051E1EeMIi4L/beo1Li", "Rasmus Andreas", "Nielsen");

-- Insert Products
INSERT INTO Product
VALUES ("1111", "Green Duck", 1000, "Short Description of Green Duck", "Longer Description Green Duck",
10, NULL, NULL, NULL, true, "2018-4-1", "rasmus.andreas96@gmail.com", 1);

INSERT INTO Product
VALUES ("1112", "Red Duck", 1000, "Short Description of Red Duck", "Longer Description Red Duck",
18, NULL, NULL, NULL, true, "2018-4-2", "rasmus.andreas96@gmail.com", 1);

INSERT INTO Product
VALUES ("1113", "Yellow Duck", 1000, "Short Description of Yellow Duck", "Longer Description Yellow Duck",
8, NULL, NULL, NULL, true, "2017-4-3", "rasmus.andreas96@gmail.com", 1);

INSERT INTO Product
VALUES ("2221", "Batman Duck", 50, "Short Description of Batman Duck", "Longer Description Batman Duck",
10, NULL, NULL, NULL, true, "2016-4-4", "rasmus.andreas96@gmail.com", 2);

INSERT INTO Product
VALUES ("2222", "Deadpool Duck", 49, "Short Description of Deadpool Duck", "Longer Description Deadpool Duck",
12, NULL, NULL, NULL, true, "2018-11-5", "rasmus.andreas96@gmail.com", 2);

INSERT INTO Product
VALUES ("3331", "EfB Duck", 1000, "Short Description of EfB Duck", "Longer Description EfB Duck",
15, NULL, NULL, NULL, true, "2012-12-24", "rasmus.andreas96@gmail.com", 3);

INSERT INTO Product
VALUES ("3332", "Chelsea Duck", 2, "Short Description of Chelsea Duck", "Longer Description Chelsea Duck",
20, NULL, NULL, NULL, true, "2018-1-15", "rasmus.andreas96@gmail.com", 3);

INSERT INTO Product
VALUES ("3333", "United Duck", 1000, "Short Description of United Duck", "Longer Description United Duck",
25, NULL, NULL, NULL, true, "2014-9-20", "rasmus.andreas96@gmail.com", 3);

INSERT INTO Product
VALUES ("3334", "Arsenal Duck", 1000, "Short Description of Arsenal Duck", "Longer Description Arsenal Duck",
25, NULL, NULL, NULL, true, "2018-4-10", "rasmus.andreas96@gmail.com", 3);

INSERT INTO Product
VALUES ("3335", "Liverpool Duck", 10, "Short Description of Liverpool Duck", "Longer Description Liverpool Duck",
22, NULL, NULL, NULL, false, "2008-5-20", "rasmus.andreas96@gmail.com", 3);

-- Insert Reviews
INSERT INTO Review
VALUES (NULL, "2008-11-11 13:23:44", 3, "ReviewTitle", "ReviewersName", "This is the review content", "1111");

INSERT INTO Review
VALUES (NULL, "2008-11-11 13:23:44", 4, "ReviewTitle", "ReviewersName", "This is the review content", "1111");

INSERT INTO Review
VALUES (NULL, "2008-11-11 13:23:44", 4, "ReviewTitle", "ReviewersName", "This is the review content", "1111");

INSERT INTO Review
VALUES (NULL, "2008-11-11 13:23:44", 5, "ReviewTitle", "ReviewersName", "This is the review content", "1111");

INSERT INTO Review
VALUES (NULL, "2008-11-11 13:23:44", 3, "ReviewTitle", "ReviewersName", "This is the review content", "1112");

INSERT INTO Review
VALUES (NULL, "2008-11-11 13:23:44", 4, "ReviewTitle", "ReviewersName", "This is the review content", "1113");

INSERT INTO Review
VALUES (NULL, "2008-11-11 13:23:44", 5, "ReviewTitle", "ReviewersName", "This is the review content", "2221");

INSERT INTO Review
VALUES (NULL, "2008-11-11 13:23:44", 4, "ReviewTitle", "ReviewersName", "This is the review content", "2222");

INSERT INTO Review
VALUES (NULL, "2008-11-11 13:23:44", 5, "ReviewTitle", "ReviewersName", "This is the review content", "3331");

INSERT INTO Review
VALUES (NULL, "2008-11-11 13:23:44", 5, "ReviewTitle", "ReviewersName", "This is the review content", "3332");

INSERT INTO Review
VALUES (NULL, "2008-11-11 13:23:44", 1, "ReviewTitle", "ReviewersName", "This is the review content", "3333");

INSERT INTO Review
VALUES (NULL, "2008-11-11 13:23:44", 1, "ReviewTitle", "ReviewersName", "This is the review content", "3334");

INSERT INTO Review
VALUES (NULL, "2008-11-11 13:23:44", 1, "ReviewTitle", "ReviewersName", "This is the review content", "3335");

-- Insert ImgGallery
INSERT INTO ImgGallery
VALUES (NULL, "http://via.placeholder.com/200x200");

INSERT INTO ImgGallery
VALUES (NULL, "http://via.placeholder.com/400x400");

INSERT INTO ImgGallery
VALUES (NULL, "http://via.placeholder.com/600x600");

INSERT INTO ImgGallery
VALUES (NULL, "http://via.placeholder.com/800x800");

INSERT INTO ImgGallery
VALUES (NULL, "http://via.placeholder.com/1920x1080");

INSERT INTO ImgGallery
VALUES (NULL, "http://via.placeholder.com/800x800");

-- Insert ProductImg
INSERT INTO ProductImg
VALUES ("1111", 1, true);

INSERT INTO ProductImg
VALUES ("1111", 6, false);

INSERT INTO ProductImg
VALUES ("1112", 2, true);

INSERT INTO ProductImg
VALUES ("1113", 3, true);

INSERT INTO ProductImg
VALUES ("2221", 4, true);

INSERT INTO ProductImg
VALUES ("2222", 2, true);

INSERT INTO ProductImg
VALUES ("3331", 2, true);

INSERT INTO ProductImg
VALUES ("3332", 2, true);

INSERT INTO ProductImg
VALUES ("3333", 2, true);

INSERT INTO ProductImg
VALUES ("3334", 2, true);

INSERT INTO ProductImg
VALUES ("3335", 2, true);

-- Insert DeliveryMethods
INSERT INTO DeliveryMethod
VALUES (NULL, "Shipping to postoffice", "This is the description for the shipping to postoffice", 5);

INSERT INTO DeliveryMethod
VALUES (NULL, "Shipping to home address", "This is the description for the shipping to home address", 8);

INSERT INTO DeliveryMethod
VALUES (NULL, "Express shipping", "This is the description for the Express shipping", 15);

-- Insert BlogCategories
INSERT INTO BlogCategory
VALUES (NULL, "Company News", "Here you will find some of our company news.", "SeoTitle", "MetaDescription");

INSERT INTO BlogCategory
VALUES (NULL, "Top 10s", "Here you will find top 10s lists", "SeoTitle", "MetaDescription");

-- Insert BlogPosts
INSERT INTO BlogPost
VALUES (NULL, "New employee", "SeoTitle", "MetaDescription", "This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee", "2008-12-12 15:23:44", "rasmus.andreas96@gmail.com", 1, NULL);

INSERT INTO BlogPost
VALUES (NULL, "Top 10 sports rubber ducks", "SeoTitle", "MetaDescription", "This is blogcontent for the post Top 10 sports rubber ducks This is blogcontent for the post Top 10 sports rubber ducks This is blogcontent for the post Top 10 sports rubber ducksThis is blogcontent for the post Top 10 sports rubber ducks This is blogcontent for the post Top 10 sports rubber ducks This is blogcontent for the post Top 10 sports rubber ducks This is blogcontent for the post Top 10 sports rubber ducks This is blogcontent for the post Top 10 sports rubber ducks This is blogcontent for the post Top 10 sports rubber ducks ", "2008-10-10 09:23:44", "rasmus.andreas96@gmail.com", 2, 3);

INSERT INTO BlogPost
VALUES (NULL, "Another new employee", "SeoTitle", "MetaDescription", "This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee This is blogcontent for the post new employee", "2008-11-11 10:23:44", "rasmus.andreas96@gmail.com", 1, NULL);

INSERT INTO BlogPost
VALUES (NULL, "Top 10 rubber ducks", "SeoTitle", "MetaDescription", "This is blogcontent for the post Top 10 rubber ducks This is blogcontent for the post Top 10 rubber ducks This is blogcontent for the post Top 10 rubber ducks This is blogcontent for the post Top 10 rubber ducks This is blogcontent for the post Top 10 rubber ducks This is blogcontent for the post Top 10 rubber ducks This is blogcontent for the post Top 10 rubber ducks This is blogcontent for the post Top 10 rubber ducks This is blogcontent for the post Top 10 rubber ducks", "2008-01-26 22:23:44", "rasmus.andreas96@gmail.com", 2, 1);

-- Insert BlogImg
INSERT INTO BlogImg
VALUES (1,5, true);

INSERT INTO BlogImg
VALUES (2,5, true);

-- insert zipcodes and cities
INSERT INTO ZipCode
VALUES (6700, "Esbjerg");

-- Insert BasicPageInfo
INSERT INTO BasicPageInfo
VALUES (11223344, "uploads/rubberducklogo.png", "Rubber Duck", 25, "This is the about us text.", "r@rasmusandreas.dk", 11223344, "Kongensgade", "58C", 6700);

-- Insert Frontslides
INSERT INTO FrontSlider
VALUES (NULL, "Save 50% on all sports related ducks!", "Sports sale!", "Go to products", "products.php?cat=3", "http://via.placeholder.com/1920x1080", "rasmus.andreas96@gmail.com");

INSERT INTO FrontSlider
VALUES (NULL, "Save 25% on all superhero related ducks!", "Hero sale!", "Go to products", "products.php?cat=2", "http://via.placeholder.com/1920x1080", "rasmus.andreas96@gmail.com");

INSERT INTO FrontSlider
VALUES (NULL, "Save 75% on the yellow ducks!", "Yellow duck sale!", "Go to product", "product.php?item=1113", "http://via.placeholder.com/1920x1080", "rasmus.andreas96@gmail.com");

-- Insert Customer
INSERT INTO Customer
VALUES ("rasmus.andreas96@gmail.com", "$2a$10$74zsjq9/Tv6Ydq.QLlKeju.bwxXfs8GUSN051E1EeMIi4L/beo1Li", NULL, NULL, NULL, "Rasmus Andreas", "Nielsen", NULL);

INSERT INTO Customer
VALUES ("sebastiankbuch@hotmail.com", "$2a$10$QMmK4nTUF6szqmNG3t8V/uTu5BM7ejLvaRSN7aUFoxJY4hsvzYBhO", NULL, NULL, NULL, "Sebastian", "Buch", NULL);

INSERT INTO Customer
VALUES ("post@jdanet.dk", "$2a$10$QMmK4nTUF6szqmNG3t8V/uTu5BM7ejLvaRSN7aUFoxJY4hsvzYBhO", NULL, NULL, NULL, "Jesper", "Dalsgaard", NULL);

-- Insert orderstatus
INSERT INTO OrderStatus
VALUES (NULL, "Awaiting");

INSERT INTO OrderStatus
VALUES (NULL, "In progress");

INSERT INTO OrderStatus
VALUES (NULL, "Sent");

INSERT INTO OrderStatus
VALUES (NULL, "Delivered");

-- Insert orders
INSERT INTO CustomerOrder
VALUES (NULL, "This is a order comment", "2009-11-11 13:23:44", "Spangsbjerg Kirkevej", "99B, 16", 6700, "rasmus.andreas96@gmail.com", 1, 2, NULL);

INSERT INTO CustomerOrder
VALUES (NULL, "This is a order comment", "2008-11-11 13:23:44", "Nørregade", "30", 6700, "rasmus.andreas96@gmail.com", 3, 1, NULL);

INSERT INTO CustomerOrder
VALUES (NULL, "This is a order comment", "2010-11-11 13:23:44", "Spangsbjerg Kirkevej", "99B, 16", 6700, "sebastiankbuch@hotmail.com", 1, 2, NULL);

INSERT INTO CustomerOrder
VALUES (NULL, "This is a order comment", "2005-11-11 13:23:44", "Nørregade", "30", 6700, "sebastiankbuch@hotmail.com", 3, 1, NULL);

INSERT INTO CustomerOrder
VALUES (NULL, "This is a order comment", "2012-11-11 13:23:44", "Spangsbjerg Kirkevej", "99B, 16", 6700, "post@jdanet.dk", 1, 2, NULL);

INSERT INTO CustomerOrder
VALUES (NULL, "This is a order comment", "2017-11-11 13:23:44", "Nørregade", "30", 6700, "post@jdanet.dk", 3, 1, NULL);

-- Insert orderdetails
INSERT INTO OrderDetails
VALUES (1, "1111", 1);

INSERT INTO OrderDetails
VALUES (1, "3331", 3);

INSERT INTO OrderDetails
VALUES (1, "3332", 3);

INSERT INTO OrderDetails
VALUES (1, "2221", 1);

INSERT INTO OrderDetails
VALUES (1, "2222", 2);

INSERT INTO OrderDetails
VALUES (2, "1111", 1);

INSERT INTO OrderDetails
VALUES (2, "3331", 4);

INSERT INTO OrderDetails
VALUES (2, "3332", 1);

INSERT INTO OrderDetails
VALUES (3, "1111", 1);

INSERT INTO OrderDetails
VALUES (3, "3331", 3);

INSERT INTO OrderDetails
VALUES (3, "3332", 3);

INSERT INTO OrderDetails
VALUES (3, "2221", 1);

INSERT INTO OrderDetails
VALUES (3, "2222", 2);

INSERT INTO OrderDetails
VALUES (4, "1111", 1);

INSERT INTO OrderDetails
VALUES (4, "3331", 4);

INSERT INTO OrderDetails
VALUES (4, "3332", 1);

INSERT INTO OrderDetails
VALUES (5, "1111", 1);

INSERT INTO OrderDetails
VALUES (5, "3331", 3);

INSERT INTO OrderDetails
VALUES (5, "3332", 3);

INSERT INTO OrderDetails
VALUES (5, "2221", 1);

INSERT INTO OrderDetails
VALUES (5, "2222", 2);

INSERT INTO OrderDetails
VALUES (6, "1111", 1);

INSERT INTO OrderDetails
VALUES (6, "3331", 4);

INSERT INTO OrderDetails
VALUES (6, "3332", 1);

INSERT INTO OrderMessage
VALUES (NULL, "Some dumb message", "2009-11-11 15:23:44", 1);

INSERT INTO OrderMessage
VALUES (NULL, "Another dumb message", "2009-11-11 17:23:44", 1);

INSERT INTO OrderMessage
VALUES (NULL, "Another dumb message", "2009-11-11 17:23:44", 2);
