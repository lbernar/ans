# 🧠 Neurosystemic Analysis System (NAS)

Web system developed in Laravel for managing neurosystemic analyses, allowing registration of questions, answers, and users with level-based access control.

## 📋 Table of Contents

- [About the Project](#about-the-project)
- [Technologies](#technologies)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Testing](#testing)
- [Project Structure](#project-structure)
- [Contributing](#contributing)
- [License](#license)

## 🎯 About the Project

The NAS System is a web application that facilitates the management of neurosystemic analyses through:

- ✅ Authentication and level-based access control (Admin/User)
- ✅ Complete CRUD for users, questions, and answers
- ✅ Administrative interface based on AdminLTE
- ✅ Robust validation with Form Requests
- ✅ Automated tests (unit and feature)
- ✅ SQLite database (development) or MySQL (production)

## 🚀 Technologies

This project was developed with the following technologies:

- **[Laravel 12](https://laravel.com/)** - PHP Framework
- **[PHP 8.3+](https://www.php.net/)** - Programming Language
- **[SQLite](https://www.sqlite.org/)** / **[MySQL](https://www.mysql.com/)** - Database
- **[AdminLTE 2](https://adminlte.io/themes/AdminLTE/index2.html)** - Admin Template
- **[Bootstrap 3](https://getbootstrap.com/docs/3.4/)** - CSS Framework
- **[jQuery](https://jquery.com/)** - JavaScript Library
- **[DataTables](https://datatables.net/)** - Interactive tables plugin
- **[PHPUnit](https://phpunit.de/)** - Testing Framework

## 📝 Requirements

Before starting, you need to have installed:

- **PHP >= 8.3**
- **Composer**
- **PHP Extensions:**
  - php-sqlite3
  - php-mbstring
  - php-xml
  - php-curl
  - php-zip
  - php-bcmath
  - php-json

### Installing PHP Extensions (Ubuntu/Debian)

```bash
sudo apt update
sudo apt install php8.3 php8.3-cli php8.3-sqlite3 php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip php8.3-bcmath
```

## ⚙️ Installation

### 1. Clone the repository

```bash
git clone https://github.com/your-username/ans-laravel.git
cd ans-laravel
```

### 2. Install dependencies

```bash
composer install
```

### 3. Configure environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Create the database

For **SQLite** (default):
```bash
touch database/database.sqlite
```

For **MySQL**, edit `.env` and configure credentials.

### 5. Run migrations and seeders

```bash
php artisan migrate --seed
```

This will create the tables and two default users:
- **Admin**: admin@ans.com / admin123
- **User**: usuario@ans.com / user123

## 🔧 Configuration

### Main Environment Variables

Edit the `.env` file:

```env
APP_NAME="Neurosystemic Analysis"
APP_URL=http://localhost
APP_ENV=local
APP_DEBUG=true

DB_CONNECTION=sqlite
# or for MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_DATABASE=ans_laravel
# DB_USERNAME=root
# DB_PASSWORD=secret
```

### Permissions

Make sure the `storage` and `bootstrap/cache` folders have write permissions:

```bash
chmod -R 775 storage bootstrap/cache
```

## 🎮 Usage

### Starting the Development Server

```bash
php artisan serve
```

Access: **http://localhost:8000**

### Full Dev Mode (with Queue and Logs)

```bash
composer dev
```

This starts:
- Web server (port 8000)
- Queue worker
- Log monitor (Laravel Pail)

### Default Users

After running the seed, you will have:

| Email | Password | Level |
|-------|----------|-------|
| admin@ans.com | admin123 | Administrator |
| usuario@ans.com | user123 | User |

## 🧪 Testing

### Run All Tests

```bash
php artisan test
```

### Run Tests with Coverage

```bash
php artisan test --coverage
```

### Run Specific Tests

```bash
# Unit tests only
php artisan test --testsuite=Unit

# Feature tests only
php artisan test --testsuite=Feature

# Specific test
php artisan test --filter=UserModelTest
```

### Test Coverage

Currently the project has:
- ✅ **25+ automated tests**
- ✅ Unit tests for Models
- ✅ Feature tests for Controllers
- ✅ Authentication tests

## 📁 Project Structure

```
ans-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Application controllers
│   │   ├── Middleware/       # Custom middlewares
│   │   └── Requests/         # Form Requests for validation
│   └── Models/               # Eloquent Models
├── database/
│   ├── factories/            # Factories for testing
│   ├── migrations/           # Database migrations
│   └── seeders/              # Initial data seeders
├── resources/
│   └── views/                # Blade views
├── routes/
│   └── web.php               # Application routes
├── tests/
│   ├── Feature/              # Integration tests
│   └── Unit/                 # Unit tests
└── public/
    └── adminlte/             # AdminLTE assets
```

## 🏗️ Features

### For Administrators

- 👥 **User Management**
  - Create, edit, view, and delete users
  - Define access levels (Admin/User)
  - Activate/deactivate users
  
- ❓ **Question Management**
  - Register custom questions
  - Edit and remove existing questions
  - Organize by type and category
  
- ✍️ **Answer Management**
  - Link answers to questions
  - Edit and remove answers

### For Regular Users

- 📊 Dashboard with personal information
- 🔐 Secure authentication
- 👤 Profile viewing

## 🔒 Security

The project implements several security layers:

- ✅ Native Laravel authentication
- ✅ CSRF Protection on all forms
- ✅ Password hashing with BCrypt
- ✅ Middleware-based authorization
- ✅ Form Requests for centralized validation
- ✅ Prepared Statements (SQL Injection protection)
- ✅ Mass Assignment protection

## 🛠️ Implemented Best Practices

- ✅ **Form Requests** for validation separation
- ✅ **Constants** to avoid magic numbers
- ✅ **Accessors/Mutators** for presentation logic
- ✅ **Indexes** in database for performance
- ✅ **Route Model Binding** for cleaner code
- ✅ **Eager Loading** to avoid N+1 queries
- ✅ **Factory Pattern** for testing
- ✅ **Repository Pattern** considerations

## 🐛 Troubleshooting

### Error: "could not find driver (SQLite)"

```bash
sudo apt install php8.3-sqlite3
```

### Error: "Call to undefined function mb_split()"

```bash
sudo apt install php8.3-mbstring
```

### Permission denied on storage/

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## 📈 Roadmap

- [ ] RESTful API with Sanctum authentication
- [ ] Export results to PDF
- [ ] Dashboard with charts and statistics
- [ ] Notification system
- [ ] Password recovery by email
- [ ] User action audit
- [ ] Soft deletes for sensitive data

## 🤝 Contributing

Contributions are welcome! To contribute:

1. Fork the project
2. Create a branch for your feature (`git checkout -b feature/MyFeature`)
3. Commit your changes (`git commit -m 'Add MyFeature'`)
4. Push to the branch (`git push origin feature/MyFeature`)
5. Open a Pull Request

### Code Standards

- Follow the [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards
- Run `composer test` before committing
- Keep test coverage above 70%
- Document public methods with DocBlocks

## 📄 License

This project is under the MIT license. See the [LICENSE](LICENSE) file for more details.

## 👨‍💻 Author

Developed with ❤️ for neurosystemic analysis management.

---

## 📞 Support

If you have any questions or problems:

1. Check the [Laravel documentation](https://laravel.com/docs)
2. Open an [issue](https://github.com/your-username/ans-laravel/issues)
3. Contact: contact@example.com

---

⭐ If this project was useful, consider giving it a star on GitHub!
