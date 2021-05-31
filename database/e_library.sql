/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.13-MariaDB : Database - e_library
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`e_library` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `e_library`;

/*Table structure for table `booking` */

DROP TABLE IF EXISTS `booking`;

CREATE TABLE `booking` (
  `id_booking` varchar(12) NOT NULL,
  `tgl_booking` date DEFAULT NULL,
  `batas_ambil` date DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_booking`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `booking` */

/*Table structure for table `booking_detail` */

DROP TABLE IF EXISTS `booking_detail`;

CREATE TABLE `booking_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_booking` varchar(12) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_booking` (`id_booking`),
  KEY `id_buku` (`id_buku`),
  CONSTRAINT `booking_detail_ibfk_1` FOREIGN KEY (`id_booking`) REFERENCES `booking` (`id_booking`),
  CONSTRAINT `booking_detail_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

/*Data for the table `booking_detail` */

/*Table structure for table `buku` */

DROP TABLE IF EXISTS `buku`;

CREATE TABLE `buku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul_buku` varchar(128) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `pengarang` varchar(64) DEFAULT NULL,
  `penerbit` varchar(64) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `isbn` varchar(64) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `dipinjam` int(11) DEFAULT NULL,
  `dibooking` int(11) DEFAULT NULL,
  `image` varchar(256) DEFAULT NULL,
  `jml_halaman` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kategori` (`id_kategori`),
  CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4;

/*Data for the table `buku` */

insert  into `buku`(`id`,`judul_buku`,`id_kategori`,`pengarang`,`penerbit`,`tahun_terbit`,`isbn`,`stok`,`dipinjam`,`dibooking`,`image`,`jml_halaman`) values (24,'Ensiklopedia Teknologi Komputer',22,'Madcoms','ANDI OFFSET',2019,'9786230101533',0,0,0,'img1622196910.png',280),(25,'Fs Mudah Membuat dan Berbisnis Aplikasi Android dengan Android Studio',22,'Yudha Yudhanto & Ardhi Wijayanto','Elex Media Komputindo',2021,'9786020455051',6,0,0,'img1622209714.png',192),(26,'Logika Pemrograman Java',22,'Abdul Kadir','Elex media Komputindo',2020,'9786230019500',2,1,0,'img1622209768.png',568),(27,'Dasar Logika Pemrograman Komputer',22,'Abdul Kadir','Elex Media Komputindo',2018,'9786020451664',4,1,0,'img1622209844.png',348),(28,'7 in 1 Pemrograman Web Tingkat Lanjut',22,'Rohi Abdulloh','Elex Media Komputindo',2018,'9786020486628',4,1,0,'img1622210866.png',336),(31,'Koleksi Program Web Php',22,'Yuniar Supardi & Irwan Kurniawan, S.Kom.','Elex Media komputindo',2020,'9786230014994',12,0,0,'img1622425840.png',396),(32,'Komputer & Masyarakat',22,'Putu Agus Eka Pratama','Informatika',2021,'9786237131403',8,0,0,'img1622425974.png',408),(33,'101+ Pengetahuan Bikin Kamu Mahir IT',22,'Feri Sulianta','Elex Media Komputindo',2018,'9786020483955',3,0,0,'img1622426031.png',280),(34,'Teknik Penulisan Tugas Akhir dan Skripsi Pemrograman',22,'Uus Rusmawan','Elex Media Komputindo',2019,'9786020496801',4,0,0,'img1622426079.png',212),(35,'Melumpuhkan Hacker Dengan Web Application Firewall',22,'Girindro Pringgo Digdo','Andi Publisher',2016,'9789792953091',1,0,0,'img1622426140.png',104),(36,'Rekayasa fondasi untuk program vokasi',23,'IR.Hanifiah, Zairpan Jaya dan Muhammad Reza','ANDI OFFSET',2020,'9786230103261',3,0,0,'img1622426215.jpg',346),(37,'Pengantar desain komunikasi visual dalam penerapan',23,'Ricky W. Putra','ANDI OFFSET',2021,'9786230110214',7,0,0,'img1622426264.jpg',176),(38,'Elektronika dasar CD',23,'John Adler dan Sutono','Informatika',2020,'9786237131267',5,0,0,'img1622428517.jpg',322),(39,'IOS App Dev. 101-Dasar Dasar Pengembangan Aplikasi ios',23,'Luthfi Fathur Rahman','Elex Media Komputindo',2017,'9786020450520',8,0,0,'img1622428560.jpg',120),(40,'Panduan Praktis Perancangan Dan Pemrogramn Hasta Karya Robot',23,'Dr. Widodo Bidiharto','Andi Publisher',2014,'9789792943474',5,0,0,'img1622428603.jpg',145),(41,'Menguasai Adobe Photoshop Cc 2021',23,'Jubilcc Enterprise','Elex Media komputindo',2021,'9786230025792',12,0,0,'img1622428671.jpg',280),(42,'Mengolah Data Statistik Dengan Ms Excel',23,'Yudhy Wicaksono dan Solusi kantor','Elex Media komputindo',2021,'9786230024603',4,0,0,'img1622428713.jpg',320),(43,'Komputer Dan Masyarakat Edisi Revisi',23,'I Putu Agus Eka Pratama','Informatika',2021,'9786237131403',8,0,0,'img1622428759.jpg',408),(44,'Panduan  Coreldraw, Photoshop, Dan Camtasia',23,'Aristia Prasetyo Adi','Elex Media Komputindo',2020,'9786230021992',4,0,0,'img1622428811.jpg',344),(45,'Desain Web Bagi Pemula',23,'Candra Surya Dan Miftahul Jannah','Elex Media Komputindo',2020,'9786230016349',4,0,0,'img1622428865.jpg',288),(46,'Pajak 4.0, Tantangan Dan Dinamika Perpajakan',24,'Prof. Gunadi | Sugianto | Wahyu Nuryanto','PT MULTI UTAMA CONSULTINDO',2019,'9786027420090',3,0,0,'img1622430139.jpg',300),(47,'Raving Fans, Pendekatan Revolusioner Untuk Dicintai Pelanggan',24,'Harvey Mackay','Elex Media Komputindo',2021,'9786230015762',2,0,0,'img1622430197.jpg',152),(48,'Marketing Plan! Dalam Bisnis (Third Edition)',24,'Ir. FI. Titik Wijayanti,MM','Elex Media Komputindo',2017,'9786020438443',2,0,0,'img1622430240.jpg',256),(49,'Soft Competencies Industry 4.0, Strategi Menyiapkan Sdm Unggul di Era Disrupsi',24,'Dr. Silverius Y. Soeharso, Psikolog | Ir. Tedjo Tripomo, M.T.','Andi Offset',2021,'9786237851066',3,0,0,'img1622430287.jpg',320),(50,'Property Top Secret, Buku Pintar Bisnis Dan Investasi Properti di Era Revolusi Industri 4.0',24,'Iswi Hariyani, S.H., M.H. | Dr. Cita Yustisia Sertiyani, S.H., M','Andi Offset',2021,'9786230110726',5,0,0,'img1622430386.jpg',688),(51,'Psikologi Bisnis, Paradigma Baru Mengelola Bisnis',24,'Dr. Sonny Y. Soeharso, Psi.','Andi Offset',2020,'9786239196820',5,0,0,'img1622430428.jpg',496),(52,'Ekonomi, Politik Dan Peluang Bisnis Di Negara-Negara Teluk',24,'Pusdatin','PUSAT DATA DAN INFORMASI (PUSDATIN)',2021,'9786239585105',5,0,0,'img1622430473.jpg',332),(53,'Standard Operating Procedure, Cara Praktis Dan Efektif Menerapkan SOP di Segala Macam Bisnis',24,'Fajar Nur’aini D.F.','Quadrant',2020,'9786232443013',5,0,0,'img1622430587.jpg',164),(54,'Kebijakan Ekonomi Regulasi, Institusi, dan Konstitusi',24,'Ahmad Erani Yustika | Rukavina Baksh','Intrans Publishing',2021,'9786236709108',2,0,0,'img1622430697.jpg',278),(55,'Penguatan Konektivitas Lintas Batas Dalam Kerja Sama Ekonomi Subregional',24,'Indriana Kartini | Rosita Dewi | Agus R. Rahman','Yayasan Pustaka Obor Indonesia',2021,'9786233210089',6,0,0,'img1622430736.jpg',230),(56,'Sejarah Hukum Agaria',25,'Prof.Dr. Drs.Abintoro, S.H., M.S,','Setara Press',2021,'9786026344977',10,0,0,'img1622430829.jpg',358),(57,'Hukum Acara Perdata Indonesia',25,'Prof.Dr.Sudikno Mertokusumo, S.H.','CV Maha Karya Pustaka',2021,'9786239006563',9,0,0,'img1622430873.jpg',390),(58,'Hukum Dan Masyarakat',25,'PROF. DR. SUTEKI, SH., M. HUM','Thafa Media',2021,'9786025589454',8,0,0,'img1622430914.jpg',450),(59,'Hukum Pidana Positif Penghinaan',25,'Adami Chazawi','Media Nusa Creative',2021,'9786020839417',7,0,0,'img1622430967.jpg',300),(60,'Pemberantasan Korupsi',25,'Dr. H. Abdul Muis Bj','Pustaka Reka Cipta',2021,'9786021311578',6,0,0,'img1622431012.jpg',304),(61,'Hukum Waris Adat',25,'Prof. Dr.Rosnidar Sembiring, S.H., M.hum.','PT.Rajagrafindo Persada',2021,'9786232317949',5,0,0,'img1622431057.jpg',256),(62,'Penghantar Hukum Indonesia',25,'Prof.Dr. Teguh Prasetyo, S.H., M,Si.','PT.Rajagrafindo Persada',2021,'9786232315600',4,0,0,'img1622431115.jpg',348),(63,'Hukum Komunikasi Massa',25,'Ahmad Riyadh','Indomedia Pustaka',2021,'9786026417930',3,0,0,'img1622431157.jpg',88),(64,'Aspek Hukum Perlindungan Anak',25,'Dr.Dani Ramdani, S.H.I., M.H','Prenadamedia Group',2021,'9786232185593',2,0,0,'img1622431227.jpg',218),(65,'Hukum KeNotariatan',25,'Dr,H. Bachrudin','Thema Publishing',2021,'9786239224523',1,0,0,'img1622431269.jpg',270),(66,'Seni Bersikap Santuy',26,'Elin Pash & Kyle Keller','Bhuana Ilmu Populer',2021,'9786230404597',5,0,0,'img1622431421.jpeg',40),(67,'Temukan Dirimu Nikmati Hidupmu',26,'Dr. Maha Arab','Gemilang',2021,'9786237162834',4,0,0,'',256),(68,'Seni Bahagia Menjadi Introver',26,'Sendy Saga','Gagasmedia',2021,'9789797809737',3,0,0,'img1622433535.jpg',180),(69,'Melejitkan Potensi Otak Kanan',26,'Muhammad Nasrullah','Araska Publisher',2021,'9786237537953',2,0,0,'img1622433591.jpg',240),(70,'The Art Positive Thinking',26,'Rifcka R.N','Araska Publisher',2021,'9786237910015',1,0,0,'img1622433632.jpg',240),(71,'Sejarah Teh',27,'Laura C.Martin','Elex Media Komputindo',2020,'9786230013201',5,0,0,'img1622433748.jpg',232),(72,'Lahirnya Pancasila',27,'Floriberta Aing','Media Pressindo',2019,'9786237254393',4,0,0,'img1622433784.jpg',162),(73,'Sejarah Lengkap Perang Dunia I',27,'Alfi Arifian','Sociality',2020,'9786232441323',3,0,0,'img1622433827.jpg',336),(74,'Islam Dalam Arus Sejarah Indonesia',27,'Jajat Burhanudin','Preda Media Group',2017,'9786024220655',3,0,0,'img1622433866.jpg',521),(75,'Sejarah Lengkap Abad Pertengahan 500-1400 M',27,'Alfi Arifian','Sociality',2020,'9786232441330',4,0,0,'img1622433901.jpg',452);

/*Table structure for table `detail_pinjam` */

DROP TABLE IF EXISTS `detail_pinjam`;

CREATE TABLE `detail_pinjam` (
  `no_pinjam` varchar(12) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `denda` int(11) DEFAULT NULL,
  KEY `id_buku` (`id_buku`),
  CONSTRAINT `detail_pinjam_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `detail_pinjam` */

insert  into `detail_pinjam`(`no_pinjam`,`id_buku`,`denda`) values ('30052021001',28,5000),('30052021001',27,5000),('30052021001',26,5000);

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kategori` */

insert  into `kategori`(`id`,`kategori`) values (22,'Komputer & Teknologi'),(23,'Teknik'),(24,'Bisnis Dan Ekonomi'),(25,'Hukum'),(26,'Pengembangan Diri'),(27,'Sejarah');

/*Table structure for table `pinjam` */

DROP TABLE IF EXISTS `pinjam`;

CREATE TABLE `pinjam` (
  `no_pinjam` varchar(12) NOT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `id_booking` varchar(12) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `tgl_pengembalian` date DEFAULT NULL,
  `status` enum('Pinjam','Kembali') DEFAULT NULL,
  `total_denda` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_pinjam`),
  KEY `id_user` (`id_user`),
  KEY `id_booking` (`id_booking`),
  CONSTRAINT `pinjam_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pinjam` */

insert  into `pinjam`(`no_pinjam`,`tgl_pinjam`,`id_booking`,`id_user`,`tgl_kembali`,`tgl_pengembalian`,`status`,`total_denda`) values ('30052021001','2021-05-30','30052021001',31,'2021-05-31','0000-00-00','Pinjam',0);

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `role` */

insert  into `role`(`id`,`role`) values (1,'Admin'),(2,'Member');

/*Table structure for table `temp` */

DROP TABLE IF EXISTS `temp`;

CREATE TABLE `temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_booking` datetime DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `email_user` varchar(128) DEFAULT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `judul_buku` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `penulis` varchar(128) DEFAULT NULL,
  `penerbit` varchar(128) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_buku` (`id_buku`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `temp_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`),
  CONSTRAINT `temp_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `temp` */

/*Table structure for table `token` */

DROP TABLE IF EXISTS `token`;

CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) DEFAULT NULL,
  `token` varchar(180) DEFAULT NULL,
  `date_created` varchar(180) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

/*Data for the table `token` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(128) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `image` varchar(128) DEFAULT 'default.jpg',
  `password` varchar(256) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `tanggal_input` int(11) DEFAULT NULL,
  `no_telp` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`id`,`nama`,`alamat`,`email`,`image`,`password`,`role_id`,`is_active`,`tanggal_input`,`no_telp`) values (1,'Andika Permana Sidiq','Blok Walahar I','andika@gmail.com','default.jpg','$2y$10$YAE4AuK94fZtp9.K52yAjuOjllWjYzfBj0xsTBPvqe0FAghAsWVjC',1,1,1606012478,'085321874357'),(31,'Andika Permana Sidiq','Bandung','andikapermanasidiq00@gmail.com','pro1622385319.jpg','$2y$10$uGWCNKVqP.uZ3w2yAyh6ZuHqYlIUChlQ1Cz3T2aaRdnQYSyOPoV7m',2,1,1622181518,'085321874358'),(36,'Andika Permana Sidiq','Bandung','andikapermanasidiq@gmail.com','default.jpg','$2y$10$KP1jjpZtp.lS3fASydRuBeLRdRw0T3izQ1ZSU6yz6dgYi1FDSuGHW',2,1,1622207991,'085321874358');

/*Table structure for table `wishlist` */

DROP TABLE IF EXISTS `wishlist`;

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_buku` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_buku` (`id_buku`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`),
  CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `wishlist` */

insert  into `wishlist`(`id`,`id_buku`,`id_user`,`date_created`) values (4,24,31,1622388306),(6,25,36,1622390224),(7,28,36,1622390434);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
