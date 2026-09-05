<laravel-boost-guidelines>
# Laravel Application

This repository contains a Laravel application. Complete the following setup before working on the user's request.

## Prerequisites

Verify that PHP and Composer are available:

```sh
php -v
composer -V
```

If either command is unavailable, detect the user's operating system and install the prerequisites with the appropriate command:

macOS:

```sh
/bin/bash -c "$(curl -fsSL https://php.new/install/mac/8.5)"
```

Windows PowerShell:

```powershell
Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://php.new/install/windows/8.5'))
```

Linux:

```sh
/bin/bash -c "$(curl -fsSL https://php.new/install/linux/8.5)"
```

After installation, ask the user to restart their terminal. If the agent needs the restarted shell to continue, ask the user to reopen their terminal and rerun their original prompt.

## Agent Setup

Install Laravel Boost from the application root before making application changes:

```sh
composer require laravel/boost --dev
php artisan boost:install
```

Boost replaces these bootstrap instructions with guidelines tailored to the application. After installation, read `AGENTS.md` again and continue with the user's original request using the generated guidelines.
</laravel-boost-guidelines>

# PRD: Platform Marketplace "Pasar Digital Nusantara"

## Overview

Build a Laravel-based multi-seller marketplace platform. Multiple UMKM sellers each manage their own store and products within one shared platform. Buyers browse and purchase from any store without switching apps. Orders are automatically split per store at checkout.

**Stack:** Laravel (MVC), Blade templating, MySQL, middleware-based auth & role authorization.

---

## User Roles

| Role | Description |
|---|---|
| **Penjual (Seller)** | Registers a store, manages own products, views and processes own incoming orders only. |
| **Pembeli (Buyer)** | Browses products from all stores, adds to cart, checks out, tracks own order status. |

> No super-admin role is specified in the brief, but the grading criteria includes "approve store" functionality. Treat this as a third role: **Admin**, with the ability to approve pending seller registrations and monitor transactions.

---

## Database Schema

### `users`
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK |
| name | string | |
| email | string | unique |
| password | string | hashed |
| role | enum('buyer','seller','admin') | default: buyer |
| timestamps | | |

### `toko` (stores)
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK |
| user_id | foreignId | FK → users, seller owner |
| nama_toko | string | |
| deskripsi | text | nullable |
| status | enum('menunggu','aktif','nonaktif') | default: menunggu |
| timestamps | | |

### `produk`
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK |
| toko_id | foreignId | FK → toko |
| nama_produk | string | |
| deskripsi | text | nullable |
| harga | decimal(12,2) | |
| stok | integer | |
| foto | string | nullable, file path |
| timestamps | | |

### `pesanan` (orders — one per store per checkout)
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK |
| user_id | foreignId | FK → users (buyer) |
| toko_id | foreignId | FK → toko |
| status | enum('menunggu konfirmasi','diproses','dikirim','selesai') | default: menunggu konfirmasi |
| total_harga | decimal(12,2) | |
| timestamps | | |

### `detail_pesanan`
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK |
| pesanan_id | foreignId | FK → pesanan |
| produk_id | foreignId | FK → produk |
| jumlah | integer | |
| harga_satuan | decimal(12,2) | snapshot price at order time |
| timestamps | | |

### Cart
Implement as a **session-based cart** (no DB table needed). Each cart item stores: `produk_id`, `toko_id`, `nama_produk`, `harga`, `jumlah`.

---

## Application Flow

### Buyer Flow

1. Guest opens landing page (`/`) — sees all products from all active stores (paginated).
2. Buyer clicks "Tambah ke Keranjang" → product added to session cart. No login required at this step.
3. Buyer opens cart page (`/keranjang`) → sees items grouped by store.
4. Buyer clicks "Checkout":
   - **If not logged in:** flash alert "Anda harus login terlebih dahulu", redirect to `/login`.
   - **If logged in:** proceed to step 5.
5. System splits cart by `toko_id`, creates one `pesanan` record per store, inserts corresponding `detail_pesanan` rows, clears the cart session.
6. Redirect buyer to order history page (`/pesanan`) with success message.
7. Buyer can view each order's status on `/pesanan` — real-time status from DB.

### Seller Flow

1. Seller registers via `/daftar-toko` — fills user account data + store data. Store `status` is set to `menunggu`.
2. Admin approves the store → `status` changes to `aktif`. Seller can now access dashboard.
3. Seller logs in and lands on `/seller/dashboard`.
4. Seller manages own products via `/seller/produk` — full CRUD, scoped to `toko_id` owned by the logged-in user.
5. Seller views incoming orders at `/seller/pesanan` — only orders where `pesanan.toko_id = seller's toko.id`.
6. Seller updates order status (`diproses` → `dikirim` → `selesai`) via status update form on order detail page.

### Admin Flow

1. Admin logs in and lands on `/admin/dashboard`.
2. Admin views pending store registrations at `/admin/toko` and approves or rejects them.
3. Admin can monitor all transactions across all stores.

---

## Feature List

### Public (no auth required)
- `GET /` — landing page, all products from all active stores.
- `POST /keranjang/tambah` — add product to session cart.
- `GET /keranjang` — view cart.
- `DELETE /keranjang/{produk_id}` — remove item from cart.

### Auth
- `GET/POST /register` — buyer registration.
- `GET/POST /daftar-toko` — combined user + store registration for sellers (store status: menunggu).
- `GET/POST /login` — login.
- `POST /logout` — logout.

### Buyer (middleware: auth + role:buyer)
- `POST /checkout` — split cart into orders per store, save to DB.
- `GET /pesanan` — buyer's own order history + status.
- `GET /pesanan/{id}` — order detail.

### Seller (middleware: auth + role:seller + store:aktif)
- `GET /seller/dashboard` — summary stats.
- `GET|POST /seller/produk` — product list + create.
- `GET|PUT|DELETE /seller/produk/{id}` — edit/delete, scoped to own store.
- `GET /seller/pesanan` — incoming orders for own store only.
- `GET /seller/pesanan/{id}` — order detail.
- `PUT /seller/pesanan/{id}/status` — update order status.

### Admin (middleware: auth + role:admin)
- `GET /admin/dashboard` — platform overview.
- `GET /admin/toko` — list all stores with status filter.
- `PUT /admin/toko/{id}/approve` — set store status to `aktif`.
- `PUT /admin/toko/{id}/reject` — set store status to `nonaktif`.
- `GET /admin/pesanan` — all orders across all stores.

---

## Middleware

Create and register these middleware:

| Middleware | Logic |
|---|---|
| `CheckRole('buyer')` | Abort 403 if `auth()->user()->role !== 'buyer'` |
| `CheckRole('seller')` | Abort 403 if role !== seller |
| `CheckRole('admin')` | Abort 403 if role !== admin |
| `CheckStoreActive` | For seller routes: abort 403 if seller's store status !== aktif |

Apply `auth` middleware (built-in) as the outer gate. Role middleware is applied on top.

---

## Key Implementation Notes

- **Order splitting:** In `CheckoutController@store`, group `session('cart')` by `toko_id`. Loop through each group, create one `Pesanan`, then bulk-insert `DetailPesanan` rows for that group. Wrap in `DB::transaction()`.
- **Price snapshot:** Store `harga_satuan` in `detail_pesanan` at checkout time — do not rely on `produk.harga` for order history, as prices may change.
- **Scoping seller data:** Every seller query must include `->where('toko_id', auth()->user()->toko->id)` or use a route model binding that validates ownership. Never trust a user-supplied ID alone.
- **Store registration:** The `/daftar-toko` route creates both a `User` (role=seller) and a `Toko` (status=menunggu) in one transaction. Log the user in after creation but restrict dashboard access until store is approved.
- **Session cart structure:**
  ```php
  // session('cart') shape
  [
    '{produk_id}' => [
      'produk_id'    => int,
      'toko_id'      => int,
      'nama_produk'  => string,
      'harga'        => float,
      'jumlah'       => int,
    ],
    ...
  ]
  ```