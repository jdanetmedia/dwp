-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Vært: mysql5.unoeuro.com
-- Genereringstid: 25. 05 2018 kl. 07:53:49
-- Serverversion: 5.7.21-21-log
-- PHP-version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rasmusandreas_dk_db3`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `BasicPageInfo`
--

CREATE TABLE `BasicPageInfo` (
  `CVR` int(11) NOT NULL,
  `LogoURL` varchar(255) NOT NULL,
  `ShopName` varchar(255) NOT NULL,
  `AboutUsText` text,
  `Email` varchar(255) DEFAULT NULL,
  `Phone` int(11) DEFAULT NULL,
  `Street` varchar(255) DEFAULT NULL,
  `HouseNumber` varchar(255) DEFAULT NULL,
  `StripeToken` varchar(255) DEFAULT NULL,
  `ProductsSeoTitle` varchar(255) DEFAULT NULL,
  `ProductsMetaDescription` varchar(255) DEFAULT NULL,
  `BlogSeoTitle` varchar(255) DEFAULT NULL,
  `BlogMetaDescription` varchar(255) DEFAULT NULL,
  `ContactSeoTitle` varchar(255) DEFAULT NULL,
  `ContactMetaDescription` varchar(255) DEFAULT NULL,
  `HomeSeoTitle` varchar(255) DEFAULT NULL,
  `HomeMetaDescription` varchar(255) DEFAULT NULL,
  `ZipCode` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `BasicPageInfo`
--

INSERT INTO `BasicPageInfo` (`CVR`, `LogoURL`, `ShopName`, `AboutUsText`, `Email`, `Phone`, `Street`, `HouseNumber`, `StripeToken`, `ProductsSeoTitle`, `ProductsMetaDescription`, `BlogSeoTitle`, `BlogMetaDescription`, `ContactSeoTitle`, `ContactMetaDescription`, `HomeSeoTitle`, `HomeMetaDescription`, `ZipCode`) VALUES
(11223344, 'http://cms.rasmusandreas.dk/admin/img/rubberducklogo.png', 'Rubber Duck', 'Welcome to our online duck store and meet the cutest rubber ducks of Amsterdam. They’re all premium ducks made of high quality materials and CE approved. Discover the hand painted details and special finishing. Absolute collectors items. Take your pick. Order online worldwide or visit our duck stores in Denmark(Oude Leliestraat & Staalstraat), Barcelona, Mallorca, Sevilla, San Sebastian, Lisbon, Florence, Turin, Limassol and San Marino. Have a nice duck!', 'r@rasmusandreas.dk', 73427985, 'Kongensgade', '58C', 'sk_test_YZzzQg82HA6EdEV0aEDmlWzS', '', '', '', '', 'Give us a quack', 'If you have any questions about rubber ducks, don&#39;t hesitate to give us a quack', 'Awesome webshop with rubber ducks', 'Rubber ducks for all purposes and needs. It&#39;s everything you&#39;ve ever wished for a duckshop.', 6700);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `BlogCategory`
--

CREATE TABLE `BlogCategory` (
  `BlogCategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `Description` text,
  `SeoTitle` varchar(255) DEFAULT NULL,
  `MetaDescription` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `BlogCategory`
--

INSERT INTO `BlogCategory` (`BlogCategoryID`, `CategoryName`, `Description`, `SeoTitle`, `MetaDescription`) VALUES
(1, 'Company News', 'Here you will find some of our company news.', 'SeoTitle', 'MetaDescription'),
(2, 'Top 10s', 'Here you will find top 10s lists', 'SeoTitle', 'MetaDescription'),
(3, 'Science', '<div>Science regarding ducks might be the most important thing known to history of man. The way we are able to analyze and study every inch of a duck will in the very end lead us to world peace</div>', 'Science duck', 'Read about ducks and known every inch of this beautiful creature'),
(5, 'News', '<div>Here you will find the lastest news about anything related to these awesome and beautiful ducks. The site to be the first to bring you the latest news</div>', '', ''),
(6, 'Sports', '<div>Sport Ducks are for the highschool jocks that have been bullying you for your entire life<br></div>', '', '');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `BlogImg`
--

CREATE TABLE `BlogImg` (
  `BlogPostID` int(11) NOT NULL,
  `ImgID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `BlogImg`
--

INSERT INTO `BlogImg` (`BlogPostID`, `ImgID`) VALUES
(5, 36),
(10, 37),
(11, 38),
(12, 39);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `BlogPost`
--

CREATE TABLE `BlogPost` (
  `BlogPostID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `SeoTitle` varchar(255) DEFAULT NULL,
  `MetaDescription` varchar(255) DEFAULT NULL,
  `BlogContent` text NOT NULL,
  `BlogDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `UserEmail` varchar(255) NOT NULL,
  `BlogCategoryID` int(20) NOT NULL,
  `RelatedProducts` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `BlogPost`
--

INSERT INTO `BlogPost` (`BlogPostID`, `Title`, `SeoTitle`, `MetaDescription`, `BlogContent`, `BlogDate`, `UserEmail`, `BlogCategoryID`, `RelatedProducts`) VALUES
(5, 'Duck facts', '', '', 'Duck, any of various species of relatively small short-necked,\r\nlarge-billed&nbsp;<a><span>waterfowl</span></a><span>. In true ducks—i.e.,\r\nthose classified in the subfamily Anatinae in the waterfowl family Anatidae—the\r\nlegs are placed rearward, as in&nbsp;</span><a><span>swans</span></a><span>, rather than forward, as in&nbsp;</span><a><span>geese</span></a><span>. The result is a distinctive waddling gait.\r\nMost true ducks, including a few inaccurately called geese (e.g.,&nbsp;</span><a><span>sheldgeese</span></a><span>) by reason of size and\r\nbuild, also differ from swans and true geese in the following characteristics:\r\nmales (drakes) and females (hens or ducks) exhibit some degree of\r\ndifferentiation in&nbsp;</span><a><span>plumage</span></a><span>&nbsp;and in call,\r\nmales molt twice annually, females lay large clutches of smooth-shelled rather\r\nthan rough-shelled&nbsp;</span><a><span>eggs</span></a><span>, and both sexes have overlapping scales on the\r\nskin of the leg. The wild&nbsp;</span><a><span>mallard</span></a><span>&nbsp;(Anas\r\nplatyrhynchos) is believed to be the ancestor of all domestic ducks, and it has\r\nundergone numerous crossbreedings and mutations since it was first domesticated\r\nin China between 2,000 and 3,000 years ago.<o:p></o:p></span><br><p class=\"MsoNormal\"><span>Common, or northern, pintail (Anas acuta).©\r\nLawrence E. Naylor—The National Audubon Society Collection/Photo Researchers<o:p></o:p></span></p><p>\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\"><span>&nbsp;</span></p>', '2018-05-24 15:56:44', 'admin@dwp.com', 3, 1),
(10, 'Understanding Waterfowl: The Two Sides of Drought', '', '', '<div></div>The prospects of a severe drought<div></div><div></div><div></div> can strike fear into the hearts of duck hunters—and for good reason. Drought usually results in fewer wetlands to support breeding waterfowl, and thus lower duck production; or less habitat during the migration and wintering periods, and therefore fewer places to hunt. But it might come as a surprise that not all aspects of drought are bad for waterfowl. Let\'s explore the many ways in which periodic drought affects waterfowl across their annual cycle.<p></p><p style=\"box-sizing: border-box; margin-top: 30px; margin-right: 0px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 24px; line-height: inherit; font-family: Halant, serif; vertical-align: baseline;\">We start our journey in the Prairie Pothole Region (PPR) of the United States and Canada. Dotting this landscape are hundreds of thousands of shallow wetlands, known as prairie potholes, which in combination with adjacent nesting habitats annually support 50 to 80 percent of North America\'s breeding ducks. Prairie potholes are unique among freshwater wetlands because of the variability of their water levels from year to year. The smallest and shallowest of these wetlands are typically the most dynamic and productive. These seasonally flooded basins fill with snowmelt in early spring, explode with invertebrate production as the weather warms, and then dry out during summer. Deeper potholes remain flooded into summer, providing valuable brood-rearing habitat for waterfowl. In contrast, permanent wetlands often support fish populations and produce fewer invertebrates, limiting their waterfowl habitat value. During abnormally wet periods that last several years, prairie potholes can begin to function like these less-productive permanent wetlands. When this occurs, a return of drier conditions, often in the form of drought, is needed to stimulate the decomposition of organic matter and recycling of nutrients that have accumulated in the low-oxygen soils of perennially flooded wetlands. </p><p style=\"box-sizing: border-box; margin-top: 30px; margin-right: 0px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 24px; line-height: inherit; font-family: Halant, serif; vertical-align: baseline;\">Despite the important role that drought plays in maintaining the productivity of prairie potholes, these conditions do temporarily reduce the availability of breeding habitat for waterfowl. Decades of survey data clearly demonstrate that breeding duck numbers are closely tied to wetland density on the prairies. Over the past four decades, roughly 30 percent of the breeding populations of mallards, northern pintails, northern shovelers, blue-winged teal, and gadwalls settled in the U.S. portion of the PPR during years when this region was relatively wet. During dry years, the proportion of these populations that settled in the U.S. PPR fell to roughly 15 percent. Fortunately, it\'s rare for the entire PPR to experience drought at the same time, and when portions of the region are dry, breeding ducks redistribute to areas with more favorable wetland habitats. </p><p style=\"box-sizing: border-box; margin-top: 30px; margin-right: 0px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 24px; line-height: inherit; font-family: Halant, serif; vertical-align: baseline;\">While dry conditions may cause some ducks to overfly the prairies to the Boreal Forest, where wetland habitats are more stable, the majority of the birds continue to settle on the prairies. For example, during years when the U.S. portion of the region was dry, the PPR as a whole still supported 60 percent of the breeding populations of the five previously mentioned dabbling duck species. This illustrates the remarkable ability of the PPR to support breeding waterfowl, even when significant portions of the region are dry, and emphasizes the importance of broadly conserving prairie wetlands and adjacent uplands to offset the impacts of variable precipitation. </p><p style=\"box-sizing: border-box; margin-top: 30px; margin-right: 0px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 24px; line-height: inherit; font-family: Halant, serif; vertical-align: baseline;\">Beyond the breeding grounds, waterfowl depend on a great diversity of wetlands, ranging from permanent lakes and estuarine bays that support abundant divers and sea ducks to seasonal and temporary wetlands that provide crucial foraging habitat for dabblers. Like prairie potholes, some of these wetlands must go dry periodically to maintain their productivity. Typical climate and precipitation patterns on most migration and wintering areas naturally result in flooding during winter and spring, followed by drier weather during the summer, which rejuvenates wetland productivity. In fact, many wetland management practices for migrating and wintering waterfowl, such as moist-soil management, are designed to mimic natural wet and dry cycles. </p><p style=\"box-sizing: border-box; margin-top: 30px; margin-right: 0px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 24px; line-height: inherit; font-family: Halant, serif; vertical-align: baseline;\">However, water shortages on migration and wintering areas caused by prolonged periods of severe drought are always detrimental to waterfowl. First, reduced irrigation supplies during the growing season can adversely affect both managed wetlands and agricultural crops (especially rice), which provide vital food resources and habitat for waterfowl. Second, drought decreases the availability of surface water for managed flooding of impounded wetlands as ducks and geese begin their southward migration. Third, drought reduces the frequency and extent of natural wetland inundation from precipitation, overbank streamflow, and runoff from spring snowmelt. </p><p style=\"box-sizing: border-box; margin-top: 30px; margin-right: 0px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 24px; line-height: inherit; font-family: Halant, serif; vertical-align: baseline;\">Unfortunately, all these adverse effects were observed recently along the Texas Gulf Coast and in California\'s Central Valley (see below). Although recent wet weather has provided much-needed drought relief in these regions, continued human population growth, increased demand for municipal and industrial water supplies, and the possibility of more severe and frequent droughts remain serious threats. Waterfowl are well adapted to naturally occurring drought conditions, but habitat loss and competition for limited water supplies will likely result in more severe impacts on waterfowl populations in the future. </p><p style=\"box-sizing: border-box; margin-top: 30px; margin-right: 0px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 24px; line-height: inherit; font-family: Halant, serif; vertical-align: baseline;\">The size and health of waterfowl populations are a direct reflection of the abundance and productivity of the wetland habitats on which the birds depend. For this reason, Ducks Unlimited and its partners are dedicated to conserving abundant and intact prairie potholes and other wetlands on the breeding grounds, while simultaneously pursuing policies and programs that will ensure reliable water supplies for wetland management and a sustainable rice industry on key migration and wintering areas. These continental conservation efforts are more important now than ever to ensure that North America\'s waterfowl will continue to have the habitats they need today and in the future. </p><hr style=\"clear: both; margin: 20px 0px; border-top-style: solid; border-top-color: rgb(238, 238, 238); border-right: 0px; border-bottom: 0px; border-left: 0px; border-image: initial; font-family: Halant, serif; font-size: 24px;\"><p style=\"box-sizing: border-box; margin-top: 30px; margin-right: 0px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 24px; line-height: inherit; font-family: Halant, serif; vertical-align: baseline;\"><em style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;\">Dr. Mike Brasher is biological team leader for the Gulf Coast Joint Venture. Kaylan Carrlson is manager of conservation planning in DU\'s Great Plains Region. Dr. Dale James is director of conservation planning in DU\'s Southern Region. </em></p><p style=\"box-sizing: border-box; margin-top: 30px; margin-right: 0px; margin-left: 0px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 24px; line-height: inherit; font-family: Halant, serif; vertical-align: baseline;\"><span style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: 700; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;\">Learning from Drought in Texas and California</span> Since 2010, two of DU\'s highest-priority conservation areas—the Central Valley of California and the Texas Gulf Coast—have battled record droughts spanning many years. Wetland systems in the Central Valley are intensively managed for waterfowl food production, and together with post-harvest flooded rice fields they support 5 million to 7 million waterfowl annually. From 2011 to 2016, California experienced one of the most severe droughts in its history. Managed wetlands in this region rely heavily on surface water from state and federal water projects, but reservoir levels during the drought were at less than 50 percent of capacity. At the peak of the drought, in 2014, waterfowl managers braced for water restrictions that would have reduced managed wetland habitat by 25 percent and winter-flooded rice by 75 percent. Thankfully, timely rainfall arrived during the winter, averting what could have been severe waterfowl habitat shortages.  </p><p style=\"box-sizing: border-box; margin: 30px 0px 10px; padding: 0px; border: 0px; font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-size: 24px; line-height: inherit; font-family: Halant, serif; vertical-align: baseline;\">On the Texas Gulf Coast, where rice fields are vital to more than 5 million ducks and geese, the acreage of planted rice has declined by over 300,000 acres since the 1970s. This decline has been driven in part by increased competition for water supplies, and the recent drought of 2010–2014 demonstrated the seriousness of this threat. Prompted by declining water levels in upstream lakes, regional water authorities curtailed releases of irrigation water to downstream rice farmers for four consecutive growing seasons, causing an immediate 52,000-acre reduction in planted rice. Lake levels eventually recovered, and in 2016 Texas farmers planted the largest rice acreage since 2005. While Texas and California have both recovered from their recent droughts, these events serve as a stark reminder of the importance of DU\'s work to ensure reliable water supplies for wetlands and agriculture on these vital landscapes.</p>', '2018-05-24 21:12:48', 'admin@dwp.com', 3, 3),
(11, 'Wild ducks caught on camera snacking on small birds', '', '', 'Wild mallard ducks have been observed attacking and eating migratory birds. This has never been documented before and is probably a new behaviour, say scientists.</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin: 18px 0px 0px; padding: 0px; vertical-align: baseline;\">Zoologists at the University of Cambridge filmed a group of mallard ducks hunting other birds on a reservoir in Romania.</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin: 18px 0px 0px; padding: 0px; vertical-align: baseline;\">Two fledglings - a grey wagtail and a black redstart - were chased and swallowed when they landed in the water.</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin: 18px 0px 0px; padding: 0px; vertical-align: baseline;\">Mallards are one of the most abundant types of wild duck, and a common sight in parks and on lakes.</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin: 18px 0px 0px; padding: 0px; vertical-align: baseline;\">The duck normally snacks on seeds, acorns, berries, plants and insects.</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin-top: 18px; margin-right: 0px; margin-left: 0px; padding: 0px; vertical-align: baseline;\">It has, on occasions, been seen to eat small fish, but bigger vertebrates are normally strictly off the menu.</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin-top: 18px; margin-right: 0px; margin-left: 0px; padding: 0px; vertical-align: baseline;\"><img src=\"https://ichef.bbci.co.uk/news/624/cpsprodpb/122FD/production/_96739447_3-4.jpg\" alt=\"Mallard duck eating bird\"><br></p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin: 18px 0px 0px; padding: 0px; vertical-align: baseline;\">Dr Silviu Petrovan noticed the unusual behaviour of a group of mallards while he was out bird watching with friends near a national park in southwest Romania.</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin: 18px 0px 0px; padding: 0px; vertical-align: baseline;\">He saw the adult female duck grab the grey wagtail in her beak, and repeatedly submerge it in the water, before eventually eating it.</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin: 18px 0px 0px; padding: 0px; vertical-align: baseline;\">A second bird - a fledgling black redstart - then landed in the water, where it was chased by juvenile mallard ducks.</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin: 18px 0px 0px; padding: 0px; vertical-align: baseline;\">\"The poor bird landed on the water and was screaming and trying to navigate itself out of danger,\" said Dr Petrovan. \"Then it was almost instantaneously attacked by the mallards.\"</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin: 18px 0px 0px; padding: 0px; vertical-align: baseline;\">The bird eventually disappeared - assumed to be drowned or consumed.</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin: 18px 0px 0px; padding: 0px; vertical-align: baseline;\">The scientists could find no record of mallard bird predation in the scientific literature, which suggests such behaviour is both \"very rare\" and newly-learned.</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin: 18px 0px 0px; padding: 0px; vertical-align: baseline;\">\"The mallard was massively struggling to eat that wagtail, presumably because it couldn\'t actually tear it to pieces because the bill is flattened - it\'s not designed for ripping prey apart,\" said Dr Petrovan.</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin-top: 18px; margin-right: 0px; margin-left: 0px; padding: 0px; vertical-align: baseline;\">\"Digesting bones and feathers - that\'s not something that mallards have really evolved to do.\"</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin: 18px 0px 0px; padding: 0px; vertical-align: baseline;\">Ducks by nature are seldom aggressive and tend not to enjoy novel food.</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin: 18px 0px 0px; padding: 0px; vertical-align: baseline;\">However, mallards in California have been seen to enter the sea to feed on sand crabs, perhaps to find new sources of high-energy protein.</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin: 18px 0px 0px; padding: 0px; vertical-align: baseline;\">The same may be happening at the reservoir, which is largely deep-water.</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin: 18px 0px 0px; padding: 0px; vertical-align: baseline;\">\"Potentially there is quite a lot of pressure for those fast-growing juveniles to get animal protein intake, and therefore they are looking at opportunities to supplement that,\" said Dr Petrovan.</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin: 18px 0px 0px; padding: 0px; vertical-align: baseline;\">\"But, the fact that these individuals seem to have learnt how to hunt birds is pretty extraordinary.\"</p><p style=\"border: 0px; color: rgb(64, 64, 64); font-variant-numeric: inherit; font-variant-east-asian: inherit; font-stretch: inherit; font-family: Helmet, Freesans, Helvetica, Arial, sans-serif; font-size: 1rem; line-height: 1.375; margin-top: 18px; margin-right: 0px; margin-left: 0px; padding: 0px; vertical-align: baseline;\">The findings are published in the journal, Waterbirds.</p>', '2018-05-24 21:20:59', 'admin@dwp.com', 5, 4),
(12, 'Oregon Ducks', '', '', 'The Oregon Ducks are the athletic teams that represent the University of Oregon in Eugene, Oregon. The Ducks compete at the <a href=\"https://en.wikipedia.org/wiki/National_Collegiate_Athletic_Association\" title=\"National Collegiate Athletic Association\"><span style=\"color: windowtext;\">National Collegiate Athletic Association</span></a> (NCAA) <a href=\"https://en.wikipedia.org/wiki/NCAA_Division_I\" title=\"NCAA Division I\"><span style=\"color: windowtext;\">Division I</span></a> level as a member of the <a href=\"https://en.wikipedia.org/wiki/Pac-12_Conference\" title=\"Pac-12 Conference\"><span style=\"color: windowtext;\">Pac-12 Conference</span></a>. With eighteen varsity teams, Oregon is best known for its <a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks_football\" title=\"Oregon Ducks football\"><span style=\"color: windowtext;\">American football</span></a> team and <a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks_track_and_field\" title=\"Oregon Ducks track and field\"><span style=\"color: windowtext;\">track and field</span></a> program, which has helped Eugene gain a reputation as \"Track Town, USA\".<a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-tracktown-2\"><span style=\"color: windowtext;\">[2]</span></a> Oregon\'s main <a href=\"https://en.wikipedia.org/wiki/College_rivalry\" title=\"College rivalry\"><span style=\"color: windowtext;\">rivalries</span></a> are with the <a href=\"https://en.wikipedia.org/wiki/Oregon_State_Beavers\" title=\"Oregon State Beavers\"><span style=\"color: windowtext;\">Oregon State Beavers</span></a> (the <a href=\"https://en.wikipedia.org/wiki/Civil_War_(college_rivalry)\" title=\"Civil War (college rivalry)\"><span style=\"color: windowtext;\">Civil War</span></a>) and the <a href=\"https://en.wikipedia.org/wiki/Washington_Huskies\" title=\"Washington Huskies\"><span style=\"color: windowtext;\">Washington Huskies</span></a>.<span style=\"color: windowtext;\"><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-3\">[3]</a></span><br><o:p></o:p><p></p><div style=\"border-top: none; border-right: none; border-left: none; border-image: initial; border-bottom: 1pt solid rgb(162, 169, 177); padding: 0in; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\">\r\n\r\n<p class=\"MsoNormal\" style=\"margin: 12pt 0in 3pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; border: none; padding: 0in;\"><span lang=\"EN-US\" style=\"font-size:18.0pt;font-family:\" georgia\",\"serif\";=\"\" mso-fareast-font-family:\"times=\"\" new=\"\" roman\";mso-bidi-font-family:\"times=\"\" roman\";=\"\" color:black;mso-ansi-language:en-us;mso-fareast-language:da\"=\"\">Nicknames and\r\nmascot history<o:p></o:p></span></p>\r\n\r\n</div><p class=\"MsoNormal\" style=\"margin: 6pt 0in; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><span lang=\"EN-US\">Oregon teams were\r\noriginally known as Webfoots, possibly as early as the 1890s.</span><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-rg1995-4\"><span lang=\"EN-US\" style=\"color: windowtext;\">[4]</span></a><span lang=\"EN-US\"> The Webfoots name\r\noriginally applied to a group of fishermen from the coast of Massachusetts who\r\nhad been heroes during the </span><a href=\"https://en.wikipedia.org/wiki/American_Revolutionary_War\" title=\"American Revolutionary War\"><span lang=\"EN-US\" style=\"color: windowtext;\">American\r\nRevolutionary War</span></a><span lang=\"EN-US\">; their descendants had settled in Oregon\'s\r\nWillamette Valley in the 19th century and the name stayed with them.</span><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-theduck-5\"><span lang=\"EN-US\" style=\"color: windowtext;\">[5]</span></a><span lang=\"EN-US\"> A naming contest\r\nin 1926 won by </span><a href=\"https://en.wikipedia.org/wiki/The_Oregonian\" title=\"The Oregonian\"><span lang=\"EN-US\" style=\"color: windowtext;\">Oregonian</span></a><span lang=\"EN-US\"> sports\r\neditor </span><a href=\"https://en.wikipedia.org/wiki/L._H._Gregory\" title=\"L. H. Gregory\"><span lang=\"EN-US\" style=\"color: windowtext;\">L. H. Gregory</span></a><span lang=\"EN-US\"> made the Webfoots\r\nname official, and a subsequent student vote in 1932 affirmed the nickname,\r\nchosen over other suggested nicknames such as Pioneers, Trappers, Lumberjacks,\r\nWolves, and Yellow Jackets.</span><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-rg1995-4\"><span lang=\"EN-US\" style=\"color: windowtext;\">[4]</span></a><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-rg1976-6\"><span lang=\"EN-US\" style=\"color: windowtext;\">[6]</span></a><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-rg1978-7\"><span lang=\"EN-US\" style=\"color: windowtext;\">[7]</span></a><span lang=\"EN-US\"><o:p></o:p></span></p><p class=\"MsoNormal\" style=\"margin: 6pt 0in; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><span lang=\"EN-US\">Ducks, with their\r\nwebbed feet, began to be associated with the team in the 1920s, and live duck\r\nmascots were adopted to represent the team.</span><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-theduck-5\"><span lang=\"EN-US\" style=\"color: windowtext;\">[5]</span></a><span lang=\"EN-US\"> Journalists,\r\nespecially headline writers, also adopted the shorter Duck nickname,</span><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-rg1976-6\"><span lang=\"EN-US\" style=\"color: windowtext;\">[6]</span></a><span lang=\"EN-US\"> but it wasn\'t\r\nuntil the 1940s that the image of </span><a href=\"https://en.wikipedia.org/wiki/Donald_Duck\" title=\"Donald Duck\"><span lang=\"EN-US\" style=\"color: windowtext;\">Donald Duck</span></a><span lang=\"EN-US\">, permitted via a\r\nhandshake deal between </span><a href=\"https://en.wikipedia.org/wiki/Walt_Disney\" title=\"Walt Disney\"><span lang=\"EN-US\" style=\"color: windowtext;\">Walt Disney</span></a><span lang=\"EN-US\"> and Oregon\r\nathletic director </span><a href=\"https://en.wikipedia.org/wiki/Leo_Harris\" title=\"Leo Harris\"><span lang=\"EN-US\" style=\"color: windowtext;\">Leo Harris</span></a><span lang=\"EN-US\">, cemented the image of\r\nthe Duck as the school\'s mascot.</span><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-rg1995-4\"><span lang=\"EN-US\" style=\"color: windowtext;\">[4]</span></a><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-theduck-5\"><span lang=\"EN-US\" style=\"color: windowtext;\">[5]</span></a><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-rg1978-7\"><span lang=\"EN-US\" style=\"color: windowtext;\">[7]</span></a><span lang=\"EN-US\"> Both nicknames\r\nwere still in use well into the 1970s.</span><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-rg1995-4\"><span lang=\"EN-US\" style=\"color: windowtext;\">[4]</span></a><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-theduck-5\"><span lang=\"EN-US\" style=\"color: windowtext;\">[5]</span></a><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-rg1976-6\"><span lang=\"EN-US\" style=\"color: windowtext;\">[6]</span></a><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-rg1978-7\"><span lang=\"EN-US\" style=\"color: windowtext;\">[7]</span></a><span lang=\"EN-US\"><o:p></o:p></span></p><p class=\"MsoNormal\">\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\" style=\"margin: 6pt 0in; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial;\"><span lang=\"EN-US\">In 1978, a student\r\ncartoonist came up with a new duck image, but students rejected the alternative\r\nby a 2-to-1 margin. Although Donald wasn\'t on that ballot, the University\r\nArchivist declared that the election made Ducks the school\'s official mascot,\r\nreplacing Webfoots.</span><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-rg1995-4\"><span style=\"color: windowtext;\">[4]</span></a><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-theduck-5\"><span style=\"color: windowtext;\">[5]</span></a><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-rg1978-7\"><span style=\"color: windowtext;\">[7]</span></a><a href=\"https://en.wikipedia.org/wiki/Oregon_Ducks#cite_note-oq2012-8\"><span style=\"color: windowtext;\">[8]</span></a><o:p></o:p></p>', '2018-05-24 21:31:40', 'sebastiankbuch@hotmail.com', 6, 3);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Customer`
--

CREATE TABLE `Customer` (
  `CustomerEmail` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Street` varchar(255) DEFAULT NULL,
  `HouseNumber` varchar(255) DEFAULT NULL,
  `Phone` int(11) DEFAULT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `ZipCode` int(20) DEFAULT NULL,
  `ResetKey` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `Customer`
--

INSERT INTO `Customer` (`CustomerEmail`, `Password`, `Street`, `HouseNumber`, `Phone`, `FirstName`, `LastName`, `ZipCode`, `ResetKey`) VALUES
('kunde@dwp.com', '$2y$10$8esR6xSS.3XBOC3trjPXS.yZJsQluApvQsoyHeJOLbshZsdkFFU5a', NULL, NULL, NULL, 'Kunde', 'Bruger', NULL, NULL),
('post@jdanet.dk', '$2a$10$QMmK4nTUF6szqmNG3t8V/uTu5BM7ejLvaRSN7aUFoxJY4hsvzYBhO', 'Vædderens Kvarter', '4', NULL, 'Jesper', 'Dalsgaard', 6710, NULL),
('rasmus.andreas96@gmail.com', '$2a$10$74zsjq9/Tv6Ydq.QLlKeju.bwxXfs8GUSN051E1EeMIi4L/beo1Li', 'Spangsbjerg Kirkevej', '99B', NULL, 'Rasmus Andreas', 'Nielsen', 6700, NULL);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `CustomerOrder`
--

CREATE TABLE `CustomerOrder` (
  `OrderNumber` int(11) NOT NULL,
  `Comment` varchar(255) DEFAULT NULL,
  `StripeChargeID` varchar(255) NOT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ShippingStreet` varchar(255) NOT NULL,
  `ShippingHouseNumber` varchar(255) NOT NULL,
  `ZipCode` int(20) NOT NULL,
  `CustomerEmail` varchar(255) NOT NULL,
  `DeliveryMethodID` int(11) NOT NULL,
  `OrderStatusID` int(11) NOT NULL,
  `PromoCode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `CustomerOrder`
--

INSERT INTO `CustomerOrder` (`OrderNumber`, `Comment`, `StripeChargeID`, `OrderDate`, `ShippingStreet`, `ShippingHouseNumber`, `ZipCode`, `CustomerEmail`, `DeliveryMethodID`, `OrderStatusID`, `PromoCode`) VALUES
(1, 'This is a order comment', 'testChargeID', '2009-11-11 12:23:44', 'Spangsbjerg Kirkevej', '99B, 16', 6700, 'rasmus.andreas96@gmail.com', 1, 2, 'virker'),
(2, 'This is a order comment', 'testChargeID', '2008-11-11 12:23:44', 'Nørregade', '30', 6700, 'rasmus.andreas96@gmail.com', 3, 1, NULL),
(3, 'This is a order comment', 'testChargeID', '2010-11-11 12:23:44', 'Spangsbjerg Kirkevej', '99B, 16', 6700, 'kunde@dwp.com', 1, 2, NULL),
(4, 'This is a order comment', 'testChargeID', '2005-11-11 12:23:44', 'Nørregade', '30', 6700, 'kunde@dwp.com', 3, 1, NULL),
(5, 'This is a order comment', 'testChargeID', '2012-11-11 12:23:44', 'Spangsbjerg Kirkevej', '99B, 16', 6700, 'post@jdanet.dk', 1, 2, NULL),
(6, 'This is a order comment', 'testChargeID', '2017-11-11 12:23:44', 'Nørregade', '30', 6700, 'post@jdanet.dk', 3, 1, NULL),
(7, 'Please wrap it as a gift', 'ch_1CVaJuANxk1lUrnjXGNrO5wB', '2018-05-25 07:46:17', 'Vædderens Kvarter', '4', 6710, 'post@jdanet.dk', 2, 2, NULL);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `DeliveryMethod`
--

CREATE TABLE `DeliveryMethod` (
  `DeliveryMethodID` int(11) NOT NULL,
  `Method` varchar(255) NOT NULL,
  `MethodDescription` varchar(255) NOT NULL,
  `DeliveryPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `DeliveryMethod`
--

INSERT INTO `DeliveryMethod` (`DeliveryMethodID`, `Method`, `MethodDescription`, `DeliveryPrice`) VALUES
(1, 'Shipping to postoffice', 'This is the description for the shipping to postoffice', 5),
(2, 'Shipping to home address', 'This is the description for the shipping to home address', 8),
(3, 'Express shipping', 'This is the description for the Express shipping', 15);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `FrontSlider`
--

CREATE TABLE `FrontSlider` (
  `SlideID` int(11) NOT NULL,
  `SliderText` varchar(255) DEFAULT NULL,
  `SliderHeader` varchar(255) DEFAULT NULL,
  `CTAButtonText` varchar(255) DEFAULT NULL,
  `CTAURL` varchar(255) DEFAULT NULL,
  `SliderImg` varchar(255) NOT NULL,
  `UserEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `FrontSlider`
--

INSERT INTO `FrontSlider` (`SlideID`, `SliderText`, `SliderHeader`, `CTAButtonText`, `CTAURL`, `SliderImg`, `UserEmail`) VALUES
(1, 'Some normals ducks are on sale!', 'One normal duck on sale!', 'Go to products', 'products.php?cat=1', 'http://cms.rasmusandreas.dk/admin/img/slide-1.jpg', 'rasmus.andreas96@gmail.com'),
(2, 'Look at our latest added Superhero ducks! Flying in to save your day!', 'New Hero Ducks!', 'Go to products', 'products.php?cat=2', 'http://cms.rasmusandreas.dk/admin/img/slide-2.jpg', 'rasmus.andreas96@gmail.com'),
(4, 'This is definitely not a clickbait. We are here to educate people and make them understand the wonders of ducks', 'DUCK FIGHT GONE WRONG. GONE VIRAL (IN THE HOOD)', 'Go to Bluck', 'post.php?post=10', 'http://cms.rasmusandreas.dk/admin/img/jr69375-duck-fight.jpg', 'rasmus.andreas96@gmail.com');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Hours`
--

CREATE TABLE `Hours` (
  `HoursID` int(11) NOT NULL,
  `Open` varchar(255) NOT NULL,
  `Close` varchar(255) NOT NULL,
  `Day` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `Hours`
--

INSERT INTO `Hours` (`HoursID`, `Open`, `Close`, `Day`) VALUES
(1, '9:00', '17:00', 'Weekdays'),
(2, '10:00', '14:00', 'Weekends');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `ImgGallery`
--

CREATE TABLE `ImgGallery` (
  `ImgID` int(11) NOT NULL,
  `URL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `ImgGallery`
--

INSERT INTO `ImgGallery` (`ImgID`, `URL`) VALUES
(1, 'http://via.placeholder.com/200x200'),
(2, 'http://via.placeholder.com/400x400'),
(3, 'http://via.placeholder.com/600x600'),
(4, 'http://via.placeholder.com/800x800'),
(5, 'http://via.placeholder.com/1920x1080'),
(6, 'http://via.placeholder.com/800x800'),
(7, 'http://cms.rasmusandreas.dk/admin/img/superman-rubber-duck-amsterdam-duck-store.jpg'),
(8, 'http://cms.rasmusandreas.dk/admin/blogimgs/topoofduck.jpg'),
(9, 'http://cms.rasmusandreas.dk/admin/img/tullip-rubber-duck-front.jpg'),
(10, 'http://cms.rasmusandreas.dk/admin/img/batman-rubber-duck-amsterdam-duck-store.jpg'),
(11, 'http://cms.rasmusandreas.dk/admin/img/bath168-batman-bath-rubber-duck1.jpg'),
(12, 'http://cms.rasmusandreas.dk/admin/img/yellow-rubber-duck-front-300x300.jpg'),
(13, 'http://cms.rasmusandreas.dk/admin/img/red-white-hearts-rubber-duck-front.jpg'),
(14, 'http://cms.rasmusandreas.dk/admin/img/red-white-hearts-rubber-duck-leaning.jpg'),
(15, 'http://cms.rasmusandreas.dk/admin/img/red-white-hearts-rubber-duck-left.jpg'),
(16, 'http://cms.rasmusandreas.dk/admin/img/red-white-hearts-rubber-duck-right.jpg'),
(17, 'http://cms.rasmusandreas.dk/admin/img/green-white-dots-rubber-duck-front.jpg'),
(18, 'http://cms.rasmusandreas.dk/admin/img/green-white-dots-rubber-duck-leaning.jpg'),
(19, 'http://cms.rasmusandreas.dk/admin/img/green-white-dots-rubber-duck-left-side.jpg'),
(20, 'http://cms.rasmusandreas.dk/admin/img/green-white-dots-rubber-duck-right-side.jpg'),
(21, 'http://cms.rasmusandreas.dk/admin/img/surfer-rubber-duck-amsterdam-duck-store.jpg'),
(22, 'http://cms.rasmusandreas.dk/admin/img/kung-fu-rubber-duck-front-amsterdam-duck-store.jpg'),
(23, 'http://cms.rasmusandreas.dk/admin/img/kung-fu-rubber-duck-left-amsterdam-duck-store.jpg'),
(24, 'http://cms.rasmusandreas.dk/admin/img/kung-fu-rubber-duck-right-amsterdam-duck-store.jpg'),
(25, 'http://cms.rasmusandreas.dk/admin/img/kung-fu-rubber-duck-back-amsterdam-duck-store.jpg'),
(26, 'http://cms.rasmusandreas.dk/admin/img/basketball-rubber-duck.jpg'),
(27, 'http://cms.rasmusandreas.dk/admin/img/volleyball-rubber-duck-front.jpg'),
(28, 'http://cms.rasmusandreas.dk/admin/img/volleyball-rubber-duck-leaning1.jpg'),
(30, 'http://cms.rasmusandreas.dk/admin/img/volleyball-rubber-duck-left-side.jpg'),
(31, 'http://cms.rasmusandreas.dk/admin/img/volleyball-rubber-duck-right-side1.jpg'),
(32, 'http://cms.rasmusandreas.dk/admin/img/spidy-rubber-duck-front.jpg'),
(33, 'http://cms.rasmusandreas.dk/admin/img/spidy-rubber-duck-leaning.jpg'),
(34, 'http://cms.rasmusandreas.dk/admin/img/spidy-rubber-duck-left-side.jpg'),
(35, 'http://cms.rasmusandreas.dk/admin/img/spidy-rubber-duck-right-side.jpg'),
(36, 'http://cms.rasmusandreas.dk/admin/blogimgs/science_duck_by_jettfumes-d9odx6f.jpg'),
(37, 'http://cms.rasmusandreas.dk/admin/blogimgs/1_FURTMAN_BWDHAB_DROUGHT_00301cs1200x500.jpg'),
(38, 'http://cms.rasmusandreas.dk/admin/blogimgs/_96739443_1-2.jpg'),
(39, 'http://cms.rasmusandreas.dk/admin/blogimgs/download.png'),
(40, 'http://cms.rasmusandreas.dk/admin/img/rubberducklogo.png'),
(41, 'http://cms.rasmusandreas.dk/admin/img/slide-1.jpg'),
(42, 'http://cms.rasmusandreas.dk/admin/img/slide-2.jpg'),
(43, 'http://cms.rasmusandreas.dk/admin/img/jr69375-duck-fight.jpg');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `OrderDetails`
--

CREATE TABLE `OrderDetails` (
  `OrderNumber` int(11) NOT NULL,
  `ItemNumber` varchar(255) NOT NULL,
  `Amount` int(11) NOT NULL,
  `FinalPrice` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `OrderDetails`
--

INSERT INTO `OrderDetails` (`OrderNumber`, `ItemNumber`, `Amount`, `FinalPrice`) VALUES
(1, '1111', 1, 10),
(1, '2221', 1, 8),
(1, '2222', 2, 23),
(1, '3331', 3, 15),
(1, '3332', 3, 17),
(2, '1111', 1, 7.5),
(2, '3331', 4, 9.99),
(2, '3332', 1, 12.45),
(3, '1111', 1, 13.49),
(3, '2221', 1, 10.1),
(3, '2222', 2, 10.95),
(3, '3331', 3, 11.11),
(3, '3332', 3, 12.12),
(4, '1111', 1, 5.5),
(4, '3331', 4, 10),
(4, '3332', 1, 12),
(5, '1111', 1, 8.49),
(5, '2221', 1, 10),
(5, '2222', 2, 5),
(5, '3331', 3, 7.5),
(5, '3332', 3, 5),
(6, '1111', 1, 12.34),
(6, '3331', 4, 13.37),
(6, '3332', 1, 10),
(7, '1112', 12, 10),
(7, '3333', 3, 19);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `OrderMessage`
--

CREATE TABLE `OrderMessage` (
  `OrderMessageID` int(11) NOT NULL,
  `OrderMessage` text NOT NULL,
  `OrderMessageDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `OrderNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `OrderMessage`
--

INSERT INTO `OrderMessage` (`OrderMessageID`, `OrderMessage`, `OrderMessageDate`, `OrderNumber`) VALUES
(1, 'Some dumb message', '2009-11-11 14:23:44', 1),
(2, 'Another dumb message', '2009-11-11 16:23:44', 1),
(3, 'Another dumb message', '2009-11-11 16:23:44', 2),
(4, 'Your order WILL be sent today!', '2018-05-25 07:45:58', 7);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `OrderStatus`
--

CREATE TABLE `OrderStatus` (
  `OrderStatusID` int(11) NOT NULL,
  `Status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `OrderStatus`
--

INSERT INTO `OrderStatus` (`OrderStatusID`, `Status`) VALUES
(1, 'Awaiting'),
(2, 'In progress'),
(3, 'Sent'),
(4, 'Delivered');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Product`
--

CREATE TABLE `Product` (
  `ItemNumber` varchar(255) NOT NULL,
  `ProductName` varchar(255) NOT NULL,
  `StockStatus` int(11) NOT NULL,
  `ShortDescription` varchar(255) NOT NULL,
  `LongDescription` text NOT NULL,
  `Price` float NOT NULL,
  `OfferPrice` float DEFAULT NULL,
  `SeoTitle` varchar(255) DEFAULT NULL,
  `MetaDescription` varchar(255) DEFAULT NULL,
  `ProductStatus` tinyint(1) NOT NULL,
  `CreationDate` date NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `ProductCategoryID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `Product`
--

INSERT INTO `Product` (`ItemNumber`, `ProductName`, `StockStatus`, `ShortDescription`, `LongDescription`, `Price`, `OfferPrice`, `SeoTitle`, `MetaDescription`, `ProductStatus`, `CreationDate`, `UserEmail`, `ProductCategoryID`) VALUES
('1111', 'Green White Dots Duck', 1000, 'Green White Dots Rubber Duck. Buy the Green duck with white dots of the Amsterdam Duck Store. Very original rubber duck.', 'DescriptionGreen White Dots Rubber Duck. Buy the red duck with white dots of the Amsterdam Duck Store. Very original rubber duck.This Green White Dots Rubber Duck is CE approvedAll our rubber ducks are CE (Communauté Européenne) approved, according to EU legislation. This means that your rubber duck contains no harmful materials or toxic elements. Next to CE approval we have a very strict quality control to make sure your duck is manufactured in a safe environment by happy workers. This is not a teething toy for small children.World wide deliveryChoose your country. We’re shipping from The Netherlands so it can take a few days, depending on how far you live. Contact us for express delivery if you’re in a hurry. Normally shipping takes 5 – 12 working days outside EU and 5 – 8 working days within EU. Unfortunately we can’t guarantee exact arrival dates due to customs checks. During holidays like Christmas it might take longer to arrive. We’ll do our best to send your order on time!This Green White Dots Rubber Duck is a perfect company give awayAre you looking for a nice give away? Contact us to order our Green White Dots Rubber Duck in bulk and we give you a quote. We can even print your company’s logo on the front.Send this Green White Dots Rubber Duck as a giftA rubber duck puts a smile on everybody’s face. It’s a perfect gift. Choose ‘Ship to a different address’ when checking out. We’ll send your Green White Dots Rubber Duck gift to your friend or family.This Green White Dots Duck has hand painted detailsTake a close look at the tiny bits of this Green White Dots Rubber Duck. These are all hand painted by special craftsmen. It’s a very delicate and skillful job. But it makes the rubber duck look extra good.', 10, 0, '', '', 1, '2018-04-01', 'rasmus.andreas96@gmail.com', 1),
('1112', 'Red White Hearts Duck', 988, 'Red White Hearts Rubber Duck. Buy the love spreading duck of the Amsterdam Duck Store. With white hearts on red, always in a romantic mood…', 'DescriptionRed White Hearts Rubber Duck. Buy the love spreading duck of the Amsterdam Duck Store. With white hearts on red, always in a romantic mood…This Red White Hearts Rubber Duck is CE approvedAll our rubber ducks are CE (Communauté Européenne) approved, according to EU legislation. This means that your rubber duck contains no harmful materials or toxic elements. Next to CE approval we have a very strict quality control to make sure your duck is manufactured in a safe environment by happy workers. This is not a teething toy for small children.World wide deliveryChoose your country. We’re shipping from The Netherlands so it can take a few days, depending on how far you live. Contact us for express delivery if you’re in a hurry. Normally shipping takes 5 – 12 working days outside EU and 5 – 8 working days within EU. Unfortunately we can’t guarantee exact arrival dates due to customs checks. During holidays like Christmas it might take longer to arrive. We’ll do our best to send your order on time!This Red White Hearts Rubber Duck is a perfect company give awayAre you looking for a nice give away? Contact us to order our diver rubber duck in bulk and we give you a quote. We can even print your company’s logo on the front.Send this Red White Hearts Rubber Duck as a giftA rubber duck puts a smile on everybody’s face. It’s a perfect gift. Choose ‘Ship to a different address’ when checking out. We’ll send your Red White Hearts rubber duck gift to your friend or family.This Red White Hearts Rubber Duck has hand painted detailsTake a close look at the tiny bits of this Red White Hearts rubber duck. These are all hand painted by special craftsmen. It’s a very delicate and skillful job. But it makes the rubber duck look extra good.', 18, 10, '', '', 1, '2018-04-02', 'rasmus.andreas96@gmail.com', 1),
('1113', 'Yellow Duck', 1000, 'Yellow Rubber Duck. Buy the original yellow bath mate of the Rubber Duck Shop. Pure and simple. This is the ultimate start of your duckies collection.', 'DescriptionYellow Rubber Duck. Buy the original yellow bath mate of the Amsterdam Duck Store. Pure and simple. This is the ultimate start of your duckies collection. Can’t do without it! Also a great gift for true bathers.This Yellow Rubber Duck is CE approvedAll our rubber ducks are CE (Communauté Européenne) approved, according to EU legislation. This means that this Yellow Rubber Duck contains no harmful materials or toxic elements. Next to CE approval we have a very strict quality control to make sure your duck is manufactured in a safe environment by happy workers. This is not a teething toy for small children.World wide deliveryChoose your country. We’re shipping from The Netherlands so it can take a few days, depending on how far you live. Contact us for express delivery if you’re in a hurry. Normally shipping takes 5 – 12 working days outside EU and 5 – 8 working days within EU. Unfortunately we can’t guarantee exact arrival dates due to customs checks. During holidays like Christmas it might take longer to arrive. We’ll do our best to send your order on time!This Yellow Rubber Duck is a perfect company give awayAre you looking for a nice give away? Contact us to order our Rubber Ducks in bulk and we give you a quote. We can even print your company’s logo on the front.Send as a gift!A rubber duck puts a smile on everybody’s face. It’s a perfect gift. Choose ‘Ship to a different address’ when checking out. We’ll send your Yellow Rubber Duck gift to your friend or family.This Yellow Rubber Duck has hand painted detailsTake a close look at the tiny bits of this Yellow Rubber Duck. These are all hand painted by special craftsmen. It’s a very delicate and skillful job. But it makes the rubber duck look extra good.', 8, 0, '', '', 1, '2017-04-03', 'rasmus.andreas96@gmail.com', 1),
('2221', 'Batman Duck', 50, 'Batman Rubber Duck. Buy the mysterious hero of the Amsterdam Duck Store. He only comes out at night to safe ducks in distress and scares off villains.', 'DescriptionBatman Rubber Duck. Buy the mysterious hero of the Amsterdam Duck Store. He only comes out at night to safe ducks in distress. Rules the canals and scares off villains.This Batman Rubber Duck is CE approvedAll our rubber ducks are CE (Communauté Européenne) approved, according to EU legislation. This means that your rubber duck contains no harmful materials or toxic elements. Next to CE approval we have a very strict quality control to make sure your duck is manufactured in a safe environment by happy workers. This is not a teething toy for small children.World wide deliveryChoose your country. We’re shipping from The Netherlands so it can take a few days, depending on how far you live. Contact us for express delivery if you’re in a hurry. Normally shipping takes 5 – 12 working days outside EU and 5 – 8 working days within EU. Unfortunately we can’t guarantee exact arrival dates due to customs checks. During holidays like Christmas it might take longer to arrive. We’ll do our best to send your order on time!This Batman Rubber Duck is a perfect company give awayAre you looking for a nice give away? Contact us to order our Batman Rubber Duck in bulk and we give you a quote. We can even print your company’s logo on the front.Send this Batman Rubber Duck as a giftA rubber duck puts a smile on everybody’s face. It’s a perfect gift. Choose ‘Ship to a different address’ when checking out. We’ll send your Batman Rubber Duck gift to your friend or family.This Batman Duck has hand painted detailsTake a close look at the tiny bits of this Batman Rubber Duck. These are all hand painted by special craftsmen. It’s a very delicate and skillful job. But it makes the rubber duck look extra good.', 12, 8, '', '', 1, '2016-04-04', 'rasmus.andreas96@gmail.com', 2),
('2222', 'Spiderman Duck', 49, 'Buy the arachnohero of the Amsterdam Duck Store. With his special skills he swings through the store to save our ducks from evil', 'DescriptionSpidy Rubber Duck. Buy the arachnohero of the Amsterdam Duck Store. With his special skills he swings through the store to save our ducks from evil. This spidy rubber duck is a nice gift to surprise your own hero.This Spidy Rubber Duck is CE approvedAll our rubber ducks are CE (Communauté Européenne) approved, according to EU legislation. This means that your rubber duck contains no harmful materials or toxic elements. Next to CE approval we have a very strict quality control to make sure your duck is manufactured in a safe environment by happy workers. This is not a teething toy for small children.World wide deliveryChoose your country. We’re shipping from The Netherlands so it can take a few days, depending on how far you live. Contact us for express delivery if you’re in a hurry. Normally shipping takes 5 to 12 working days outside EU and 5 working days within EU. Unfortunately we can’t guarantee exact arrival dates. During holidays business like Christmas it might take longer to arrive. We’ll do our best to send your order on time! Contact us if you think your order takes too long so we can check with our logistic partner.This Spidy Rubber Duck is a perfect company give awayAre you looking for a nice give away? Contact us to order our Spidy Rubber Duck in bulk and we give you a quote. We can even print your company’s logo on the front.Send this Spidy Rubber Duck as a giftA rubber duck puts a smile on everybody’s face. It’s a perfect gift. Choose ‘Ship to a different address’ when checking out. We’ll send your Spidy Rubber Duck gift to your friend or family.This Spidy Duck has hand painted detailsTake a close look at the tiny bits of this Spidy Rubber Duck. These are all hand painted by special craftsmen. It’s a very delicate and skillful job. But it makes the rubber duck look extra good.', 12, 0, '', '', 1, '2018-11-05', 'rasmus.andreas96@gmail.com', 2),
('3331', 'Volley Duck', 1000, 'Buy the smashing player of the Amsterdam Duck Store. With volleyball jersey and volleyball. Bumping for a pass to score another point.', 'DescriptionVolleyball Rubber Duck. Buy the smashing player of the Amsterdam Duck Store. With volleyball jersey and basketball. Bumping for a pass to score another point.This Volleyball Rubber Duck is CE approvedAll our rubber ducks are CE (Communauté Européenne) approved, according to EU legislation. This means that this Volleyball Rubber Duck contains no harmful materials or toxic elements. Next to CE approval we have a very strict quality control to make sure your duck is manufactured in a safe environment by happy workers. This is not a teething toy for small children.World wide deliveryChoose your country. We’re shipping from The Netherlands so it can take a few days, depending on how far you live. Contact us for express delivery if you’re in a hurry. Normally shipping takes 5 – 12 working days outside EU and 5 – 8 working days within EU. Unfortunately we can’t guarantee exact arrival dates due to customs checks. During holidays like Christmas it might take longer to arrive. We’ll do our best to send your order on time!This Volleyball Rubber Duck is a perfect company give awayAre you looking for a nice give away? Contact us to order our Volleyball Rubber Duck in bulk and we give you a quote. We can even print your company’s logo on the front.Send as a gift!A rubber duck puts a smile on everybody’s face. It’s a perfect gift. Choose ‘Ship to a different address’ when checking out. We’ll send your Volleyball Rubber Duck gift to your friend or family.Hand painted detailsTake a close look at the tiny bits of this Volleyball Rubber Duck. These are all hand painted by special craftsmen. It’s a very delicate and skillful job. But it makes the rubber duck look extra good.', 15, 1, '', '', 1, '2012-12-24', 'rasmus.andreas96@gmail.com', 3),
('3332', 'Surfer Duck', 2, 'Surfer Rubber Duck. Buy the fearless wave rider of the Amsterdam Duck Store. With board and wild hair. Just about to take another tube ride.', 'DescriptionSurfer Rubber Duck. Buy the fearless wave rider of the Amsterdam Duck Store. With board and wild hair. Just about to take another tube ride.This Surfer Rubber Duck is CE approvedAll our rubber ducks are CE (Communauté Européenne) approved, according to EU legislation. This means that your rubber duck contains no harmful materials or toxic elements. Next to CE approval we have a very strict quality control to make sure your duck is manufactured in a safe environment by happy workers. This is not a teething toy for small children.World wide deliveryChoose your country. We’re shipping from The Netherlands so it can take a few days, depending on how far you live. Contact us for express delivery if you’re in a hurry. Normally shipping takes 5 – 12 working days outside EU and 5 – 8 working days within EU. Unfortunately we can’t guarantee exact arrival dates due to customs checks. During holidays like Christmas it might take longer to arrive. We’ll do our best to send your order on time!This Surfer Rubber Duck is a perfect company give awayAre you looking for a nice give away? Contact us to order our Surfer Rubber Duck in bulk and we give you a quote. We can even print your company’s logo on the front.Send this Surfer Rubber Duck as a giftA rubber duck puts a smile on everybody’s face. It’s a perfect gift. Choose ‘Ship to a different address’ when checking out. We’ll send your Surfer Rubber Duck gift to your friend or family.This Surfer Duck has hand painted detailsTake a close look at the tiny bits of this Surfer Rubber Duck. These are all hand painted by special craftsmen. It’s a very delicate and skillful job. But it makes the rubber duck look extra good.', 20, 0, '', '', 1, '2018-01-15', 'rasmus.andreas96@gmail.com', 3),
('3333', 'Kungfu Duck', 997, 'Kung Fu Rubber Duck. Buy the martial arts master of the Amsterdam Duck Store. With with kung fu uniform and black belt.', 'DescriptionKung Fu Rubber Duck. Buy the martial arts master of the Amsterdam Duck Store. With with kung fu uniform and black belt.This Kung Fu Rubber Duck is CE approvedAll our rubber ducks are CE (Communauté Européenne) approved, according to EU legislation. This means that this Kung Fu Rubber Duck contains no harmful materials or toxic elements. Next to CE approval we have a very strict quality control to make sure your duck is manufactured in a safe environment by happy workers. This is not a teething toy for small children.World wide deliveryChoose your country. We’re shipping from The Netherlands so it can take a few days, depending on how far you live. Contact us for express delivery if you’re in a hurry. Normally shipping takes 5 – 12 working days outside EU and 5 – 8 working days within EU. Unfortunately we can’t guarantee exact arrival dates due to customs checks. During holidays like Christmas it might take longer to arrive. We’ll do our best to send your order on time!This Kung Fu Rubber Duck is a perfect company give awayAre you looking for a nice give away? Contact us to order our Kung Fu Rubber Duck in bulk and we give you a quote. We can even print your company’s logo on the front.Send as a gift!A rubber duck puts a smile on everybody’s face. It’s a perfect gift. Choose ‘Ship to a different address’ when checking out. We’ll send your Kung Fu Rubber Duck gift to your friend or family.Hand painted detailsTake a close look at the tiny bits of this Kung Fu Rubber Duck. These are all hand painted by special craftsmen. It’s a very delicate and skillful job. But it makes the rubber duck look extra good.', 25, 19, '', '', 1, '2014-09-20', 'rasmus.andreas96@gmail.com', 3),
('3334', 'Basketball Duck', 1000, 'Buy the dunking player of the Amsterdam Duck Store. With basketball jersey, sweatband and basketball. Ready to release a jump shot.', 'DescriptionBasketball Rubber Duck. Buy the dunking player of the Amsterdam Duck Store. With basketball jersey, sweatband and basketball. Ready to release a jump shot.This Basketball Rubber Duck is CE approvedAll our rubber ducks are CE (Communauté Européenne) approved, according to EU legislation. This means that this Basketball Rubber Duck contains no harmful materials or toxic elements. Next to CE approval we have a very strict quality control to make sure your duck is manufactured in a safe environment by happy workers. This is not a teething toy for small children.World wide deliveryChoose your country. We’re shipping from The Netherlands so it can take a few days, depending on how far you live. Contact us for express delivery if you’re in a hurry. Normally shipping takes 5 – 12 working days outside EU and 5 – 8 working days within EU. Unfortunately we can’t guarantee exact arrival dates due to customs checks. During holidays like Christmas it might take longer to arrive. We’ll do our best to send your order on time!This Basketball Rubber Duck is a perfect company give awayAre you looking for a nice give away? Contact us to order our Basketball Rubber Duck in bulk and we give you a quote. We can even print your company’s logo on the front.Send as a gift!A rubber duck puts a smile on everybody’s face. It’s a perfect gift. Choose ‘Ship to a different address’ when checking out. We’ll send your Basketball Rubber Duck gift to your friend or family.Hand painted detailsTake a close look at the tiny bits of this Basketball Rubber Duck. These are all hand painted by special craftsmen. It’s a very delicate and skillful job. But it makes the rubber duck look extra good.', 25, 0, '', '', 1, '2018-04-10', 'rasmus.andreas96@gmail.com', 3),
('4521329847', 'Tulip Rubber Duck', 100, 'Tulip Rubber Duck. Buy the typical Dutch bulb flower of the Amsterdam Duck Store. Red, yellow and green colored tulip.', 'DescriptionTulip Rubber Duck. Buy the typical Dutch bulb flower of the Amsterdam Duck Store. Red, yellow and green colored tulip.This Tulip Rubber Duck is CE approvedAll our rubber ducks are CE (Communauté Européenne) approved, according to EU legislation. This means that your rubber duck contains no harmful materials or toxic elements. Next to CE approval we have a very strict quality control to make sure your duck is manufactured in a safe environment by happy workers. This is not a teething toy for small children.This Tulip Rubber Duck is world wide deliveredChoose your country. We’re shipping from The Netherlands so it can take a few days, depending on how far you live. Contact us for express delivery if you’re in a hurry. Normally shipping takes 5 to 12 working days outside EU and 5 – 8 working days within EU. Unfortunately we can’t guarantee exact arrival dates due to customs checks. During holidays like Christmas it might take longer to arrive. We’ll do our best to send your order on time!Perfect company give awayAre you looking for a nice give away? Contact us to order our Tulip Rubber Duck in bulk and we give you a quote. We can even print your company’s logo on the front.Send this Tulip Rubber Duck as a giftA rubber duck puts a smile on everybody’s face. It’s a perfect gift. Choose ‘Ship to a different address’ when checking out. We’ll send your Tulip Rubber Duck gift to your friend or family.This Tulip Duck has hand painted detailsTake a close look at the tiny bits of this Tulip Rubber Duck. These are all hand painted by special craftsmen. It’s a very delicate and skillful job. But it makes the rubber duck look extra good.', 9, 0, '', '', 1, '2018-05-24', 'admin@dwp.com', 4),
('4527345', 'Superman Duck', 80, 'This superhero duck will save your day', 'Is it a bird is it a plan. IT IS SUPERMAN DUCK', 10, 0, '', '', 1, '2018-05-24', 'admin@dwp.com', 2);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `ProductCategory`
--

CREATE TABLE `ProductCategory` (
  `ProductCategoryID` int(11) NOT NULL,
  `CategoryName` varchar(255) NOT NULL,
  `Description` text,
  `SeoTitle` varchar(255) DEFAULT NULL,
  `MetaDescription` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `ProductCategory`
--

INSERT INTO `ProductCategory` (`ProductCategoryID`, `CategoryName`, `Description`, `SeoTitle`, `MetaDescription`) VALUES
(1, 'Normal Ducks', 'The normal ducks are for plain people', 'SeoTitle for Cat1', 'This is the Metadescription for category 1'),
(2, 'SuperHero Ducks', 'Superhero Ducks are for the people who wants to save the world in style', 'SeoTitle for Cat2', 'This is the Metadescription for category 2'),
(3, 'Sport Ducks', '<div>Sport Ducks are for the highschool jocks that have been bullying you for your entire life</div>', 'SeoTitle for Cat3', 'This is the Metadescription for category 3'),
(4, 'Festival duck', '<div>These festivals are getting out of hand. The ducks are doing wild</div>', '', '');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `ProductImg`
--

CREATE TABLE `ProductImg` (
  `ItemNumber` varchar(255) NOT NULL,
  `ImgID` int(11) NOT NULL,
  `IsPrimary` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `ProductImg`
--

INSERT INTO `ProductImg` (`ItemNumber`, `ImgID`, `IsPrimary`) VALUES
('1111', 17, 1),
('1111', 18, 0),
('1111', 19, 0),
('1111', 20, 0),
('1112', 13, 1),
('1112', 14, 0),
('1112', 15, 0),
('1112', 16, 0),
('1113', 12, 1),
('2221', 10, 1),
('2221', 11, 0),
('2222', 32, 1),
('2222', 33, 0),
('2222', 34, 0),
('2222', 35, 0),
('3331', 27, 1),
('3331', 28, 0),
('3331', 30, 0),
('3331', 31, 0),
('3332', 21, 1),
('3333', 22, 1),
('3333', 23, 0),
('3333', 24, 0),
('3333', 25, 0),
('3334', 26, 1),
('4521329847', 9, 1),
('4527345', 7, 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `PromoCode`
--

CREATE TABLE `PromoCode` (
  `PromoCode` varchar(255) NOT NULL,
  `DiscountAmount` int(2) NOT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  `NumberOfUses` int(11) DEFAULT NULL,
  `UserEmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `PromoCode`
--

INSERT INTO `PromoCode` (`PromoCode`, `DiscountAmount`, `StartDate`, `EndDate`, `NumberOfUses`, `UserEmail`) VALUES
('gammel', 50, '2009-11-11', '2009-12-11', 100, 'rasmus.andreas96@gmail.com'),
('ingendato', 50, NULL, NULL, 100, 'rasmus.andreas96@gmail.com'),
('intetantal', 50, '2009-11-11', '2020-11-11', NULL, 'rasmus.andreas96@gmail.com'),
('ny', 50, '2020-11-11', '2020-12-11', 100, 'rasmus.andreas96@gmail.com'),
('virker', 50, '2009-11-11', '2020-11-11', 100, 'rasmus.andreas96@gmail.com');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `Review`
--

CREATE TABLE `Review` (
  `ReviewID` int(11) NOT NULL,
  `ReviewDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Rating` int(1) NOT NULL,
  `ReviewTitle` varchar(255) NOT NULL,
  `ReviewName` varchar(255) DEFAULT NULL,
  `ReviewContent` text,
  `ItemNumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `Review`
--

INSERT INTO `Review` (`ReviewID`, `ReviewDate`, `Rating`, `ReviewTitle`, `ReviewName`, `ReviewContent`, `ItemNumber`) VALUES
(14, '2018-05-24 21:43:19', 3, 'Great Duck', 'Anonymous', 'This is a really great and cheap duck', '1111'),
(15, '2018-05-24 21:44:16', 1, 'Not green', 'Kunde', 'The duck wasn&#39;t green enough. Disappointed', '1111'),
(16, '2018-05-24 21:45:21', 4, 'Cool', 'Rasmus Andreas', 'Wow this duck was exactly what I needed. Thank you', '1112'),
(17, '2018-05-24 21:45:57', 3, 'Very cheap and fast', 'Anonymous', '', '1112'),
(18, '2018-05-24 21:47:03', 3, 'The delivery was on time', 'Anonymous', 'Fast and secure. Would definitely buy again.', '1113'),
(21, '2018-05-25 07:13:42', 4, 'Nice quality', 'Jesper', 'I bought this duck for a present. The quality is very good.', '4527345');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `User`
--

CREATE TABLE `User` (
  `UserEmail` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `ResetKey` varchar(255) DEFAULT NULL,
  `AccessLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `User`
--

INSERT INTO `User` (`UserEmail`, `Password`, `FirstName`, `LastName`, `ResetKey`, `AccessLevel`) VALUES
('admin@dwp.com', '$2y$10$8esR6xSS.3XBOC3trjPXS.yZJsQluApvQsoyHeJOLbshZsdkFFU5a', 'Admin', 'Admin', NULL, 1),
('post@jdanet.dk', '$2a$10$74zsjq9/Tv6Ydq.QLlKeju.bwxXfs8GUSN051E1EeMIi4L/beo1Li', 'Jesper', 'Dalsgaard', NULL, 0),
('rasmus.andreas96@gmail.com', '$2a$10$74zsjq9/Tv6Ydq.QLlKeju.bwxXfs8GUSN051E1EeMIi4L/beo1Li', 'Rasmus Andreas', 'Nielsen', NULL, 1),
('sebastiankbuch@hotmail.com', '$2a$10$74zsjq9/Tv6Ydq.QLlKeju.bwxXfs8GUSN051E1EeMIi4L/beo1Li', 'Sebastian', 'Buch', NULL, 0);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `ZipCode`
--

CREATE TABLE `ZipCode` (
  `ZipCode` int(20) NOT NULL,
  `City` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `ZipCode`
--

INSERT INTO `ZipCode` (`ZipCode`, `City`) VALUES
(100, 'Tórshavn'),
(110, 'Tórshavn'),
(160, 'Argir'),
(165, 'Argir'),
(175, 'Kirkjubøur'),
(176, 'Velbastadur'),
(177, 'Sydradalur, Streymoy'),
(178, 'Nordradalur'),
(180, 'Kaldbak'),
(185, 'Kaldbaksbotnur'),
(186, 'Sund'),
(187, 'Hvitanes'),
(188, 'Hoyvík'),
(210, 'Sandur'),
(215, 'Sandur'),
(220, 'Skálavík'),
(230, 'Húsavík'),
(235, 'Dalur'),
(236, 'Skarvanes'),
(240, 'Skopun'),
(260, 'Skúvoy'),
(270, 'Nólsoy'),
(280, 'Hestur'),
(285, 'Koltur'),
(286, 'Stóra Dimun'),
(330, 'Stykkid'),
(335, 'Leynar'),
(336, 'Skællingur'),
(340, 'Kvívík'),
(350, 'Vestmanna'),
(355, 'Vestmanna'),
(358, 'Válur'),
(360, 'Sandavágur'),
(370, 'Midvágur'),
(375, 'Midvágur'),
(380, 'Sørvágur'),
(385, 'Vatnsoyrar'),
(386, 'Bøur'),
(387, 'Gásadalur'),
(388, 'Mykines'),
(400, 'Oyrarbakki'),
(405, 'Oyrarbakki'),
(410, 'Kollafjørdur'),
(415, 'Oyrareingir'),
(416, 'Signabøur'),
(420, 'Hósvík'),
(430, 'Hvalvík'),
(435, 'Streymnes'),
(436, 'Saksun'),
(437, 'Nesvík'),
(438, 'Langasandur'),
(440, 'Haldarsvík'),
(445, 'Tjørnuvík'),
(450, 'Oyri'),
(460, 'Nordskáli'),
(465, 'Svináir'),
(466, 'Ljósá'),
(470, 'Eidi'),
(475, 'Funningur'),
(476, 'Gjógv'),
(477, 'Funningsfjørdur'),
(478, 'Elduvík'),
(480, 'Skáli'),
(485, 'Skálafjørdur'),
(490, 'Strendur'),
(494, 'Innan Glyvur'),
(495, 'Kolbanargjógv'),
(496, 'Morskranes'),
(497, 'Selatrad'),
(510, 'Gøta'),
(511, 'Gøtugjógv'),
(512, 'Nordragøta'),
(513, 'Sydrugøta'),
(515, 'Gøta'),
(520, 'Leirvík'),
(530, 'Fuglafjørdur'),
(535, 'Fuglafjørdur'),
(600, 'Saltangará'),
(610, 'Saltangará'),
(620, 'Runavík'),
(625, 'Glyvrar'),
(626, 'Lambareidi'),
(627, 'Lambi'),
(640, 'Rituvík'),
(645, 'Æduvík'),
(650, 'Toftir'),
(655, 'Nes, Eysturoy'),
(656, 'Saltnes'),
(660, 'Søldarfjørdur'),
(665, 'Skipanes'),
(666, 'Gøtueidi'),
(690, 'Oyndarfjørdur'),
(695, 'Hellur'),
(700, 'Klaksvík'),
(710, 'Klaksvík'),
(725, 'Nordoyri'),
(726, 'Ánir'),
(727, 'Árnafjørdur'),
(730, 'Norddepil'),
(735, 'Depil'),
(736, 'Nordtoftir'),
(737, 'Múli'),
(740, 'Hvannasund'),
(750, 'Vidareidi'),
(765, 'Svinoy'),
(766, 'Kirkja'),
(767, 'Hattarvík'),
(780, 'Kunoy'),
(785, 'Haraldssund'),
(795, 'Sydradalur, Kalsoy'),
(796, 'Húsar'),
(797, 'Mikladalur'),
(798, 'Trøllanes'),
(800, 'Tvøroyri'),
(810, 'Tvøroyri'),
(825, 'Frodba'),
(826, 'Trongisvágur'),
(827, 'Øravík'),
(850, 'Hvalba'),
(860, 'Sandvík'),
(870, 'Fámjin'),
(900, 'Vágur'),
(910, 'Vágur'),
(914, 'København K'),
(925, 'Nes, Vágur'),
(926, 'Lopra'),
(927, 'Akrar'),
(928, 'Vikarbyrgi'),
(950, 'Porkeri'),
(960, 'Hov'),
(970, 'Sumba'),
(1000, 'København K'),
(1001, 'København K'),
(1002, 'København K'),
(1003, 'København K'),
(1004, 'København K'),
(1005, 'København K'),
(1006, 'København K'),
(1007, 'København K'),
(1008, 'København K'),
(1009, 'København K'),
(1010, 'København K'),
(1011, 'København K'),
(1012, 'København K'),
(1013, 'København K'),
(1014, 'København K'),
(1015, 'København K'),
(1016, 'København K'),
(1017, 'København K'),
(1018, 'København K'),
(1019, 'København K'),
(1020, 'København K'),
(1021, 'København K'),
(1022, 'København K'),
(1023, 'København K'),
(1024, 'København K'),
(1025, 'København K'),
(1026, 'København K'),
(1045, 'København K'),
(1050, 'København K'),
(1051, 'København K'),
(1052, 'København K'),
(1053, 'København K'),
(1054, 'København K'),
(1055, 'København K'),
(1056, 'København K'),
(1057, 'København K'),
(1058, 'København K'),
(1059, 'København K'),
(1060, 'København K'),
(1061, 'København K'),
(1062, 'København K'),
(1063, 'København K'),
(1064, 'København K'),
(1065, 'København K'),
(1066, 'København K'),
(1067, 'København K'),
(1068, 'København K'),
(1069, 'København K'),
(1070, 'København K'),
(1071, 'København K'),
(1072, 'København K'),
(1073, 'København K'),
(1074, 'København K'),
(1092, 'København K'),
(1093, 'København K'),
(1095, 'København K'),
(1098, 'København K'),
(1100, 'København K'),
(1101, 'København K'),
(1102, 'København K'),
(1103, 'København K'),
(1104, 'København K'),
(1105, 'København K'),
(1106, 'København K'),
(1107, 'København K'),
(1110, 'København K'),
(1111, 'København K'),
(1112, 'København K'),
(1113, 'København K'),
(1114, 'København K'),
(1115, 'København K'),
(1116, 'København K'),
(1117, 'København K'),
(1118, 'København K'),
(1119, 'København K'),
(1120, 'København K'),
(1121, 'København K'),
(1122, 'København K'),
(1123, 'København K'),
(1124, 'København K'),
(1125, 'København K'),
(1126, 'København K'),
(1127, 'København K'),
(1128, 'København K'),
(1129, 'København K'),
(1130, 'København K'),
(1131, 'København K'),
(1140, 'København K'),
(1147, 'København K'),
(1148, 'København K'),
(1150, 'København K'),
(1151, 'København K'),
(1152, 'København K'),
(1153, 'København K'),
(1154, 'København K'),
(1155, 'København K'),
(1156, 'København K'),
(1157, 'København K'),
(1158, 'København K'),
(1159, 'København K'),
(1160, 'København K'),
(1161, 'København K'),
(1162, 'København K'),
(1163, 'København K'),
(1164, 'København K'),
(1165, 'København K'),
(1166, 'København K'),
(1167, 'København K'),
(1168, 'København K'),
(1169, 'København K'),
(1170, 'København K'),
(1171, 'København K'),
(1172, 'København K'),
(1173, 'København K'),
(1174, 'København K'),
(1175, 'København K'),
(1200, 'København K'),
(1201, 'København K'),
(1202, 'København K'),
(1203, 'København K'),
(1204, 'København K'),
(1205, 'København K'),
(1206, 'København K'),
(1207, 'København K'),
(1208, 'København K'),
(1209, 'København K'),
(1210, 'København K'),
(1211, 'København K'),
(1212, 'København K'),
(1213, 'København K'),
(1214, 'København K'),
(1215, 'København K'),
(1216, 'København K'),
(1217, 'København K'),
(1218, 'København K'),
(1219, 'København K'),
(1220, 'København K'),
(1221, 'København K'),
(1240, 'København K'),
(1250, 'København K'),
(1251, 'København K'),
(1253, 'København K'),
(1254, 'København K'),
(1255, 'København K'),
(1256, 'København K'),
(1257, 'København K'),
(1259, 'København K'),
(1260, 'København K'),
(1261, 'København K'),
(1263, 'København K'),
(1264, 'København K'),
(1265, 'København K'),
(1266, 'København K'),
(1267, 'København K'),
(1268, 'København K'),
(1270, 'København K'),
(1271, 'København K'),
(1300, 'København K'),
(1301, 'København K'),
(1302, 'København K'),
(1303, 'København K'),
(1304, 'København K'),
(1306, 'København K'),
(1307, 'København K'),
(1308, 'København K'),
(1309, 'København K'),
(1310, 'København K'),
(1311, 'København K'),
(1312, 'København K'),
(1313, 'København K'),
(1314, 'København K'),
(1315, 'København K'),
(1316, 'København K'),
(1317, 'København K'),
(1318, 'København K'),
(1319, 'København K'),
(1320, 'København K'),
(1321, 'København K'),
(1322, 'København K'),
(1323, 'København K'),
(1324, 'København K'),
(1325, 'København K'),
(1326, 'København K'),
(1327, 'København K'),
(1328, 'København K'),
(1329, 'København K'),
(1350, 'København K'),
(1352, 'København K'),
(1353, 'København K'),
(1354, 'København K'),
(1355, 'København K'),
(1356, 'København K'),
(1357, 'København K'),
(1358, 'København K'),
(1359, 'København K'),
(1360, 'København K'),
(1361, 'København K'),
(1362, 'København K'),
(1363, 'København K'),
(1364, 'København K'),
(1365, 'København K'),
(1366, 'København K'),
(1367, 'København K'),
(1368, 'København K'),
(1369, 'København K'),
(1370, 'København K'),
(1371, 'København K'),
(1400, 'København K'),
(1401, 'København K'),
(1402, 'København K'),
(1403, 'København K'),
(1404, 'København K'),
(1406, 'København K'),
(1407, 'København K'),
(1408, 'København K'),
(1409, 'København K'),
(1410, 'København K'),
(1411, 'København K'),
(1412, 'København K'),
(1413, 'København K'),
(1414, 'København K'),
(1415, 'København K'),
(1416, 'København K'),
(1417, 'København K'),
(1418, 'København K'),
(1419, 'København K'),
(1420, 'København K'),
(1421, 'København K'),
(1422, 'København K'),
(1423, 'København K'),
(1424, 'København K'),
(1425, 'København K'),
(1426, 'København K'),
(1427, 'København K'),
(1428, 'København K'),
(1429, 'København K'),
(1430, 'København K'),
(1431, 'København K'),
(1432, 'København K'),
(1433, 'København K'),
(1434, 'København K'),
(1435, 'København K'),
(1436, 'København K'),
(1437, 'København K'),
(1438, 'København K'),
(1439, 'København K'),
(1440, 'København K'),
(1441, 'København K'),
(1448, 'København K'),
(1450, 'København K'),
(1451, 'København K'),
(1452, 'København K'),
(1453, 'København K'),
(1454, 'København K'),
(1455, 'København K'),
(1456, 'København K'),
(1457, 'København K'),
(1458, 'København K'),
(1459, 'København K'),
(1460, 'København K'),
(1461, 'København K'),
(1462, 'København K'),
(1463, 'København K'),
(1464, 'København K'),
(1465, 'København K'),
(1466, 'København K'),
(1467, 'København K'),
(1468, 'København K'),
(1470, 'København K'),
(1471, 'København K'),
(1472, 'København K'),
(1473, 'København K'),
(1500, 'København V'),
(1501, 'København V'),
(1502, 'København V'),
(1503, 'København V'),
(1504, 'København V'),
(1505, 'København V'),
(1506, 'København V'),
(1507, 'København V'),
(1508, 'København V'),
(1509, 'København V'),
(1510, 'København V'),
(1512, 'København V'),
(1513, 'København V'),
(1532, 'København V'),
(1533, 'København V'),
(1550, 'København V'),
(1551, 'København V'),
(1552, 'København V'),
(1553, 'København V'),
(1554, 'København V'),
(1555, 'København V'),
(1556, 'København V'),
(1557, 'København V'),
(1558, 'København V'),
(1559, 'København V'),
(1560, 'København V'),
(1561, 'København V'),
(1562, 'København V'),
(1563, 'København V'),
(1564, 'København V'),
(1566, 'København V'),
(1567, 'København V'),
(1568, 'København V'),
(1569, 'København V'),
(1570, 'København V'),
(1571, 'København V'),
(1572, 'København V'),
(1573, 'København V'),
(1574, 'København V'),
(1575, 'København V'),
(1576, 'København V'),
(1577, 'København V'),
(1592, 'København V'),
(1599, 'København V'),
(1600, 'København V'),
(1601, 'København V'),
(1602, 'København V'),
(1603, 'København V'),
(1604, 'København V'),
(1605, 'København V'),
(1606, 'København V'),
(1607, 'København V'),
(1608, 'København V'),
(1609, 'København V'),
(1610, 'København V'),
(1611, 'København V'),
(1612, 'København V'),
(1613, 'København V'),
(1614, 'København V'),
(1615, 'København V'),
(1616, 'København V'),
(1617, 'København V'),
(1618, 'København V'),
(1619, 'København V'),
(1620, 'København V'),
(1621, 'København V'),
(1622, 'København V'),
(1623, 'København V'),
(1624, 'København V'),
(1630, 'København V'),
(1631, 'København V'),
(1632, 'København V'),
(1633, 'København V'),
(1634, 'København V'),
(1635, 'København V'),
(1650, 'København V'),
(1651, 'København V'),
(1652, 'København V'),
(1653, 'København V'),
(1654, 'København V'),
(1655, 'København V'),
(1656, 'København V'),
(1657, 'København V'),
(1658, 'København V'),
(1659, 'København V'),
(1660, 'København V'),
(1661, 'København V'),
(1662, 'København V'),
(1663, 'København V'),
(1664, 'København V'),
(1665, 'København V'),
(1666, 'København V'),
(1667, 'København V'),
(1668, 'København V'),
(1669, 'København V'),
(1670, 'København V'),
(1671, 'København V'),
(1672, 'København V'),
(1673, 'København V'),
(1674, 'København V'),
(1675, 'København V'),
(1676, 'København V'),
(1677, 'København V'),
(1699, 'København V'),
(1700, 'København V'),
(1701, 'København V'),
(1702, 'København V'),
(1703, 'København V'),
(1704, 'København V'),
(1705, 'København V'),
(1706, 'København V'),
(1707, 'København V'),
(1708, 'København V'),
(1709, 'København V'),
(1710, 'København V'),
(1711, 'København V'),
(1712, 'København V'),
(1713, 'København V'),
(1714, 'København V'),
(1715, 'København V'),
(1716, 'København V'),
(1717, 'København V'),
(1718, 'København V'),
(1719, 'København V'),
(1720, 'København V'),
(1721, 'København V'),
(1722, 'København V'),
(1723, 'København V'),
(1724, 'København V'),
(1725, 'København V'),
(1726, 'København V'),
(1727, 'København V'),
(1728, 'København V'),
(1729, 'København V'),
(1730, 'København V'),
(1731, 'København V'),
(1732, 'København V'),
(1733, 'København V'),
(1734, 'København V'),
(1735, 'København V'),
(1736, 'København V'),
(1737, 'København V'),
(1738, 'København V'),
(1739, 'København V'),
(1749, 'København V'),
(1750, 'København V'),
(1751, 'København V'),
(1752, 'København V'),
(1753, 'København V'),
(1754, 'København V'),
(1755, 'København V'),
(1756, 'København V'),
(1757, 'København V'),
(1758, 'København V'),
(1759, 'København V'),
(1760, 'København V'),
(1761, 'København V'),
(1762, 'København V'),
(1763, 'København V'),
(1764, 'København V'),
(1765, 'København V'),
(1766, 'København V'),
(1770, 'København V'),
(1771, 'København V'),
(1772, 'København V'),
(1773, 'København V'),
(1774, 'København V'),
(1775, 'København V'),
(1777, 'København V'),
(1780, 'København V'),
(1782, 'København V'),
(1785, 'København V'),
(1786, 'København V'),
(1787, 'København V'),
(1790, 'København V'),
(1799, 'København V'),
(1800, 'Frederiksberg C'),
(1801, 'Frederiksberg C'),
(1802, 'Frederiksberg C'),
(1803, 'Frederiksberg C'),
(1804, 'Frederiksberg C'),
(1805, 'Frederiksberg C'),
(1806, 'Frederiksberg C'),
(1807, 'Frederiksberg C'),
(1808, 'Frederiksberg C'),
(1809, 'Frederiksberg C'),
(1810, 'Frederiksberg C'),
(1811, 'Frederiksberg C'),
(1812, 'Frederiksberg C'),
(1813, 'Frederiksberg C'),
(1814, 'Frederiksberg C'),
(1815, 'Frederiksberg C'),
(1816, 'Frederiksberg C'),
(1817, 'Frederiksberg C'),
(1818, 'Frederiksberg C'),
(1819, 'Frederiksberg C'),
(1820, 'Frederiksberg C'),
(1822, 'Frederiksberg C'),
(1823, 'Frederiksberg C'),
(1824, 'Frederiksberg C'),
(1825, 'Frederiksberg C'),
(1826, 'Frederiksberg C'),
(1827, 'Frederiksberg C'),
(1828, 'Frederiksberg C'),
(1829, 'Frederiksberg C'),
(1835, 'Frederiksberg C'),
(1850, 'Frederiksberg C'),
(1851, 'Frederiksberg C'),
(1852, 'Frederiksberg C'),
(1853, 'Frederiksberg C'),
(1854, 'Frederiksberg C'),
(1855, 'Frederiksberg C'),
(1856, 'Frederiksberg C'),
(1857, 'Frederiksberg C'),
(1860, 'Frederiksberg C'),
(1861, 'Frederiksberg C'),
(1862, 'Frederiksberg C'),
(1863, 'Frederiksberg C'),
(1864, 'Frederiksberg C'),
(1865, 'Frederiksberg C'),
(1866, 'Frederiksberg C'),
(1867, 'Frederiksberg C'),
(1868, 'Frederiksberg C'),
(1870, 'Frederiksberg C'),
(1871, 'Frederiksberg C'),
(1872, 'Frederiksberg C'),
(1873, 'Frederiksberg C'),
(1874, 'Frederiksberg C'),
(1875, 'Frederiksberg C'),
(1876, 'Frederiksberg C'),
(1877, 'Frederiksberg C'),
(1878, 'Frederiksberg C'),
(1879, 'Frederiksberg C'),
(1900, 'Frederiksberg C'),
(1901, 'Frederiksberg C'),
(1902, 'Frederiksberg C'),
(1903, 'Frederiksberg C'),
(1904, 'Frederiksberg C'),
(1905, 'Frederiksberg C'),
(1906, 'Frederiksberg C'),
(1908, 'Frederiksberg C'),
(1909, 'Frederiksberg C'),
(1910, 'Frederiksberg C'),
(1911, 'Frederiksberg C'),
(1912, 'Frederiksberg C'),
(1913, 'Frederiksberg C'),
(1914, 'Frederiksberg C'),
(1915, 'Frederiksberg C'),
(1916, 'Frederiksberg C'),
(1917, 'Frederiksberg C'),
(1920, 'Frederiksberg C'),
(1921, 'Frederiksberg C'),
(1922, 'Frederiksberg C'),
(1923, 'Frederiksberg C'),
(1924, 'Frederiksberg C'),
(1925, 'Frederiksberg C'),
(1926, 'Frederiksberg C'),
(1927, 'Frederiksberg C'),
(1928, 'Frederiksberg C'),
(1931, 'Frederiksberg C'),
(1950, 'Frederiksberg C'),
(1951, 'Frederiksberg C'),
(1952, 'Frederiksberg C'),
(1953, 'Frederiksberg C'),
(1954, 'Frederiksberg C'),
(1955, 'Frederiksberg C'),
(1956, 'Frederiksberg C'),
(1957, 'Frederiksberg C'),
(1958, 'Frederiksberg C'),
(1959, 'Frederiksberg C'),
(1960, 'Frederiksberg C'),
(1961, 'Frederiksberg C'),
(1962, 'Frederiksberg C'),
(1963, 'Frederiksberg C'),
(1964, 'Frederiksberg C'),
(1965, 'Frederiksberg C'),
(1966, 'Frederiksberg C'),
(1967, 'Frederiksberg C'),
(1970, 'Frederiksberg C'),
(1971, 'Frederiksberg C'),
(1972, 'Frederiksberg C'),
(1973, 'Frederiksberg C'),
(1974, 'Frederiksberg C'),
(2000, 'Frederiksberg'),
(2100, 'København Ø'),
(2150, 'Nordhavn'),
(2200, 'København N'),
(2300, 'København S'),
(2400, 'København NV'),
(2412, 'Santa Claus/Julemanden'),
(2450, 'København SV'),
(2500, 'Valby'),
(2600, 'Glostrup'),
(2605, 'Brøndby'),
(2610, 'Rødovre'),
(2620, 'Albertslund'),
(2625, 'Vallensbæk'),
(2630, 'Taastrup'),
(2635, 'Ishøj'),
(2640, 'Hedehusene'),
(2650, 'Hvidovre'),
(2660, 'Brøndby Strand'),
(2665, 'Vallensbæk Strand'),
(2670, 'Greve'),
(2680, 'Solrød Strand'),
(2690, 'Karlslunde'),
(2700, 'Brønshøj'),
(2720, 'Vanløse'),
(2730, 'Herlev'),
(2740, 'Skovlunde'),
(2750, 'Ballerup'),
(2760, 'Måløv'),
(2765, 'Smørum'),
(2770, 'Kastrup'),
(2791, 'Dragør'),
(2800, 'Kongens Lyngby'),
(2820, 'Gentofte'),
(2830, 'Virum'),
(2840, 'Holte'),
(2850, 'Nærum'),
(2860, 'Søborg'),
(2870, 'Dyssegård'),
(2880, 'Bagsværd'),
(2900, 'Hellerup'),
(2920, 'Charlottenlund'),
(2930, 'Klampenborg'),
(2942, 'Skodsborg'),
(2950, 'Vedbæk'),
(2960, 'Rungsted Kyst'),
(2970, 'Hørsholm'),
(2980, 'Kokkedal'),
(2990, 'Nivå'),
(3000, 'Helsingør'),
(3050, 'Humlebæk'),
(3060, 'Espergærde'),
(3070, 'Snekkersten'),
(3080, 'Tikøb'),
(3100, 'Hornbæk'),
(3120, 'Dronningmølle'),
(3140, 'Ålsgårde'),
(3150, 'Hellebæk'),
(3200, 'Helsinge'),
(3210, 'Vejby'),
(3220, 'Tisvildeleje'),
(3230, 'Græsted'),
(3250, 'Gilleleje'),
(3300, 'Frederiksværk'),
(3310, 'Ølsted'),
(3320, 'Skævinge'),
(3330, 'Gørløse'),
(3360, 'Liseleje'),
(3370, 'Melby'),
(3390, 'Hundested'),
(3400, 'Hillerød'),
(3450, 'Allerød'),
(3460, 'Birkerød'),
(3480, 'Fredensborg'),
(3490, 'Kvistgård'),
(3500, 'Værløse'),
(3520, 'Farum'),
(3540, 'Lynge'),
(3550, 'Slangerup'),
(3600, 'Frederikssund'),
(3630, 'Jægerspris'),
(3650, 'Ølstykke'),
(3660, 'Stenløse'),
(3670, 'Veksø Sjælland'),
(3700, 'Rønne'),
(3720, 'Aakirkeby'),
(3730, 'Nexø'),
(3740, 'Svaneke'),
(3751, 'Østermarie'),
(3760, 'Gudhjem'),
(3770, 'Allinge'),
(3782, 'Klemensker'),
(3790, 'Hasle'),
(3900, 'Nuuk'),
(3905, 'Nuussuaq'),
(3910, 'Kangerlussuaq'),
(3911, 'Sisimiut'),
(3912, 'Maniitsoq'),
(3913, 'Tasiilaq'),
(3915, 'Kulusuk'),
(3919, 'Alluitsup Paa'),
(3920, 'Qaqortoq'),
(3921, 'Narsaq'),
(3922, 'Nanortalik'),
(3923, 'Narsarsuaq'),
(3924, 'Ikerasassuaq'),
(3930, 'Kangilinnguit'),
(3932, 'Arsuk'),
(3940, 'Paamiut'),
(3950, 'Aasiaat'),
(3951, 'Qasigiannguit'),
(3952, 'Ilulissat'),
(3953, 'Qeqertarsuaq'),
(3955, 'Kangaatsiaq'),
(3961, 'Uummannaq'),
(3962, 'Upernavik'),
(3964, 'Qaarsut'),
(3970, 'Pituffik'),
(3971, 'Qaanaaq'),
(3972, 'Staon Nord'),
(3980, 'Ioqqortoormiit'),
(3982, 'Mestersvig'),
(3984, 'Danmarkshavn'),
(3985, 'Constable Pynt'),
(3992, 'Slædepatruljen Sirius'),
(4000, 'Roskilde'),
(4030, 'Tune'),
(4040, 'Jyllinge'),
(4050, 'Skibby'),
(4060, 'Kirke Såby'),
(4070, 'Kirke Hyllinge'),
(4100, 'Ringsted'),
(4129, 'Ringsted'),
(4130, 'Viby Sjælland'),
(4140, 'Borup'),
(4160, 'Herlufmagle'),
(4171, 'Glumsø'),
(4173, 'Fjenneslev'),
(4174, 'Jystrup Midtsj'),
(4180, 'Sorø'),
(4190, 'Munke Bjergby'),
(4200, 'Slagelse'),
(4220, 'Korsør'),
(4230, 'Skælskør'),
(4241, 'Vemmelev'),
(4242, 'Boeslunde'),
(4243, 'Rude'),
(4244, 'Agersø'),
(4245, 'Omø'),
(4250, 'Fuglebjerg'),
(4261, 'Dalmose'),
(4262, 'Sandved'),
(4270, 'Høng'),
(4281, 'Gørlev'),
(4291, 'Ruds Vedby'),
(4293, 'Dianalund'),
(4295, 'Stenlille'),
(4296, 'Nyrup'),
(4300, 'Holbæk'),
(4305, 'Orø'),
(4320, 'Lejre'),
(4330, 'Hvalsø'),
(4340, 'Tølløse'),
(4350, 'Ugerløse'),
(4360, 'Kirke Eskilstrup'),
(4370, 'Store Merløse'),
(4390, 'Vipperød'),
(4400, 'Kalundborg'),
(4420, 'Regstrup'),
(4440, 'Mørkøv'),
(4450, 'Jyderup'),
(4460, 'Snertinge'),
(4470, 'Svebølle'),
(4480, 'Store Fuglede'),
(4490, 'Jerslev Sjælland'),
(4500, 'Nykøbing S'),
(4520, 'Svinninge'),
(4532, 'Gislinge'),
(4534, 'Hørve'),
(4540, 'Fårevejle'),
(4550, 'Asnæs'),
(4560, 'Vig'),
(4571, 'Grevinge'),
(4572, 'Nørre Asmindrup'),
(4573, 'Højby'),
(4581, 'Rørvig'),
(4583, 'Sjællands Odde'),
(4591, 'Føllenslev'),
(4592, 'Sejerø'),
(4593, 'Eskebjerg'),
(4600, 'Køge'),
(4621, 'Gadstrup'),
(4622, 'Havdrup'),
(4623, 'Lille Skensved'),
(4632, 'Bjæverskov'),
(4640, 'Fakse'),
(4652, 'Hårlev'),
(4653, 'Karise'),
(4654, 'Fakse Ladeplads'),
(4660, 'Store Heddinge'),
(4671, 'Strøby'),
(4672, 'Klippinge'),
(4673, 'Rødvig Stevns'),
(4681, 'Herfølge'),
(4682, 'Tureby'),
(4683, 'Rønnede'),
(4684, 'Holmegaard'),
(4690, 'Haslev'),
(4700, 'Næstved'),
(4720, 'Præstø'),
(4733, 'Tappernøje'),
(4735, 'Mern'),
(4736, 'Karrebæksminde'),
(4750, 'Lundby'),
(4760, 'Vordingborg'),
(4771, 'Kalvehave'),
(4772, 'Langebæk'),
(4773, 'Stensved'),
(4780, 'Stege'),
(4791, 'Borre'),
(4792, 'Askeby'),
(4793, 'Bogø By'),
(4800, 'Nykøbing F'),
(4840, 'Nørre Alslev'),
(4850, 'Stubbekøbing'),
(4862, 'Guldborg'),
(4863, 'Eskilstrup'),
(4871, 'Horbelev'),
(4872, 'Idestrup'),
(4873, 'Væggerløse'),
(4874, 'Gedser'),
(4880, 'Nysted'),
(4891, 'Toreby L'),
(4892, 'Kettinge'),
(4894, 'Øster Ulslev'),
(4895, 'Errindlev'),
(4900, 'Nakskov'),
(4912, 'Harpelunde'),
(4913, 'Horslunde'),
(4920, 'Søllested'),
(4930, 'Maribo'),
(4941, 'Bandholm'),
(4942, 'Askø og Lilleø'),
(4943, 'Torrig L'),
(4944, 'Fejø'),
(4945, 'Femø'),
(4951, 'Nørreballe'),
(4952, 'Stokkemarke'),
(4953, 'Vesterborg'),
(4960, 'Holeby'),
(4970, 'Rødby'),
(4983, 'Dannemare'),
(4990, 'Sakskøbing'),
(4992, 'Midtsjælland USF P'),
(5000, 'Odense C'),
(5029, 'Odense C'),
(5100, 'Odense C'),
(5200, 'Odense V'),
(5210, 'Odense NV'),
(5220, 'Odense SØ'),
(5230, 'Odense M'),
(5240, 'Odense NØ'),
(5250, 'Odense SV'),
(5260, 'Odense S'),
(5270, 'Odense N'),
(5290, 'Marslev'),
(5300, 'Kerteminde'),
(5320, 'Agedrup'),
(5330, 'Munkebo'),
(5350, 'Rynkeby'),
(5370, 'Mesinge'),
(5380, 'Dalby'),
(5390, 'Martofte'),
(5400, 'Bogense'),
(5450, 'Otterup'),
(5462, 'Morud'),
(5463, 'Harndrup'),
(5464, 'Brenderup Fyn'),
(5466, 'Asperup'),
(5471, 'Søndersø'),
(5474, 'Veflinge'),
(5485, 'Skamby'),
(5491, 'Blommenslyst'),
(5492, 'Vissenbjerg'),
(5500, 'Middelfart'),
(5540, 'Ullerslev'),
(5550, 'Langeskov'),
(5560, 'Aarup'),
(5580, 'Nørre Aaby'),
(5591, 'Gelsted'),
(5592, 'Ejby'),
(5600, 'Faaborg'),
(5601, 'Lyø'),
(5602, 'Avernakø'),
(5603, 'Bjørnø'),
(5610, 'Assens'),
(5620, 'Glamsbjerg'),
(5631, 'Ebberup'),
(5642, 'Millinge'),
(5672, 'Broby'),
(5683, 'Haarby'),
(5690, 'Tommerup'),
(5700, 'Svendborg'),
(5750, 'Ringe'),
(5762, 'Vester Skerninge'),
(5771, 'Stenstrup'),
(5772, 'Kværndrup'),
(5792, 'Årslev'),
(5800, 'Nyborg'),
(5853, 'Ørbæk'),
(5854, 'Gislev'),
(5856, 'Ryslinge'),
(5863, 'Ferritslev Fyn'),
(5871, 'Frørup'),
(5874, 'Hesselager'),
(5881, 'Skårup Fyn'),
(5882, 'Vejstrup'),
(5883, 'Oure'),
(5884, 'Gudme'),
(5892, 'Gudbjerg Sydfyn'),
(5900, 'Rudkøbing'),
(5932, 'Humble'),
(5935, 'Bagenkop'),
(5943, 'Strynø'),
(5953, 'Tranekær'),
(5960, 'Marstal'),
(5965, 'Birkholm'),
(5970, 'Ærøskøbing'),
(5985, 'Søby Ærø'),
(6000, 'Kolding'),
(6040, 'Egtved'),
(6051, 'Almind'),
(6052, 'Viuf'),
(6064, 'Jordrup'),
(6070, 'Christiansfeld'),
(6091, 'Bjert'),
(6092, 'Sønder Stenderup'),
(6093, 'Sjølund'),
(6094, 'Hejls'),
(6100, 'Haderslev'),
(6200, 'Aabenraa'),
(6210, 'Barsø'),
(6230, 'Rødekro'),
(6240, 'Løgumkloster'),
(6261, 'Bredebro'),
(6270, 'Tønder'),
(6280, 'Højer'),
(6300, 'Gråsten'),
(6310, 'Broager'),
(6320, 'Egernsund'),
(6330, 'Padborg'),
(6340, 'Kruså'),
(6360, 'Tinglev'),
(6372, 'Bylderup Bov'),
(6392, 'Bolderslev'),
(6400, 'Sønderborg'),
(6430, 'Nordborg'),
(6440, 'Augustenborg'),
(6470, 'Sydals'),
(6500, 'Vojens'),
(6510, 'Gram'),
(6520, 'Toftlund'),
(6534, 'Agerskov'),
(6535, 'Branderup J'),
(6541, 'Bevtoft'),
(6560, 'Sommersted'),
(6580, 'Vamdrup'),
(6600, 'Vejen'),
(6621, 'Gesten'),
(6622, 'Bække'),
(6623, 'Vorbasse'),
(6630, 'Rødding'),
(6640, 'Lunderskov'),
(6650, 'Brørup'),
(6660, 'Lintrup'),
(6670, 'Holsted'),
(6682, 'Hovborg'),
(6683, 'Føvling'),
(6690, 'Gørding'),
(6700, 'Esbjerg'),
(6701, 'Esbjerg'),
(6705, 'Esbjerg Ø'),
(6710, 'Esbjerg V'),
(6715, 'Esbjerg N'),
(6720, 'Fanø'),
(6731, 'Tjæreborg'),
(6740, 'Bramming'),
(6752, 'Glejbjerg'),
(6753, 'Agerbæk'),
(6760, 'Ribe'),
(6771, 'Gredstedbro'),
(6780, 'Skærbæk'),
(6792, 'Rømø'),
(6800, 'Varde'),
(6818, 'Årre'),
(6823, 'Ansager'),
(6830, 'Nørre Nebel'),
(6840, 'Oksbøl'),
(6851, 'Janderup Vestj'),
(6852, 'Billum'),
(6853, 'Vejers Strand'),
(6854, 'Henne'),
(6855, 'Outrup'),
(6857, 'Blåvand'),
(6862, 'Tistrup'),
(6870, 'Ølgod'),
(6880, 'Tarm'),
(6893, 'Hemmet'),
(6900, 'Skjern'),
(6920, 'Videbæk'),
(6933, 'Kibæk'),
(6940, 'Lem St'),
(6950, 'Ringkøbing'),
(6960, 'Hvide Sande'),
(6971, 'Spjald'),
(6973, 'Ørnhøj'),
(6980, 'Tim'),
(6990, 'Ulfborg'),
(7000, 'Fredericia'),
(7007, 'Fredericia'),
(7017, 'Taulov Pakkecenter'),
(7018, 'Pakker TLP'),
(7029, 'Fredericia'),
(7080, 'Børkop'),
(7100, 'Vejle'),
(7120, 'Vejle Øst'),
(7130, 'Juelsminde'),
(7140, 'Stouby'),
(7150, 'Barrit'),
(7160, 'Tørring'),
(7171, 'Uldum'),
(7173, 'Vonge'),
(7182, 'Bredsten'),
(7183, 'Randbøl'),
(7184, 'Vandel'),
(7190, 'Billund'),
(7200, 'Grindsted'),
(7250, 'Hejnsvig'),
(7260, 'Sønder Omme'),
(7270, 'Stakroge'),
(7280, 'Sønder Felding'),
(7300, 'Jelling'),
(7321, 'Gadbjerg'),
(7323, 'Give'),
(7330, 'Brande'),
(7361, 'Ejstrupholm'),
(7362, 'Hampen'),
(7400, 'Herning'),
(7429, 'Herning'),
(7430, 'Ikast'),
(7441, 'Bording'),
(7442, 'Engesvang'),
(7451, 'Sunds'),
(7470, 'Karup J'),
(7480, 'Vildbjerg'),
(7490, 'Aulum'),
(7500, 'Holstebro'),
(7540, 'Haderup'),
(7550, 'Sørvad'),
(7560, 'Hjerm'),
(7570, 'Vemb'),
(7600, 'Struer'),
(7620, 'Lemvig'),
(7650, 'Bøvlingbjerg'),
(7660, 'Bækmarksbro'),
(7673, 'Harboøre'),
(7680, 'Thyborøn'),
(7700, 'Thisted'),
(7730, 'Hanstholm'),
(7741, 'Frøstrup'),
(7742, 'Vesløs'),
(7752, 'Snedsted'),
(7755, 'Bedsted Thy'),
(7760, 'Hurup Thy'),
(7770, 'Vestervig'),
(7790, 'Thyholm'),
(7800, 'Skive'),
(7830, 'Vinderup'),
(7840, 'Højslev'),
(7850, 'Stoholm Jyll'),
(7860, 'Spøttrup'),
(7870, 'Roslev'),
(7884, 'Fur'),
(7900, 'Nykøbing M'),
(7950, 'Erslev'),
(7960, 'Karby'),
(7970, 'Redsted M'),
(7980, 'Vils'),
(7990, 'Øster Assels'),
(7992, 'Sydjylland/Fyn USF P'),
(7993, 'Sydjylland/Fyn USF B'),
(7996, 'Fakturaservice'),
(7997, 'Fakturascanning'),
(7998, 'Statsservice'),
(7999, 'Kommunepost'),
(8000, 'Aarhus C'),
(8100, 'Aarhus C'),
(8200, 'Aarhus N'),
(8210, 'Aarhus V'),
(8220, 'Brabrand'),
(8229, 'Risskov Ø'),
(8230, 'Åbyhøj'),
(8240, 'Risskov'),
(8245, 'Risskov Ø'),
(8250, 'Egå'),
(8260, 'Viby J'),
(8270, 'Højbjerg'),
(8300, 'Odder'),
(8305, 'Samsø'),
(8310, 'Tranbjerg J'),
(8320, 'Mårslet'),
(8330, 'Beder'),
(8340, 'Malling'),
(8350, 'Hundslund'),
(8355, 'Solbjerg'),
(8361, 'Hasselager'),
(8362, 'Hørning'),
(8370, 'Hadsten'),
(8380, 'Trige'),
(8381, 'Tilst'),
(8382, 'Hinnerup'),
(8400, 'Ebeltoft'),
(8410, 'Rønde'),
(8420, 'Knebel'),
(8444, 'Balle'),
(8450, 'Hammel'),
(8462, 'Harlev J'),
(8464, 'Galten'),
(8471, 'Sabro'),
(8472, 'Sporup'),
(8500, 'Grenaa'),
(8520, 'Lystrup'),
(8530, 'Hjortshøj'),
(8541, 'Skødstrup'),
(8543, 'Hornslet'),
(8544, 'Mørke'),
(8550, 'Ryomgård'),
(8560, 'Kolind'),
(8570, 'Trustrup'),
(8581, 'Nimtofte'),
(8585, 'Glesborg'),
(8586, 'Ørum Djurs'),
(8592, 'Anholt'),
(8600, 'Silkeborg'),
(8620, 'Kjellerup'),
(8632, 'Lemming'),
(8641, 'Sorring'),
(8643, 'Ans By'),
(8653, 'Them'),
(8654, 'Bryrup'),
(8660, 'Skanderborg'),
(8670, 'Låsby'),
(8680, 'Ry'),
(8700, 'Horsens'),
(8721, 'Daugård'),
(8722, 'Hedensted'),
(8723, 'Løsning'),
(8732, 'Hovedgård'),
(8740, 'Brædstrup'),
(8751, 'Gedved'),
(8752, 'Østbirk'),
(8762, 'Flemming'),
(8763, 'Rask Mølle'),
(8765, 'Klovborg'),
(8766, 'Nørre Snede'),
(8781, 'Stenderup'),
(8783, 'Hornsyld'),
(8789, 'Endelave'),
(8799, 'Tunø'),
(8800, 'Viborg'),
(8830, 'Tjele'),
(8831, 'Løgstrup'),
(8832, 'Skals'),
(8840, 'Rødkærsbro'),
(8850, 'Bjerringbro'),
(8860, 'Ulstrup'),
(8870, 'Langå'),
(8881, 'Thorsø'),
(8882, 'Fårvang'),
(8883, 'Gjern'),
(8900, 'Randers C'),
(8920, 'Randers NV'),
(8930, 'Randers NØ'),
(8940, 'Randers SV'),
(8950, 'Ørsted'),
(8960, 'Randers SØ'),
(8961, 'Allingåbro'),
(8963, 'Auning'),
(8970, 'Havndal'),
(8981, 'Spentrup'),
(8983, 'Gjerlev J'),
(8990, 'Fårup'),
(9000, 'Aalborg'),
(9029, 'Aalborg'),
(9100, 'Aalborg'),
(9200, 'Aalborg SV'),
(9210, 'Aalborg SØ'),
(9220, 'Aalborg Øst'),
(9230, 'Svenstrup J'),
(9240, 'Nibe'),
(9260, 'Gistrup'),
(9270, 'Klarup'),
(9280, 'Storvorde'),
(9293, 'Kongerslev'),
(9300, 'Sæby'),
(9310, 'Vodskov'),
(9320, 'Hjallerup'),
(9330, 'Dronninglund'),
(9340, 'Asaa'),
(9352, 'Dybvad'),
(9362, 'Gandrup'),
(9370, 'Hals'),
(9380, 'Vestbjerg'),
(9381, 'Sulsted'),
(9382, 'Tylstrup'),
(9400, 'Nørresundby'),
(9430, 'Vadum'),
(9440, 'Aabybro'),
(9460, 'Brovst'),
(9480, 'Løkken'),
(9490, 'Pandrup'),
(9492, 'Blokhus'),
(9493, 'Saltum'),
(9500, 'Hobro'),
(9510, 'Arden'),
(9520, 'Skørping'),
(9530, 'Støvring'),
(9541, 'Suldrup'),
(9550, 'Mariager'),
(9560, 'Hadsund'),
(9574, 'Bælum'),
(9575, 'Terndrup'),
(9600, 'Aars'),
(9610, 'Nørager'),
(9620, 'Aalestrup'),
(9631, 'Gedsted'),
(9632, 'Møldrup'),
(9640, 'Farsø'),
(9670, 'Løgstør'),
(9681, 'Ranum'),
(9690, 'Fjerritslev'),
(9700, 'Brønderslev'),
(9740, 'Jerslev J'),
(9750, 'Øster Vrå'),
(9760, 'Vrå'),
(9800, 'Hjørring'),
(9830, 'Tårs'),
(9850, 'Hirtshals'),
(9870, 'Sindal'),
(9881, 'Bindslev'),
(9900, 'Frederikshavn'),
(9940, 'Læsø'),
(9970, 'Strandby'),
(9981, 'Jerup'),
(9982, 'Ålbæk'),
(9990, 'Skagen'),
(9992, 'Jylland USF P'),
(9993, 'Jylland USF B'),
(9996, 'Fakturaservice'),
(9997, 'Fakturascanning'),
(9998, 'Borgerservice');

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `BasicPageInfo`
--
ALTER TABLE `BasicPageInfo`
  ADD PRIMARY KEY (`CVR`),
  ADD KEY `ZipCode` (`ZipCode`);

--
-- Indeks for tabel `BlogCategory`
--
ALTER TABLE `BlogCategory`
  ADD PRIMARY KEY (`BlogCategoryID`);

--
-- Indeks for tabel `BlogImg`
--
ALTER TABLE `BlogImg`
  ADD PRIMARY KEY (`BlogPostID`,`ImgID`),
  ADD KEY `ImgID` (`ImgID`);

--
-- Indeks for tabel `BlogPost`
--
ALTER TABLE `BlogPost`
  ADD PRIMARY KEY (`BlogPostID`),
  ADD KEY `UserEmail` (`UserEmail`),
  ADD KEY `BlogCategoryID` (`BlogCategoryID`),
  ADD KEY `RelatedProducts` (`RelatedProducts`);

--
-- Indeks for tabel `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`CustomerEmail`),
  ADD KEY `ZipCode` (`ZipCode`);

--
-- Indeks for tabel `CustomerOrder`
--
ALTER TABLE `CustomerOrder`
  ADD PRIMARY KEY (`OrderNumber`),
  ADD KEY `ZipCode` (`ZipCode`),
  ADD KEY `CustomerEmail` (`CustomerEmail`),
  ADD KEY `DeliveryMethodID` (`DeliveryMethodID`),
  ADD KEY `OrderStatusID` (`OrderStatusID`),
  ADD KEY `PromoCode` (`PromoCode`);

--
-- Indeks for tabel `DeliveryMethod`
--
ALTER TABLE `DeliveryMethod`
  ADD PRIMARY KEY (`DeliveryMethodID`);

--
-- Indeks for tabel `FrontSlider`
--
ALTER TABLE `FrontSlider`
  ADD PRIMARY KEY (`SlideID`),
  ADD KEY `UserEmail` (`UserEmail`);

--
-- Indeks for tabel `Hours`
--
ALTER TABLE `Hours`
  ADD PRIMARY KEY (`HoursID`);

--
-- Indeks for tabel `ImgGallery`
--
ALTER TABLE `ImgGallery`
  ADD PRIMARY KEY (`ImgID`);

--
-- Indeks for tabel `OrderDetails`
--
ALTER TABLE `OrderDetails`
  ADD PRIMARY KEY (`OrderNumber`,`ItemNumber`),
  ADD KEY `ItemNumber` (`ItemNumber`);

--
-- Indeks for tabel `OrderMessage`
--
ALTER TABLE `OrderMessage`
  ADD PRIMARY KEY (`OrderMessageID`),
  ADD KEY `OrderNumber` (`OrderNumber`);

--
-- Indeks for tabel `OrderStatus`
--
ALTER TABLE `OrderStatus`
  ADD PRIMARY KEY (`OrderStatusID`);

--
-- Indeks for tabel `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`ItemNumber`),
  ADD KEY `UserEmail` (`UserEmail`),
  ADD KEY `ProductCategoryID` (`ProductCategoryID`);

--
-- Indeks for tabel `ProductCategory`
--
ALTER TABLE `ProductCategory`
  ADD PRIMARY KEY (`ProductCategoryID`);

--
-- Indeks for tabel `ProductImg`
--
ALTER TABLE `ProductImg`
  ADD PRIMARY KEY (`ItemNumber`,`ImgID`),
  ADD KEY `ImgID` (`ImgID`);

--
-- Indeks for tabel `PromoCode`
--
ALTER TABLE `PromoCode`
  ADD PRIMARY KEY (`PromoCode`),
  ADD KEY `UserEmail` (`UserEmail`);

--
-- Indeks for tabel `Review`
--
ALTER TABLE `Review`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `ItemNumber` (`ItemNumber`);

--
-- Indeks for tabel `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`UserEmail`);

--
-- Indeks for tabel `ZipCode`
--
ALTER TABLE `ZipCode`
  ADD PRIMARY KEY (`ZipCode`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `BlogCategory`
--
ALTER TABLE `BlogCategory`
  MODIFY `BlogCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tilføj AUTO_INCREMENT i tabel `BlogPost`
--
ALTER TABLE `BlogPost`
  MODIFY `BlogPostID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tilføj AUTO_INCREMENT i tabel `CustomerOrder`
--
ALTER TABLE `CustomerOrder`
  MODIFY `OrderNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tilføj AUTO_INCREMENT i tabel `DeliveryMethod`
--
ALTER TABLE `DeliveryMethod`
  MODIFY `DeliveryMethodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tilføj AUTO_INCREMENT i tabel `FrontSlider`
--
ALTER TABLE `FrontSlider`
  MODIFY `SlideID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tilføj AUTO_INCREMENT i tabel `Hours`
--
ALTER TABLE `Hours`
  MODIFY `HoursID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tilføj AUTO_INCREMENT i tabel `ImgGallery`
--
ALTER TABLE `ImgGallery`
  MODIFY `ImgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Tilføj AUTO_INCREMENT i tabel `OrderMessage`
--
ALTER TABLE `OrderMessage`
  MODIFY `OrderMessageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tilføj AUTO_INCREMENT i tabel `OrderStatus`
--
ALTER TABLE `OrderStatus`
  MODIFY `OrderStatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tilføj AUTO_INCREMENT i tabel `ProductCategory`
--
ALTER TABLE `ProductCategory`
  MODIFY `ProductCategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tilføj AUTO_INCREMENT i tabel `Review`
--
ALTER TABLE `Review`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Begrænsninger for tabel `BasicPageInfo`
--
ALTER TABLE `BasicPageInfo`
  ADD CONSTRAINT `BasicPageInfo_ibfk_1` FOREIGN KEY (`ZipCode`) REFERENCES `ZipCode` (`ZipCode`);

--
-- Begrænsninger for tabel `BlogImg`
--
ALTER TABLE `BlogImg`
  ADD CONSTRAINT `BlogImg_ibfk_1` FOREIGN KEY (`BlogPostID`) REFERENCES `BlogPost` (`BlogPostID`),
  ADD CONSTRAINT `BlogImg_ibfk_2` FOREIGN KEY (`ImgID`) REFERENCES `ImgGallery` (`ImgID`);

--
-- Begrænsninger for tabel `BlogPost`
--
ALTER TABLE `BlogPost`
  ADD CONSTRAINT `BlogPost_ibfk_1` FOREIGN KEY (`UserEmail`) REFERENCES `User` (`UserEmail`),
  ADD CONSTRAINT `BlogPost_ibfk_2` FOREIGN KEY (`BlogCategoryID`) REFERENCES `BlogCategory` (`BlogCategoryID`),
  ADD CONSTRAINT `BlogPost_ibfk_3` FOREIGN KEY (`RelatedProducts`) REFERENCES `ProductCategory` (`ProductCategoryID`);

--
-- Begrænsninger for tabel `Customer`
--
ALTER TABLE `Customer`
  ADD CONSTRAINT `Customer_ibfk_1` FOREIGN KEY (`ZipCode`) REFERENCES `ZipCode` (`ZipCode`);

--
-- Begrænsninger for tabel `CustomerOrder`
--
ALTER TABLE `CustomerOrder`
  ADD CONSTRAINT `CustomerOrder_ibfk_1` FOREIGN KEY (`ZipCode`) REFERENCES `ZipCode` (`ZipCode`),
  ADD CONSTRAINT `CustomerOrder_ibfk_2` FOREIGN KEY (`CustomerEmail`) REFERENCES `Customer` (`CustomerEmail`),
  ADD CONSTRAINT `CustomerOrder_ibfk_3` FOREIGN KEY (`DeliveryMethodID`) REFERENCES `DeliveryMethod` (`DeliveryMethodID`),
  ADD CONSTRAINT `CustomerOrder_ibfk_4` FOREIGN KEY (`OrderStatusID`) REFERENCES `OrderStatus` (`OrderStatusID`),
  ADD CONSTRAINT `CustomerOrder_ibfk_5` FOREIGN KEY (`PromoCode`) REFERENCES `PromoCode` (`PromoCode`);

--
-- Begrænsninger for tabel `FrontSlider`
--
ALTER TABLE `FrontSlider`
  ADD CONSTRAINT `FrontSlider_ibfk_1` FOREIGN KEY (`UserEmail`) REFERENCES `User` (`UserEmail`);

--
-- Begrænsninger for tabel `OrderDetails`
--
ALTER TABLE `OrderDetails`
  ADD CONSTRAINT `OrderDetails_ibfk_1` FOREIGN KEY (`OrderNumber`) REFERENCES `CustomerOrder` (`OrderNumber`),
  ADD CONSTRAINT `OrderDetails_ibfk_2` FOREIGN KEY (`ItemNumber`) REFERENCES `Product` (`ItemNumber`);

--
-- Begrænsninger for tabel `OrderMessage`
--
ALTER TABLE `OrderMessage`
  ADD CONSTRAINT `OrderMessage_ibfk_1` FOREIGN KEY (`OrderNumber`) REFERENCES `CustomerOrder` (`OrderNumber`);

--
-- Begrænsninger for tabel `Product`
--
ALTER TABLE `Product`
  ADD CONSTRAINT `Product_ibfk_1` FOREIGN KEY (`UserEmail`) REFERENCES `User` (`UserEmail`),
  ADD CONSTRAINT `Product_ibfk_2` FOREIGN KEY (`ProductCategoryID`) REFERENCES `ProductCategory` (`ProductCategoryID`);

--
-- Begrænsninger for tabel `ProductImg`
--
ALTER TABLE `ProductImg`
  ADD CONSTRAINT `ProductImg_ibfk_1` FOREIGN KEY (`ItemNumber`) REFERENCES `Product` (`ItemNumber`),
  ADD CONSTRAINT `ProductImg_ibfk_2` FOREIGN KEY (`ImgID`) REFERENCES `ImgGallery` (`ImgID`);

--
-- Begrænsninger for tabel `PromoCode`
--
ALTER TABLE `PromoCode`
  ADD CONSTRAINT `PromoCode_ibfk_1` FOREIGN KEY (`UserEmail`) REFERENCES `User` (`UserEmail`);

--
-- Begrænsninger for tabel `Review`
--
ALTER TABLE `Review`
  ADD CONSTRAINT `Review_ibfk_1` FOREIGN KEY (`ItemNumber`) REFERENCES `Product` (`ItemNumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
