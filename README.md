## Installation

Install the composer dependencies:

```bash
composer install
```

Make a copy of the `.env.example` file named `.env`:

```bash
cp .env.example .env
```

Generate an app key:

```bash
php artisan key:generate
```

Run vite to server your assets/bundle:

```bash
yarn run dev
```

Open a new terminal instance and serve the application:

```bash
php artisan serve
```
