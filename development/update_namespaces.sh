#!/bin/bash

# Directory base
BASE_DIR="laravel/Modules/Fixcity/app/Ticket"

# Trova tutti i file PHP
find "$BASE_DIR" -type f -name "*.php" -exec sed -i 's/namespace Modules\\Ticket/namespace Modules\\Fixcity\\Ticket/g' {} +

# Aggiorna anche i riferimenti nei use statements
find "$BASE_DIR" -type f -name "*.php" -exec sed -i 's/use Modules\\Ticket/use Modules\\Fixcity\\Ticket/g' {} +

echo "Namespace updates completed" 