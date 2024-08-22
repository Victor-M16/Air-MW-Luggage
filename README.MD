# Luggage Handling and Ticket Management System

## Project Overview

This project is a web-based application designed to handle ticket purchases, luggage registration, and management for a transportation service. The system allows customers to buy tickets, register their luggage, and receive a QR code that links to a detailed report of their trip. The system ensures that each trip is linked to a unique ticket number and supports multiple luggage items for each trip.

## Features

- **Customer Registration**: Allows customers to register their details even if they have already purchased a ticket in the past.
- **Ticket Generation**: Automatically generates a unique ticket number for each trip.
- **Trip Management**: Associates each trip with a ticket number and stores relevant trip details.
- **Luggage Registration**: Allows customers to register multiple bags and items for each trip.
- **QR Code Generation**: Generates a QR code that links to the detailed trip report, which customers can use for quick access.

## Prerequisites

- PHP 7.4 or higher
- Composer
- Laravel 8.x
- MySQL or any other supported database
- Node.js and npm (optional, for front-end dependencies)

## Installation

### Step 1: Clone the repository

```bash
git clone https://github.com/Victor-M16/Air-MW-Luggage.git
cd Air-MW-Luggage
```

### Step 2: Install dependencies

```bash
composer install
npm install
```

### Step 3: Set up the environment

```bash
cp .env.example .env
```


### Step 4: Generate application key

```bash
php artisan key:generate
```

### Step 5: Run database migrations

```bash
php artisan migrate
```

### Step 6: Serve the application

```bash
php artisan serve
```

##Usage

1. Customer Ticket Purchase
Customers can buy tickets by entering their details, including their email, departure point, and destination. Even if the customer has previously purchased a ticket, they can buy a new one with a unique ticket number.

2. Luggage Registration
After purchasing a ticket, customers can register their luggage by providing descriptions and item details for each bag. Each bag is linked to the customer's trip.

3. QR Code Generation
Once the luggage is registered, the system generates a QR code for the trip, which can be scanned to view and download the trip report.

4. Viewing Trip Reports
The generated QR code links to a report page that displays all the details of the trip, including customer information, trip details, and registered luggage.

## Directory Structure

- app/: Contains the application logic (controllers, models, etc.).
- resources/views/: Contains the blade templates for rendering views.
- routes/web.php: Contains the routes for the web application.
- public/: Contains publicly accessible files, including the QR codes generated for each trip.
database/migrations/: Contains the database migration files.

## Troubleshooting
- Issue: Error related to ticket number or trip not found.

- Solution: Ensure the ticket number is unique and properly linked to a trip. Check the database for consistency.
Issue: QR Code is not generating.

- Solution: Verify that the qrcodes directory exists in storage/app/public/. Make sure the required QR code package is installed and correctly configured.

## License
This project is licensed under the MIT License. See the LICENSE file for details.

## Contributing
Feel free to open issues or submit pull requests to improve the system. Contributions are welcome!

## Contact
For any inquiries or support, please contact vcmjimapemba@gmail.com.
