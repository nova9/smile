# Smile

Smile is a web application built with Laravel and Livewire.

## Prerequisites

- PHP >= 8.1
- Composer
- Node.js & npm

## Installation

1. Clone the repository:
   ```bash
   git clone <repository-url>
   cd smile
   ```

2. Install PHP dependencies:
   ```bash
   composer install
   ```

3. Install JavaScript dependencies:
   ```bash
   npm install
   ```

4. Copy the example environment file and configure your settings:
   ```bash
   cp .env.example .env
   ```
   Edit `.env` as needed (database, mail, etc).

5. Generate application key:
   ```bash
   php artisan key:generate
   ```

6. Run migrations:
   ```bash
   php artisan migrate
   ```

## Running the Application

- Start the development server:
  ```bash
  php artisan serve
  ```

- Build frontend assets:
  ```bash
  npm run dev
  ```

Visit [http://localhost:8000](http://localhost:8000) in your browser.

## Running Tests

```bash
php artisan test
```
or
```bash
./vendor/bin/pest
```
