# Backend Setup Guide

## Overview
This guide outlines the essential steps to set up the Apache server with PHP on a Windows system and configure the backend for the project.

## Requirements
- Windows Operating System
- Apache HTTP Server
- PHP 8.x (with Thread Safe version for Apache compatibility)

## Installation Steps

### Apache
1. **Download Apache**: Get the latest version from Apache Lounge compatible with your Windows (x64 or x86).
2. **Install Apache**: Extract the files to `C:\Apache24` and install Apache as a Windows service using Command Prompt with Administrator privileges:
    ```
    httpd.exe -k install
    ```
3. **Configure Apache**: Set the `ServerName` directive in `httpd.conf` to `localhost`.

### PHP
1. **Download PHP**: Get the latest Thread Safe (TS) version from the [official PHP downloads page](https://windows.php.net/download).
2. **Install PHP**: Extract the PHP archive to `C:\php`.
3. **Configure PHP with Apache**: Update the `httpd.conf` with the path to your PHP installation and enable the PHP module:
    ```apache
    LoadModule php_module "C:/php/php8apache2_4.dll"
    PHPIniDir "C:/php"
    LoadModule rewrite_module modules/mod_rewrite.so

    DocumentRoot "C:/path/to/your/ProjectRoot"
    * Path to full project, not strictly backend *

    <Directory "C:/path/to/your/backend">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
    ```

### File Structure
Your project should have the following directory structure:
```
backend/
│
├── api/
│ ├── login.php
│ ├── search.php
│ ├── update.php
│ ├── delete.php
│ └── grade.php
├── .htaccess
└── index.php
```

### .htaccess Configuration
Place the `.htaccess` file in the `backend` directory with the following content:
```apache
RewriteEngine On
RewriteBase /backend/
RewriteCond %{QUERY_STRING} !(^|&)url= [NC]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]
```

### Testing the Setup

Test the PHP configuration by accessing http://localhost/info.php.

Test the API endpoints by accessing the defined routes, for example, http://localhost/backend/login.