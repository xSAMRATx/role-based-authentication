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
- For database connection use MySQL

## 📁 Project Structure

- `app/Models/Role.php` – Role model
- `app/Http/Middleware/RoleMiddleware.php` – Role-based middleware
- `database/seeders/RoleSeeder.php` – Seeder to create default roles
- `database/seeders/PermissionRoleSeeder.php` – Seeder to create role-wise permission
- `routes/web.php` – All web routes with middleware protection
- `resources/views/` – Blade files for login, register, dashboard, profile, employee, task etc.

## 🛠 Installation

```bash
git clone https://github.com/xSAMRATx/role-based-authentication.git
cd role-based-authentication
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
