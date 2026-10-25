# 🚚 ExpressVan — On-Demand Moving & Van Logistics Platform

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-PHP-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/Bootstrap-5.x-7952B3?style=for-the-badge&logo=bootstrap" alt="Bootstrap 5">
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql" alt="MySQL">
  <img src="https://img.shields.io/badge/Stripe-Payments-635BFF?style=for-the-badge&logo=stripe" alt="Stripe">
</p>

---

## 📖 What is ExpressVan?

**ExpressVan** is an enterprise-grade **logistics, removals, and man-with-a-van dispatch platform** built on **PHP & Laravel**. Designed for transport operators, courier companies, and moving services, ExpressVan provides an automated end-to-end booking experience from real-time distance-based pricing to driver dispatch and payment collection.

---

## 🎯 Why ExpressVan? Problem & Solution

| The Challenge | How ExpressVan Solves It |
| :--- | :--- |
| **Manual Quotation Inefficiencies:** Customers traditional have to call or email movers for quotes, creating long wait times and lost bookings. | Implements a **Dynamic Instant Quote Wizard** calculating accurate pricing based on pickup/destination coordinates, van volume required, helpers needed, and stairs. |
| **Complex Route & Mileage Calculations:** Estimating accurate travel times and tolls manually often leads to under-charging. | Integrates map routing APIs to calculate exact driving distances, duration, and access surcharges automatically. |
| **Fragmented Dispatch Management:** Managing drivers via phone calls and spreadsheets causes scheduling conflicts and delays. | Features an administrative dispatch console where bookings, driver schedules, vehicle assignments, and job statuses are coordinated seamlessly. |

---

## 🌟 Key Features

### 📦 Customer Booking & Instant Quote Wizard
- **Step-by-Step Moving Estimator:** Select pickup/dropoff postcodes, property types, floor levels (elevators/stairs), and inventory size.
- **Fleet Selection:** Choose between multiple van capacities (Small Van, Medium Wheelbase, Long Wheelbase, Luton Van with Tail Lift).
- **Service Add-ons:** Add extra helpers, packing materials, disassembly/assembly assistance, and flexible transit insurance.
- **Online Checkout:** Secure payments via credit/debit card powered by **Stripe**.
- **Self-Service Order Tracking:** Real-time job updates, invoice downloads, and booking status lookups.

### 🚗 Fleet & Driver Dispatch Engine
- **Driver Management:** Profile tracking, license verification, vehicle assignments, and availability calendars.
- **Job Dispatching:** Assign moving jobs to specific drivers with automated route directions and inventory summaries.
- **Fulfillment Status Pipeline:** Track shipments through Pending, Dispatched, In-Transit, and Completed stages.

### 🛡️ Administrative Command Suite
- **Revenue Analytics & Reporting:** Track daily booking volume, total gross margins, driver payouts, and seasonal moving trends.
- **Custom Pricing Rules:** Configure base rates, mileage multipliers, hourly helper fees, peak-hour surcharges, and congestion zone fees.
- **Automated Communication:** Automated customer notifications, booking confirmation emails, and invoice delivery.

---

## 🛠️ Technical Stack

- **Backend:** Laravel / Core PHP (Modular MVC Architecture inside `@core`)
- **Database:** MySQL 8.0+ / MariaDB (Optimized Relational Schema)
- **Frontend:** Bootstrap 5, Vanilla JavaScript, jQuery, CSS3
- **Payment Gateways:** Stripe API, Flutterwave
- **Mapping & Routing:** Google Maps / OpenStreetMap API integrations

---

## 📦 Local Installation & Setup

### 1. Prerequisites
- PHP 8.1 or 8.2 with `pdo_mysql`, `curl`, `mbstring`, `fileinfo` extensions
- Composer 2.x
- MySQL 5.7+ or MariaDB

### 2. Setup Project
```bash
# Clone the repository
git clone https://github.com/ranaumairnawaz/ExpressVan.git
cd ExpressVan

# Navigate to backend core
cd @core
composer install
cp .env.example .env
php artisan key:generate
```

### 3. Database Configuration
Update database credentials in `@core/.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=expressvan_db
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Run Migrations & Launch
```bash
php artisan migrate --seed
php artisan serve
```

---

## 👨‍💻 Author
**Rana Umair Nawaz**  
- [GitHub Profile](https://github.com/ranaumairnawaz)  
- [LinkedIn Profile](https://linkedin.com/in/ranaumairnawaz)
