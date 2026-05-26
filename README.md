<<<<<<< HEAD
# CollabUp - Social Network for Creators & Devs

CollabUp is a hybrid platform combining social networking and professional project recruitment. Users can find teammates for their startups, post project openings, and chat in real-time.

## Features
- **Project Discovery**: Search by tech stack and categories.
- **Team Management**: Project owners can post roles (e.g., 'React Dev', 'UI Designer') and accept/reject applicants.
- **Social Connection**: Send/accept friend requests.
- **Real-time Chat**: Connect with friends and teammates instantly using Laravel Reverb.
- **Freemium Model**: Free users are limited to 3 active projects; Premium users have no limits.
- **News Feed**: Stay updated with the latest projects and members.

## Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- SQLite (usually built-in with PHP)

## Installation Steps

1. **Clone and Install Backend Dependencies**:
    composer install

2. **Install Frontend Dependencies**:
    npm install
    npm run build

3. **Setup Environment**:
    cp .env.example .env
    php artisan key:generate

4. **Prepare Database**:
    touch database/database.sqlite
    php artisan migrate --seed

5. **Start Servers**:
    - Open terminal 1 (Web server): `php artisan serve`
    - Open terminal 2 (WebSocket server): `php artisan reverb:start`

## Demonstration (Multi-user Scenario)

To test the full flow:
1. Open `http://localhost:8000` in your main browser and log in with `founder@example.com` / `password`.
2. Open an **Incognito** window and log in with `dev@example.com` / `password`.
3. In the Founder's window, go to **My Projects** -> **Create Project**. Add roles.
4. In the Dev's window, go to **Find Project**, click details, and **Apply**.
5. Go back to the Founder's window. In **My Projects**, you will see the application. **Accept** it.
6. Go to **Friends** to connect the two accounts.
7. Use the **Chats** tab to send messages between accounts in real-time.

## Troubleshooting
- **Real-time Chat not working?** Ensure `php artisan reverb:start` is running and your `.env` Reverb settings match.
- **Database error?** Ensure `database/database.sqlite` exists and has write permissions.
=======
# Collup
laravel 
>>>>>>> 1ca7bb711aa7130e29c9747e94a1ad5e40b092f2
