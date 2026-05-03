# 🍛 Bongs Biryani Premium Ordering Platform

<p align="center">
  A complete full-stack smart restaurant ordering and management platform built for modern food businesses.<br>
  Inspired by Swiggy, Zomato and QR-based in-store ordering ecosystems.
</p>

<p align="center">

![Laravel](https://img.shields.io/badge/Laravel-12-red?style=for-the-badge\&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3-blue?style=for-the-badge\&logo=php)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3-cyan?style=for-the-badge\&logo=tailwindcss)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge\&logo=mysql)
![Razorpay](https://img.shields.io/badge/Razorpay-Integrated-blueviolet?style=for-the-badge)
![Status](https://img.shields.io/badge/Project-Demo%20Ready-success?style=for-the-badge)

</p>

---

## 📌 Project Overview

**Bongs Biryani Premium Ordering Platform** is a feature-rich restaurant web application developed to digitize and automate complete restaurant ordering operations.

This platform supports:

* 🚚 Delivery Orders
* 🛍️ Takeaway Orders
* 🍽️ Dine-In Table Orders (QR Based)
* 💳 Secure Razorpay Online Payments
* 🧾 Kitchen Order Ticket (KOT) Printing
* 📦 Admin Restaurant Management Dashboard
* 🔴 Real-Time Order Tracking Simulation
* ⭐ Customer Ratings & Reviews
* 🎁 Coupons, Offers & Reward Ready Architecture

The system provides both:

### 👤 Customer Side Smart Ordering Experience

and

### 🛠️ Admin Side Restaurant Control Panel

inside one integrated Laravel ecosystem.

---

## ✨ Core Features

### 👨‍🍳 Customer Features

* Premium dark themed restaurant website
* User Registration / Login Authentication
* Guest cart + Local Storage cart persistence
* Smart Cart Drawer
* Delivery / Takeaway / Dine-In Order Mode Selection
* QR based dine-in order flow support
* Dynamic checkout based on order type
* Razorpay payment gateway integration
* COD / Pay at Counter / UPI / Card options
* Coupon application system
* Premium live order tracking page
* Floating global "Track Order" popup
* My Orders page
* Customer Profile page
* Ratings & Reviews after delivery
* Order history management

---

### 🛠️ Admin Features

* Premium restaurant admin dashboard
* Revenue analytics cards
* Order type segmentation
* Delivery / Takeaway / Dine-In tabs
* Real-time order status management
* Payment status monitoring
* Kitchen Order Ticket printable slips
* Category management
* Product/menu management
* Coupon management
* User management
* Export CSV order data
* Delivered order lock protection

---

### 📍 Smart Restaurant Workflow Supported

This project simulates a complete restaurant SaaS workflow:

Customer Scan QR ➜ Select Order Mode ➜ Add Food ➜ Checkout ➜ Payment ➜ Admin Receives Order ➜ Admin Updates Status ➜ Customer Tracks Order ➜ Delivery Complete ➜ Rating Submitted

---

## 🧰 Tech Stack Used

| Technology             | Purpose               |
| ---------------------- | --------------------- |
| Laravel 12             | Backend Framework     |
| PHP 8.3                | Server Side Logic     |
| MySQL                  | Database              |
| Blade Engine           | Templating            |
| Tailwind CSS           | UI Styling            |
| Alpine.js / JavaScript | Frontend Interactions |
| Razorpay API           | Payment Gateway       |
| Git + GitHub           | Version Control       |

---

## 📂 Major Modules

* Authentication Module
* Frontend Restaurant Website
* Cart & Checkout Module
* Razorpay Payment Verification
* Delivery/Takeaway/Dine-In Flow
* QR Table Ordering System
* Live Tracking System
* Ratings Module
* Admin Management Dashboard
* Kitchen Order Ticket System

---

## 🖼️ Project Screenshots

### 🏠 Homepage

<img width="1915" height="979" alt="image" src="https://github.com/user-attachments/assets/79757057-4ab9-40c8-bac2-5edbe37c8ca1" />

### 🍽️ Menu Ordering

<img width="1918" height="984" alt="image" src="https://github.com/user-attachments/assets/211be041-b46d-44f8-a15d-1a6a802d67f2" />


### 💳 Checkout Page

<img width="1919" height="986" alt="image" src="https://github.com/user-attachments/assets/2dd8c5f8-8933-4592-8661-2bc8f9b8b2ec" />


### 📦 Live Tracking Page

<img width="1916" height="985" alt="image" src="https://github.com/user-attachments/assets/d168bc77-507f-4d48-8188-4524949ec304" />


### 🛠️ Admin Dashboard

<img width="1916" height="1028" alt="image" src="https://github.com/user-attachments/assets/d950e0cc-c785-4193-8b73-0addc15856a4" />


---

## ⚙️ Installation Guide

```bash
git clone https://github.com/rohit1275/bongs-biryani-ordering-system.git
cd bongs-biryani-ordering-system
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run build
php artisan serve
```

---

## 🔐 Environment Variables Required

Add the following in `.env`:

```env
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=

RAZORPAY_KEY_ID=your_test_key
RAZORPAY_KEY_SECRET=your_test_secret
GOOGLE_MAPS_API_KEY=your_google_key_if_used
```

---

## 🎯 Academic Objective of this Project

This project was developed as a full-stack academic major project to demonstrate:

* Real world food ordering workflow automation
* Payment gateway integration
* Customer/admin role management
* QR based smart dine-in ordering
* Dynamic live tracking interfaces
* Restaurant ERP-like order management

---

## 👨‍💻 Developed By

**Rohit Choudhary**
B.Tech Computer Science Engineering
Lovely Professional University

---

## 📜 License

This project is developed for academic and demonstration purposes.

---

## ⭐ Repository Support

If you found this project useful, consider giving it a star ⭐
