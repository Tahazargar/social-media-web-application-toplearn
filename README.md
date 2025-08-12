# Social Media Web Application - TopLearn

A mini social media web application where users can sign up, sign in, follow/unfollow other users, and see posts from the users they follow. The app also features a public live chat and a user panel to create and manage posts.

This project is part of a course I run on TopLearn:  
[متخصص لاراول 1](https://toplearn.com/courses/web/%D9%85%D8%AA%D8%AE%D8%B5%D8%B5-%D9%84%D8%A7%D8%B1%D8%A7%D9%88%D9%84-1)

## 🚀 Features

- User registration and login  
- Follow and unfollow other users  
- View posts from followed users  
- Public live chat for all users  
- User panel for posting and managing content  

## 📦 Installation & Configuration

### Installation Steps

cp .env.example .env
php artisan key:generate

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

php artisan migrate --seed

npm install
npm run dev

php artisan serve

Broadcasting (Live Chat):
Configure broadcasting in .env according to your preferred driver (Pusher, Redis, Laravel WebSockets). Example for Pusher:

BROADCAST_DRIVER=pusher
PUSHER_APP_ID=your_pusher_app_id
PUSHER_APP_KEY=your_pusher_app_key
PUSHER_APP_SECRET=your_pusher_app_secret
PUSHER_APP_CLUSTER=mt1

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME="${APP_NAME}"
