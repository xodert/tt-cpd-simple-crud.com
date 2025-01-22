# Laravel Product Management System

This is a test assignment for a job application that demonstrates basic CRUD operations with additional features using Laravel 8+. The project was created as part of the technical assessment for a PHP/Laravel Developer position.

## Task Description

Develop a product management system using Laravel 8+ with MySQL database that includes:

1. Product listing with:
   - Search functionality
   - Status filtering
   - Sorting capabilities

2. Product management:
   - Create/Read/Update/Delete operations
   - Role-based article number editing
   - Soft deletes
   - Form validation

3. Additional features:
   - Email notifications via queue for new products
   - API endpoints
   - Scheduled webhook notifications
   - Database transactions
   - Event observers

## Features Implemented

- Product management (CRUD operations)
- Role-based access control (admin can edit article numbers)
- Soft deletes for products
- Search and filtering functionality
- Asynchronous notifications via queues
- API endpoints for product listing
- Scheduled webhook notifications
- Form validation
- Transaction support
- Event observers for product lifecycle

## Requirements

- PHP ^7.4
- MySQL 5.7+
- Composer
- Node.js & NPM

## Installation

1. Clone the repository:
```bash
git clone <repository-url>
cd project-directory
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install and compile frontend assets:
```bash
npm install && npm run dev
```

4. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in `.env`:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Run migrations:
```bash
php artisan migrate
```

7. Start queue worker:
```bash
php artisan queue:work
```

8. Configure scheduler (add to crontab):
```bash
* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
```

## Configuration

The following configuration files need to be set up:

1. `config/products.php`:
```php
return [
    'webhook' => env('PRODUCT_WEBHOOK_URL'),
    'email' => env('PRODUCT_NOTIFICATION_EMAIL'),
    'role' => env('USER_ROLE', 'user')
];
```

2. `config/roles.php`:
```php
return [
    'can-edit-articles' => ['admin']
];
```

## API Endpoints

- GET `/api/products` - List all products

## License

This is a test project created for job application purposes. Feel free to use it for learning purposes.
