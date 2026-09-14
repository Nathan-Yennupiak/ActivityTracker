# Activity Tracker

A robust Laravel application designed to manage, track, and report on daily team activities. It streamlines the process of assigning tasks, providing updates, generating daily handover reports, and performing historical activity reporting.

## Features

- **Activity Management**: Create tasks/activities and track their statuses (`pending` to `done`).
- **Activity Updates**: Add descriptive remarks and log status updates for ongoing activities.
- **Daily Handover**: Automatically generate daily handover reports showing all activities updated or created today.
- **Reporting**: Generate activity reports filtered by start and end dates.
- **User Authentication**: Secure user registration and login system to track who created or updated specific activities.
- **Dashboard**: A comprehensive dashboard to view the latest activities and their entire update history at a glance.

## Tech Stack

- **Framework**: [Laravel 12](https://laravel.com/)
- **Language**: PHP 8.2+
- **Frontend**: Blade Templates, JavaScript, CSS (TailwindCSS/Bootstrap as configured)
- **Database**: Configured via `.env` (SQLite/MySQL/PostgreSQL)

## Requirements

- PHP >= 8.2
- Composer
- Node.js & npm (for frontend assets)
- A supported database (e.g., MySQL, SQLite, PostgreSQL)

## Installation

Follow these steps to set up the project locally:

1. **Clone the repository**
   ```bash
   git clone https://github.com/Nathan-Yennupiak/ActivityTracker.git
   cd ActivityTracker
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install NPM dependencies**
   ```bash
   npm install
   npm run build
   ```

4. **Environment Setup**
   Copy the example `.env` file and configure your database settings:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database Migration**
   Run the migrations to set up the database schema:
   ```bash
   php artisan migrate
   ```

6. **Serve the Application**
   Start the Laravel development server:
   ```bash
   php artisan serve
   ```
   *By default, the application will be accessible at `http://localhost:8000`.*

## Usage Workflow

1. **Register/Login**: Start by creating an account.
2. **Dashboard**: Navigate to the dashboard to create your first activity.
3. **Update Activities**: Click on an activity to add an update, change its status to `done`, and leave a remark.
4. **Daily Handover**: At the end of the day, visit the Handover section to see a summary of the day's work.
5. **Reporting**: Use the Reporting tab to filter activities by specific dates for performance reviews or audits.

## Contributing

Contributions, issues, and feature requests are welcome! 
Feel free to check the [issues page](https://github.com/Nathan-Yennupiak/ActivityTracker/issues).

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
