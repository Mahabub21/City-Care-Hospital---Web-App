## City Care Hospital - Web App

Professional repository documentation for the City Care Hospital PHP/MySQL web application.

---

## Project Overview

City Care Hospital is a small PHP-based hospital management web application. The repo contains the public-facing website (homepage), patient/doctor/admin dashboards, appointment booking, patient management, and report management. The application is intended to run on a local LAMP/WAMP/XAMPP stack using PHP and MariaDB/MySQL.

## Key Features

- Role-based users: patient, doctor, admin
- Appointment booking and management
- Doctor listings and specializations
- Patient management (CRUD, reports)
- Admin dashboard and reports

## Tech Stack

- PHP (works with PHP 7.4+ but tested with PHP 8+)
- MySQL / MariaDB
- HTML, CSS, JavaScript
- Designed to run on XAMPP (Windows), WAMP, MAMP, or a LAMP server

## Project Structure (important files/folders)

- `index.html` — public landing page
- `style.css`, `script.js` — site styles and scripts
- `city_care_hospital (3).sql` — database schema + initial admin user
- `Admin/` — admin dashboard, manage patients, manage doctors, registration helpers
- `doctor/` — doctor dashboard and related pages
- `patient/` — patient dashboard and related pages
- `loging/` — login and signup pages (note: directory name is `loging`)

Each subfolder may include a `config.php` file where DB credentials are configured.

## Database

The included SQL dump `city_care_hospital (3).sql` contains the schema for tables such as:

- `users` (roles: patient, doctor, admin)
- `appointments`
- `doctor_info`
- `reports`
- `specializations`

There is an initial admin user inserted in the dump (see SQL file). Passwords are stored hashed in the `users` table.

## Prerequisites (Windows local dev)

1. Install XAMPP (https://www.apachefriends.org/) or WAMP.
2. Ensure PHP is enabled and Apache & MySQL (MariaDB) are running.
3. Have access to phpMyAdmin or MySQL CLI.

## Installation and Setup (quick)

1. Place the project folder into your web root (for XAMPP):

   - Move the repository into `C:\xampp\htdocs\hospital` (or clone directly into htdocs).

# 🏥 City Care Hospital — Web App

A lightweight PHP + MySQL hospital management web application for local development and demo purposes.

---

## ✨ Overview

City Care Hospital provides role-based dashboards (patient, doctor, admin), appointment booking, basic patient management, and report handling. It's designed to run on a local XAMPP/WAMP/MAMP/LAMP stack.

## 🚀 Quick summary

| Item | Short info |
|---|---|
| Language | PHP, HTML, CSS, JavaScript |
| DB | MySQL / MariaDB |
| Tested PHP | 7.4+ (recommended 8.x) |
| Run on | XAMPP (Windows recommended for local testing) |

## 🔑 Key Features

| Feature | Description |
|---|---|
| Role-based users | patient, doctor, admin |
| Appointments | Book, confirm, complete appointments |
| Doctor listing | Specializations and hospital affiliation |
| Patient management | CRUD operations and reports |
| Admin area | Manage users, doctors, view reports |

## 🗂 Project structure (high level)

| Path | Purpose |
|---|---|
| `index.html` | Public landing page |
| `style.css`, `script.js` | Frontend styles and scripts |
| `city_care_hospital (3).sql` | DB schema + initial data (import in phpMyAdmin) |
| `Admin/` | Admin dashboard and management pages |
| `doctor/` | Doctor-facing pages |
| `patient/` | Patient-facing pages |
| `loging/` | Authentication pages (note: folder named `loging`) |

> Note: Several folders include a `config.php` file — make sure DB credentials are set correctly in each or centralize configuration.

## 🗄 Database — important tables

| Table | Purpose |
|---|---|
| `users` | Stores users and roles (patient, doctor, admin) |
| `appointments` | Appointment scheduling and status |
| `doctor_info` | Extra metadata for doctors |
| `reports` | Medical/report records for patients |
| `specializations` | Lookup for doctor specializations |

The included SQL dump `city_care_hospital (3).sql` contains schema and an initial admin user (password hashed).

## 🛠 Prerequisites (Windows/XAMPP)

| Item | Recommended |
|---|---|
| XAMPP / WAMP | XAMPP for Windows (https://www.apachefriends.org/) |
| PHP | 8.x recommended |
| MySQL / MariaDB | Included with XAMPP |

## ⚙️ Installation & Setup (quick)

1. Copy the project to your web root, e.g. `C:\xampp\htdocs\hospital`.
2. Start Apache and MySQL via XAMPP Control Panel.
3. Create a database (for example `city_care_hospital`) and import `city_care_hospital (3).sql` using phpMyAdmin.
4. Update DB credentials in the `config.php` files found under `Admin/`, `doctor/`, `patient/`, and `loging/` (or centralize one `config.php`):

```php
// example values
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'city_care_hospital');
define('DB_USER', 'root');
define('DB_PASS', '');
```

5. Open the site: http://localhost/hospital/

### Admin account (from dump)

- Email: `admin@gmail.com` — password is hashed in the SQL dump. Reset via phpMyAdmin if needed (see next section).

## 🔐 Reset admin password (safe method)

Create a small PHP script in a safe, non-public location to generate a bcrypt hash, then paste it into phpMyAdmin for the admin `users.password` field:

```php
<?php
echo password_hash('YourNewAdminPassword', PASSWORD_DEFAULT);
```

Then update the `users` table for the admin user with the generated hash.

## 🔒 Security recommendations

- Do not leave SQL dumps in the public folder after importing.
- Use a DB user with minimal privileges in production (not `root`).
- Use prepared statements (PDO or mysqli) to prevent SQL injection.
- Add CSRF tokens to forms and validate/sanitize all user inputs.

## 🧰 Troubleshooting

| Symptom | Check |
|---|---|
| 500 Internal Server Error | Apache/PHP error logs (XAMPP Control Panel -> Logs) |
| DB connection errors | Check DB_HOST/DB_USER/DB_PASS/DB_NAME and MySQL service |
| Missing files or broken links | Verify paths after moving folders |

## 🤝 Contributing

1. Fork the repo
2. Create a feature branch
3. Open a PR with details and tests (if applicable)

Style notes: prefer clear commits, sanitize inputs, and keep consistent PHP formatting.

## .gitignore suggestions

- `city_care_hospital (3).sql`
- `*.env`
- `vendor/`
- `node_modules/`

## 📄 License

Consider adding an MIT `LICENSE` if you plan to publish this repository publicly.

## ✅ Next steps I can help with

- Add a `LICENSE` (MIT)
- Add a `.gitignore`
- Centralize DB config into a single `config.php`
- Add a small script to safely reset the admin password
- Create `CONTRIBUTING.md` or `deploy.md`

---

If you'd like me to add any of the items above, tell me which ones and I'll implement them.
