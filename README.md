# Regur Technology Task - Laravel Project Installation Guide (Please follow the steps)

This guide will walk you through the installation process for the Laravel project from the repository `https://github.com/Earth-1218/regur_technology_task.git`.

## Requirements

Before you begin, make sure your system meets the following requirements:

- PHP >= 8.0
- Composer
- A web server (Apache or Nginx)
- Database server (MySQL, PostgreSQL, SQLite, etc.)
- Node.js and NPM (for front-end assets)

## Installation Steps

### Step 1: Clone the Repository

Clone the repository to your local machine using Git:

```bash
git clone https://github.com/Earth-1218/regur_technology_task.git
cd regur_technology_task
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan serve
