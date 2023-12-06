# Connect
 
## Introduction

This project is my playground for learning Filament V3, a handy collection of beautiful full-stack
components for Accelerated Laravel Development. 

I've added Filament Shield for permissions which still need to be configured properly, but as an admin you can see everything.

There is data about European countries, provinces, and cities in the migrations.

## Installation

### 1. Clone the Repository
```bash
git clone https://github.com/minuut/connect.git
```

### 2. Navigate to the Project Directory
```bash
cd connect
```

### 3. Install Composer Dependencies
```bash
composer install
```

### 4. Create a Copy of the .env File
```bash
cp .env.example .env
```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Configure the Database
Edit the .env file with your database configuration:

```bash
DB_CONNECTION=mysql
DB_HOST=your-database-host
DB_PORT=your-database-port
DB_DATABASE=your-database-name
DB_USERNAME=your-database-username
DB_PASSWORD=your-database-password
```

### 7. Migrate the Database
```bash
php artisan migrate
```

### 8. Install NPM Dependencies
```bash
npm install
```

### 9. Build Assets
```bash
npm run dev
```
