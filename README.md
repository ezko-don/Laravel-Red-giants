# 🛍️ Mini Shop Lite - Laravel E-Commerce Platform

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?logo=mysql&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC34A?logo=alpine.js&logoColor=white)

**A modern, full-stack e-commerce platform built with Laravel 11, featuring role-based authentication, advanced product management, and seamless checkout experience.**

[![Open in GitHub Codespaces](https://github.com/codespaces/badge.svg)](https://codespaces.new/ezko-don/Laravel-Red-giants?quickstart=1)

[🚀 Live Demo](#live-demo) • [📖 Documentation](#documentation) • [🎯 Features](#features) • [⚡ Quick Start](#quick-start)

</div>

---

## ✨ Features

### 🔐 **Authentication & Authorization**
- **Laravel Breeze** integration with Alpine.js
- **Role-based access control** (Admin/Customer)
- **Middleware protection** with custom AdminMiddleware
- **Policy-based authorization** for resource access

### 👨‍💼 **Admin Panel**
- **📊 Comprehensive Dashboard** with real-time statistics
- **📦 Product CRUD** with image upload and stock management
- **📈 Sales Analytics** and revenue tracking
- **⚠️ Low Stock Alerts** with automated notifications
- **📋 Order Management** and customer insights

### 🛒 **Customer Experience**
- **🔍 Advanced Search & Filtering** by name, price, and availability
- **🛍️ Smart Shopping Cart** with quantity controls
- **💳 Streamlined Checkout** process
- **📱 Responsive Design** optimized for all devices
- **🎨 Modern UI** with smooth animations and hover effects

### 🔌 **RESTful API**
- `GET /api/products` - Public product listing with pagination
- `POST /api/orders` - Create orders (authenticated)
- **JSON responses** with proper error handling
- **Authentication** via Laravel Sanctum

### 🎯 **Advanced Features**
- **📸 Image Upload** with storage linking
- **📊 Database Transactions** for order processing
- **🔄 Real-time Stock Updates** during checkout
- **📱 Mobile-First Design** with Tailwind CSS
- **⚡ Performance Optimized** with proper indexing

---

## 🚀 Quick Start

### Prerequisites

Ensure you have the following installed:
- **PHP** 8.1 or higher
- **Composer** 2.x
- **Node.js** 16.x or higher
- **MySQL** 8.0 or higher
- **Git** (latest version)

### ⚡ Installation (Copy-Paste Ready)

```bash
# 1. Clone the repository
git clone https://github.com/ezko-don/Laravel-Red-giants.git
cd Laravel-Red-giants

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies
npm install

# 4. Environment setup
cp .env.example .env
php artisan key:generate

# 5. Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=minishop
DB_USERNAME=root
DB_PASSWORD=your_password

# 6. Create database
mysql -u root -p -e "CREATE DATABASE minishop;"

# 7. Run migrations and seed data
php artisan migrate
php artisan db:seed

# 8. Create storage symlink
php artisan storage:link

# 9. Build assets
npm run build

# 10. Start development server
php artisan serve
```

🎉 **Visit http://localhost:8000 to see your application!**

---

## 👥 Demo Accounts

The application comes with pre-configured demo accounts:

### 🔑 **Admin Account**
- **Email:** `admin@demo.com`
- **Password:** `password`
- **Access:** Full admin panel with product management

### 🛒 **Customer Account**
- **Email:** `customer@demo.com`
- **Password:** `password`
- **Access:** Product browsing, cart, and checkout

---

## 📊 Database Schema

```sql
-- Core Tables
users (id, name, email, password, role: admin/customer)
products (id, name, price, stock, description, image)
orders (id, user_id, total_amount, status, created_at)
order_items (id, order_id, product_id, quantity, price)
carts (id, user_id, product_id, quantity)
```

### 🔗 Relationships
- **Users** → Orders (1:many)
- **Orders** → OrderItems (1:many)
- **Products** → OrderItems (1:many)
- **Users** → Carts (1:many)

---

## 🎯 Key Routes

### 🌐 **Web Routes**
```php
// Public
GET  /                          # Product catalog (home)
GET  /products                  # Product listing
GET  /products/{product}        # Product details

// Admin (auth + admin middleware)
GET  /admin/dashboard           # Admin dashboard
GET  /admin/products            # Product management
POST /admin/products            # Create product
PUT  /admin/products/{id}       # Update product
DELETE /admin/products/{id}     # Delete product

// Customer (auth middleware)
GET  /cart                      # Shopping cart
POST /cart/add/{product}        # Add to cart
GET  /checkout                  # Checkout page
POST /checkout                  # Process order
GET  /orders                    # Order history
```

### 🔌 **API Routes**
```php
// Public API
GET  /api/products              # Products listing (paginated)
GET  /api/products/{id}         # Product details

// Authenticated API (Sanctum)
POST /api/orders                # Create order
GET  /api/orders                # User orders
GET  /api/orders/{id}           # Order details
```

---

## 🎨 UI Components

### 🖥️ **Admin Dashboard**
- **Real-time Statistics Cards**
- **Revenue Charts** (last 7 days)
- **Recent Orders** overview
- **Top Selling Products** ranking
- **Low Stock Alerts** with direct links to restock

### 🛍️ **Product Catalog**
- **Advanced Search Bar** with real-time filtering
- **Price Range Filters** with min/max inputs
- **Sort Options** (latest, name, price, stock)
- **Responsive Product Grid** with hover animations
- **Stock Status Badges** with color coding

### 🛒 **Shopping Cart**
- **Quantity Selectors** with stock validation
- **Real-time Subtotal** calculations
- **Order Summary Sidebar** with breakdown
- **Security Badges** for trust indicators
- **Continue Shopping** suggestions

---

## 🔧 Technical Architecture

### 🏗️ **Backend (Laravel 11)**
- **MVC Architecture** with resource controllers
- **Eloquent ORM** with proper relationships
- **Form Request Validation** with custom rules
- **Policy-based Authorization** for security
- **Database Transactions** for data integrity
- **Custom Middleware** for role checking

### 🎨 **Frontend (Blade + Alpine.js)**
- **Laravel Breeze** authentication scaffolding
- **Tailwind CSS** for modern styling
- **Alpine.js** for interactive components
- **Responsive Design** mobile-first approach
- **Progressive Enhancement** with JavaScript

### 📊 **Database (MySQL)**
- **Proper Indexing** for performance
- **Foreign Key Constraints** for data integrity
- **Seeders** with realistic demo data
- **Migrations** with rollback support

---

## 🧪 API Examples

### 📦 **Get Products** (Public)
```bash
curl -X GET "http://localhost:8000/api/products" \
  -H "Accept: application/json"
```

```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "name": "Smartphone X1",
        "price": "899.99",
        "stock": 50,
        "description": "Latest flagship smartphone..."
      }
    ],
    "total": 10
  }
}
```

### 🛍️ **Create Order** (Authenticated)
```bash
curl -X POST "http://localhost:8000/api/orders" \
  -H "Authorization: Bearer YOUR_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{
    "items": [
      {"product_id": 1, "quantity": 2},
      {"product_id": 3, "quantity": 1}
    ]
  }'
```

```json
{
  "success": true,
  "message": "Order created successfully",
  "data": {
    "id": 15,
    "total_amount": "2099.97",
    "status": "pending",
    "created_at": "2025-10-05T12:00:00Z"
  }
}
```

---

## 📈 Performance Features

### ⚡ **Optimizations**
- **Eager Loading** to prevent N+1 queries
- **Database Indexing** on frequently searched columns
- **Image Optimization** with proper storage handling
- **Pagination** for large datasets
- **Caching** for static content

### 🔒 **Security**
- **CSRF Protection** on all forms
- **SQL Injection Prevention** via Eloquent ORM
- **XSS Protection** with Blade templating
- **Input Validation** with Form Requests
- **Role-based Access Control** with policies

---

## 🚀 Deployment

### 📦 **Production Setup**
```bash
# 1. Environment
APP_ENV=production
APP_DEBUG=false

# 2. Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Build assets
npm run build

# 4. Set permissions
chmod -R 755 storage bootstrap/cache
```

### 🌐 **Server Requirements**
- **PHP** 8.1+ with extensions: BCMath, Ctype, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML
- **MySQL** 8.0+ or equivalent
- **Nginx/Apache** with proper URL rewriting
- **SSL Certificate** for production use

---

## 📝 Assessment Compliance

### ✅ **All Requirements Met**

| Requirement | Status | Implementation |
|-------------|--------|----------------|
| Auth & Roles | ✅ | Laravel Breeze + Custom middleware |
| Product CRUD | ✅ | Resource controllers + Form requests |
| Cart & Checkout | ✅ | Database-driven with transactions |
| API Endpoints | ✅ | RESTful with JSON responses |
| Validation | ✅ | Server-side Form Requests |
| UI Quality | ✅ | Tailwind CSS + responsive design |
| Demo Data | ✅ | Comprehensive seeders |
| SQL Queries | ✅ | Optimized with proper relationships |

### 🏆 **Bonus Features**
- **Advanced Search & Filtering** 🔍
- **Admin Dashboard with Analytics** 📊
- **Modern UI with Animations** ✨
- **Mobile-First Responsive Design** 📱
- **Real-time Stock Management** 📦
- **Comprehensive API Documentation** 📚

---

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

---

## 📄 License

This project is built for educational and assessment purposes. 

---

<div align="center">

**Built with ❤️ using Laravel 11 + Blade + Alpine.js**

**Perfect for Laravel Full-Stack Assessment** 🎯

[⬆ Back to Top](#-mini-shop-lite---laravel-e-commerce-platform)

</div>