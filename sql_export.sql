-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2022 at 05:53 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peanut`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `eventid` int(10) NOT NULL,
  `eventname` varchar(80) NOT NULL,
  `eventdate` datetime NOT NULL,
  `eventdesc` text NOT NULL,
  `maxperson` int(10) NOT NULL,
  `price` double(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`eventid`, `eventname`, `eventdate`, `eventdesc`, `maxperson`, `price`) VALUES
(10001, 'League of Legends 2022 World Championship', '2022-12-15 19:00:00', 'Championships has gained tremendous success and popularity, making it among the world\'s most prestigious and watched tournaments, as well as the most watched video game in the world.\r\n\r\nThe tournament rotates its venues across different major countries and regions each year. South Korea\'s T1 is the most successful team in the tournament\'s history, having won three world championships.', 250, 50.00),
(10002, 'The International 2022 Western Europe Qualifier Dota 2', '2023-01-04 20:00:00', 'All teams that participated in the third tour of the current DPC season that aren’t qualified to The International 2022 by finishing top 12 in DPC rankings are eligible to participate provided that they did not replace more than two players from their third tour roster.\r\nThe teams are seeded based on their DPC point total followed by their standing in the final tour of the regional league.', 250, 50.00),
(10003, 'Elisa Invitational Fall 2022', '2023-01-15 20:00:00', 'Elisa Invitational Fall 2022 is an online European Global Offensive tournament organized by Elisa Esports. This online tournament will take place featuring 28 teams competing over a total prize pool of $25,000 USD.', 250, 50.00),
(10004, 'PUBG Mobile Pro League 2022 PUBG', '2023-02-02 20:00:00', 'The PMPL is the pro-level of the PUBG MOBILE esports ecosystem and sees the best teams from around the world compete in regional-based leagues for a share of a $5,300,000 USD prize pool. For 2022, the PMPL shifted to run on a 1-year-cycle instead of seasonal relegation in order to create a stable competitive environment and provide even more excitement for teams and fans. ', 250, 50.00),
(10005, 'Nerd Street Gamers-Summer Championship 2022 Apex', '2023-02-28 20:00:00', 'Nerd Street Gamers: Summer Championship is an online North American tournament organized by Nerd Street Gamers.', 250, 50.00),
(10006, 'VCT Masters Copenhagen 2022', '2022-09-24 23:08:00', 'The Valorant Champions Tour 2022: Stage 2 Masters has been full of exciting moments, surprises and last-minute victories. There have been dramatic wins and moving losses, with plenty to be proud of from each team and participant. One of the most explosive things that can happen during a match is a clutch, a move that secures a victory from a team at a disadvantage. If the last remaining member of a team suddenly knocks everyone else out and claims the win – that\'s a clutch. The move has seen countless Valorant games change course dramatically in all manner of competitions, but a clutch at the VCT Masters just hits a little harder.', 200, 10.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `eventid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10007;
COMMIT;

-- --------------------------------------------------------

--
-- Stand-in structure for view `eventstat`
-- (See below for the actual view)
--
CREATE TABLE `eventstat` (
`eventid` int(10)
,`eventname` varchar(80)
,`eventdate` datetime
,`eventdesc` text
,`maxperson` int(10)
,`revenue` double(19,2)
,`ticketresv` decimal(32,0)
,`ticketavail` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `memberid` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phoneno` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`memberid`, `username`, `fullname`, `email`, `phoneno`, `password`, `created_at`) VALUES
(1001, 'GW0904', 'Law Guan Wen', 'guanwen0904@gmail.com', '016-23145678', '$2y$10$aYdp1usgSyMi71anuz00PuJ9NRvl1G6YHIZDNO0LiDAPQom2R0CB6', '2022-09-24 15:51:29'),
(1002, 'Doggy123', 'Tan Jia Hong', 'doggy@gmail.com', '011-12345678', '$2y$10$/6/zVa2WvFPABFNZ/IT1xutBahxilwUtyTy3T7xY6SbhgMvlf8B5G', '2022-09-24 15:44:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `memberid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1003;
COMMIT;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsid` int(100) NOT NULL,
  `title` varchar(90) NOT NULL,
  `detail` varchar(600) NOT NULL,
  `date` date NOT NULL,
  `game` varchar(30) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsid`, `title`, `detail`, `date`, `game`, `image`) VALUES
(7, 'Veteran Gen.G ADC Ruler wins first LCK MVP award for 2022 Summer Split', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2022-08-31', 'League Of Legends', 'uploads/df83f7e2a91adeff58fb74b2b95d6430.jpg'),
(8, 'SANDBOX take down DRX to advance to semifinals of 2022 LCK Summer Playoffs ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n                    ', '2022-09-06', 'League Of Legends', 'uploads/0a400ae28ef15d76b2596c2c213b0008.jpg'),
(9, 'Sentinels VALORANT pro Zellsis banned on Twitch, denies any wrongdoing', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n                    ', '2022-09-01', 'Valorant', 'uploads/7a5f6a0b6cbad773765caa0423b47f28.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phoneno` varchar(12) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `username`, `fullname`, `email`, `phoneno`, `password`, `created_at`) VALUES
(2001, 'admin1', 'Ng Chong Jian', 'gunwun2020@gmail.com', '012-19875462', '$2y$10$2w1810xEzNrrjPXN1PFhke.To8vEzl5IpSW1BrO86tokXYbPs2h9.', '2022-09-24 15:45:42'),
(2002, 'admin2', 'Chong Wen Bin', 'chongjian@gmail.com', '018-10574857', '$2y$10$LByQwN5yb5amAAYpUYhH7ufUphoy66TNmovlTUuyztHqlm60KK4sW', '2022-09-24 15:45:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2003;
COMMIT;

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticketid` int(10) NOT NULL,
  `memberid` int(10) NOT NULL,
  `eventid` int(10) NOT NULL,
  `ticketnum` int(10) NOT NULL,
  `registerdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketid`, `memberid`, `eventid`, `ticketnum`, `registerdate`) VALUES
(50001, 1001, 10001, 5, '2022-09-24 23:29:13'),
(50002, 1002, 10006, 2, '2022-09-24 23:48:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticketid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticketid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50003;
COMMIT;

-- --------------------------------------------------------

--
-- Structure for view `eventstat`
--
DROP TABLE IF EXISTS `eventstat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eventstat`  AS SELECT `e`.`eventid` AS `eventid`, `e`.`eventname` AS `eventname`, `e`.`eventdate` AS `eventdate`, `e`.`eventdesc` AS `eventdesc`, `e`.`maxperson` AS `maxperson`, coalesce(sum(`t`.`ticketnum`),0) * `e`.`price` AS `revenue`, coalesce(sum(`t`.`ticketnum`),0) AS `ticketresv`, `e`.`maxperson`- coalesce(sum(`t`.`ticketnum`),0) AS `ticketavail` FROM (`event` `e` left join `ticket` `t` on(`e`.`eventid` = `t`.`eventid`)) GROUP BY `e`.`eventid`;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`eventid`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberid`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticketid`),
  ADD KEY `memberid` (`memberid`),
  ADD KEY `eventid` (`eventid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
