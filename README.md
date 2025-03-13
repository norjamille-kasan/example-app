# Project Setup

## Installation

Follow these steps to set up the project locally:

1. **Clone the repository:**

    ```sh
    git clone https://github.com/norjamille-kasan/example-app.git
    cd example-app
    ```

2. **Install dependencies:**

    ```sh
    npm install
    composer install
    ```

3. **Set up the database:**

    - Configure your local database connection in the `.env` file.
    - Run migrations if necessary:
        ```sh
        php artisan migrate
        ```

4. **Run frontend dependencies:**

    ```sh
    npm install
    ```

5. **Start the development server:**

    ```sh
    php artisan serve
    ```

6. **Register an account:**
    - Open [http://localhost:8000/register](http://localhost:8000/register) in your browser.
    - Fill out the registration form to create an account.

## Additional Notes

-   Ensure your local server environment meets the project requirements (e.g., PHP, Node.js, and database).
-   If you encounter issues, check the `.env.example` file for necessary environment variables and copy it to `.env` if needed:
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```
