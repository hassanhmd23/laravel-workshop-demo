# Laravel Task Manager

A task management system built with Laravel and Tailwind CSS. This project allows users to
manage projects, create tasks, comment on tasks, and receive notifications about tasks.

## Installation

### Prerequisites

Ensure you have the following installed:

- PHP (>= 8.2)
- Composer
- SQLite
- Node.js & NPM
- Laravel CLI

### Setup

1. Clone the repository:

   ```sh
   git clone https://github.com/hassanhmd23/laravel-workshop-demo.git
   cd laravel-workshop-demo
    ```

2. Install PHP dependencies:

    ```sh
    composer install
    ```

3. Install NPM dependencies:

    ```sh
    npm install && npm run dev
    ```

4. Create a new `.env` file:

    ```sh
    cp .env.example .env
    ```

5. Generate an application key:

    ```sh
    php artisan key:generate
    ```

6. Migrate the database:

    ```sh
    php artisan migrate
    ```

7. Seed the database:

    ```sh
    php artisan db:seed
    ```

8. Start the development server:

    ```sh
    php artisan solo
    ```

9. Visit `http://localhost:8000` in your browser.
   
