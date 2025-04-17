# USIU-A Marketplace

## Overview

The **USIU-A Marketplace** is a web-based platform designed to facilitate buying and selling of products and services within the USIU-Africa community. The platform allows students and staff to list their products, browse available listings, and engage in the marketplace. This project is developed as part of the **APP 4080 - Collaborative Software Development** course at **USIU-Africa**.

---

## Technologies Used

The following technologies were used to develop this project:

- **PHP**: The backend of the application is built with PHP, handling the server-side logic, user authentication, and database interactions.
- **MySQL**: A relational database system used to store user data, product listings, and transaction information.
- **CSS**: Used for styling the web pages, ensuring a responsive and visually appealing user interface across all devices.


- **Tools**:
  - **Git**: Version control system for managing the source code.
  - **Visual Studio Code**: Code editor used during the development of this project.

---

## Project Features

- **Landing Page**: Introduction to the marketplace with a login section.
- **Product Listings**: Users can browse products and services listed by others in the marketplace.
- **Product Details Page**: Each product has its own page with details such as price, description, and contact information.
- **Become a Seller**: A page where users can register as sellers and list products for sale.
- **User Authentication**: Users can create accounts, login, and manage their profile.
- **Admin Panel**: An administrative interface for managing users and products.

---

Here's the updated **Installation** section reflecting that only PHP, MySQL, and CSS were used, removing any mention of Node.js, React, and npm:

---

## Installation

### Prerequisites

Before running the project locally, ensure the following are installed on your machine:

- **PHP**: Install PHP from [php.net](https://www.php.net/).
- **MySQL**: Install MySQL from [mysql.com](https://www.mysql.com/).

### Steps to Install and Run

1. **Clone the Repository**:
   Start by cloning the repository to your local machine:

   ```bash
   git clone https://github.com/robertkiplangat/mplace.git
   ```

2. **Set Up Backend (PHP and MySQL)**:

   - Place the PHP files in a directory accessible by your Apache or Nginx server.
   - Set up your MySQL database and import the provided SQL file to create the required tables. You can use the following command to create the database:
     ```bash
     mysql -u root -p
     CREATE DATABASE marketplace;
     ```
   - Import the schema:
     ```bash
     mysql -u root -p marketplace < path/to/database_schema.sql
     ```

3. **Configure Database Connection**:
   In the PHP files, ensure the correct database credentials are set in the configuration file to connect to your MySQL database.

4. **Start the PHP Server**:
   You can use the built-in PHP server for development by running the following command from the root project directory:
   ```bash
   php -S localhost:8000
   ```

5. **Start MySQL Server**:
   Ensure your MySQL server is running. You can start it with the following command:

   ```bash
   mysql.server start
   ```

6. **Access the Application**:
   Open a browser and go to `http://localhost:8000` to view the application.

---

## How to Use the Application

1. **Sign Up / Log In**:
   - Navigate to the landing page where you can either log in with your existing credentials or create a new account.
2. **Browse Products**:
   - Once logged in, you can browse the marketplace and view product details.
3. **Become a Seller**:

   - If you wish to sell products, navigate to the "Become a Seller" page, fill out the necessary details, and start listing your items.

4. **Admin Panel**:

   - If you're an admin, you can access the admin panel to manage users and products. This is a restricted area only accessible to admins.

5. **Add/Remove Products**:
   - As a seller, you can add new products, update existing ones, or remove products that are no longer available.

---

## Contributing

This project is developed as part of the **APP 4080 - Collaborative Software Development** course at **USIU-Africa**. Contributions are welcome. To contribute:

1. Fork the repository.
2. Create a new branch.
3. Make your changes.
4. Submit a pull request.

---

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## Acknowledgments

- Special thanks to the **APP 4080 - Collaborative Software Development** course instructors and peers for their guidance and collaboration.
- Thanks to **React.js**, **Bootstrap**, and **PHP** communities for providing the tools that made this project possible.

---

## Explanation:

- **Overview**: Brief description of the project and its purpose.
- **Technologies Used**: Lists all the technologies used in the development of the project.
- **Project Features**: Describes the core features and functionality of the marketplace.
- **Installation**: Details the steps required to get the project up and running, including prerequisites and setup.
- **How to Use**: Instructions for the users to interact with the application.
<<<<<<< HEAD
- **Contributing**: Encouragement for collaboration and contributions.
=======
- **Contributing**: Encouragement for collaboration and contributions widely.
>>>>>>> 21eb294 (Final commit)
- **License**: If applicable, mention the project license (MIT in this case).
- **Acknowledgments**: Credits and thanks for tools and communities used.
- **Contact**: Information for reaching out for questions or feedback.
