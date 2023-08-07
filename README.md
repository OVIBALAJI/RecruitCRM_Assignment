<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

# RecruitCRM_Assignment

This project is a Laravel-based application that implements authentication and candidates management.

## Table of Contents

- [Authentication Flow](#authentication-flow)
- [Candidates Flow](#candidates-flow)
- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)

## Authentication Flow

The authentication flow of the application is as follows:

1. Users can register using the `/api/v1/register` endpoint.
2. Registered users can log in using the `/api/v1/login` endpoint to obtain access and refresh tokens.
3. Users can use the `/api/v1/token/refresh` endpoint to refresh their access token.
4. Logged-in users can use the `/api/v1/logout` endpoint to invalidate their refresh token and log out.

## Candidates Flow

The candidates flow of the application is as follows:

1. Logged-in users can create a new candidate using the `/api/v1/candidates` endpoint.
2. Users can retrieve a specific candidate using the `/api/v1/candidates/{id}` endpoint.
3. Users can retrieve a paginated list of all candidates using the `/api/v1/candidates` endpoint.
4. Users can search for candidates with pagination using the `/api/v1/candidates/search` endpoint.
5. Logged-in users can update a specific candidate using the `/api/v1/candidates/{id}` endpoint.
6. Logged-in users can delete a specific candidate using the `/api/v1/candidates/{id}` endpoint.

## Single Page Application
1) Start the development server:[php artisan serve]
2) Open your browser and navigate to http://localhost:8000 to access the application.


## Authentication Flow
    Register: Click on the "Register" link to create a new user account. Provide your email and password.

    Login: Use the registered email and password to log in. Upon successful login, you'll be redirected to the candidates page.

    Candidates: View, create, update, and delete candidates. The candidates are associated with the logged-in user.

    Logout: Click on the "Logout" button to log out and end your session.


## Installation

1. Clone the repository: `git clone https://github.com/yourusername/your-repo.git`
2. Install dependencies: `composer install`
3. Copy `.env.example` to `.env` and configure your database settings.
4. Generate application key: `php artisan key:generate`
5. Run migrations,Based on foreign key connections :
   1) `php artisan migrate --path=/database/migrations/2014_10_12_000000_create_users_table.php`,
   2) `php artisan migrate --path=/database/migrations/2023_08_02_131748_create_currencies_table.php`,
   3) `php artisan migrate --path=/database/migrations/2023_08_02_131804_create_addresses_table.php`,
   4) 'php artisan migrate --path=/database/migrations/2023_08_02_131734_create_candidates_table.php',
   5) 'php artisan migrate --path=/database/migrations/2023_08_02_131813_create_phone_numbers_table.php',
   6) 'php artisan migrate --path=/database/migrations/2023_08_02_131823_create_education_table.php',
   7) 'php artisan migrate --path=/database/migrations/2023_08_02_131833_create_skills_table.php',
   8) 'php artisan migrate --path=/database/migrations/2023_08_02_131840_create_experiences_table.php',
      
6. Generate JWT secret key: `php artisan jwt:secret`
7. Start the development server: `php artisan serve`


## Usage

- Register a user: `/v1/register`
- Log in: `/v1/login`
- Refresh access token: `/v1/token/refresh`
- Log out: `/v1/logout`
- Create a candidate: `/v1/candidates`
- Get a candidate: `/v1/candidates/{id}`
- Get all candidates: `/v1/candidates`
- Search candidates: `/v1/candidates/search`
- Update a candidate: `/v1/candidates/{id}`
- Delete a candidate: `/v1/candidates/{id}`


## Installation

1. Clone the repository: `git clone https://github.com/yourusername/your-repo.git`
2. Install dependencies: `composer install`
3. Copy `.env.example` to `.env` and configure your database settings.
4. Generate application key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Generate JWT secret key: `php artisan jwt:secret`
7. Start the development server: `php artisan serve`

## Usage

- Register a user: `/v1/register`
- Log in: `/v1/login`
- Refresh access token: `/v1/token/refresh`
- Log out: `/v1/logout`
- Create a candidate: `/v1/candidates`
- Get a candidate: `/v1/candidates/{id}`
- Get all candidates: `/v1/candidates`
- Search candidates: `/v1/candidates/search`
- Update a candidate: `/v1/candidates/{id}`
- Delete a candidate: `/v1/candidates/{id}`


## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
