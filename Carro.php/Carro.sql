CREATE TABLE `Carro` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `modelo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ano` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `cor` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `placa` varchar(7) COLLATE utf8_unicode_ci NOT NULL
)


