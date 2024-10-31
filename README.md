<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Pizza Ordering Web App - RapidEaTs

Welcome to the RapidEaTs pizza app! This application allows users to browse pizza products, manage their cart, and proceed to checkout. Admins can manage the product inventory, handle orders, and maintain user accounts through an intuitive admin panel.

## Table of Contents

- [Features](#features)
- [Technologies Used](#technologies-used)
- [Getting Started](#getting-started)
- [Running the Application](#running-the-application)
- [Using Docker](#using-docker)
- [Kubernetes Setup](#kubernetes-setup)
- [Helm Chart](#helm-chart)
- [Contributing](#contributing)
- [License](#license)

## Features

- User authentication and account management
- Browse and search for pizza products
- Add products to the cart
- Checkout process for placing orders
- Admin panel for managing products and orders
- CRUD operations for product management
- Dockerized application for easy deployment
- Kubernetes support for scalability
- Helm chart for simplified deployment and management

## Technologies Used

- Laravel (PHP Framework)
- MySQL (Database)
- Docker (Containerization)
- Kubernetes (Orchestration)
- Helm (Package Manager for Kubernetes)
- Tailwind CSS (Styling)

## Getting Started

To get started with the Pizza Ordering Web App, clone the repository to your local machine:

## Prerequisites
- PHP 8.x
- Composer: Dependency manager for PHP
- Node.js and npm: For managing frontend dependencies
- Docker: For containerization
- Kubernetes: For orchestration (optional)

## Running the Application

- Using Docker Compose
- Build and run the Docker containers in detached mode:
- Recommended to use WSL - Ubuntu ^20.04.6 

```bash
git clone https://github.com/DSelimov/rapideats-fast-food.git

# Build and run the Docker containers in detached mode
docker-compose up -d --build

#Check that the containers are running
docker-compose ps

#make sure that mysql is configured in .env file(db,host,port,password)
cp .env.example .env 

# Run migrations
docker-compose exec app php artisan migrate

```

## .ENV example
- DB_CONNECTION=mysql
- DB_HOST=localhost
- DB_PORT=3306
- DB_DATABASE= <db_name> - rapid-eats
- DB_USERNAME= <db_username> - root
- DB_PASSWORD= <db_password>

## Clear cache

1) php artisan config:clear
2) php artisan cache:clear
3) php artisan route:clear
4) php artisan view:clear


## Fixing issues

### Possible issues you may face

- install dependencies: run - composer install inside the container /var/www/
- build issues: run - npm run build
- vite plugin issues: run - npm install vite laravel-vite-plugin then again run - npm run build
- manifest.json issue: run  - mv /var/www/public/build/.vite/manifest.json /var/www/public/build


