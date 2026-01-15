This README is in English. For the French version, see [README.md](README.md).

# Youdemy – Online Learning Platform

## Project Description

Youdemy is an online course platform designed to modernize and simplify learning by offering an interactive, structured, and personalized experience for both students and teachers.  
It provides complete management of courses, users, and statistics through a secure architecture.

---

## Features

### Visitor

- Browse the course catalog with pagination
- Search courses by keywords
- Create an account with role selection:
    - Student
    - Teacher

### Student

- View the full course catalog
- Search and view detailed course information:
    - Description
    - Content
    - Teacher
- Enroll in a course (requires authentication)
- Access to "My Courses" personal space

### Teacher

- Add new courses including:
    - Title
    - Description
    - Content (video or document)
    - Tags
    - Category
- Manage their courses:
    - Edit
    - Delete
    - View enrolled students

### Administrator

- Validate teacher accounts
- User management:
    - Activate
    - Suspend
    - Delete
- Content management:
    - Courses
    - Categories
    - Tags

- Bulk tag insertion
- Access to global statistics:
    - Total number of courses
    - Courses distribution by category
    - Most popular course
    - Top 3 teachers

### Security

- Authentication & Authorization system
- Role-Based Access Control (RBAC)

---

## Technologies Used

- **PHP (OOP)**
- **MySQL**
- **PDO**
- **Composer**
- **HTML / CSS / JavaScript**
- **Dotenv** for environment variables management

---

## Installation & Usage

### Prerequisites

Make sure you have the following tools installed:
- `PHP` (8.0 or higher)
- `MySQL`
- `Composer` (PHP dependency manager)

Check versions:

```Bash
php -v
mysql --version
composer -V
```

## Project Setup

**1. Clone the repository**

```Bash
git clone https://github.com/anass17/Plateforme-de-Cours-en-Ligne-Youdemy.git
cd Plateforme-de-Cours-en-Ligne-Youdemy
```

**2. Install PHP dependencies**

```Bash
composer install
```

This command will:

- Install required packages
- Create the vendor/ folder
- Set up class autoloading

**3. Set up environment variables**

Copy the example file:

```Bash
cp .env_example .env
```

Then edit `.env` with your local configuration

**4. Create and initialize the database**

Create database:

```SQL
CREATE DATABASE youdemy;
```

Import tables from SQL script:

```Bash
mysql -u root -p youdemy < sql/script.sql
```

The script can be found here:

```
/SQL/script.sql
```

**5. Start the built-in PHP server (recommended)**

```Bash
php -S localhost:8000
```

Then open in your browser:

```
texthttp://localhost:8000
```

**6. Test accounts (examples)**

| Role         | Email	                        | Password      |
| ------------ | ------------------------------ | ------------- |
| Admin        | ahmed.elfassi@example.com      | 123456789     |
| Teacher      | fatima.benali@example.com      | 123456789     |
| Student      | sara.elmansouri@example.com    | 123456789     |

---

## Notes

Make sure the `pdo_mysql` extension is enabled in your `php.ini`

---

## Visuals

## Interfaces

![Home Page](https://github.com/user-attachments/assets/baeed7df-00fd-44c8-95d2-f1ac72cf4575)
![Login](https://github.com/user-attachments/assets/f791046d-7316-4bb1-90e0-4fc3dce4a3cb)
![Courses](https://github.com/user-attachments/assets/b8d67823-ee90-436c-ba87-a71603292e65)
![Dashboard](https://github.com/user-attachments/assets/c60fdcf1-71cc-4409-80bb-587442c42251)
![Add Review](https://github.com/user-attachments/assets/575d62aa-2ac4-4159-b95a-aafb2e4c8904)

## Diagrams

![Use Case Diagram](https://github.com/user-attachments/assets/65e0b740-412c-4873-876d-3421b171b598)
![Class Diagram](https://github.com/user-attachments/assets/549b1cf6-e711-4a08-afe2-080398c75553)