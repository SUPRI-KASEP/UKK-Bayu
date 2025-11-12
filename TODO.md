# TODO: Implement Admin Panel Features

## 1. Create Migrations
- [x] Create migration for `toko` table (id, nama, alamat, created_at, updated_at)
- [x] Create migration for `kategori` table (id, nama, created_at, updated_at)
- [x] Create migration for `produk` table (id, nama, harga, deskripsi, kategori_id, toko_id, created_at, updated_at)

## 2. Create Models
- [x] Create Toko model with fillable attributes
- [x] Create Kategori model with fillable attributes
- [x] Create Produk model with fillable attributes and relationships (belongsTo kategori, belongsTo toko)

## 3. Create Controllers
- [x] Create AdminTokoController with CRUD methods (index, create, store, show, edit, update, destroy)
- [x] Create AdminKategoriController with CRUD methods
- [x] Create AdminProdukController with CRUD methods
- [x] Create AdminUserController with CRUD methods (using existing User model)

## 4. Create Views
- [x] Create admin/toko/index.blade.php, create.blade.php, edit.blade.php
- [x] Create admin/kategori/index.blade.php, create.blade.php, edit.blade.php
- [x] Create admin/produk/index.blade.php, create.blade.php, edit.blade.php
- [x] Create admin/user/index.blade.php, create.blade.php, edit.blade.php

## 5. Update Routes
- [x] Add resource routes for admin/toko, admin/kategori, admin/produk, admin/user in routes/web.php

## 6. Update Sidebar Links
- [x] Update resources/views/admin/beranda.blade.php to link sidebar items to respective routes

## 7. Run Migrations
- [x] Execute php artisan migrate to create tables
