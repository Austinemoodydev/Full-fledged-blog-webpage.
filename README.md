Blog Webpage Project
importation of sql
Install XAMPP and ensure Apache and MySQL are running.

Access to phpMyAdmin.


Steps

1. Start XAMPP: Launch Apache and MySQL.


2. Open phpMyAdmin: Go to http://localhost/phpmyadmin.


3. Create Database:

Click "Databases."

Name it blog and set collation to utf8mb4_general_ci.



4. Import SQL File:

Select the new database.

Go to "Import," upload blog.sql.sql, and click Go.



5. Verify Setup: Check tables like users, posts, and comments under "Structure."



Connect Project to Database

Update connection if error occurs

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";


Run the Project

Place the project in htdocs.

Access via http://localhost/blogwebpage/index.php.


Troubleshooting

Ensure database credentials match.

Re-import SQL if errors occur.


Overview

This project is a fully functional blogging platform built using HTML, CSS, PHP, and MySQL, with CDN for icons. The platform includes user roles (Admin and Contributor), secure authentication, pagination, a search bar, and the ability for users to add comments to blog posts.

Features

Admin Dashboard:

Manage blog posts (delete/edit posts).

Edit user profiles.

View blog analytics.


Main Blog Page:

Display all blog posts with pagination.

Allow users to add comments to posts.

Include a search bar to quickly find specific posts.


Secure Authentication:

Passwords are hashed for secure login and registration.


User Roles:

Admin: Full access to the dashboard to manage posts, users, and view analytics.

Contributor: Limited access to create and save posts.
Pages and Functionalities

1. index.php

Displays all published blog posts on the main blog page.

Features:

Pagination: Automatically divides blog posts into pages for easy navigation.

Search Bar: Allows users to search for posts by title or content.

Add Comments: Users can comment on individual posts.



2. dashboard.php

The admin dashboard where administrators can:

Delete posts.

Edit posts.

Edit user profiles.

View blog analytics.


Access:
Only accessible to users registered as Admin.
Admins must log in first to access this page.


3. register.php

Used to register new users as either:

Admin: Full access to the platform.

Contributor: Can create and save posts.


Password Hashing: User passwords are securely stored using hashing.


4. savepost.php

Allows contributors or admins to create and save new blog posts.


5. add_comment.php

Handles the functionality for users to add comments to blog posts.

Comments are associated with specific posts in the database.


6. Pagination

Automatically implemented in index.php to divide blog posts across multiple pages.

Users can navigate through pages using next/previous buttons.


7. Search Bar

Allows users to search blog posts by keywords in titles or content.


8. SQL File (blog.sql)

This file contains the structure and data of the database used in the project.

Includes tables for:

Users.

Blog posts.

Comments.


Import this file into your MySQL database to set up the project.



---

How to Use

Database Setup

1. Open phpMyAdmin in XAMPP.


2. Create a new database (e.g., blogdatabase).


3. Import the provided blog.sql file:

Go to the Import tab.

Choose the blog.sql file.

Click Go to import the database.




Run the Project

1. Place the project folder (blogwebpage) inside the htdocs directory in your XAMPP installation.


2. Start Apache and MySQL in XAMPP.


3. Open your browser and navigate to:

http://localhost/blogwebpage/register.php to register a new user.

http://localhost/blogwebpage/login.php to log in as a user.

http://localhost/blogwebpage/index.php to view the blog.





---

Technologies Used

Frontend: HTML, CSS (custom styles and CDN-based icons).

Backend: PHP.

Database: MySQL.

Security: Passwords hashed for secure authentication.



---

Folder Structure

/blogwebpage
|-- images/                # Contains image files for the blog
|-- add_comment.php        # Handles user comments
|-- blog.sql               # Database file
|-- create.css             # Styles for post creation page
|-- create.php             # Page for creating blog posts
|-- dashboard.css          # Styles for the admin dashboard
|-- dashboard.php          # Admin dashboard for managing posts and users
|-- delete_post.php        # Handles post deletion
|-- edit_post.php          # Allows editing of existing posts
|-- edit_user.php          # Allows editing of user details
|-- index.css              # Styles for the main blog page
|-- index.php              # Main blog page for viewing posts
|-- login.css              # Styles for login page
|-- login.php              # Login functionality
|-- register.css           # Styles for registration page
|-- register.php           # User registration
|-- register_process.php   # Handles the registration process
|-- save_post.php          # Saves blog posts


---

Usage Notes

Roles:
Users must specify their role (Admin or Contributor) during registration. Only Admins can access dashboard.php.

Admin Access:
After registering as an Admin, navigate to dashboard.php to manage posts, users, and analytics.

Pagination:
Blog posts are paginated to improve user experience when there are many posts.

Search Bar:
Quickly locate blog posts by keywords in the title or content.

Comments:
Users can add comments to posts, which are stored in the database.



---

Future Improvements

Implement a user profile section for contributors.

Add the ability to like and share posts on social media.

Include an option for admins to manage comments (delete inappropriate ones).



---

Feel free to reach out in whatsapp +254115650092or mail me strating with project at moodyaustine477@gmail.com
 
