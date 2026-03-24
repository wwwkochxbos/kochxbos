# KochxBos Website

Official website and admin panel for KochxBos Gallery, Amsterdam.

**Live site:** [kochxbos.com](https://kochxbos.com)

## Project Overview

This repository powers:

- Public website pages
- Artist and artwork listings
- Exhibition pages
- News and product management
- CMS-style page content

## Tech Stack

- PHP
- Filament admin (`/admin`)
- MySQL
- Tailwind CSS + Vite

## Local Development

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
npm run dev
```

## Admin Panel

Use `/admin` to manage artists, artworks, exhibitions, news, products, and pages.

## Gallery Address

Eerste Anjeliersdwarsstraat 36, 1015NR Amsterdam, The Netherlands
