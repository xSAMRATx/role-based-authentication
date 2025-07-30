# Role-Based Authentication System Application

A Laravel-based web application implementing custom role-based authentication **without using external packages**. It supports user registration, login, role management, middleware protection, profile management, and permissions control.

## 🔒 Features

- Manual authentication (login, register, logout)
- Role-based middleware protection
- Blade directives for roles
- Role seeder with roles like `admin`, `hr manager`, `employee`
- CRUD for Employee and Task (with role-based access)
- My Profile view for all
- Pagination & status colors

## 📁 Project Structure

- `app/Models/Role.php` – Role model
- `app/Http/Middleware/RoleMiddleware.php` – Role-based middleware
- `database/seeders/RoleSeeder.php` – Seeder to create default roles
- `routes/web.php` – All web routes with middleware protection
- `resources/views/` – Blade files for login, register, dashboard, profile, etc.

## 🛠 Installation

```bash
git clone https://github.com/yourusername/role-auth-app.git
cd role-auth-app
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed

🧪 Dummy Credentials

After seeding, use these login credentials:

Admin:
Email: admin@gmail.com
Password: 123456

HR Manager:
Email: hr@gmail.com
Password: 123456

Employee:
Email: employee@gmail.com
Password: 123456
