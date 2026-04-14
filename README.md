# PropBook

A real estate property booking platform where owners list properties and visitors schedule viewings with integrated calendar and payments.

## Stack

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white)](https://laravel.com)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)](https://mysql.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Vite](https://img.shields.io/badge/Vite-646CFF?style=flat-square&logo=vite&logoColor=white)](https://vitejs.dev)
[![Stripe](https://img.shields.io/badge/Stripe-008CDD?style=flat-square&logo=stripe&logoColor=white)](https://stripe.com)

## Features

- Property listings with images and pricing
- Booking system with interactive calendar (9 AM – 6 PM slots)
- Stripe payment integration
- Role-based access: owners vs visitors
- Dark theme UI, mobile-first

## Setup

```bash
git clone https://github.com/Anwaroxxx/PropBook.git
cd PropBook
composer install && npm install
cp .env.example .env
php artisan key:generate
# Configure DB and Stripe keys in .env
php artisan migrate --seed
php artisan storage:link
npm run build
php artisan serve
```

## Testing

```bash
php artisan test
```
