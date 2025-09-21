# Laravel E-commerce Platform

A simplified e-commerce platform built with Laravel 8, featuring CRUD operations for categories, subcategories, and products with image management.

## Features

- **Categories Management** - Create, read, update, delete product categories
- **Subcategories Management** - Organize products under categories
- **Products Management** - Full CRUD with multiple image uploads
- **Image Handling** - Polymorphic image relationships with delete functionality
- **SEO-Friendly URLs** - Automatic slug generation for all entities
- **Form Validation** - Server-side validation using Laravel Form Requests
- **Responsive Design** - Bootstrap 5 with custom styling

## Tech Stack

- **Backend**: Laravel 8, PHP 8.0+
- **Frontend**: Bootstrap 5, Blade Templates
- **Database**: MySQL

## Quick Start

1. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

2. **Database Setup**
   ```bash
   php artisan migrate
   ```

3. **Start Server**
   ```bash
   php artisan serve
   ```
