# Project Name

CRUD for patient data

## Technologies Used

- Laravel 12
- PHP >= 8.2
- MySQL
- Composer

## Architecture

This project uses the **Service Pattern** to separate business logic from controllers. Each feature (like patients) has its own service class to handle logic such as storing, updating, and deleting data — making the code cleaner, reusable, and easier to test.

Example structure:

app/

├── Http/

│ └── Controllers/

├── Services/

│ └── PatientService.php

├── Models/

│ └── Patient.php

## Installation

Follow the steps below to install and run the project locally:

```bash
git clone git@github.com:yudo23/patient-api.git
cd patient-api

# Install dependencies
composer install

# Copy .env file and generate application key
cp .env.example .env
php artisan key:generate

# Configure the database
# Then run migrations and seeders
php artisan migrate --seed

# Start the local development server
php artisan serve

```

## Access Key

The access key is taken from the access_keys table. This token is generated when running the seeder.

Access-Key = A9D8F7C6B5E4D3C2A1B0D9F8C7E6B5A4 

## URL API

[GET] https://api.hipamklampok.my.id/api/v1/patients

[GET] https://api.hipamklampok.my.id/api/v1/patients/{id}

[PUT] https://api.hipamklampok.my.id/api/v1/patients/{id}

[POST] https://api.hipamklampok.my.id/api/v1/patients

[DELETE] https://api.hipamklampok.my.id/api/v1/patients/{id}

