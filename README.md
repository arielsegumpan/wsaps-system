# Web-portal E-commerce System for Automotive Shop

![FireShot Capture 089 - Products - WSAPS System -  wsaps-system test](https://github.com/user-attachments/assets/e32dc275-b593-46e2-8b75-1922a9d22fbf)

## 📌 Overview

The **Web-portal E-commerce System** is a full-featured online platform designed for automotive shops to manage and sell their products and services efficiently. The system provides users with a seamless shopping experience, order tracking, and an intuitive admin dashboard.

## 👨‍💻 Contributors

-   ✅ **Jairus Vincent Gale**
-   ✅ **Gian Carlo Joligon**
-   ✅ **Art Jamison**
-   ✅ **Lister**

## 🚀 Features

-   **User Management**: Secure authentication, role-based access control.
-   **Product Management**: Add, update, and categorize automotive products.
-   **Shopping Cart & Checkout**: Secure order processing with multiple payment gateways.
-   **Order Tracking**: Real-time order status updates.
-   **Inventory Management**: Stock level tracking and low-stock alerts.
-   **Review & Rating System**: Customers can provide feedback and rate products.
-   **Admin Dashboard**: Comprehensive analytics and reporting tools.

## 🛠️ Technologies Used

-   **Frontend**: HTML, CSS, JavaScript, Tailwind CSS
-   **Backend**: PHP (Laravel)
-   **Database**: MySQL
-   **Payment Integration**: PayPal, Stripe, Gcash, Debit/Credit Card
-   **Authentication**: JWT / Laravel Passport

## 📂 Installation

### 1️⃣ Clone the Repository

```sh
 git clone https://github.com/your-username/web-portal-ecommerce.git
```

### 2️⃣ Navigate to the Project Directory

```sh
 cd web-portal-ecommerce
```

### 3️⃣ Install Dependencies

```sh
 composer install
 npm install
```

### 4️⃣ Configure Environment Variables

Copy the example environment file and set up database credentials:

```sh
 cp .env.example .env
```

Edit `.env` file with your database details.

```sh
 DB_CONNECTION=mysql
 DB_HOST=127.0.0.1
 DB_PORT=3306
 DB_DATABASE=your_database_name
 DB_USERNAME=your_database_user
 DB_PASSWORD=your_database_password
```

### 5️⃣ Run Database Migrations

```sh
 php artisan migrate --seed
```

### 6️⃣ Start the Development Server

```sh
 php artisan serve
```

## 🧑‍💻 Usage

1. **Visit the application**: `http://127.0.0.1:8000`
2. **Register/Login** as a user or admin.
3. **Browse products**, add items to the cart, and proceed to checkout.
4. **Track orders** in the dashboard.
5. **Admins** can manage users, orders, and inventory from the admin panel.

## 🔒 Security Measures

-   Input validation and sanitization
-   Secure authentication & password hashing
-   CSRF protection and HTTPS enforcement
-   SQL Injection & XSS protection

## 💡 Contributing

Contributions are welcome! Follow these steps:

1. Fork the repository.
2. Create a feature branch: `git checkout -b feature-name`
3. Commit your changes: `git commit -m 'Add new feature'`
4. Push to your branch: `git push origin feature-name`
5. Open a Pull Request.

## 📜 License

This project is open-source and available under the [MIT License](LICENSE).

---

### 🌟 Show your support!

If you find this project useful, **give it a ⭐ on GitHub**!

Happy coding! 🚀
