[![Laravel Forge Site Deployment Status](https://img.shields.io/endpoint?url=https%3A%2F%2Fforge.laravel.com%2Fsite-badges%2Fe99d1bbc-9d83-4c94-936b-7769c4834418%3Fdate%3D1%26commit%3D1&style=plastic)](https://forge.laravel.com)

# Installation

## PHP
Download [php](https://windows.php.net/download) (VS16 x64 Thread Safe)

Extract to `C:\php`

Copy `C:\php\php.ini-development` and rename to `php.ini`

Add php to PATH (`Windows Start -> Type "environment" -> Edit the system environment variables -> Advanced -> Environment Variables -> Click "Path" under System variables -> Edit -> New -> Type "C:\php"`)

Uncomment these lines in `php.ini`
```bash
extension=fileinfo
extension=exif
extension=pdo_mysql
extension=gd
```

Setup curl https://stackoverflow.com/a/49071524

## Yarn

Download [node.js](https://nodejs.org/en/)

Install yarn Plug'n'Play

```bash
npm install --global yarn
yarn set version berry
```

## Composer

Download and run [Composer-Setup.exe](https://getcomposer.org/download/)

Install the composer dependencies:

```bash
composer install
```

## Laravel
Make a copy of the `.env.example` file named `.env`:

```bash
cp .env.example .env
```

Generate an app key

```bash
php artisan key:generate
```

Start vite development server

```bash
yarn run dev
```

Try serving the site in a new terminal and check you can open it at `http://localhost:8000/`

```bash
php artisan serve
```

## MySQL

Download and run the [MySQL installer](https://dev.mysql.com/downloads/installer/)

Add MySQL to PATH (e.g. `C:\Program Files\MySQL\MySQL Server 8.0\bin`)

Set all `DB_` prefixed variables in `.env`

Initialise the database

```bash
php artisan migrate:refresh --seed
```

## Discord Integration
Set all `Discord_` prefixed variables in `.env`

These are used for OAuth2, and can be found on the [Discord Developer Portal](https://discord.com/developers/applications)

```bash
DISCORD_CLIENT_ID=
DISCORD_CLIENT_SECRET=
```

Ensure that a redirect has been added to your bot for `http://localhost:8000/auth/callback`
