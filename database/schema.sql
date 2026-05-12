-- Empty database creation
CREATE DATABASE wave;

USE wave;

-- users table
CREATE TABLE
    users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(50) NOT NULL,
        streak INT DEFAULT 0,
        max_streak INT DEFAULT 0,
        points INT DEFAULT 0,
        last_week_points INT DEFAULT 0,
        sessions INT DEFAULT 0,
        achievements INT DEFAULT 0,
        achievements_points INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

-- sessions table
CREATE TABLE
    sessions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        length TIME NOT NULL,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users (id)
    );

-- quizzes table
CREATE TABLE
    quizzes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        score INT NOT NULL,
        length TIME NOT NULL,
        answered_questions TINYINT NOT NULL,
        total_questions TINYINT NOT NULL,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users (id)
    );

-- friends table
CREATE TABLE
    friends (
        id INT AUTO_INCREMENT PRIMARY KEY,
        sender_id INT NOT NULL,
        receiver_id INT NOT NULL,
        status BOOLEAN DEFAULT FALSE,
        FOREIGN KEY (sender_id) REFERENCES users (id),
        FOREIGN KEY (receiver_id) REFERENCES users (id)
    );