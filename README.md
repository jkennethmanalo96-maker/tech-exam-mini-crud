# Native PHP CRUD – Songs App

A simple **native PHP CRUD application** (no framework) built using:
- PHP (PDO)
- MySQL
- Docker & Docker Compose
- Basic security best practices (CSRF, validation, prepared statements)

This project demonstrates how to build a clean and secure PHP CRUD app **without Laravel**.

---

## 📦 Requirements

- Docker
- Docker Compose
- Git

---

## 🚀 How to Set up and Run Locally

```bash
### 1️⃣ Clone the repository
git clone https://github.com/jkennethmanalo96-maker/tech-exam-mini-crud.git
cd tech-exam-mini-crud


### 2️⃣ Start Docker containers
docker-compose up -d

### 3️⃣ Run migration
docker exec -it php_native_app php /var/www/html/migrations/create_songs_table.php

4️⃣ Run seeders
docker exec -it php_native_app php /var/www/html/seeders/songs.php

🌐 Access the Application
http://localhost:8100

🔐 Security Practices Used

PDO prepared statements (SQL injection safe)
CSRF protection
Input validation
POST-only delete actions
Output escaping with htmlspecialchars

🛠️ Tech Stack

PHP 8+
MySQL
Docke
Docker Compose

📌 Notes

No frameworks (Laravel, Symfony, etc.)
Built for learning and small CRUD projects
