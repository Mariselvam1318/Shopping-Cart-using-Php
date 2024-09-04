# Shopping Cart PHP Project

## Description

This project is a simple PHP-based shopping cart application with features for user login, product management, and contact form functionality. It includes a user interface built with Bootstrap and provides a seamless experience for users to manage their cart and provide feedback.

## Features

*   **User Authentication**: Users can log in and view their profile.
*   **Product Management**: Users can view products, add them to their cart.
*   **Feedback System**: Users can contact the admin and receive a confirmation email.
*   **Responsive Design**: The application is built using Bootstrap for a mobile-friendly experience.

## Prerequisites

Before you begin, ensure you have met the following requirements:

*   A web server with PHP support (e.g., Apache or Nginx)
*   MySQL database server
*   Composer (for managing PHP dependencies)

## Installation

### 1\. Clone the Repository

```
bash
git clone https://github.com/your-username/your-repository.git
cd your-repository
```
### 2\. Set Up the Database

1.  **Create a MySQL Database**: Create a new database in MySQL.
2.  **Import Database Schema**: Use the provided SQL scripts to set up the database schema. These should be included in your project directory or created manually.

### 3\. Configure Database Connection

Update the `config.php` file with your database credentials:
```
php
<?php
$host = 'localhost'; // or your database host
$dbname = 'your\_database\_name';
$username = 'your\_database\_username';
$password = 'your\_database\_password';

$connection = mysqli\_connect($host, $username, $password, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli\_connect\_error());
}
?>
```
### 4\. Set Up Email

Configure the email settings in the `home.php` file:
```
php
$mail->Host       = 'smtp.gmail.com';  // Your SMTP host
$mail->Username   = 'your-email@gmail.com'; // Your SMTP username
$mail->Password   = 'your-email-password'; // Your SMTP password
```
Ensure that you use an application-specific password if you have 2-factor authentication enabled.

## Usage

1.  **Start the Web Server**: Start your web server to serve the PHP files.
2.  **Access the Application**: Open a web browser and navigate to `http://localhost/your-repository/home.php`.

### User Actions

*   **Login**: Access the login page and enter your credentials to log in.
*   **View Products**: Browse the products and add them to your cart.
*   **Contact Us**: Fill out the contact form to send feedback.

## Troubleshooting

*   **Database Connection Issues**: Verify your database credentials and ensure that the database server is running.
*   **Email Issues**: Check SMTP settings and ensure that you have the correct username and password.
*   **Responsive Design**: Ensure that Bootstrap is properly linked and your CSS styles are not conflicting.


#
