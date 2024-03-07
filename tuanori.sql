-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 07, 2024 lúc 07:49 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `test`
--

DELIMITER $$
--
-- Các hàm
--
CREATE DEFINER=`root`@`localhost` FUNCTION `SPLIT_STR` (`x` VARCHAR(255), `delim` VARCHAR(12), `pos` INT) RETURNS VARCHAR(255) CHARSET utf8mb4 COLLATE utf8mb4_general_ci  RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(x, delim, pos),
       CHAR_LENGTH(SUBSTRING_INDEX(x, delim, pos -1)) + 1),
       delim, "")$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banggia_dichvu`
--

CREATE TABLE `banggia_dichvu` (
  `id` int(11) NOT NULL,
  `category_dichvu` int(11) DEFAULT 1,
  `title` varchar(250) DEFAULT NULL,
  `author` text DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `banggia_dichvu`
--

INSERT INTO `banggia_dichvu` (`id`, `category_dichvu`, `title`, `author`, `status`) VALUES
(1, 1, 'Tiểu Đội Sát Thủ( yêu cầu : nm 100k ki , xd 100k hp chưa item , td 5k sd có item )', '{\"server\":[1,2,3,4,5,6,7,8,9,10],\"gia\":{\"1\":200,\"2\":200,\"3\":200,\"4\":200,\"5\":200,\"6\":200,\"7\":200,\"8\":200,\"9\":200,\"10\":200}}', 1),
(2, 1, 'Tiêu Diệt Fide ( yêu cầu : nm 100k ki , xd 100k hp chưa item , td 5k sd có item )', '{\"server\":[1,2,3,4,5,6,7,8,9,10],\"gia\":{\"1\":200,\"2\":200,\"3\":200000,\"4\":200,\"5\":200,\"6\":200,\"7\":200,\"8\":200,\"9\":200,\"10\":200}}', 1),
(3, 1, 'Apk 19 20( yêu cầu : nm 100k ki , xd 100k hp chưa item , td 5k sd có item )', '{\"server\":[1,2,3,4,5,6,7,8],\"gia\":{\"1\":200000,\"2\":200,\"3\":200,\"4\":200,\"5\":200,\"6\":200,\"7\":200,\"8\":200}}', 1),
(13, 1, '123', '{\"gia\":{\"123\":\"123\"},\"server\":[123]}', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `biendongsodu`
--

CREATE TABLE `biendongsodu` (
  `id` int(11) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `truoc` bigint(20) DEFAULT 0,
  `sau` bigint(20) DEFAULT 0,
  `note` varchar(250) DEFAULT NULL,
  `tongtien` bigint(20) DEFAULT NULL,
  `time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `biendongsodu`
--

INSERT INTO `biendongsodu` (`id`, `username`, `truoc`, `sau`, `note`, `tongtien`, `time`) VALUES
(1, 'tuanori', 194984428, 194984728, 'Thưởng nạp top #1 với số tiền 300đ', 300, '2024-03-05 22:55:38'),
(2, 'tuanori23', 195182827, 195183027, 'Thưởng nạp top #2 với số tiền 200đ', 200, '2024-03-05 22:55:38'),
(3, 'TUANCHOPEM2212', 0, 100, 'Thưởng nạp top #3 với số tiền 100đ', 100, '2024-03-05 22:55:38'),
(4, 'ctvtuanori', 600000, 690000, 'Cộng tiền đơn hàng cho dịch vụ Apk 19 20( yêu cầu : nm 100k ki , xd 100k hp chưa item , td 5k sd có item )', 100000, '2024-03-05 23:08:02'),
(5, 'ctvtuanori', 690000, 780000, 'Cộng tiền đơn hàng cho dịch vụ Apk 19 20( yêu cầu : nm 100k ki , xd 100k hp chưa item , td 5k sd có item )', 100000, '2024-03-05 23:08:02'),
(6, 'ctvtuanori', 780000, 280000, 'Mua tài khoản SƠ SINH CHỈ SỐ NGON (GIẢM GIÁ 15%) #12 với số tiền 500,000đ', 500000, '2024-03-05 23:15:54'),
(7, 'ctvtuanori', 280000, 730000, 'Tiền bán tài khoản mã #12 với số tiền 450,000đ', 450000, '2024-03-05 23:15:54'),
(8, 'tuanori', 194984728, 195053728, 'Nạp 69.000đ vào tài khoản qua MOMO', 69000, '2024-03-06 12:49:50'),
(9, 'tuanori', 0, 500000, 'Nạp 500.000đ vào tài khoản qua MOMO', 500000, '2024-03-06 12:55:19'),
(10, 'tuanori', 500000, 0, 'Mua tài khoản SƠ SINH CHỈ SỐ NGON (GIẢM GIÁ 15%) #16 với số tiền 500,000đ', 500000, '2024-03-06 12:56:02'),
(11, 'tuanori', 0, 57500, 'Nạp 57.500đ vào tài khoản qua MBBANK', 57500, '2024-03-06 13:35:45'),
(12, 'tuanori', 57500, 557500, 'Thưởng nạp top #1 với số tiền 500,000đ', 500000, '2024-03-06 13:37:39'),
(13, 'tuanori23', 195183027, 195383027, 'Thưởng nạp top #2 với số tiền 200,000đ', 200000, '2024-03-06 13:37:39'),
(14, 'TUANCHOPEM2212', 100, 100100, 'Thưởng nạp top #3 với số tiền 100,000đ', 100000, '2024-03-06 13:37:39'),
(15, 'tuanori', 557500, 547600, 'Mua thẻ VIETTEL, số lượng 0 thẻ với giá 9,900đ', 9900, '2024-03-06 15:46:58'),
(16, 'tuanori', 547600, 537700, 'Mua thẻ VIETTEL, số lượng 1 thẻ với giá 9,900đ', 9900, '2024-03-06 15:47:45'),
(17, 'tuanori', 537700, 527800, 'Mua thẻ VIETTEL, số lượng 1 thẻ với giá 9,900đ', 9900, '2024-03-06 15:47:53'),
(18, 'tuanori', 527800, 517900, 'Mua thẻ VIETTEL, số lượng 1 thẻ với giá 9,900đ', 9900, '2024-03-06 15:47:55'),
(19, 'tuanori', 517900, 508000, 'Mua thẻ VIETTEL, số lượng 1 thẻ với giá 9,900đ', 9900, '2024-03-06 15:48:21'),
(20, 'tuanori', 508000, 478300, 'Mua thẻ VIETTEL, số lượng 3 thẻ với giá 29,700đ', 29700, '2024-03-06 15:51:42'),
(21, 'tuanori', 478300, 448600, 'Mua thẻ VIETTEL, số lượng 3 thẻ với giá 29,700đ', 29700, '2024-03-06 15:52:19'),
(22, 'tuanori', 448600, 399100, 'Mua thẻ VIETTEL, số lượng 5 thẻ với giá 49,500đ', 49500, '2024-03-06 15:52:34'),
(23, 'tuanori', 399100, 407036, 'Nhận 7,936đ từ quà nạp lần đầu', 7936, '2024-03-06 16:39:29'),
(24, 'ctvtuanori', 280000, 280000, 'Hoàn tiền do yêu cầu thu hồi lệnh rút tiền mã #2', 0, '2024-03-06 23:49:05'),
(25, 'ctvtuanori', 280000, 280000, 'Hoàn tiền do yêu cầu thu hồi lệnh rút tiền mã #1', 0, '2024-03-06 23:49:52'),
(26, 'ctvtuanori', 280000, 280000, 'Hoàn tiền do yêu cầu thu hồi lệnh rút tiền mã #2', 0, '2024-03-06 23:50:19'),
(27, 'ctvtuanori', 280000, 280000, 'Hoàn tiền do yêu cầu thu hồi lệnh rút tiền mã #1', 0, '2024-03-06 23:51:17'),
(28, 'ctvtuanori', 280000, 280003, 'Hoàn tiền do yêu cầu thu hồi lệnh rút tiền mã #2', 3, '2024-03-06 23:51:38'),
(29, 'ctvtuanori', 0, 3, 'Rút tiền thất bại, hoàn 3đ', 3, '2024-03-07 07:28:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blockip`
--

CREATE TABLE `blockip` (
  `id` int(11) NOT NULL,
  `ip` varchar(250) DEFAULT NULL,
  `amount` bigint(20) DEFAULT 0,
  `note` text DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `anxa` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_banthe`
--

CREATE TABLE `category_banthe` (
  `id` int(11) NOT NULL,
  `nhamang` varchar(250) DEFAULT NULL,
  `menhgia` text NOT NULL DEFAULT '',
  `ck` text NOT NULL DEFAULT '',
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category_banthe`
--

INSERT INTO `category_banthe` (`id`, `nhamang`, `menhgia`, `ck`, `status`) VALUES
(1, 'VIETTEL', '10000\n20000\n30000\n50000\n100000\n200000\n500000\n1000000', '1\n2\n3\n4\n5\n6\n7\n10', 1),
(2, 'VINAPHONE', '10000\n20000\n30000\n50000\n100000\n200000\n500000\n1000000', '1\r\n2\r\n3\r\n4\r\n5\r\n6\r\n7\r\n8', 1),
(3, 'MOBIPHONE', '10000\r\n20000', '1\n2', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_dichvu`
--

CREATE TABLE `category_dichvu` (
  `id` int(11) NOT NULL,
  `stt` int(11) NOT NULL DEFAULT 0,
  `title` varchar(250) DEFAULT NULL,
  `mota` text DEFAULT NULL,
  `img` varchar(250) DEFAULT NULL,
  `num_sell` bigint(20) NOT NULL DEFAULT 0,
  `server` text DEFAULT NULL COMMENT 'các server hỗ trợ',
  `slug` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category_dichvu`
--

INSERT INTO `category_dichvu` (`id`, `stt`, `title`, `mota`, `img`, `num_sell`, `server`, `slug`, `status`) VALUES
(1, 3, 'LÀM NHIỆM VỤ THUÊ NGỌC RỒNG', '<p>VUI LÒNG ĐỂ 1 NGỌC TRONG TÀI KHOẢN TRƯỚC KHI MUA<br></p>', 'https://123nick.vn/upload-usr/images/W7BSg314nb_1629517925.gif', 13, '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\"]', 'lamnhiemvuthuengocrong', 1),
(9, 2, 'ÚP SỨC MẠNH SƯ PHỤ', 'MÔ TẢ DỊCH VỤ', 'https://i.imgur.com/VlTphCZ.gif', 0, '[\"\"]', 'up-suc-manh-su-phu', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_game`
--

CREATE TABLE `category_game` (
  `id` int(11) NOT NULL,
  `stt` int(11) NOT NULL DEFAULT 0,
  `type` varchar(250) DEFAULT NULL COMMENT 'account, random',
  `title` varchar(250) DEFAULT NULL,
  `mota` text DEFAULT 'CHÚC QUÝ KHÁCH MỘT NGÀY MỚI VUI VẺ',
  `img` varchar(250) DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `num_all` bigint(20) DEFAULT 0,
  `num_sell` bigint(20) DEFAULT 0,
  `author` text DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category_game`
--

INSERT INTO `category_game` (`id`, `stt`, `type`, `title`, `mota`, `img`, `slug`, `num_all`, `num_sell`, `author`, `status`) VALUES
(1, 2, 'account', 'SƠ SINH CHỈ SỐ NGON (GIẢM GIÁ 15%)', '<p style=\"margin-left:0; margin-right:0; text-align:center\"><strong><span style=\"background-color:#ffffff; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:22px\"><span style=\"color:#e74c3c\"><strong>NICK9S.COM</strong>\r\n                                </span>\r\n                                </span>\r\n                                <br />\r\n                                <span style=\"background-color:#ffffff; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:22px\"><span style=\"color:#e74c3c\"><strong>Cập Nhật Nhiều Nick Ngon Cực Rẻ</strong></span></span>\r\n                                </strong>\r\n                            </p>\r\n\r\n                            <p style=\"margin-left:0; margin-right:0; text-align:center\"><u><span style=\"color:#e74c3c\"><strong><em><span style=\"background-color:#ffffff\">NẠP QUA ATM / VÍ => TỰ ĐỘNG CỘNG THÊM 15%</span></em></strong></span></u>\r\n                            </p>\r\n\r\n                            <p style=\"margin-left:0; margin-right:0; text-align:center\"><strong><span style=\"color:#e25041\">LƯU Ý : NAP THẺ KHÔNG BỊ TRỪ CHIẾT KHẤU 100K NHẬN ĐƯỢC 100K</span></strong>\r\n                            </p>\r\n\r\n                            <p style=\"margin-left:0; margin-right:0; text-align:center\"><span style=\"color:#e74c3c\"><strong><span style=\"font-family:helvetica,arial,sans-serif; font-size:22px\"><strong><span style=\"background-color:#f1c40f\">( KHI MUA NICK XONG YÊU CẦU KHÁCH ĐỔI LUÔN MẬT KHẨU )</span>\r\n                                </strong>\r\n                                </span>\r\n                                </strong>\r\n                                </span>\r\n                            </p>\r\n\r\n                            <div style=\"text-align:center\"><span style=\"font-family:Arial, Helvetica, sans-serif\"><strong><em><span style=\"background-color:#ffffff\">ĐỂ BẢO VỆ TÀI KHOẢN CỦA MÌNH.</span>\r\n                                </em>\r\n                                </strong>\r\n                                </span>\r\n                            </div>\r\n\r\n                            <div style=\"text-align:center\"><span style=\"font-family:Arial, Helvetica, sans-serif\"><strong><em><span style=\"background-color:#ffffff\">SHOP ĐÃ CÀI CHỨC NĂNG CHECK MẬT KHẨU ĐÚNG SAI</span>\r\n                                </em>\r\n                                </strong>\r\n                                </span>\r\n                            </div>\r\n\r\n                            <div style=\"text-align:center\"><span style=\"font-family:Arial, Helvetica, sans-serif\"><strong><em><span style=\"background-color:#ffffff\">NẾU NHƯ NICK SAI KHÁCH MUA SẼ KHÔNG BỊ TRỪ TIỀN</span>\r\n                                </em>\r\n                                </strong>\r\n                                </span>\r\n                            </div>\r\n\r\n                            <div style=\"text-align:center\"><span style=\"font-family:Arial, Helvetica, sans-serif\"><strong><em><span style=\"background-color:#ffffff\">LƯU Ý : Nếu có lỗi khi mua nick hãy báo với shop ngay lập tức</span>\r\n                                </em>\r\n                                </strong>\r\n                                </span>\r\n                            </div>\r\n\r\n                            <div style=\"text-align:center\"><span style=\"font-family:Arial, Helvetica, sans-serif\"><strong><em><span style=\"background-color:#ffffff\">quá 5p shop sẽ không chịu trách nhiệm về nick của bạn </span>\r\n                                </em>\r\n                                </strong>\r\n                                </span>\r\n                            </div>\r\n\r\n                            <div style=\"text-align:center\"><u><em><span style=\"color:#2ecc71\"><strong>TẤT CẢ NICK TRÊN SHOP ĐỀU LÀ ĐĂNG KÝ ẢO VÀ ĐỔI ĐƯỢC MẬT KHẨU </strong></span></em></u>\r\n                            </div>', 'https://i.imgur.com/DaefDXX.gif', 'sosinhchisongongiamgia15', 2, 2, 'Máy chủ\r\nHành tinh\r\nBông tai\r\nĐăng ký', 1),
(2, 1, 'random', 'NICK RANDOM 29K ( TRÚNG 100% NICK CAO NHẤT 50 TỈ )', '<p style=\"margin-left:0; margin-right:0; text-align:center\"><strong><span style=\"background-color:#ffffff; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:22px\"><span style=\"color:#e74c3c\"><strong>NICK9S.COM</strong>\r\n                                </span>\r\n                                </span>\r\n                                <br>\r\n                                <span style=\"background-color:#ffffff; color:#5c6873; font-family:helvetica,arial,sans-serif; font-size:22px\"><span style=\"color:#e74c3c\"><strong>Cập Nhật Nhiều Nick Ngon Cực Rẻ</strong></span></span>\r\n                                </strong>\r\n                            </p>\r\n\r\n                            <p style=\"margin-left:0; margin-right:0; text-align:center\"><u><span style=\"color:#e74c3c\"><strong><em><span style=\"background-color:#ffffff\">NẠP QUA ATM / VÍ => TỰ ĐỘNG CỘNG THÊM 15%</span></em></strong></span></u>\r\n                            </p>\r\n\r\n                            <p style=\"margin-left:0; margin-right:0; text-align:center\"><strong><span style=\"color:#e25041\">LƯU Ý : NAP THẺ KHÔNG BỊ TRỪ CHIẾT KHẤU 100K NHẬN ĐƯỢC 100K</span></strong>\r\n                            </p>\r\n\r\n                            <p style=\"margin-left:0; margin-right:0; text-align:center\"><span style=\"color:#e74c3c\"><strong><span style=\"font-family:helvetica,arial,sans-serif; font-size:22px\"><strong><span style=\"background-color:#f1c40f\">( KHI MUA NICK XONG YÊU CẦU KHÁCH ĐỔI LUÔN MẬT KHẨU )</span>\r\n                                </strong>\r\n                                </span>\r\n                                </strong>\r\n                                </span>\r\n                            </p>\r\n\r\n                            <div style=\"text-align:center\"><span style=\"font-family:Arial, Helvetica, sans-serif\"><strong><em><span style=\"background-color:#ffffff\">ĐỂ BẢO VỆ TÀI KHOẢN CỦA MÌNH.</span>\r\n                                </em>\r\n                                </strong>\r\n                                </span>\r\n                            </div>\r\n\r\n                            <div style=\"text-align:center\"><span style=\"font-family:Arial, Helvetica, sans-serif\"><strong><em><span style=\"background-color:#ffffff\">SHOP ĐÃ CÀI CHỨC NĂNG CHECK MẬT KHẨU ĐÚNG SAI</span>\r\n                                </em>\r\n                                </strong>\r\n                                </span>\r\n                            </div>\r\n\r\n                            <div style=\"text-align:center\"><span style=\"font-family:Arial, Helvetica, sans-serif\"><strong><em><span style=\"background-color:#ffffff\">NẾU NHƯ NICK SAI KHÁCH MUA SẼ KHÔNG BỊ TRỪ TIỀN</span>\r\n                                </em>\r\n                                </strong>\r\n                                </span>\r\n                            </div>\r\n\r\n                            <div style=\"text-align:center\"><span style=\"font-family:Arial, Helvetica, sans-serif\"><strong><em><span style=\"background-color:#ffffff\">LƯU Ý : Nếu có lỗi khi mua nick hãy báo với shop ngay lập tức</span>\r\n                                </em>\r\n                                </strong>\r\n                                </span>\r\n                            </div>\r\n\r\n                            <div style=\"text-align:center\"><span style=\"font-family:Arial, Helvetica, sans-serif\"><strong><em><span style=\"background-color:#ffffff\">quá 5p shop sẽ không chịu trách nhiệm về nick của bạn</span></em></strong></span></div>\r\n\r\n                            <div style=\"text-align:center\"><u><em><span style=\"color:#2ecc71\"><strong>TẤT CẢ NICK TRÊN SHOP ĐỀU LÀ ĐĂNG KÝ ẢO VÀ ĐỔI ĐƯỢC MẬT KHẨU </strong></span></em></u>\r\n                            </div>', 'https://i.imgur.com/jhiEJYk.gif', 'nickrandom29ktrung100nickcaonhat50ti', 1, 0, 'Máy chủ\r\nHành tinh\r\nBông tai\r\nĐăng ký', 1),
(13, 0, 'account', 'BÁN NICK NGỌC RỒNG GIÁ SIÊU RẺ', 'MÔ TẢ DỊCH VỤ', 'https://i.imgur.com/jhiEJYk.gif', 'ban-nick-ngoc-rong-gia-sieu-re', 0, 0, '', 1),
(14, 0, 'account', 'NICK WIN DOANH TRẠI ( GIÁ TỪ 16K )', 'MÔ TẢ DỊCH VỤ', 'https://i.imgur.com/oP25h3I.gif', 'nick-win-doanh-trai--gia-tu-k-', 0, 0, '', 1),
(15, 0, 'account', 'BÁN NICK LIÊN QUÂN', 'MÔ TẢ DỊCH VỤ', 'https://i.imgur.com/XA0vuBs.jpg', 'ban-nick-lien-quan', 0, 0, '', 1),
(16, 3, 'account', 'BÁN NICK FREE FIRE', 'MÔ TẢ DỊCH VỤ', 'https://i.imgur.com/l4cvjmk.jpg', 'bannickfreefire', 0, 0, '', 1),
(18, 2, 'random', 'NICK RANDOM 19K ( TRÚNG 100% NICK CAO NHẤT 40 TỈ )', 'MÔ TẢ DỊCH VỤ', 'https://i.imgur.com/AH37QVP.gif', 'nick-random-k--trung--nick-cao-nhat--ti-', 0, 0, NULL, 1),
(19, 3, 'random', 'NICK RANDOM 39K ( SĂN CAO NHẤT NICK 70 TỈ )', 'MÔ TẢ DỊCH VỤ', 'https://i.imgur.com/I0xOoKF.gif', 'nick-random-k--san-cao-nhat-nick--ti-', 0, 0, NULL, 1),
(20, 4, 'random', 'NICK RANDOM 5K ( VÀNG , NICK , NGỌC , THẺ )', 'MÔ TẢ DỊCH VỤ', 'https://i.imgur.com/sKgigBx.gif', 'nick-random-k--vang--nick--ngoc--the-', 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `code` varchar(250) DEFAULT NULL,
  `money_toithieu` bigint(20) DEFAULT 0,
  `giam` int(11) DEFAULT 0,
  `luotdung` bigint(20) NOT NULL DEFAULT 0,
  `conlai` int(11) DEFAULT 1,
  `apply` text NOT NULL DEFAULT 'account' COMMENT 'Áp dụng cho dịch vụ nào',
  `type` int(11) NOT NULL DEFAULT 1 COMMENT '1: 1 người xài nhiều lần, 0: 1 người xài 1 lần',
  `thoigian` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `money_toithieu`, `giam`, `luotdung`, `conlai`, `apply`, `type`, `thoigian`) VALUES
(1, 'N4APX5XH', 1000, 88, 2000, 87, 'account', 0, '2024-03-03 11:10:32'),
(2, 'WYAUWJNM', 100, 50, 200, 194, 'ngoc', 0, '2024-03-03 11:10:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ctv_ruttien`
--

CREATE TABLE `ctv_ruttien` (
  `id` int(11) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `bank` varchar(250) DEFAULT NULL,
  `stk` varchar(250) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `sotien` bigint(20) NOT NULL DEFAULT 0,
  `thoigian` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0: chờ xử lý, 1: xong, 2: hủy'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ctv_ruttien`
--

INSERT INTO `ctv_ruttien` (`id`, `username`, `bank`, `stk`, `name`, `sotien`, `thoigian`, `status`) VALUES
(1, 'ctvtuanori', 'MOMO', '1', '2', 3, '2024-03-06 23:32:57', 2),
(2, 'ctvtuanori', 'MOMO', '1', '2', 3, '2024-03-06 23:33:18', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `history_dichvu`
--

CREATE TABLE `history_dichvu` (
  `id` int(11) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `category_dichvu` int(11) DEFAULT NULL,
  `dichvu` int(11) DEFAULT NULL,
  `server` int(11) DEFAULT NULL,
  `tongtien` bigint(20) DEFAULT 0,
  `tk` varchar(250) DEFAULT NULL COMMENT '(tên nv)',
  `mk` varchar(250) DEFAULT NULL,
  `noteadmin` text DEFAULT NULL,
  `iteam` bigint(70) DEFAULT 0,
  `coupon` text DEFAULT NULL,
  `ctv` varchar(250) DEFAULT '',
  `ctv_tongtien` bigint(20) DEFAULT 0,
  `timectv` datetime DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `upthoigian` datetime DEFAULT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `history_dichvu`
--

INSERT INTO `history_dichvu` (`id`, `username`, `category_dichvu`, `dichvu`, `server`, `tongtien`, `tk`, `mk`, `noteadmin`, `iteam`, `coupon`, `ctv`, `ctv_tongtien`, `timectv`, `thoigian`, `upthoigian`, `status`) VALUES
(8, 'tuanori', 1, 3, 1, 100000, '123', '123', '', 0, 'WYAUWJNM', 'ctvtuanori', 20000, '2024-03-05 23:07:59', '2024-03-03 15:03:55', '2024-03-05 14:16:28', 0),
(9, 'tuanori', -2, -2, 1, 250000, '21312', '3123123', NULL, 6000, 'WYAUWJNM', ' ', 200000, NULL, '2024-03-04 13:22:35', '2024-01-05 14:16:30', 0),
(10, 'tuanori', -1, -1, 1, 200000, '123123', NULL, NULL, 1600000000, '', '', 0, NULL, '2024-03-05 14:49:45', NULL, 0),
(11, 'tuanori', -1, -1, 1, 200000, '12', NULL, NULL, 1600000000, '', '', 0, NULL, '2024-03-05 14:50:42', NULL, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `history_rutngoc`
--

CREATE TABLE `history_rutngoc` (
  `id` int(11) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `tk` varchar(250) DEFAULT NULL,
  `mk` varchar(250) DEFAULT NULL,
  `server` int(11) DEFAULT NULL,
  `ngoc` bigint(20) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0: xử lý, 1: ok, 2; error',
  `thoigian` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `history_rutngoc`
--

INSERT INTO `history_rutngoc` (`id`, `username`, `tk`, `mk`, `server`, `ngoc`, `note`, `status`, `thoigian`) VALUES
(1, 'tuanori', '20000', '20000', 1, 10000, '12', 0, '2024-03-06 22:59:02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `history_rutvang`
--

CREATE TABLE `history_rutvang` (
  `id` int(11) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `tennv` varchar(250) DEFAULT NULL,
  `server` int(11) DEFAULT NULL,
  `vang` bigint(20) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0: xử lý, 1: ok, 2; error',
  `thoigian` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `history_rutvang`
--

INSERT INTO `history_rutvang` (`id`, `username`, `tennv`, `server`, `vang`, `note`, `status`, `thoigian`) VALUES
(1, 'tuanori', '6457567', 2, 57, '5', 0, '2024-03-06 15:29:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `history_vongquay`
--

CREATE TABLE `history_vongquay` (
  `id` int(11) NOT NULL,
  `vongquay` int(11) DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `sotien` bigint(20) DEFAULT 0,
  `iteam` bigint(20) DEFAULT 0,
  `note` text DEFAULT NULL,
  `hinhthuc` varchar(100) NOT NULL DEFAULT 'vang' COMMENT 'vang,tien,ngoc',
  `thoigian` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `history_vongquay`
--

INSERT INTO `history_vongquay` (`id`, `vongquay`, `username`, `sotien`, `iteam`, `note`, `hinhthuc`, `thoigian`) VALUES
(1, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:09:52'),
(2, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:09:59'),
(3, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:12:09'),
(4, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:15:29'),
(5, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:15:44'),
(6, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:15:45'),
(7, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:15:46'),
(8, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:15:46'),
(9, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:15:47'),
(10, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:15:47'),
(11, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:15:47'),
(12, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:15:48'),
(13, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:15:48'),
(14, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:15:49'),
(15, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:15:49'),
(16, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:15:49'),
(17, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:11'),
(18, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:13'),
(19, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:13'),
(20, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:13'),
(21, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:14'),
(22, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:14'),
(23, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:15'),
(24, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:15'),
(25, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:16'),
(26, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:16'),
(27, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:16'),
(28, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:17'),
(29, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:17'),
(30, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:18'),
(31, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:18'),
(32, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:19'),
(33, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:19'),
(34, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:20'),
(35, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:20'),
(36, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:21'),
(37, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:21'),
(38, 1, 'tuanori', 50000, 10000, 'Chúc mừng bạn nhận được 10.000 ngọc xanh', 'ngoc', '2024-03-03 15:16:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `listbank`
--

CREATE TABLE `listbank` (
  `id` int(11) NOT NULL,
  `bank` varchar(250) DEFAULT NULL,
  `stk` varchar(250) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `listbank`
--

INSERT INTO `listbank` (`id`, `bank`, `stk`, `name`, `status`) VALUES
(1, 'MBBANK1', '2598765432102', 'Phạm Hoàng Tuấn3', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_acc_game`
--

CREATE TABLE `list_acc_game` (
  `id` int(11) NOT NULL,
  `category_game` int(11) DEFAULT NULL,
  `type` varchar(250) NOT NULL DEFAULT 'account' COMMENT 'account, random',
  `tk` varchar(250) DEFAULT NULL,
  `mk` varchar(250) DEFAULT NULL,
  `card` bigint(20) DEFAULT 0,
  `atm` bigint(20) DEFAULT 0,
  `giacu` bigint(20) DEFAULT 0,
  `author` text DEFAULT NULL,
  `noibat` text DEFAULT NULL,
  `giamgia` bigint(20) DEFAULT 0,
  `img` text DEFAULT NULL,
  `listimg` text DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `ctv` varchar(250) NOT NULL DEFAULT '',
  `ctv_tongtien` bigint(20) DEFAULT 0,
  `thanhtoan` bigint(20) DEFAULT NULL,
  `mgg` varchar(250) DEFAULT NULL,
  `timeup` datetime DEFAULT NULL,
  `timemua` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `list_acc_game`
--

INSERT INTO `list_acc_game` (`id`, `category_game`, `type`, `tk`, `mk`, `card`, `atm`, `giacu`, `author`, `noibat`, `giamgia`, `img`, `listimg`, `username`, `ctv`, `ctv_tongtien`, `thanhtoan`, `mgg`, `timeup`, `timemua`) VALUES
(8, 2, 'random', '123', '345', 123, 0, 123, NULL, 'MÔ TẢ TÀI KHOẢN BÁN', 0, '123', '123', NULL, 'ctvtuanori', 2000, NULL, NULL, '2024-03-05 15:21:49', '2024-03-05 13:22:35'),
(10, 2, 'random', '123', '345', 123, 0, 123, NULL, 'MÔ TẢ TÀI KHOẢN BÁN', 0, '123', '123', NULL, 'ctvtuanori', 2000, NULL, NULL, '2024-03-05 15:21:49', '2024-03-05 13:22:35'),
(12, 1, 'account', '1', '2', 500000, 0, 568182, 'Ảo', 'MÔ TẢ TÀI KHOẢN BÁN', 12, 'https://i.imgur.com/DaefDXX.gif', 'https://i.imgur.com/DaefDXX.gif', 'ctvtuanori', 'ctvtuanori', 2000, 500000, '', '2024-03-05 23:15:45', '2024-03-05 23:15:54'),
(13, 1, 'account', '1', '2', 2, 0, 2, '1 Sao\nTrái Đất\nCó\nẢo', 'MÔ TẢ TÀI KHOẢN BÁN', 12, 'https://i.imgur.com/DaefDXX.gif', 'https://i.imgur.com/DaefDXX.gif', 'ctvtuanori', 'ctvtuanori', 2000, 2, NULL, '2024-03-05 15:53:49', '2024-03-05 15:53:49'),
(16, 1, 'account', '123123', '213123', 500000, 0, 1000000, '1 Sao\nTrái Đất\nCó\nẢo', 'MÔ TẢ TÀI KHOẢN BÁN', 50, '123', '123', 'tuanori', 'tuanori', 0, 500000, '', '2024-03-06 12:54:02', '2024-03-06 12:56:02'),
(17, 1, 'account', '567567', '1123123', 12222, 0, 12222, '1 Sao\nTrái Đất\nCó\nẢo', 'ĐÂY NÈ HIHI', 0, '65756', '7567567', 'ctvtuanori', 'ctvtuanori', 0, 12222, NULL, '2024-03-05 16:00:37', '2024-03-05 16:00:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `list_khothe`
--

CREATE TABLE `list_khothe` (
  `id` int(11) NOT NULL,
  `loaithe` varchar(250) DEFAULT NULL,
  `menhgia` bigint(20) DEFAULT NULL,
  `thongtin` text DEFAULT NULL,
  `username` varchar(250) DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `thucnhan` bigint(20) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `list_khothe`
--

INSERT INTO `list_khothe` (`id`, `loaithe`, `menhgia`, `thongtin`, `username`, `thoigian`, `thucnhan`, `status`) VALUES
(1, 'VIETTEL', 10000, 'TUANNE|12334', 'tuanori', '2024-03-06 15:52:19', 9900, 1),
(4, 'VIETTEL', 10000, 'TUANNE|12334', 'tuanori', '2024-03-06 15:52:19', 9900, 1),
(5, 'VIETTEL', 10000, 'TUANNE|12334', 'tuanori', '2024-03-06 15:52:19', 9900, 1),
(6, 'VIETTEL', 10000, 'TUANNE|12334', 'tuanori', '2024-03-06 15:52:34', 9900, 1),
(7, 'VIETTEL', 10000, 'TUANNE|12334', 'tuanori', '2024-03-06 15:52:34', 9900, 1),
(8, 'VIETTEL', 10000, 'TUANNE|12334', 'tuanori', '2024-03-06 15:52:34', 9900, 1),
(9, 'VIETTEL', 10000, 'TUANNE|12334', 'tuanori', '2024-03-06 15:52:34', 9900, 1),
(10, 'VIETTEL', 10000, 'TUANNE|12334', 'tuanori', '2024-03-06 15:52:34', 9900, 1),
(11, 'MOBIPHONE', 10000, '23123|213123', NULL, NULL, NULL, 1),
(13, 'MOBIPHONE', 20000, '3|3\r', NULL, NULL, NULL, 1),
(14, 'MOBIPHONE', 20000, '123445|1234354', '123', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mini_game`
--

CREATE TABLE `mini_game` (
  `id` int(11) NOT NULL,
  `stt` int(11) NOT NULL DEFAULT 0,
  `title` varchar(250) DEFAULT NULL,
  `sotien` bigint(20) DEFAULT 0,
  `note` text DEFAULT NULL,
  `num_sell` bigint(20) DEFAULT 0,
  `img` varchar(250) DEFAULT NULL,
  `img_anh` varchar(250) DEFAULT '0',
  `slug` text DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mini_game`
--

INSERT INTO `mini_game` (`id`, `stt`, `title`, `sotien`, `note`, `num_sell`, `img`, `img_anh`, `slug`, `status`) VALUES
(1, 2, 'TÌM KIẾM HŨ NGỌC 50K ( TRÚNG 100% )', 50000, 'TUẤN NÈ ANH EM', 63, 'https://i.imgur.com/OlBLCMv.gif', 'https://i.imgur.com/RO3kpK2.png', 'tim-kiem-hu-ngoc-k--trung--', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mini_game_gift`
--

CREATE TABLE `mini_game_gift` (
  `id` int(255) NOT NULL,
  `id_vongquay` int(255) NOT NULL,
  `o_1` varchar(999) NOT NULL,
  `o_2` varchar(999) NOT NULL,
  `o_3` varchar(999) NOT NULL,
  `o_4` varchar(999) NOT NULL,
  `o_5` varchar(999) NOT NULL,
  `o_6` varchar(999) NOT NULL,
  `o_7` varchar(999) NOT NULL,
  `o_8` varchar(999) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `mini_game_gift`
--

INSERT INTO `mini_game_gift` (`id`, `id_vongquay`, `o_1`, `o_2`, `o_3`, `o_4`, `o_5`, `o_6`, `o_7`, `o_8`) VALUES
(1, 1, '{\"text\":\"Ch\\u00fac m\\u1eebng b\\u1ea1n nh\\u1eadn \\u0111\\u01b0\\u1ee3c 1.000 ng\\u1ecdc xanh\",\"iteam\":\"1000\",\"tyle\":\"0\",\"hinhthuc\":\"ngoc\"}', '{\"text\":\"Ch\\u00fac m\\u1eebng b\\u1ea1n nh\\u1eadn \\u0111\\u01b0\\u1ee3c 5.000 ng\\u1ecdc xanh\",\"iteam\":\"5000\",\"tyle\":\"0\",\"hinhthuc\":\"ngoc\"}', '{\"text\":\"Ch\\u00fac m\\u1eebng b\\u1ea1n nh\\u1eadn \\u0111\\u01b0\\u1ee3c 10.000 ng\\u1ecdc xanh\",\"iteam\":\"10000\",\"tyle\":\"100\",\"hinhthuc\":\"ngoc\"}', '{\"text\":\"Nh\\u1eadn \\u0111\\u01b0\\u1ee3c 1 nick may m\\u1eafn\",\"iteam\":\"0\",\"tyle\":\"0\",\"hinhthuc\":\"ngoc\"}', '{\"text\":\"Ch\\u00fac m\\u1eebng b\\u1ea1n nh\\u1eadn \\u0111\\u01b0\\u1ee3c 200K ti\\u1ec1n shop\",\"iteam\":\"200000\",\"tyle\":\"0\",\"hinhthuc\":\"tien\"}', '{\"text\":\"Ch\\u00fac m\\u1eebng b\\u1ea1n nh\\u1eadn \\u0111\\u01b0\\u1ee3c 100K v\\u00e0ng\",\"iteam\":\"100000\",\"tyle\":\"0\",\"hinhthuc\":\"vang\"}', '{\"text\":\"Ch\\u00fac m\\u1eebng b\\u1ea1n nh\\u1eadn \\u0111\\u01b0\\u1ee3c 500K v\\u00e0ng\",\"iteam\":\"500000\",\"tyle\":\"0\",\"hinhthuc\":\"vang\"}', '{\"text\":\"Ch\\u00fac m\\u1eebng b\\u1ea1n nh\\u1eadn \\u0111\\u01b0\\u1ee3c 2.000 ng\\u1ecdc xanh\",\"iteam\":\"2000\",\"tyle\":\"0\",\"hinhthuc\":\"ngoc\"}');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `napatm`
--

CREATE TABLE `napatm` (
  `id` int(11) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `hinhthuc` varchar(250) DEFAULT NULL,
  `magd` varchar(250) DEFAULT NULL,
  `sotien` varchar(250) DEFAULT NULL,
  `ndnaptien` varchar(250) DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `napatm`
--

INSERT INTO `napatm` (`id`, `username`, `hinhthuc`, `magd`, `sotien`, `ndnaptien`, `thoigian`) VALUES
(1, '123', '123', '21323', '200', '23', '2024-03-04 13:05:38'),
(3, 'tuanori', 'MOMO', '54313093495', '500000.45', 'NAP5', '2024-03-06 12:55:19'),
(4, 'tuanori', 'MBBANK', 'FT24066802365250', '57500', 'CUSTOMER NAP5 FT24066194176960 - Ma giao  dich/ Trace280395 Trace 280395', '2024-03-06 13:35:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `napcard`
--

CREATE TABLE `napcard` (
  `id` int(11) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `loaithe` varchar(250) DEFAULT NULL,
  `menhgia` varchar(250) DEFAULT NULL,
  `pin` varchar(250) DEFAULT NULL,
  `seri` varchar(250) DEFAULT NULL,
  `thucnhan` varchar(250) NOT NULL,
  `requestid` varchar(250) DEFAULT NULL,
  `status` int(3) DEFAULT 0 COMMENT '0: xuly, 1: thanhcong, 2: sai',
  `thoigian` datetime DEFAULT NULL,
  `uptime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhapnick_game`
--

CREATE TABLE `nhapnick_game` (
  `id` int(11) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `game` varchar(250) NOT NULL DEFAULT 'ngocrong',
  `tk` varchar(250) DEFAULT NULL,
  `mk` varchar(250) DEFAULT NULL,
  `sotien` bigint(20) DEFAULT 0,
  `thucnhan` bigint(20) NOT NULL DEFAULT 0,
  `server` int(250) DEFAULT 1,
  `note` text DEFAULT NULL,
  `noteadmin` text DEFAULT NULL,
  `thoigian` datetime DEFAULT NULL,
  `hinhthuc` varchar(25) DEFAULT 'khac' COMMENT 'tien, vang, ngoc, khac',
  `status` int(11) DEFAULT 0 COMMENT '0 xử lý, 1 : thành công, 2: thất bại'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `nhapnick_game`
--

INSERT INTO `nhapnick_game` (`id`, `username`, `game`, `tk`, `mk`, `sotien`, `thucnhan`, `server`, `note`, `noteadmin`, `thoigian`, `hinhthuc`, `status`) VALUES
(1, 'tuanori', 'ngocrong', 'tuanori', 'tuanori', 50000, 20000000000000, 1, 'xin chào admin', 'XIN CHÀO ANH EM', '2024-02-21 12:43:25', 'ngoc', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `key` text DEFAULT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `options`
--

INSERT INTO `options` (`id`, `key`, `value`) VALUES
(1, 'title', 'TUANORI.COM- Chuyên thiết kế website Bán Acc Game, chuẩn SEO, chuyên nghiệp, tích hợp công nghệ CHỐNG CLICK TẶC ADWORD ✅. Đội ngũ hỗ trợ nhiệt tình nhất'),
(2, 'mota', 'NICK9S.COM - Hệ Thống Bán Acc Game Uy Tín Số 1 Việt Nam'),
(3, 'tukhoa', 'hack pubg mobile | hack pubg android | hack tốc chiến | tool pubg | tool pubg mobile | hack pubg ios | undetected pc hacks | aimbot esp radar cheats | hack pubg mobile | hack pubg mb | hack pubg | tool pubg | thue hackpubg | thue tool pubg | pubg mobile | pubg mobile giả lập | hack ring of eysium | ring of eysium esp | thuê hack roe'),
(4, 'logo', 'https://i.imgur.com/kh4pKIT.gif'),
(5, 'email', '3'),
(6, 'pass_email', '4'),
(7, 'noidung_naptien', 'NAP'),
(8, 'thongbao', '<p>\r\n    <p style=\"margin-left:0; margin-right:0; text-align:center\"><strong><span style=\"color:#e25041\">TOP NẠP THẺ THÁNG 7</span></strong>\r\n    </p>\r\n\r\n    <p style=\"margin-left:0; margin-right:0; text-align:center\"><strong><span style=\"color:#61bd6d\">TOP 1: NHẬN NICK 1TR VNĐ + 3K NGỌC</span></strong>\r\n    </p>\r\n\r\n    <p style=\"margin-left:0; margin-right:0; text-align:center\"><span style=\"color:#61bd6d\"><strong>TOP 2: NHẬN NICK 800K + 1K NGỌC</strong></span>\r\n    </p>\r\n\r\n    <p style=\"margin-left:0; margin-right:0; text-align:center\"><strong><span style=\"color:#61bd6d\">TOP 3: NHẬN NICK 500K + 500TR VÀNG</span></strong>\r\n    </p>\r\n\r\n    <p style=\"margin-left:0; margin-right:0; text-align:center\"><strong><span style=\"color:#61bd6d\"> ĐÃ TRAO GIẢI THƯỞNG TOP THÁNG 7</span></strong>\r\n    </p>\r\n\r\n    <p style=\"margin-left:0; margin-right:0; text-align:center\"><strong><span style=\"color:#61bd6d\">VÀO00h30 </span></strong><strong><span style=\"color:#61bd6d\">NGÀY 1/8/2022</span></strong>\r\n    </p>\r\n</p>'),
(9, 'anhbia', 'https://i.imgur.com/74qInK4.jpg'),
(10, 'banner1', 'https://i.imgur.com/qawacxd.jpeg'),
(11, 'banner2', 'https://i.imgur.com/gSZLZAB.png'),
(12, 'fbadmin', 'https://facebook.com/phamhoangtuan.ytb'),
(13, 'ytbadmin', 'https://www.youtube.com/@TuanOriITv2'),
(14, 'partner_id', '12'),
(15, 'partner_key', '2123'),
(16, 'ckcard', '30'),
(17, 'token_momo', '    34'),
(18, 'token_bank', '  2'),
(19, 'stk_bank', '  3'),
(21, 'mk_bank', '  4'),
(22, 'loaibank', 'MBBANK'),
(23, 'favicon', 'https://i.imgur.com/5CjMnTV.png'),
(24, 'stk_bank', '  3'),
(25, 'mk_bank', '  4'),
(26, 'status_napmomo', 'ON'),
(27, 'status_napbank', 'ON'),
(28, 'status_card', '1'),
(29, 'javascript', ''),
(30, 'phone', '0812665001'),
(31, 'status_tele', '0'),
(32, 'id_tele', '1'),
(33, 'key_tele', '2'),
(35, 'phanthuong_top', '<p style=\"margin-right: 0px; margin-bottom: 10px; margin-left: 0px; text-align: center;\"><font color=\"#61bd6d\"><b>Đã trao thưởng vào lúc ...</b></font></p>'),
(36, 'status_banvang', '1'),
(37, 'title_banvang', 'Bán vàng giá rẻ x10'),
(38, 'img_banvang', 'https://i.imgur.com/jERo8WY.gif'),
(39, 'mota_banvang', NULL),
(40, 'server_banvang', '{\"maychu\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\"],\"vitri\":[\"Làng KKR K12\",\"Làng KKR K12\",\"Làng KKR K12\",\"Làng KKR K12\",\"Làng KKR K12\",\"Làng KKR K12\",\"Làng KKR K12\",\"Làng KKR K12\",\"Làng KKR K12\"],\"tennv\":[\"phamhoangtuan1\",\"phamhoangtuan2\",\"phamhoangtuan2\",\"phamhoangtuan1\",\"phamhoangtuan2\",\"phamhoangtuan2\",\"phamhoangtuan1\",\"phamhoangtuan2\",\"phamhoangtuan2\"],\"status\":[\"1\",\"1\",\"1\",\"0\",\"1\",\"1\",\"1\",\"1\",\"1\"],\"heso\":[\"8000\",\"20000\",\"20000\",\"8000\",\"20000\",\"20000\",\"8000\",\"20000\",\"2000\"]}'),
(41, 'max_banvang', '1000000000000'),
(42, 'min_banvang', '200'),
(44, 'title_banngoc', 'BÁN NGỌC TỰ ĐỘNG X10'),
(45, 'img_banngoc', 'https://i.imgur.com/JbSqsex.gif'),
(46, 'mota_banngoc', NULL),
(47, 'server_banngoc', '{\"maychu\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"],\"status\":[\"1\",\"1\",\"1\",\"1\",\"1\",\"0\"],\"heso\":[\"12\",\"12\",\"12\",\"12\",\"12\",\"12\"]}'),
(48, 'max_banngoc', '100000000'),
(49, 'min_banngoc', '500000'),
(51, 'status_banngoc', '1'),
(52, 'ckatm', '15'),
(53, 'web_api', 'https://gachthe1s.com'),
(54, 'num_sell_banvang', '4'),
(55, 'num_sell_banngoc', '8'),
(56, 'id_zalo', ''),
(57, 'key_zalo', ''),
(58, 'status_zalo', '0'),
(59, 'ctv_dichvu', '10'),
(60, 'id_google', ''),
(61, 'key_google', ''),
(62, 'status_google', '0'),
(63, 'topnap', '500000\n200000\n100000'),
(64, 'type_topnap', '1'),
(65, 'time_topnap', '01/5/2022'),
(66, 'ctv_banacc', '10'),
(67, 'note_topnap', '500.00K VÀO TÀI KHOẢN SHOP\n200.00K VÀO TÀI KHOẢN SHOP\n100.00K VÀO TÀI KHOẢN SHOP'),
(68, 'time_momo', '1709704534'),
(69, 'status_bank', '1'),
(70, 'status_momo', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `select_category`
--

CREATE TABLE `select_category` (
  `id` int(11) NOT NULL,
  `category_game` int(11) DEFAULT NULL,
  `author` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `select_category`
--

INSERT INTO `select_category` (`id`, `category_game`, `author`) VALUES
(1, 1, '{\"nameselect\":[\"Máy chủ\",\"Hành Tinh\",\"Bông Tai\",\"Đăng ký\"],\"maychu\":[\"1 Sao\",\"2 Sao\",\"3 Sao\",\"4 Sao\",\"5 Sao\",\"6 Sao\",\"7 Sao\",\"8 Sao\",\"9 Sao\",\"10 Sao\"],\"hanhtinh\":[\"Trái Đất\",\"XayDa\",\"Namếc\"],\"bongtai\":[\"Có\",\"Không\"],\"dangky\":[\"Ảo\",\"Gmail xóa vĩnh viễn\",\"Gmail trắng thông tin\",\"Gmail full thông tin\"]}');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `passwordc2` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `fullname` varchar(250) DEFAULT NULL,
  `money` bigint(20) DEFAULT 0,
  `total_money` bigint(20) DEFAULT 0,
  `total_topnapthe` bigint(20) DEFAULT 0,
  `level` varchar(20) DEFAULT NULL,
  `tokenlog` varchar(250) DEFAULT NULL,
  `timereg` datetime DEFAULT NULL,
  `timeon` datetime DEFAULT NULL,
  `online` varchar(250) DEFAULT 'OFFLINE',
  `banned` varchar(250) DEFAULT 'ON',
  `ip` varchar(250) DEFAULT NULL,
  `token_resetpas` varchar(250) DEFAULT NULL,
  `reason_banned` text DEFAULT NULL,
  `bonus` int(11) NOT NULL DEFAULT 0 COMMENT '1: đã nhận, 0: chưa nhận',
  `iteam` bigint(20) DEFAULT 0,
  `iteam_ngoc` bigint(20) DEFAULT 0,
  `saimkad` int(11) DEFAULT 6
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `passwordc2`, `email`, `fullname`, `money`, `total_money`, `total_topnapthe`, `level`, `tokenlog`, `timereg`, `timeon`, `online`, `banned`, `ip`, `token_resetpas`, `reason_banned`, `bonus`, `iteam`, `iteam_ngoc`, `saimkad`) VALUES
(1, 'tuanori', '8be9afa4ac293015623c5711cccbf30f', '8be9afa4ac293015623c5711cccbf30f', 'tuanori@gmail.com', 'Phạm Hoàng Tuấn', 407036, 626500, 626500, 'admin', '7e78e241388135bacf8fec42cf5c19a07049ba1d427c9b1c7c', '2024-02-29 21:49:49', '2024-03-07 10:25:55', 'ONLINE', 'ON', '::1', NULL, NULL, 1, 57, 30000, 6);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `banggia_dichvu`
--
ALTER TABLE `banggia_dichvu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `biendongsodu`
--
ALTER TABLE `biendongsodu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `blockip`
--
ALTER TABLE `blockip`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_banthe`
--
ALTER TABLE `category_banthe`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_dichvu`
--
ALTER TABLE `category_dichvu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_game`
--
ALTER TABLE `category_game`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ctv_ruttien`
--
ALTER TABLE `ctv_ruttien`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `history_dichvu`
--
ALTER TABLE `history_dichvu`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `history_rutngoc`
--
ALTER TABLE `history_rutngoc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `history_rutvang`
--
ALTER TABLE `history_rutvang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `history_vongquay`
--
ALTER TABLE `history_vongquay`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `listbank`
--
ALTER TABLE `listbank`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `list_acc_game`
--
ALTER TABLE `list_acc_game`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `list_khothe`
--
ALTER TABLE `list_khothe`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `mini_game`
--
ALTER TABLE `mini_game`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `mini_game_gift`
--
ALTER TABLE `mini_game_gift`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `napatm`
--
ALTER TABLE `napatm`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `napcard`
--
ALTER TABLE `napcard`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `nhapnick_game`
--
ALTER TABLE `nhapnick_game`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `select_category`
--
ALTER TABLE `select_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `banggia_dichvu`
--
ALTER TABLE `banggia_dichvu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `biendongsodu`
--
ALTER TABLE `biendongsodu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `blockip`
--
ALTER TABLE `blockip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `category_banthe`
--
ALTER TABLE `category_banthe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `category_dichvu`
--
ALTER TABLE `category_dichvu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `category_game`
--
ALTER TABLE `category_game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `ctv_ruttien`
--
ALTER TABLE `ctv_ruttien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `history_dichvu`
--
ALTER TABLE `history_dichvu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `history_rutngoc`
--
ALTER TABLE `history_rutngoc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `history_rutvang`
--
ALTER TABLE `history_rutvang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `history_vongquay`
--
ALTER TABLE `history_vongquay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT cho bảng `listbank`
--
ALTER TABLE `listbank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `list_acc_game`
--
ALTER TABLE `list_acc_game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `list_khothe`
--
ALTER TABLE `list_khothe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `mini_game`
--
ALTER TABLE `mini_game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `mini_game_gift`
--
ALTER TABLE `mini_game_gift`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `napatm`
--
ALTER TABLE `napatm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `napcard`
--
ALTER TABLE `napcard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `nhapnick_game`
--
ALTER TABLE `nhapnick_game`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT cho bảng `select_category`
--
ALTER TABLE `select_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
