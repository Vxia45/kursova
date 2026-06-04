-- Database initialization for kursova
CREATE TABLE IF NOT EXISTS `discussions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(255) NOT NULL,
  `content` TEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Insert initial sample discussion
INSERT INTO `discussions` (`id`, `title`, `content`) VALUES
(1, 'Добре дошли във форума!', 'Това е автоматично създадена първа тема за вашата курсова работа.')
ON DUPLICATE KEY UPDATE id=id;
