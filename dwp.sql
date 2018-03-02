DROP DATABASE IF EXISTS dwp;
CREATE DATABASE dwp;
USE dwp;

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
  StartDate varchar(255) NULL,
  EndDate varchar(255) NULL,
  NumberOfUses int NULL,
  UserEmail varchar(255) NOT NULL -- Foreign Key, set later
);

CREATE TABLE Page (
  PageID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  Titel varchar(255) NOT NULL,
  SeoTitel varchar(255) NULL,
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
  SeoTitel varchar(255) NULL,
  MetaDescription varchar(255) NULL,
  UserEmail varchar(255) NOT NULL, -- Foreign Key, set later
  ProductCategoryID int NOT NULL -- Foreign Key, set later
);

CREATE TABLE User (
  UserEmail varchar(255) NOT NULL PRIMARY KEY,
  Password varchar(255) NOT NULL
);

CREATE TABLE Review (
  ReviewID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  ReviewDate varchar(255) NOT NULL,
  Rating int(1) NOT NULL,
  ReviewTitel varchar(255) NOT NULL,
  ReviewName varchar(255) NULL,
  ReviewContent varchar(255) NULL,
  ItemNumber varchar(255) NOT NULL -- Foreign Key, set later
);

CREATE TABLE ProductCategory (
  ProductCategoryID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  CategoryName varchar(255) NOT NULL,
  Description varchar(255) NULL,
  SeoTitel varchar(255) NULL,
  MetaDescription varchar(255) NULL
);

CREATE TABLE ImgGallery (
  ImgID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  URL varchar(255) NOT NULL,
  IsPrimary boolean NULL
);

CREATE TABLE Customer (
  CustomerEmail varchar(255) NOT NULL PRIMARY KEY,
  Password varchar(255) NOT NULL,
  Street varchar(255) NULL,
  HouseNumber varchar(255) NULL,
  Phone int null,
  FirstName varchar(255) NOT NULL,
  LastName varchar(255) NOT NULL,
  ZipCode int(20) NOT NULL -- Foreign Key, set later
);

CREATE TABLE BlogPost (
  BlogPostID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  Titel varchar(255) NOT NULL,
  SeoTitel varchar(255) NULL,
  MetaDescription varchar(255) NULL,
  BlogContent varchar(255) NOT NULL,
  BlogDate varchar(255) NOT NULL,
  ShortDescription varchar(255) NULL,
  UserEmail varchar(255) NOT NULL, -- Foreign Key, set later
  BlogCategoryID int(20) NOT NULL -- Foreign Key, set later
);

CREATE TABLE BlogCategory (
  BlogCategoryID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  CategoryName varchar(255) NOT NULL,
  Description varchar(255) NULL,
  SeoTitel varchar(255) NULL,
  MetaDescription varchar(255) NULL
);

CREATE TABLE CustomerOrder (
  OrderNumber int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  TotalPrice int NOT NULL,
  Comment varchar(255) NULL,
  OrderDate varchar(255) NOT NULL,
  ShippingStreet varchar(255) NOT NULL,
  ShippingHouseNumber varchar(255) NOT NULL,
  ZipCode int(20) NOT NULL, -- Foreign Key, set later
  CustomerEmail varchar(255) NOT NULL, -- Foreign Key, set later
  DeliveryMethodID int NOT NULL, -- Foreign Key, set later
  OrderStatusID int NOT NULL, -- Foreign Key, set later
  PromoCode varchar(255) NOT NULL -- Foreign Key, set later
);

CREATE TABLE OrderMessage (
  OrderMessageID int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  OrderMessage varchar(255) NOT NULL,
  OrderMessageDate varchar(255) NOT NULL,
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
    CONSTRAINT PK_DisplaysOnPage PRIMARY KEY (PageID, ImgID),
    FOREIGN KEY (PageID) REFERENCES Page (PageID),
    FOREIGN KEY (ImgID) REFERENCES ImgGallery (ImgID)
);

CREATE TABLE ProductImg (
  ItemNumber varchar(255) NOT NULL,
  ImgID int NOT NULL,
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
  Hours int NOT NULL,
  CONSTRAINT PK_ProductOnOrder PRIMARY KEY (OrderNumber, ItemNumber),
  FOREIGN KEY (OrderNumber) REFERENCES CustomerOrder (OrderNumber),
  FOREIGN KEY (ItemNumber) REFERENCES Product (ItemNumber)
);

-- Add test data below
