CREATE DATABASE IF NOT EXISTS elonmusk_postutme_db;
USE elonmusk_postutme_db;

CREATE TABLE IF NOT EXISTS applicants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    jamb_reg_number VARCHAR(50) NOT NULL UNIQUE,
    phone VARCHAR(30) NOT NULL,
    programme VARCHAR(150) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    status ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO admins (full_name, email, password_hash) VALUES
('Admin User', 'admin@elonmuskuniversity.edu', '$2y$10$2fMfiQd21sy0l0CQJ6vU6uNN4N5y0jAJ25T0lFN9wE1b7b0I0Qm7C');

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phoneNumber VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL,
    registrationNumber VARCHAR(50) NOT NULL UNIQUE,
    dateOfBirth DATE NULL,
    gender VARCHAR(30) NULL,
    jamb_score INT NULL,
    waec_score INT NULL,
    neco_score INT NULL,
    utme_score INT NULL,
    o_level_results TEXT NULL,
    programme VARCHAR(150) NULL,
    registrationDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    registrationStatus ENUM('pending', 'completed', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
    paymentStatus ENUM('pending', 'completed', 'failed') NOT NULL DEFAULT 'pending',
    paymentAmount DECIMAL(10, 2) NULL,
    examStatus ENUM('not_taken', 'completed', 'pending') NOT NULL DEFAULT 'not_taken',
    examScore INT NULL,
    admissionStatus ENUM('pending', 'admitted', 'rejected', 'waitlisted') NOT NULL DEFAULT 'pending',
    state VARCHAR(100) NULL,
    lga VARCHAR(100) NULL,
    address TEXT NULL,
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS exams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    subject VARCHAR(100) NULL,
    duration INT NOT NULL DEFAULT 120,
    totalQuestions INT NOT NULL DEFAULT 0,
    passingScore INT NOT NULL DEFAULT 0,
    totalMarks INT NOT NULL DEFAULT 0,
    examDate DATETIME NULL,
    startTime TIME NULL,
    endTime TIME NULL,
    venue VARCHAR(255) NULL,
    status ENUM('scheduled', 'ongoing', 'completed', 'cancelled') NOT NULL DEFAULT 'scheduled',
    instructions TEXT NULL,
    maxAttempts INT NOT NULL DEFAULT 1,
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    studentId INT NOT NULL,
    examId INT NOT NULL,
    score DECIMAL(10, 2) NOT NULL DEFAULT 0,
    totalMarks INT NOT NULL DEFAULT 0,
    percentage DECIMAL(5, 2) NOT NULL DEFAULT 0,
    grade VARCHAR(5) NULL,
    status VARCHAR(30) NOT NULL DEFAULT 'published',
    completedAt DATETIME NULL,
    FOREIGN KEY (studentId) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (examId) REFERENCES exams(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    studentId INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    paymentReference VARCHAR(100) NOT NULL UNIQUE,
    status VARCHAR(30) NOT NULL DEFAULT 'pending',
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (studentId) REFERENCES students(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
