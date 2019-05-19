# EasyKey Meal Debit System


![Main Page](/supp_images/homepage.png)  
**Project for - Software Development Project - **  
**Project Duration - January - April 2019 **  
***
Easkey Key Meal Debit system is an online E-Wallet website that allows users to register new accounts to purchase food an beverages online. This website was made by using HTML, JavaScript and CSS with PHP covering the backend.

## Requirements
* Any IDE of your choice
* PHPMyadmin
* Access to Local host

## Installation
I. Clone the repo by using the following command
``` bash
$ git clone https://github.com/adib1996/EasyKey_meal_debit_system.git
$ cd EasyKey_Meal_Debit_System
```
II. Ensure your local server management software is operational (For this project I used: MAMP), load the entire EasyKey_Meal_Debit_System folder into the localhost directory.

III. Create a database in your phpMyAdmin. Ensure the name is "sdpdatabase".

![creating database](/supp_images/new_database.png)


IV. Import the sql file inside the directory ```sdpdatabase.sql``` into the newly created database.

![import_database](/supp_images/import_database.png)

V. Change the database configurations in the processingforms >> ```dbconnection.php``` file, as shown below:
``` php
<php
$dbServername="localhost";
$dbUserName="root";
$dbPassword="root";
$dbName="sdpdatabase";

  $conn = mysqli_connect($dbServername,$dbUserName,$dbPassword,$dbName);

  if (!$conn){
    die("Connection Failed: " . mysqli_connect_error());
  }
  ?>
```

VI. View the project by accessing localhost, EasyKey_Meal_Debit_System >> webpages >> index.php

# Additonal Images

![Menu](/supp_images/menu.png)
