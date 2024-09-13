<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About the Book Library API

The **Book Library API** is a simple, stateless, RESTful API built with Laravel for managing a library of books. It supports creating, updating, deleting, and retrieving books, along with user authentication. The API is designed with JWT-based authentication and adheres to REST principles, providing a clean interface for managing the library resources.

### Features

- **Book Management**: CRUD operations for managing books in the library.
- **User Authentication**: User registration and login with JWT authentication.
- **Validation**: Full validation of input fields, including unique ISBN verification.
- **Error Handling**: Clear and descriptive error messages for validation and server errors.
- **OpenAPI Documentation**: API is documented using OpenAPI (Swagger) for easy integration.

## Book API Endpoints

Here are the main endpoints available in the Book Library API:

### Book Management

- **GET** `/api/v1/books` - Retrieve the list of all books.
- **GET** `/api/v1/books/{id}` - Retrieve details of a specific book by its ID.
- **POST** `/api/v1/books` - Create a new book (requires authentication).
- **PUT** `/api/v1/books/{id}` - Update an existing book (requires authentication).
- **DELETE** `/api/v1/books/{id}` - Delete a book (requires authentication).

### Authentication

- **POST** `/api/v1/auth/register` - Register a new user.
- **POST** `/api/v1/auth/login` - Login a user and obtain a JWT token.
- **POST** `/api/v1/auth/logout` - Logout the current user (invalidate the token).
- **POST** `/api/v1/auth/refresh` - Refresh the JWT token.
- **GET** `/api/v1/auth/me` - Retrieve information about the authenticated user.

### Book Attributes

- **ID** (integer): Unique identifier for the book.
- **Title** (string): Title of the book.
- **Author** (string): Author of the book.
- **Year Published** (integer): The year the book was published (no earlier than 1800).
- **ISBN** (string): A 13-character unique identifier following the ISBN-13 standard.

### Example Request Body for Creating a Book

```json
{
    "title": "The Great Gatsby",
    "author": "F. Scott Fitzgerald",
    "year_published": 1925,
    "isbn": "9781234567897"
}


                        Installation
                        
Follow these steps to set up the project locally:

Clone the repository:

bash

git clone <repository_url>
cd book-library-api
Install dependencies:

bash

composer install
Copy the .env.example file and configure your database and other environment settings:

bash

cp .env.example .env
Generate the application key:

bash

php artisan key:generate
Run the database migrations:

bash

php artisan migrate
Install JWT package (if not installed):

bash

composer require tymon/jwt-auth
Generate the JWT secret key:

bash

php artisan jwt:secret
Start the application:

bash

php artisan serve


                        Testing
                        
                        
To run the unit tests for the core business logic, use the following command:

bash

php artisan test

These tests ensure that the core functionalities, including book management and authentication, are working as expected.


                        API Documentation
                        
                        
The API documentation is generated using Swagger. You can access the interactive documentation at the following URL:

http://127.0.0.1:8000/api/documentation

This will give you an overview of all available API endpoints, request/response structures, and examples.
