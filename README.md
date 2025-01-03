<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Laravel 10 Project Setup

## Prerequisites

Before you begin, ensure that you have the following installed on your system:

1. **PHP**: Version 8.1 or higher
2. **Composer**: Dependency manager for PHP
3. **Git**: To clone the repository
4. **Database**: MySQL

## Installation Steps

Follow these steps to set up the Laravel 10 project on your local machine:

### 1. Clone the Repository

Clone the repository to your local machine using Git:

```bash
git clone <repository-url>
cd <repository-folder>
```

Replace `<repository-url>` with your Git repository URL and `<repository-folder>` with the desired folder name.

### 2. Install Dependencies

Run the following command to install PHP dependencies using Composer:

```bash
composer install
```

### 3. Set Up Environment File

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Update the `.env` file with your local environment settings, such as database credentials.

### 4. Generate Application Key

Run the following command to generate the application key:

```bash
php artisan key:generate
```

### 5. Set Up the Database

1. Create a new database in your MySQL database management system.
2. Update the `.env` file with your database name, username, and password.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Run Migrations

Run the following command to migrate the database schema:

```bash
php artisan migrate
```

### 7. Start the Development Server

Run the following command to start the Laravel development server:

```bash
php artisan serve
```

The application will be accessible at `http://127.0.0.1:8000`.

## Additional Notes

- Ensure your `.env` file is correctly configured to avoid errors.
- For any issues or questions, please open an issue in the repository or contact the project maintainers.
