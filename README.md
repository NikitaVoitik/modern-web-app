# US Elections Simulation Web App
This project is a web application designed to simulate the process of voting and calculating election results, modeled after the U.S. elections system. Built using the Laravel framework, this application allows users to cast votes, view live results, and experience a simplified emulation of democratic voting.

## Features
User Registration and Authentication
Users can register, log in, and securely access the voting system.

### Dynamic Ballots
Provides dynamically generated ballots with candidates for simulated elections.

### Real-Time Results
Display live election results as votes are cast.

## Installation

### Initial Setup

```bash
git clone <repository-url>
cd <repository-directory>

composer install
npm install

cp .env.example .env
```

### API Set Up

#### [Source](https://rapidapi.com/alexanderxbx/api/twitter-api45)
```bash
TWITTER_API_KEY=798104a7e9msh9aed2ecaad865dbp1c878ajsndd36c315d958
```

### After

```bash
php artisan key:generate
php artisan migrate

npm run dev
php artisan serve
```
