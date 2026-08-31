-- Post-UTME Examination Portal Database
-- This SQL file creates all necessary tables for the Post-UTME Portal

-- Create database
CREATE DATABASE IF NOT EXISTS postutme_db;
USE postutme_db;

-- Students table
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(100) NOT NULL,
    lastName VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phoneNumber VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    dateOfBirth DATE,
    gender ENUM('Male', 'Female', 'Other'),
    jamb_score INT,
    waec_score INT,
    neco_score INT,
    utme_score INT,
    o_level_results TEXT,
    programme VARCHAR(100),
    registrationNumber VARCHAR(50) UNIQUE NOT NULL,
    registrationDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    registrationStatus ENUM('pending', 'approved', 'rejected', 'completed') DEFAULT 'pending',
    paymentStatus ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    paymentAmount DECIMAL(10, 2),
    examStatus ENUM('not_taken', 'completed', 'pending') DEFAULT 'not_taken',
    examScore INT,
    admissionStatus ENUM('pending', 'admitted', 'rejected', 'waitlisted') DEFAULT 'pending',
    state VARCHAR(50),
    lga VARCHAR(50),
    address TEXT,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_status (registrationStatus)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Exams table
CREATE TABLE exams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    subject VARCHAR(100),
    duration INT DEFAULT 60 COMMENT 'Duration in minutes',
    totalQuestions INT NOT NULL,
    passingScore INT NOT NULL,
    totalMarks INT NOT NULL,
    examDate DATETIME NOT NULL,
    startTime VARCHAR(10),
    endTime VARCHAR(10),
    venue VARCHAR(255),
    status ENUM('scheduled', 'ongoing', 'completed', 'cancelled') DEFAULT 'scheduled',
    instructions TEXT,
    requirements TEXT,
    maxAttempts INT DEFAULT 1,
    syllabus TEXT,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_date (examDate)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Results table
CREATE TABLE results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    studentId INT NOT NULL,
    examId INT NOT NULL,
    score INT NOT NULL,
    totalMarks INT NOT NULL,
    percentage DECIMAL(5, 2),
    grade VARCHAR(5),
    status ENUM('pass', 'fail', 'pending') DEFAULT 'pending',
    remarks TEXT,
    attemptNumber INT DEFAULT 1,
    completedAt DATETIME,
    timeSpent INT COMMENT 'Time spent in seconds',
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (studentId) REFERENCES students(id) ON DELETE CASCADE,
    FOREIGN KEY (examId) REFERENCES exams(id) ON DELETE CASCADE,
    INDEX idx_student (studentId),
    INDEX idx_exam (examId),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Contact Messages table
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    reply TEXT,
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_date (createdAt)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Payments table (optional, for tracking)
CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    studentId INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    paymentReference VARCHAR(100) UNIQUE,
    status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    paymentMethod VARCHAR(50),
    transactionId VARCHAR(100),
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (studentId) REFERENCES students(id) ON DELETE CASCADE,
    INDEX idx_status (status),
    INDEX idx_student (studentId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample exams (optional)
INSERT INTO exams (title, description, subject, duration, totalQuestions, passingScore, totalMarks, examDate, startTime, endTime, venue, status) 
VALUES 
('Mathematics Post-UTME', 'Mathematics examination for Post-UTME admission', 'Mathematics', 120, 50, 40, 100, '2024-09-15 09:00:00', '09:00', '11:00', 'Main Auditorium', 'scheduled'),
('English Language Post-UTME', 'English language examination', 'English Language', 120, 50, 40, 100, '2024-09-16 09:00:00', '09:00', '11:00', 'Main Auditorium', 'scheduled'),
('General Knowledge Post-UTME', 'General knowledge and aptitude test', 'General Knowledge', 90, 40, 30, 100, '2024-09-17 10:00:00', '10:00', '11:30', 'Building A', 'scheduled');

-- Create admin user (optional - you can use one of the students as admin)
-- For simplicity, we'll use email-based admin identification in the PHP code

-- Indexes for better performance
CREATE INDEX idx_students_email ON students(email);
CREATE INDEX idx_students_registration ON students(registrationStatus);
CREATE INDEX idx_exams_date ON exams(examDate);
CREATE INDEX idx_results_student ON results(studentId);
CREATE INDEX idx_results_exam ON results(examId);
