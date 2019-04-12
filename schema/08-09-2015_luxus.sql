/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.6.17 : Database - luxus
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `admin` */

insert  into `admin`(`id`,`email`,`password`,`active`) values (1,'admin@luxus.com','e10adc3949ba59abbe56e057f20f883e',1);

/*Table structure for table `amenities` */

DROP TABLE IF EXISTS `amenities`;

CREATE TABLE `amenities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `type` enum('common','additional','special','safety') NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `amenities` */

insert  into `amenities`(`id`,`name`,`type`,`active`) values (1,'Essentials','common',1),(2,'TV','common',1),(3,'Cable TV','common',1),(4,'Air Conditioning','common',1),(5,'Heating','common',1),(6,'Kitchen','common',1),(7,'Internet','common',1),(8,'Wireless Internet','common',1),(9,'Hot Tub','additional',1),(10,'Washer','additional',1),(11,'Pool','additional',1),(12,'Dryer','additional',1),(13,'Breakfast','additional',1),(14,'Free Parking on Premises','additional',1),(15,'Gym','additional',1),(16,'Elevator in Building','additional',1),(17,'Indoor Fireplace','additional',1),(18,'Buzzer/Wireless Intercom','additional',1),(19,'Doorman','additional',1),(20,'Shampoo','additional',1),(21,'Family/Kid Friendly','special',1),(22,'Smoking Allowed ','special',1),(23,'Suitable for Events','special',1),(24,'Pets Allowed','special',1),(25,'Pets live on this property','special',1),(26,'Wheelchair Accessible','special',1),(27,'Smoke Detector','safety',1),(28,'Carbon Monoxide Detector','safety',1),(29,'First Aid Kit','safety',1),(30,'Safety Card','safety',1),(31,'Fire Extinguisher','safety',1);

/*Table structure for table `app_routes` */

DROP TABLE IF EXISTS `app_routes`;

CREATE TABLE `app_routes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `slug` varchar(192) COLLATE utf8_unicode_ci NOT NULL,
  `controller` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `app_routes` */

insert  into `app_routes`(`id`,`slug`,`controller`) values (1,'about','pages/view/about'),(2,'privacy-policy','pages/view/privacy-policy'),(3,'terms-and-conditions','pages/view/terms'),(4,'inbox','inbox');

/*Table structure for table `home_type` */

DROP TABLE IF EXISTS `home_type`;

CREATE TABLE `home_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

/*Data for the table `home_type` */

insert  into `home_type`(`id`,`name`,`active`) values (1,'Apartment',1),(2,'House',1),(3,'Bed & Breakfast',1),(4,'Loft',1),(5,'Town house',1),(6,'Condominium',1),(7,'Bungalow',1),(8,'Cabin',1),(9,'Villa',1),(10,'Castle',1),(11,'Dorm',1),(12,'Tree house',1),(13,'Boat',1),(14,'Plane',1),(15,'Camper/RV',1),(16,'Igloo',1),(17,'Lighthouse',1),(18,'Yurt',1),(19,'Tipi',1),(20,'Cave',1),(21,'Island',1),(22,'Chalet',1),(23,'Earth House',1),(24,'Hut',1),(25,'Train',1),(26,'Tent',1),(27,'Other',1);

/*Table structure for table `listing` */

DROP TABLE IF EXISTS `listing`;

CREATE TABLE `listing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `listing_name` varchar(250) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `summary` text NOT NULL,
  `home_type` varchar(100) NOT NULL,
  `room_type` varchar(100) NOT NULL,
  `accommodates` int(11) NOT NULL,
  `bedrooms` int(11) NOT NULL,
  `beds` int(11) NOT NULL,
  `bathrooms` int(11) NOT NULL,
  `available_from` date NOT NULL,
  `available_to` date NOT NULL,
  `country` varchar(30) NOT NULL,
  `typed_address` varchar(255) NOT NULL,
  `address_line_1` varchar(200) NOT NULL,
  `address_line_2` varchar(200) NOT NULL,
  `city_town` varchar(30) NOT NULL,
  `state_province` varchar(30) NOT NULL,
  `zip_postal_code` varchar(20) NOT NULL,
  `latitude` decimal(11,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `price` int(11) NOT NULL,
  `additional_note` text NOT NULL,
  `preview_image_url` varchar(250) NOT NULL,
  `active` enum('Pending','Publish','Review') NOT NULL DEFAULT 'Pending',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_edited` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `room_type` (`room_type`),
  KEY `home_type` (`home_type`),
  KEY `listing_ibfk_6` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `listing` */

insert  into `listing`(`id`,`user_id`,`listing_name`,`slug`,`summary`,`home_type`,`room_type`,`accommodates`,`bedrooms`,`beds`,`bathrooms`,`available_from`,`available_to`,`country`,`typed_address`,`address_line_1`,`address_line_2`,`city_town`,`state_province`,`zip_postal_code`,`latitude`,`longitude`,`price`,`additional_note`,`preview_image_url`,`active`,`date_created`,`date_edited`) values (1,13,'a beautiful house for rent near newyork','a-beautiful-house-for-rent-near-newyork-1','A quick brown fox jumps over the lazy dog. a quick brown fox jumps over the lazy dog. a quick brown fox jumpes over the lazy dog','Hut','Private room',10,3,5,5,'0000-00-00','0000-00-00','United States','134 East 27th Street, New York, NY 10016, USA','East 27th Street','','New York','New York','10016','40.74185640','-73.98257450',350,'No note','36e6d13baff895ee6400b4d153adbb6b.jpg','Pending','0000-00-00 00:00:00',NULL),(2,13,'a beautiful house for rent near newyork','a-beautiful-house-for-rent-near-newyork-2','Call or Text the listing agent today for a showing! 858.229.2181 VIEWS! Over $200,000 in renovations! A 3 bedroom, 2.5 bath home nestled on a private 34,800 sf lot with plenty of room for all your toys; boats, RVs you name it! This sprawling estate is an entertainers dream, featuring a whole house entertainment center, pool with a cascading water feature, large decks and patios, mature landscape. Lives like a 1-story home with all bedrooms on the first floor along with the formal living and dining area, eat-in kitchen, large gameroom and bar. And on the 2nd floor you will discover a built-out basement w/an office and media room and a 2-Car Garage. **BONUS** a 1 bed/1 bath detached guest house. Must see to appreciate all the extras!\r\n','Hut','Private room',10,2,4,3,'1970-01-01','1970-01-01','United States','134 East 27th Street, New York, NY 10016, USA','East 27th Street','','New York','New York','10016','40.74185640','-73.98257450',5,'No note','ae4ef48d35bf965dbf42436652c5a580.jpg','Publish','0000-00-00 00:00:00',NULL),(3,13,'Features and Amenities of Bal Harbour','','Pristine 4 bed/ 2.1 bath with a loft. This home is a MUST SEE! Very low HOA. Totally upgraded inside and out. Outside was re-stuccoed and painted 3 yrs ago, brand new dual unit A/C in 2012, Master bedroom downstairs with huge walk-in his and hers closets! All bedrooms and upstairs flooring replaced with beautiful engineered hardwood, new hardwood on stairs. Brand new Kitchen. All the cabinets were refinished, granite counter tops installed, and all new stainless steel appliances only 3 months old and still under warranty, top of the line security system with cameras and window sensors, in-ground pool with screened in patio. A-rated schools and the Wellington Mall just min away. This is the perfect home to grow your family!','Hut','Private room',10,3,1,2,'0000-00-00','0000-00-00','United States','','','','San Francisco','','','0.00000000','0.00000000',250,'No note','6766135be75e79c4a46ebb800770f79c.jpg','Pending','0000-00-00 00:00:00',NULL),(4,13,'The View At Edgewater Harbor','the-view-at-edgewater-harbor-4','Giving new meaning to urban sophistication, the residences at The View exude class. Stunning architecture, unmatched attention to design and detail, direct Manhattan views, and sleek modern finishes place The View into a category all its own. If you are ready to take the next step into the world of luxury apartment living look no further.','Hut','Private room',10,1,1,1,'1970-01-01','1970-01-01','United States','134 East 27th Street, New York, NY 10016, USA','East 27th Street','','New York','New York','10016','40.74185640','-73.98257450',5,'No note','b83fb6ae2f31e96fbc763e8a841940aa.jpg','Pending','0000-00-00 00:00:00',NULL),(5,13,'1205 Woodhaven Dr,Mc Kinney, TX 75070','1205-woodhaven-drmc-kinney-tx-75070-5','Beautiful home in Woodhaven Village Stonebridge Ranch. Minutes away from Eddins Elem and Aquatic Center. Backyard paradise with gorgeous pool, large yard to play and extended covered patio. Dramatic entry, high ceilings, lots of natural light. Master, 1 bdrm and study are downstairs; 3 bdrms, gameroom that can be used as media are up. 3 car garage. Quiet street. A rare find at this price!\r\nWHAT I LOVE ABOUT THE HOME\r\n\r\nThe community is wonderful. Walking distance to elementary school and community pool. All bus stops are within view of front porch. Subdivision has an active social committee and activities throughout the year.','Hut','Private room',10,3,3,3,'1970-01-01','1970-01-01','United States','134 East 27th Street, New York, NY 10016, USA','East 27th Street','','New York','New York','10016','40.74185640','-73.98257450',5,'No note','47a395f279063789cba22f0209d6dcdd.jpg','Pending','0000-00-00 00:00:00',NULL),(6,13,'2725 NE 14th St # 115,\r\nPompano Beach, FL 33062','','walking distance from the beach, 3 beds 21/2 baths, 1 car garage. fast approval. Walking distance from the beach, 3 bedroom 2 1/2 baths 2 stories townhouse, 1 car garage. Upgraded corner unit. Fast approval. Near golf course, water sports,movie theater , dining and more. Community pool,','Hut','Private room',10,4,4,4,'0000-00-00','0000-00-00','United States','','4389 Bassel Street','','New Orleans','LA','70112','29.93035500','-90.09772400',552,'No note','6766135be75e79c4a46ebb800770f79c.jpg','Pending','0000-00-00 00:00:00',NULL),(7,13,'316 Brooks Ave,\r\nVenice, CA 90291','','Venice Bungalow home just off Abbot Kinney Blvd! Enter through a large, privatized gate in to a front yard oasis, which leads to this 2 bedroom, 2 bathroom bungalow. Hardwood floors throughout this home create a warm, comfortable feel. Originally two separate one-bedroom apartments, this property boasts two separate open living rooms, a beautifully re-done kitchen with a vintage range/oven, and a bonus room in the back. Two car gated parking in the back. Located in the heart of Venice, this is perfect for anyone who wants to be close to the beach, Main Street and everything Abbot Kinney has to offer.','Hut','Private room',10,2,4,2,'0000-00-00','0000-00-00','United States','','3008 Coventry Court','','Gulfport','MS','39501','0.00000000','0.00000000',621,'No note','47a395f279063789cba22f0209d6dcdd.jpg','Pending','0000-00-00 00:00:00',NULL),(8,13,'Bird\'s Eye\r\nMap View\r\n125 N Kentucky Ave APT 403,\r\nLakeland, FL 33801','','Beautiful fully furnished residential Loft in Downtown Lakeland. Fourth floor unit, polished concrete floors, granite counter tops, stainless steel appliances. Washer and Dryer in unit. Private parking in leased City of Lakeland garage. This unit is \"key ready\" and available now! Downtown living at its finest! \r\nUpdated : 2015-08-26','Hut','Private room',10,5,5,5,'0000-00-00','0000-00-00','United States','','1313 Old House Drive','','Uhrichsville','OH','44683','40.38634200','-81.28410300',125,'No note','d808ac4c2b5fe3c7efcd594d2274d8cb.jpg','Pending','0000-00-00 00:00:00',NULL),(9,13,'8127 Encino Ave,Northridge, CA 91325','8127-encino-avenorthridge-ca-91325-9','New-New-New! Yes almost everything is new. Starting at top is a new roof, from there both front and rear yards has been redone with drought sensitive landscaping. Huge new covered patio. Inside are all new windows. New paint throughout. New laminate wood flooring in living room, bedrooms and hallway. New vinyl flooring in kitchen, bath and laundry room. New baseboards and case moldings. New hardware throughout. New stainless steel appliances including stove/oven microwave, dishwasher and refrigerator. New kitchen cabinets and countertops. New recessed lighting in living room and kitchen. New A/C. Washer/Dryer included. 2 car garage.','Hut','Private room',10,4,7,2,'1970-01-01','1970-01-01','United States','134 East 27th Street, New York, NY 10016, USA','East 27th Street','','New York','New York','10016','40.74185640','-73.98257450',5,'No note','d808ac4c2b5fe3c7efcd594d2274d8cb.jpg','Publish','0000-00-00 00:00:00',NULL),(10,13,'9601 Shore Rd APT 5F,\r\nBrooklyn, NY 11209','','NEWLY RENOVATED and Stunning large one bedroom plus separate dining area at the Joan! Approximately 850sqft with ample closet space. The Joan includes a part-time doorman, live-in super, pet friendly (with an additional $100 per month fee) and nearby trains and express busses to Manhattan. Available September 15th. Will not last.','Hut','Private room',10,2,7,4,'0000-00-00','0000-00-00','United States','','2493 Buena Vista Avenue','','Elkton','OR','97436','43.56132900','-123.52811800',251,'No note','47a395f279063789cba22f0209d6dcdd.jpg','Pending','0000-00-00 00:00:00',NULL),(11,13,'Bird\'s EyeMap View2915 Standing Springs Ln,Dickinson, TX 77539','birds-eyemap-view2915-standing-springs-lndickinson-tx-77539-11','BEAUTIFUL HOME IS CLEAN, WELL-KEPT AND READY FOR IMMEDIATE MOVE IN. IN THIS GORGEOUS KITCHEN YOU WILL FIND GRANITE COUNTERTOPS, PLENTY OF CABINETS, STAINLESS STEEL APPLIANCES, AND A WALK IN CLOSET. OTHER FEATURES INCLUDE LARGE AND BRIGHT BREAKFAST ROOM, ELEGANT FORMAL DINING ROOM, SPLIT FLOOR PLAN, GASLOG FIREPLACE IN LIVING ROOM, CERAMIC TILE THOUGHOUT HOME EXCEPT BEDROOMS, HIGH CEILINGS, DOUBLE PANED WINDOWS, RECENT PAINT, LARGE BACK PATIO, LARGE MASTER WITH A GARDEN TUB AND SEPARATE SHOWER','Hut','Private room',10,8,7,6,'1970-01-01','1970-01-01','United States','134 East 27th Street, New York, NY 10016, USA','East 27th Street','','New York','New York','10016','40.74185640','-73.98257450',5,'No note','dac142397e9eee4a1f1f96053ca1c6e0.jpg','Pending','0000-00-00 00:00:00',NULL),(12,13,'Bird\'s EyeMap View30 Wind Harp Pl,Spring, TX 77382','birds-eyemap-view30-wind-harp-plspring-tx-77382-12','Impeccably kept home that backs to lush greenbelt in Alden Bridge! Beautiful tile & hardwood floors, Plantation shutters, recent int. paint, abundant windows & built-ins throughout. Recently remodeled island kitchen w/granite counters, under cabinet lighting & plenty of cabinet space opens to sunny breakfast rm w/2 sided gas log fireplace shared w/den; elegant formal DR; all 3 bedrms & game room up(GR could be 4th BR); private, fenced yard w/wood deck, room to play/entertain & no rear neighbors!','Hut','Private room',10,3,7,2,'1970-01-01','1970-01-01','United States','134 East 27th Street, New York, NY 10016, USA','East 27th Street','','New York','New York','10016','40.74185640','-73.98257450',5,'No note','893f9432705bd34c6f4819d2e02fc581.jpg','Pending','0000-00-00 00:00:00',NULL),(13,13,'1815 Frankenfield St,Allentown, PA 18104','1815-frankenfield-stallentown-pa-18104-13','Four fantastic levels of living in this updated split! Beautiful hardwood floors on main level and all 3 bedrooms. Enjoy a newly updated kitchen with tile floor and updated cabinets and appliances. Walk out to the covered porch and enjoy the yard with it\'s mature trees and plenty of space to entertain. The lower level has a separate laundry room, storage area and even area for home office with another half bath. The rec room has lots space for media room, work out room and even has a bar! This property is conveniently located near 22 to get where you need to be.','Hut','Private room',10,10,9,8,'1970-01-01','1970-01-01','United States','134 East 27th Street, New York, NY 10016, USA','East 27th Street','','New York','New York','10016','40.74185640','-73.98257450',150,'No note','2cb3c269eac70f09c79b55dc6bf3af1a.jpg','Publish','0000-00-00 00:00:00',NULL),(14,13,'40W938 Whitney Rd,Saint Charles, IL 60175','40w938-whitney-rdsaint-charles-il-60175-14',' FOR RENT\r\n$2,450/mo\r\nRent Zestimate®: $2,631/mo\r\n\r\nLooking to rent in Paradise? Lovely hillside ranch on a truly spectacular 4 acre lot with sloping, wooded views from your windows...Living room, dining room, and a redone kitchen plus 3 bedrooms and baths are located on the main level. Large redone master suite with gorgeous master bath! Lower walkout level has a large family room, laundry room, and exercise room (or playroom).Tenants CANNOT use lake or large pond area in back due to liability. Landscape maintenance and snow removal are included in the monthly rental price. Credit check (620+ credit score required) and background check for everyone over 18 (cost $35 per person--paid for by perspective tenants). No smoking. Minimum one year lease\r\nwould consider longer. Pets evaluated. Non-refundable carpet cleaning deposit. One month\'\'s security deposit of $2450 due at signing of lease and first month\'\'s rent due when get keys. Renters insurance required. Available immediately. Great home and incredible location!','Hut','Private room',10,7,8,7,'1970-01-01','1970-01-01','United States','134 East 27th Street, New York, NY 10016, USA','East 27th Street','','New York','New York','10016','40.74185640','-73.98257450',5,'No note','47a395f279063789cba22f0209d6dcdd.jpg','Pending','0000-00-00 00:00:00',NULL),(15,13,'2735 NE 28th Ct APT 2,Lighthouse Point, FL 33064','2735-ne-28th-ct-apt-2lighthouse-point-fl-33064-15','Beautiful waterfront first floor apt in pristine bldg only 1 block to Lighthouse Point marina and restaurant; 2/2 updated & spacious w/huge master BR, 2 walk-in closets, cedar closet w/additional closets; W/D in unit & screened porch. Located on Cap Knight Bayou for constant parade of boats & lighthouse views. Call to inquire if possible dockage is available as it is not included with apt. This private well kept bldg is a gem!','Hut','Private room',10,3,8,7,'1970-01-01','1970-01-01','United States','134 East 27th Street, New York, NY 10016, USA','East 27th Street','','New York','New York','10016','40.74185640','-73.98257450',5,'No note','e106f48e9b89955b9487e0f507223dad.jpg','Pending','0000-00-00 00:00:00',NULL),(16,13,'2511 Point Del Mar,Corona Del Mar, CA 92625','2511-point-del-marcorona-del-mar-ca-92625-16','Stunning single family home in the village of Corona del Mar. Bright, open floor plan, with two bedrooms on main level - one being a master suite - and another master suite on the upper level; along with an office/loft and two full baths & a powder. The home has recently been completely renovated offering newer stone floors throughout; granite counters; cabinets; custom fixtures; top-of-the-line stainless steel appliances; windows; custom blinds; designer carpet and paint. A rare lot offering a large rear yard for entertaining equipped with a covered patio area. Two car attached garage and plenty of storage areas. Experience CdM living. Centrally located within walking distance to the beaches, restaurant, shops, parks, Oasis Senior center and Fashion Island.','Hut','Private room',10,3,2,4,'1970-01-01','1970-01-01','United States','134 East 27th Street, New York, NY 10016, USA','East 27th Street','','New York','New York','10016','40.74185640','-73.98257450',5,'No note','bb27a4ab708b107b7323cddda7625832.jpg','Publish','0000-00-00 00:00:00',NULL),(17,13,'345 N La Salle Dr APT 3401,Chicago, IL 60654','345-n-la-salle-dr-apt-3401chicago-il-60654-17','Heart Of River North*Gorgeous Northwest Corner W/ Expansive City And Lake Views*Oversized Windows*Split Floorplan*Ensuite Master Bath*Great Closet Space*Upgraded Thru-Out*Hardwood Floors*Granite*Upgraded Doors & Cabinetry*In Unit Laundry\r\nAll Utilities Included (Even Internet And Electric )\r\nFull Amenity Building With Gym,Pool,Tennis Courts,Doorman,On Site Management*No Smoking No Pets* Available Immediately','Hut','Private room',10,1,3,2,'1970-01-01','1970-01-01','United States','134 East 27th Street, New York, NY 10016, USA','East 27th Street','','New York','New York','10016','40.74185640','-73.98257450',5,'No note','54853d19dc6fb260e1bf9c05b23d7b12.jpg','Publish','0000-00-00 00:00:00',NULL),(18,13,'2421 NE 65th St APT 211,Fort Lauderdale, FL 33308','2421-ne-65th-st-apt-211fort-lauderdale-fl-33308-18','Complete info: http://2421ne65thst211.IsNowOffered.com - Excellent value for a 2/2 with split masters in east Fort Lauderdale. Newer construction with impact glass throughout. Modern layout with kitchen bar area open to the spacious dining area and living room. Beautiful new wood floors throughout. 1st class amenities with state of the art fitness center and stunning pool/spa. Excellent location close to shopping, dining and just 1.5 miles to the beach. Pets welcome','Hut','Private room',10,4,2,1,'1970-01-01','1970-01-01','United States','134 East 27th Street, New York, NY 10016, USA','East 27th Street','','New York','New York','10016','40.74185640','-73.98257450',5,'No note','699544f7a2b283ec8f2b92aa7ff60596.jpg','Publish','0000-00-00 00:00:00',NULL),(19,13,'7855 Hawthorne Ter,Naples, FL 34113','7855-hawthorne-ternaples-fl-34113-19','Complete info: http://7855hawthorneter.CanBYours.com - Sit back and relax on the quiet lanai as you look over the lush preserve and listen to the gentle sound of the slash pines swaying in the breeze in this lovely 3 bedroom plus den, 3 bath coach home located in the gated Classics village at Lely Resort. This end unit coach home has all the right features including granite counter tops, wood cabinetry, tiled lanai, diagonal travertine tile flooring, custom window treatments, custom paint, 2 car garage, high impact windows and much more including a charming self-contained guest suite. Hawthorne, with one of the finest clubhouse facilities among Lely Resort villages, features a geo-thermal heated pool with spa, card room, club room with large 65 inch smart TV, kitchen/bar area plus a fitness center and gas BBQ all just a few steps away. Lely Resort has been named \"Community of the Year\" 6 years in a row. The Lely Players Club & Spa offers world class resort-style amenities including 3 pools, indoor and outdoor fine and casual dining, pool bar, club lounge, championship tennis courts, three 18-hole golf courses and a world class spa with beauty and wellness centerall for the exclusive enjoyment of Lely residents and guests.','Hut','Private room',10,9,9,9,'2015-11-10','2015-12-21','United States','134 East 27th Street, New York, NY 10016, USA','3953 Conference Center Way','','Tobyhanna','PA','18466','41.19061200','-75.47895500',250,'No note','47a395f279063789cba22f0209d6dcdd.jpg','Publish','0000-00-00 00:00:00',NULL),(20,13,'455 E Palmetto Park Rd,Boca Raton, FL 33432','455-e-palmetto-park-rdboca-raton-fl-33432-20','Complete info: http://455epalmettopark.IsNowOffered.com - 5 Palm- Located in the Heart of Boca Raton \'\'Manhattan comes to Boca\'\' Light, Bright, 2,525 Sq. Ft. residence with 3 bedrooms, open floor plan, high ceilings, designer kitchen with soft close doors and draws, large breakfast bar, wine cooler, walk-in pantry, wood floors, all bedrooms are ensuites with marble, guest bedrooms have their own private balconies. This gorgeous home in the sky has its own private elevator and same floor storage area. Located in the heart of Boca Raton, this unit has gorgeous views of the ocean and intracoastal, and glittering views of the city lights. walking distance to the beach, restaurants and shopping. This residence is the best deal in town, built in 2008. Full service building. With 2 parking spots. Courtesy of Douglas Elliman. Call 561.288.0059 Rachel McGinnis for your private showing. ','Hut','Private room',10,11,13,14,'0000-00-00','0000-00-00','United States','134 East 27th Street, New York, NY 10016, USA','2085 Ryan Road','','Rapid City','SD','57701','44.11082300','-103.14424600',249,'No note','6766135be75e79c4a46ebb800770f79c.jpg','Pending','0000-00-00 00:00:00',NULL),(21,13,'Cozy Studio Near Chelsea Market #22','cozy-studio-near-chelsea-market-22-21','WELCOME TO THE CHELSEA !\r\n\r\nThis room is located in Chelsea, Manhattan.\r\n\r\n\r\nRESTAURANTS | ENTERTAINMENT | TRANSPORTATION \r\n\r\nMajor subway line stations (14th ST and 8th Ave. (There is 16th st side Exit) - A, C, E Train, 14th ST and 8th Ave)\r\n\r\nOur location is within the vicinity of an unlimited variety of restaurants that range from fast food take-out to exquisite fine dining. There are also many health food markets for those who prefer to dine in. \r\n','Apartment','Entire home/apt',1,3,5,5,'1970-01-01','1970-01-01','United States','134 East 27th Street, New York, NY 10016, USA','284 Sycamore Fork Road','','Ft Lauderdale','FL','33311','40.74185640','-73.98257450',5,'','a14ec9df79f39ccbbc6c11ef23c69f83.jpg','','2015-09-02 18:24:45',NULL);

/*Table structure for table `listing_amenities` */

DROP TABLE IF EXISTS `listing_amenities`;

CREATE TABLE `listing_amenities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amenities_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `amenities_id` (`amenities_id`),
  KEY `listing_id` (`listing_id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;

/*Data for the table `listing_amenities` */

insert  into `listing_amenities`(`id`,`amenities_id`,`listing_id`) values (1,17,1),(2,10,1),(3,2,20),(4,3,20),(5,6,20),(6,7,20),(7,10,20),(8,11,20),(9,12,20),(10,16,20),(11,18,20),(12,20,20),(13,22,20),(14,26,20),(15,2,20),(16,3,20),(17,5,20),(18,6,20),(19,7,20),(20,9,20),(21,10,20),(22,11,20),(23,12,20),(24,13,20),(25,16,20),(26,18,20),(27,20,20),(28,22,20),(29,26,20),(30,1,20),(31,2,20),(32,3,20),(33,5,20),(34,6,20),(35,7,20),(36,9,20),(37,10,20),(38,11,20),(39,12,20),(40,13,20),(41,16,20),(42,17,20),(43,18,20),(44,20,20),(45,21,20),(46,22,20),(47,26,20),(48,2,19),(49,3,19),(50,4,19),(51,6,19),(52,7,19),(53,8,19),(54,9,19),(55,12,19),(56,13,19),(57,14,19),(58,15,19),(59,17,19),(60,2,15),(61,3,15),(62,6,15),(63,7,15),(64,11,15),(65,15,15),(66,2,17),(67,3,17),(68,4,17),(69,6,17),(70,7,17),(71,8,17),(72,2,16),(73,3,16),(74,4,16),(75,3,13),(76,4,13),(77,7,13),(78,8,13),(79,11,13),(80,12,13),(81,16,13),(82,18,2),(83,22,2),(84,23,2),(85,26,2),(86,27,2),(87,3,18),(88,6,18),(89,7,18),(90,10,18),(91,2,21),(92,3,21),(93,4,21),(94,8,21),(95,2,15),(96,3,15),(97,6,15),(98,7,15),(99,11,15),(100,15,15),(101,2,5),(102,2,12),(103,6,12),(104,3,4),(105,7,4),(106,3,4),(107,7,4),(108,3,9),(109,7,9),(110,11,9);

/*Table structure for table `listing_pictures` */

DROP TABLE IF EXISTS `listing_pictures`;

CREATE TABLE `listing_pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listing_id` int(11) NOT NULL,
  `picture` varchar(250) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `listing_id` (`listing_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `listing_pictures` */

insert  into `listing_pictures`(`id`,`listing_id`,`picture`,`active`) values (1,1,'f354s9m5m5ck44w.jpg',1),(2,20,'5156a8ab841155f7dab3e85230b675d9.jpg',1),(3,20,'3d7523d48eff4cfecf66b0277c95b33a.jpg',1),(4,19,'272a59b48adc9c7ab9594537abfc7872.jpg',1),(5,19,'cc8ecc58f6d5d5b654b4a62cbb35deb3.jpg',1),(6,17,'ccd32863779ad96571d0017579e33bb7.jpg',1),(7,16,'a9d6f60ac110648887e6ff946d1ea2bb.jpg',1),(8,13,'11545c5848e657e68e58e9deaabe0235.jpg',1),(9,2,'da82a1a217468b2d9dcd226d813f192b.jpg',1),(10,18,'ded93c40c2c7f10e6a27f12929562f96.jpg',1),(11,21,'c57d66ff7f742b2f855a775af42da9df.jpg',1),(12,15,'2e028f86b3c056c4cd4df269439f5c84.jpg',1);

/*Table structure for table `messages` */

DROP TABLE IF EXISTS `messages`;

CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiver_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `type` enum('Inbox','Reservation') DEFAULT 'Inbox',
  `message` text NOT NULL,
  `listing_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `read_status` tinyint(1) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `messages` */

insert  into `messages`(`id`,`receiver_id`,`sender_id`,`type`,`message`,`listing_id`,`check_in`,`check_out`,`read_status`,`date_time`) values (1,3,2,'Inbox','Message goes here message goes here Message goes here message goes here Message goes here message goes here Message goes here message goes here Message goes here message goes here Message goes here message goes here',1,'2015-08-12','2015-08-28',1,'2015-08-19 17:03:22');

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_desc` text COLLATE utf8_unicode_ci,
  `footer` tinyint(1) DEFAULT '1',
  `left_column` tinyint(1) DEFAULT '1',
  `datetime_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `pages` */

insert  into `pages`(`id`,`page_title`,`slug`,`page_desc`,`footer`,`left_column`,`datetime_added`,`active`) values (1,'About Us','about','<p>Nullam vestibulum nisi dapibus erat lobortis laoreet. Morbi ultricies diam ante, id vestibulum nisi vulputate eget. Mauris faucibus nisi mauris, eu condimentum arcu accumsan sit amet. Nulla volutpat cursus sem at viverra. Integer posuere tincidunt enim mattis consectetur. Donec accumsan adipiscing nulla. Etiam blandit arcu ante, et bibendum eros congue sed. Etiam at dolor non orci rutrum ullamcorper at non eros. Pellentesque pulvinar nisl non metus dapibus, at scelerisque ante pulvinar. Mauris venenatis nulla vel eleifend varius.</p>\r\n                                        \r\n                                        \r\n                                        <p>Integer eu mollis magna. Praesent tincidunt mi id urna sodales congue. Aenean imperdiet nisl tristique nunc viverra, eu sollicitudin erat bibendum. Duis lacinia augue tellus, ut lobortis metus adipiscing eu. Quisque et sollicitudin metus. Aenean porttitor dolor at convallis hendrerit. Ut iaculis urna vel ante pellentesque, quis commodo mauris sagittis. Cras eget gravida sapien. Vivamus feugiat sem sit amet commodo tincidunt. Pellentesque in tellus sem. Phasellus vel laoreet nulla. Vivamus ultricies sem gravida, luctus purus eget, egestas nisi.</p>\r\n                                        <p>Proin elementum dolor ut tempor congue. Fusce turpis leo, ultrices vel sagittis eu, ultricies ut velit. Donec vel imperdiet mauris. Duis pellentesque, erat a dictum dictum, felis lorem rutrum augue, ac dignissim quam quam in mi. Aliquam consectetur nisl mi, vitae suscipit mauris tempus et. Suspendisse ipsum arcu, pharetra eget aliquam suscipit, commodo et turpis. Integer magna ligula, pulvinar eu vulputate at, dapibus non turpis. Suspendisse non fringilla erat. Aenean purus dolor, fringilla id egestas non, iaculis non nisl. Integer luctus orci vestibulum</p>\r\n                                        \r\n                                   <p>&nbsp;</p>',1,1,'2015-09-02 12:33:19',1),(2,'Privacy Policy','privacy-policy','<p>Nullam vestibulum nisi dapibus erat lobortis laoreet. Morbi ultricies diam ante, id vestibulum nisi vulputate eget. Mauris faucibus nisi mauris, eu condimentum arcu accumsan sit amet. Nulla volutpat cursus sem at viverra. Integer posuere tincidunt enim mattis consectetur. Donec accumsan adipiscing nulla. Etiam blandit arcu ante, et bibendum eros congue sed. Etiam at dolor non orci rutrum ullamcorper at non eros. Pellentesque pulvinar nisl non metus dapibus, at scelerisque ante pulvinar. Mauris venenatis nulla vel eleifend varius.</p>\r\n                                        \r\n                                        \r\n                                        <p>Integer eu mollis magna. Praesent tincidunt mi id urna sodales congue. Aenean imperdiet nisl tristique nunc viverra, eu sollicitudin erat bibendum. Duis lacinia augue tellus, ut lobortis metus adipiscing eu. Quisque et sollicitudin metus. Aenean porttitor dolor at convallis hendrerit. Ut iaculis urna vel ante pellentesque, quis commodo mauris sagittis. Cras eget gravida sapien. Vivamus feugiat sem sit amet commodo tincidunt. Pellentesque in tellus sem. Phasellus vel laoreet nulla. Vivamus ultricies sem gravida, luctus purus eget, egestas nisi.</p>\r\n                                        <p>Proin elementum dolor ut tempor congue. Fusce turpis leo, ultrices vel sagittis eu, ultricies ut velit. Donec vel imperdiet mauris. Duis pellentesque, erat a dictum dictum, felis lorem rutrum augue, ac dignissim quam quam in mi. Aliquam consectetur nisl mi, vitae suscipit mauris tempus et. Suspendisse ipsum arcu, pharetra eget aliquam suscipit, commodo et turpis. Integer magna ligula, pulvinar eu vulputate at, dapibus non turpis. Suspendisse non fringilla erat. Aenean purus dolor, fringilla id egestas non, iaculis non nisl. Integer luctus orci vestibulum</p>\r\n                                        \r\n                                   <p>&nbsp;</p>',1,1,'2015-09-02 02:33:48',1),(3,'Terms & Conditions','terms','<p>Nullam vestibulum nisi dapibus erat lobortis laoreet. Morbi ultricies diam ante, id vestibulum nisi vulputate eget. Mauris faucibus nisi mauris, eu condimentum arcu accumsan sit amet. Nulla volutpat cursus sem at viverra. Integer posuere tincidunt enim mattis consectetur. Donec accumsan adipiscing nulla. Etiam blandit arcu ante, et bibendum eros congue sed. Etiam at dolor non orci rutrum ullamcorper at non eros. Pellentesque pulvinar nisl non metus dapibus, at scelerisque ante pulvinar. Mauris venenatis nulla vel eleifend varius.</p>\r\n                                        \r\n                                        \r\n                                        <p>Integer eu mollis magna. Praesent tincidunt mi id urna sodales congue. Aenean imperdiet nisl tristique nunc viverra, eu sollicitudin erat bibendum. Duis lacinia augue tellus, ut lobortis metus adipiscing eu. Quisque et sollicitudin metus. Aenean porttitor dolor at convallis hendrerit. Ut iaculis urna vel ante pellentesque, quis commodo mauris sagittis. Cras eget gravida sapien. Vivamus feugiat sem sit amet commodo tincidunt. Pellentesque in tellus sem. Phasellus vel laoreet nulla. Vivamus ultricies sem gravida, luctus purus eget, egestas nisi.</p>\r\n                                        <p>Proin elementum dolor ut tempor congue. Fusce turpis leo, ultrices vel sagittis eu, ultricies ut velit. Donec vel imperdiet mauris. Duis pellentesque, erat a dictum dictum, felis lorem rutrum augue, ac dignissim quam quam in mi. Aliquam consectetur nisl mi, vitae suscipit mauris tempus et. Suspendisse ipsum arcu, pharetra eget aliquam suscipit, commodo et turpis. Integer magna ligula, pulvinar eu vulputate at, dapibus non turpis. Suspendisse non fringilla erat. Aenean purus dolor, fringilla id egestas non, iaculis non nisl. Integer luctus orci vestibulum</p>\r\n                                        \r\n                                   <p>&nbsp;</p>',1,1,'2015-09-02 02:33:48',1),(4,'Security','security','<p>Nullam vestibulum nisi dapibus erat lobortis laoreet. Morbi ultricies diam ante, id vestibulum nisi vulputate eget. Mauris faucibus nisi mauris, eu condimentum arcu accumsan sit amet. Nulla volutpat cursus sem at viverra. Integer posuere tincidunt enim mattis consectetur. Donec accumsan adipiscing nulla. Etiam blandit arcu ante, et bibendum eros congue sed. Etiam at dolor non orci rutrum ullamcorper at non eros. Pellentesque pulvinar nisl non metus dapibus, at scelerisque ante pulvinar. Mauris venenatis nulla vel eleifend varius.</p>\r\n                                        \r\n                                        \r\n                                        <p>Integer eu mollis magna. Praesent tincidunt mi id urna sodales congue. Aenean imperdiet nisl tristique nunc viverra, eu sollicitudin erat bibendum. Duis lacinia augue tellus, ut lobortis metus adipiscing eu. Quisque et sollicitudin metus. Aenean porttitor dolor at convallis hendrerit. Ut iaculis urna vel ante pellentesque, quis commodo mauris sagittis. Cras eget gravida sapien. Vivamus feugiat sem sit amet commodo tincidunt. Pellentesque in tellus sem. Phasellus vel laoreet nulla. Vivamus ultricies sem gravida, luctus purus eget, egestas nisi.</p>\r\n                                        <p>Proin elementum dolor ut tempor congue. Fusce turpis leo, ultrices vel sagittis eu, ultricies ut velit. Donec vel imperdiet mauris. Duis pellentesque, erat a dictum dictum, felis lorem rutrum augue, ac dignissim quam quam in mi. Aliquam consectetur nisl mi, vitae suscipit mauris tempus et. Suspendisse ipsum arcu, pharetra eget aliquam suscipit, commodo et turpis. Integer magna ligula, pulvinar eu vulputate at, dapibus non turpis. Suspendisse non fringilla erat. Aenean purus dolor, fringilla id egestas non, iaculis non nisl. Integer luctus orci vestibulum</p>\r\n                                        \r\n                                   <p>&nbsp;</p>',1,1,'2015-09-02 02:33:48',1),(5,'Careers Opputunities','career','<p>Nullam vestibulum nisi dapibus erat lobortis laoreet. Morbi ultricies diam ante, id vestibulum nisi vulputate eget. Mauris faucibus nisi mauris, eu condimentum arcu accumsan sit amet. Nulla volutpat cursus sem at viverra. Integer posuere tincidunt enim mattis consectetur. Donec accumsan adipiscing nulla. Etiam blandit arcu ante, et bibendum eros congue sed. Etiam at dolor non orci rutrum ullamcorper at non eros. Pellentesque pulvinar nisl non metus dapibus, at scelerisque ante pulvinar. Mauris venenatis nulla vel eleifend varius.</p>\r\n                                        \r\n                                        \r\n                                        <p>Integer eu mollis magna. Praesent tincidunt mi id urna sodales congue. Aenean imperdiet nisl tristique nunc viverra, eu sollicitudin erat bibendum. Duis lacinia augue tellus, ut lobortis metus adipiscing eu. Quisque et sollicitudin metus. Aenean porttitor dolor at convallis hendrerit. Ut iaculis urna vel ante pellentesque, quis commodo mauris sagittis. Cras eget gravida sapien. Vivamus feugiat sem sit amet commodo tincidunt. Pellentesque in tellus sem. Phasellus vel laoreet nulla. Vivamus ultricies sem gravida, luctus purus eget, egestas nisi.</p>\r\n                                        <p>Proin elementum dolor ut tempor congue. Fusce turpis leo, ultrices vel sagittis eu, ultricies ut velit. Donec vel imperdiet mauris. Duis pellentesque, erat a dictum dictum, felis lorem rutrum augue, ac dignissim quam quam in mi. Aliquam consectetur nisl mi, vitae suscipit mauris tempus et. Suspendisse ipsum arcu, pharetra eget aliquam suscipit, commodo et turpis. Integer magna ligula, pulvinar eu vulputate at, dapibus non turpis. Suspendisse non fringilla erat. Aenean purus dolor, fringilla id egestas non, iaculis non nisl. Integer luctus orci vestibulum</p>\r\n                                        \r\n                                   <p>&nbsp;</p>',1,1,'2015-09-02 02:33:48',1),(6,'About Company','company','\r\n                                        \r\n<p>Nullam vestibulum nisi dapibus erat lobortis laoreet. Morbi ultricies diam ante, id vestibulum nisi vulputate eget. Mauris faucibus nisi mauris, eu condimentum arcu accumsan sit amet. Nulla volutpat cursus sem at viverra. Integer posuere tincidunt enim mattis consectetur. Donec accumsan adipiscing nulla. Etiam blandit arcu ante, et bibendum eros congue sed. Etiam at dolor non orci rutrum ullamcorper at non eros. Pellentesque pulvinar nisl non metus dapibus, at scelerisque ante pulvinar. Mauris venenatis nulla vel eleifend varius.</p>\r\n                                        \r\n                                        \r\n                                        <p>Integer eu mollis magna. Praesent tincidunt mi id urna sodales congue. Aenean imperdiet nisl tristique nunc viverra, eu sollicitudin erat bibendum. Duis lacinia augue tellus, ut lobortis metus adipiscing eu. Quisque et sollicitudin metus. Aenean porttitor dolor at convallis hendrerit. Ut iaculis urna vel ante pellentesque, quis commodo mauris sagittis. Cras eget gravida sapien. Vivamus feugiat sem sit amet commodo tincidunt. Pellentesque in tellus sem. Phasellus vel laoreet nulla. Vivamus ultricies sem gravida, luctus purus eget, egestas nisi.</p>\r\n                                        <p>Proin elementum dolor ut tempor congue. Fusce turpis leo, ultrices vel sagittis eu, ultricies ut velit. Donec vel imperdiet mauris. Duis pellentesque, erat a dictum dictum, felis lorem rutrum augue, ac dignissim quam quam in mi. Aliquam consectetur nisl mi, vitae suscipit mauris tempus et. Suspendisse ipsum arcu, pharetra eget aliquam suscipit, commodo et turpis. Integer magna ligula, pulvinar eu vulputate at, dapibus non turpis. Suspendisse non fringilla erat. Aenean purus dolor, fringilla id egestas non, iaculis non nisl. Integer luctus orci vestibulum</p>\r\n                                        \r\n                                   <p>&nbsp;</p>',1,1,'2015-09-02 02:33:48',1);

/*Table structure for table `reservation` */

DROP TABLE IF EXISTS `reservation`;

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listing_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `listing_id` (`listing_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `reservation` */

/*Table structure for table `reviews` */

DROP TABLE IF EXISTS `reviews`;

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reviews_to` int(11) NOT NULL,
  `reviews_by` int(11) NOT NULL,
  `review` text NOT NULL,
  `listing_id` int(11) DEFAULT NULL,
  `accuracy` int(11) NOT NULL,
  `communication` int(11) NOT NULL,
  `cleanliness` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `check_in` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `reviews_by` (`reviews_by`),
  KEY `reviews_to` (`reviews_to`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `reviews` */

insert  into `reviews`(`id`,`reviews_to`,`reviews_by`,`review`,`listing_id`,`accuracy`,`communication`,`cleanliness`,`location`,`check_in`,`value`,`date_time`) values (1,2,3,'Great developer Ever.',1,5,5,5,5,5,5,'2015-08-19 17:31:31');

/*Table structure for table `room_type` */

DROP TABLE IF EXISTS `room_type`;

CREATE TABLE `room_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `room_type` */

insert  into `room_type`(`id`,`name`,`active`) values (1,'Entire home/apt',1),(2,'Private room',1),(3,'Shared room',1);

/*Table structure for table `trust_verification` */

DROP TABLE IF EXISTS `trust_verification`;

CREATE TABLE `trust_verification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `document` varchar(250) NOT NULL,
  `document_type` enum('ID','Passport','Other') NOT NULL,
  `active` tinyint(1) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `trust_verification` */

insert  into `trust_verification`(`id`,`user_id`,`document`,`document_type`,`active`,`date_time`) values (1,3,'id-eu-passport-back-ver-1439203092000.png','ID',1,'2015-08-19 18:00:12');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `languages` varchar(255) NOT NULL,
  `picture` varchar(150) NOT NULL DEFAULT 'default.png',
  `address` varchar(100) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `country` varchar(20) NOT NULL,
  `oauth_provider` varchar(10) NOT NULL,
  `oauth_uid` varchar(20) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `registered_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `birth_date` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `about` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`first_name`,`last_name`,`email`,`password`,`hash`,`phone`,`languages`,`picture`,`address`,`city`,`state`,`zip`,`country`,`oauth_provider`,`oauth_uid`,`active`,`registered_date`,`birth_date`,`gender`,`about`) values (2,'Nadeem','iqbal','nadeem@gmail.com','25d55ad283aa400af464c76d713c07ad','','','','Desert.jpg','722 siddiq trade center','lahore','punjab','54200','pakistan','E-mail',NULL,1,'2015-08-18 13:04:26','0000-00-00','Male',''),(3,'Mr','Malik','malik@test.com','e10adc3949ba59abbe56e057f20f883e','','123456','','4v4fj3vw47ms8s8.jpg','722 siddiq trade center','lahore','punjab','54200','Pakistan','E-mail',NULL,1,'2015-08-19 17:01:47','0000-00-00','Male',''),(11,'Nadeem','iqbal','nadeem0035@gmail.com','25d55ad283aa400af464c76d713c07ad','','','','default.png','','','','','','E-mail',NULL,1,'2015-08-21 19:37:40','0000-00-00','Male',''),(13,'imran','haider','info@sheensol.com','e10adc3949ba59abbe56e057f20f883e','','','','aa22485d4be7fc0767acaf17a200a54b.jpg','','','','','','E-mail',NULL,1,'2015-08-22 14:52:40','0000-00-00','Male',''),(14,'Micaela','Johnston','micaela@betainnovative.com','25d55ad283aa400af464c76d713c07ad','','','','default.png','','','','','','E-mail',NULL,1,'2015-08-24 23:59:26','0000-00-00','Male','');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
