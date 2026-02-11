# Production Deployment Fix Guide

## Issues Found
1. **base_url** is set to `http://localhost/hrmx/` instead of production URL
2. **Database configuration** needs to be updated for production
3. **Environment** should be set to 'production'

## Files That Need to Be Updated on Server

### 1. Update `application/config/config.php`

**Line 26:** Change:
```php
$config['base_url'] = 'http://localhost/hrmx/';
```

**To:**
```php
$config['base_url'] = 'https://hrmx.dashandots.com/';
```

### 2. Update `application/config/database.php`

Update the database credentials for your production server:
```php
$db['default'] = array(
	'dsn'	=> '',
	'hostname' => "localhost",  // Usually 'localhost' on shared hosting
	'username' => "YOUR_DB_USERNAME",  // Your production database username
	'password' => "YOUR_DB_PASSWORD",  // Your production database password
	'database' => "YOUR_DB_NAME",  // Your production database name (likely 'hrmx' or similar)
	'dbdriver' => 'mysqli',
	// ... rest of config
);
```

### 3. Update `index.php`

**Line 57:** Change:
```php
define('ENVIRONMENT', 'development');
```

**To:**
```php
define('ENVIRONMENT', 'production');
```

## Quick Fix Script (Run via SSH)

You can run these commands via SSH to update the files:

```bash
cd ~/public_html  # or wherever your files are located

# Update base_url
sed -i "s|http://localhost/hrmx/|https://hrmx.dashandots.com/|g" application/config/config.php

# Update environment to production
sed -i "s|define('ENVIRONMENT', 'development');|define('ENVIRONMENT', 'production');|g" index.php

# Note: You'll need to manually update database.php with your actual credentials
```

## Manual Steps

1. **SSH into your server**
2. **Navigate to your public_html directory**
3. **Edit `application/config/config.php`** - Update base_url
4. **Edit `application/config/database.php`** - Update database credentials
5. **Edit `index.php`** - Change ENVIRONMENT to 'production'
6. **Clear any cache** (if applicable)
7. **Test the login**

## Verification

After making changes, test:
- Login page loads correctly
- No CORS errors in browser console
- Login form submits to correct URL
- Database connection works

## Common Database Credentials Location

On shared hosting, database credentials are often found in:
- cPanel → Databases → MySQL Databases
- Or check your hosting provider's documentation

