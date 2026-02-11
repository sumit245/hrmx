#!/bin/bash
# Production Configuration Update Script
# Run this script on your production server via SSH

echo "Updating production configuration..."

# Get the current directory
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd "$SCRIPT_DIR"

# Backup original files
echo "Creating backups..."
cp application/config/config.php application/config/config.php.backup
cp application/config/database.php application/config/database.php.backup
cp index.php index.php.backup

# Update base_url in config.php
echo "Updating base_url..."
sed -i.bak "s|http://localhost/hrmx/|https://hrmx.dashandots.com/|g" application/config/config.php

# Update environment in index.php
echo "Updating environment..."
sed -i.bak "s|define('ENVIRONMENT', 'development');|define('ENVIRONMENT', 'production');|g" index.php

echo ""
echo "Configuration updated!"
echo ""
echo "IMPORTANT: You still need to manually update database.php with your production database credentials:"
echo "  - hostname (usually 'localhost')"
echo "  - username (your database username)"
echo "  - password (your database password)"
echo "  - database (your database name)"
echo ""
echo "Backup files created with .backup extension"
