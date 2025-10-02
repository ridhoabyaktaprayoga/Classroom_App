# Learning Management System - SMKN 21 Jakarta

A Laravel-based Learning Management System built for SMKN 21 Jakarta with role-based access for both teachers (guru) and students (siswa).

## Features

This application includes:

### Authentication
- Role-based authentication for teachers and students
- User registration with role selection
- Login/logout functionality

### Class Management (Teachers)
- Create and manage classes
- Generate unique class codes for student enrollment
- View class statistics and member list
- Soft delete functionality

### Class Enrollment (Students)
- Join classes using unique class codes
- View list of enrolled classes
- Leave classes if needed

### Content Management
- Upload and manage learning materials (PDF, PPT, DOC formats)
- Assignments with deadlines
- File download functionality

### Assignment Management
- Teachers can create assignments with deadlines
- Students can submit assignments with files or text
- Grading system with feedback
- Assignment tracking

### Discussion Forum
- Create and participate in class discussions
- Reply to discussion threads
- Threaded replies system

### Grading System
- Teachers can grade student submissions
- Students receive notifications about grades
- Export grade reports to CSV

### Notification System
- Real-time notifications for important events
- Assignment creation notifications
- Grade release notifications
- Notification bell UI component

## Installation

1. Clone the repository to your local machine
2. Run `composer install` to install PHP dependencies
3. Run `npm install` to install frontend dependencies
4. Copy `.env.example` to `.env` and configure your database settings
5. Run `php artisan key:generate` to generate the application key
6. Run `php artisan migrate` to create database tables
7. Run `php artisan db:seed` to populate demo data
8. Run `php artisan storage:link` to create symbolic link for public storage
9. Start the development server with `php artisan serve`

## Database Structure

The application uses the following main tables:
- users: Stores user information (teachers and students)
- kelas: Stores class information
- kelas_siswa: Pivot table for student-class enrollment
- materi: Stores learning materials
- tugas: Stores assignments
- pengumpulan: Stores assignment submissions

## Demo Accounts

After seeding, you can use these demo accounts:

**Teacher (Guru):**
- Email: guru@smkn21.sch.id
- Password: password123

**Student (Siswa):**
- Email: siswa@smkn21.sch.id
- Password: password123

## Technologies Used

- Laravel 12
- Livewire 3
- Tailwind CSS
- MySQL Database
- PHP 8.2+

## Folder Structure

```
app/
├── Http/
│   └── Middleware/           # Custom middleware for role-based access
├── Livewire/                 # All Livewire components
│   ├── Guru/                 # Components for teachers
│   ├── Siswa/                # Components for students
│   └── Shared/               # Shared components
├── Models/                   # Eloquent models
├── Notifications/            # Notification classes
└── Policies/                 # Authorization policies
database/
├── migrations/               # Database migrations
└── seeders/                  # Database seeders
resources/
├── views/                    # Blade templates
│   ├── livewire/             # Livewire component views
│   └── components/           # Blade components
routes/
└── web.php                   # All web routes
```

## Security Features

- Role-based middleware for access control
- Authorization policies for sensitive operations
- Input validation and sanitization
- CSRF protection
- Password hashing using bcrypt
- File upload validation