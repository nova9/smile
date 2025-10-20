
# 🌟 SMILE - Volunteer Management Platform

**SMILE** is a comprehensive volunteer management and event coordination platform built with modern web technologies. It connects volunteers, event organizers, and legal professionals in a unified ecosystem that facilitates community service, volunteer recognition, and legal support.

## 📋 Table of Contents

-   [Overview](#overview)
-   [Key Features](#key-features)
-   [Technology Stack](#technology-stack)
-   [User Roles](#user-roles)
-   [Prerequisites](#prerequisites)
-   [Installation](#installation)
-   [Configuration](#configuration)
-   [Running the Application](#running-the-application)
-   [Project Structure](#project-structure)
-   [Core Features](#core-features)
-   [AI-Powered Features](#ai-powered-features)

## 🎯 Overview

SMILE is an advanced volunteer management system that leverages AI and modern web technologies to create meaningful connections between volunteers and community service opportunities. The platform provides intelligent event recommendations, automated certificate generation, real-time messaging, and comprehensive analytics.

### Vision

To streamline volunteer coordination, enhance community engagement, and recognize volunteer contributions through a seamless digital experience.

## ✨ Key Features

### For Volunteers

-   🎯 **AI-Powered Event Recommendations** - Smart matching based on skills, interests, and location
-   📅 **Event Discovery & Application** - Browse and apply to volunteering opportunities
-   🏆 **Achievement System** - Earn badges and track volunteer hours
-   📊 **Personal Dashboard** - View stats, upcoming events, and impact metrics
-   📜 **Digital Certificates** - Automated certificate generation for completed events
-   ⭐ **Event Reviews** - Rate and review volunteering experiences
-   🏅 **Leaderboard** - Community recognition and gamification
-   💬 **Real-time Chat** - Communicate with organizers and fellow volunteers

### For Event Organizers (Requesters)

-   📝 **Event Management** - Create, edit, and manage volunteer events
-   👥 **Volunteer Coordination** - Review applications and manage participants
-   📊 **Analytics Dashboard** - Track event performance and volunteer engagement
-   📜 **Certificate Issuance** - Generate and distribute volunteer certificates
-   📈 **Event Reports** - Comprehensive reporting on event outcomes
-   ⭐ **Review Management** - View and respond to volunteer feedback
-   🔔 **Notification System** - Stay updated on applications and event changes
-   📸 **Event Photo Gallery** - Document and share event memories

### For Administrators

-   🛡️ **User Management** - Oversee volunteers and organizations
-   📊 **Platform Analytics** - Monitor platform-wide metrics and trends
-   🎫 **Support System** - Handle help requests and disputes
-   🔍 **Event Oversight** - Review and manage all platform events
-   📈 **Reporting Tools** - Generate comprehensive platform reports

### For Legal Professionals (Lawyers)

-   📄 **Contract Drafting** - Create legal agreements for volunteer programs
-   📚 **Contract Archive** - Maintain legal document repository
-   ⚖️ **Legal Q&A** - Provide legal guidance through a real lawyer
-   🔧 **Contract Customization** - Template-based legal document creation

## 🛠️ Technology Stack

### Backend

-   **Framework**: Laravel 12.0 (Latest)
-   **PHP**: 8.2+
-   **Real-time Components**: Livewire 3.6 & Volt 1.7
-   **Database**: MySQL/PostgreSQL (Eloquent ORM)
-   **Search**: Laravel Scout
-   **Monitoring**: Laravel Telescope

### Frontend

-   **UI Framework**: Tailwind CSS 4.0
-   **Component Library**: DaisyUI 5.0
-   **JavaScript**: Alpine.js 3.14
-   **Icons**: Lucide Icons & Heroicons
-   **Build Tool**: Vite 6.2
-   **Interactivity**: Livewire Sortable

### AI & Machine Learning

-   **AI Provider**: OpenAI GPT & Embeddings API
-   **Embedding Model**: text-embedding-3-small
-   **Use Cases**:
    -   Event recommendations via cosine similarity
    -   AI chatbot

## 👥 User Roles

The platform supports four distinct user roles:

1. **Volunteer** - Individuals seeking volunteer opportunities
2. **Requester/Organizer** - Organizations or individuals creating volunteer events
3. **Admin** - Platform administrators with full system access
4. **Lawyer** - Legal professionals providing contract and legal services

## 📦 Prerequisites

-   **PHP** >= 8.2
-   **Composer** >= 2.0
-   **Node.js** >= 18.x
-   **npm** or **yarn**
-   **MySQL** >= 8.0 or **PostgreSQL** >= 13
-   **OpenAI API Key** (for AI features)

## 🚀 Installation

### 1. Clone the Repository

```bash
git clone https://github.com/nova9/smile.git
cd smile
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies

```bash
npm install
```

### 4. Environment Configuration

```bash
cp .env.example .env
```

Edit `.env` and configure;

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Database Migrations

```bash
php artisan migrate
```

### 7. Seed Database (Optional)

```bash
php artisan db:seed
```

### 8. Create Storage Link

```bash
php artisan storage:link
```

## ⚙️ Configuration

### OpenAI Setup

The platform uses OpenAI for:

-   **Event Recommendations**: Generates embeddings for users and events, matches using cosine similarity
-   **Legal Chatbot**: Provides platform guidance through GPT models

Ensure you have sufficient OpenAI API credits and configure the API key in your `.env` file.

## 🏃 Running the Application

### Development Mode

Use the convenient composer script that runs all services concurrently:

```bash
composer dev
```

This command starts:

-   Laravel development server (port 8000)
-   Queue worker
-   Log viewer (Pail)
-   Vite dev server (HMR for frontend assets)

### Manual Setup

Alternatively, run services individually:

**Terminal 1 - Application Server:**

```bash
php artisan serve
```

**Terminal 2 - Queue Worker:**

```bash
php artisan queue:listen --tries=1
```

**Terminal 3 - Frontend Assets:**

```bash
npm run dev
```

**Terminal 4 - Logs (Optional):**

```bash
php artisan pail
```

### Visit the Application

Open your browser and navigate to: **http://localhost:8000**

## 📂 Project Structure

```
smile/
├── app/
│   ├── Http/Controllers/         # HTTP controllers
│   ├── Livewire/                 # Livewire components
│   │   ├── Admin/               # Admin dashboard components
│   │   ├── Volunteer/           # Volunteer interface
│   │   ├── Requester/           # Event organizer interface
│   │   ├── Lawyer/              # Legal professional interface
│   │   └── Common/              # Shared components
│   ├── Models/                   # Eloquent models
│   │   ├── User.php
│   │   ├── Event.php
│   │   ├── Certificate.php
│   │   ├── Review.php
│   │   └── ...
│   ├── Services/                 # Business logic services
│   │   ├── ChatbotService.php
│   │   ├── EmbeddingService.php
│   │   ├── EventRecommenderService.php
│   │   ├── FileManager.php
│   │   └── ...
│   └── Jobs/                     # Queue jobs
│       └── GenerateEmbedding.php
├── database/
│   ├── migrations/               # Database migrations
│   ├── factories/                # Model factories
│   └── seeders/                  # Database seeders
├── resources/
│   ├── views/                    # Blade templates
│   │   └── livewire/            # Livewire component views
│   ├── css/                      # Stylesheets
│   └── js/                       # JavaScript files
├── routes/
│   ├── web.php                   # Main web routes
│   ├── volunteer.php             # Volunteer routes
│   ├── requester.php             # Organizer routes
│   ├── admin.php                 # Admin routes
│   └── lawyer.php                # Lawyer routes
├── public/                       # Public assets
├── storage/                      # File storage
├── tests/                        # Test files
│   ├── Feature/
│   └── Unit/
├── composer.json                 # PHP dependencies
├── package.json                  # Node dependencies
└── vite.config.js               # Vite configuration
```

## 🎯 Core Features

### 1. AI-Powered Event Recommendations

The platform uses OpenAI embeddings to match volunteers with relevant events:

-   **User Profiles**: Generate embeddings from volunteer skills, interests, and experience
-   **Event Profiles**: Create embeddings from event descriptions, required skills, and categories
-   **Matching Algorithm**: Cosine similarity (60% skills match) + geographic proximity (40% location)
-   **Background Processing**: Embeddings generated asynchronously via queued jobs

### 2. Certificate Management

Automated certificate generation for completed volunteer work:

-   Professional certificate templates with customizable designs
-   Print-optimized A4 layout with proper page breaks
-   Signature support for authenticity
-   Bulk certificate issuance
-   PDF export functionality

### 3. Real-Time Notifications

Multi-channel notification system:

-   In-app notifications for immediate updates
-   Email notifications for important events
-   Notification preferences per user
-   Read/unread status tracking
-   Notification grouping and filtering

### 4. Review & Rating System

Comprehensive feedback mechanism:

-   Star ratings (0.5 - 5.0 scale)
-   Written reviews for detailed feedback
-   Verified reviewer badges
-   Review aggregation and statistics
-   Response capabilities for organizers

### 5. Chat & Messaging

Real-time communication features:

-   Direct messaging between users
-   Event-specific group chats
-   Read receipts and typing indicators
-   Message history and search
-   File attachment support

### 6. Badge & Achievement System

Gamification to encourage participation:

-   Milestone-based badges
-   Skill-specific achievements
-   Hours-based recognition
-   Leaderboard rankings
-   Public profile display

### 7. Contract Management (Legal Module)

Professional legal document handling:

-   Template-based contract generation
-   Digital signature integration
-   Version control for contracts
-   Contract archive and retrieval
-   Multi-party agreement support

## 🤖 AI-Powered Features

### Event Recommendation Engine

**Technology**: OpenAI Embeddings (text-embedding-3-small)

**Process**:

1. Generate embeddings for user profile (skills, interests, bio)
2. Generate embeddings for event details (description, requirements)
3. Calculate cosine similarity between user and event vectors
4. Factor in geographic distance using Haversine formula
5. Combine similarity scores with weighted algorithm
6. Return top N recommended events

**Code Location**: `app/Services/EventRecommenderService.php`

### AI Chatbot

**Technology**: OpenAI GPT Models

**Features**:

-   Context-aware legal guidance
-   Contract-related Q&A
-   Legal terminology explanations
-   Citation and reference support
-   Multi-turn conversations

**Code Location**: `app/Services/ChatbotService.php`

### Embedding Generation

**Background Processing**: Queue-based embedding generation

**Implementation**:

```php
// Dispatch embedding job
GenerateEmbedding::dispatch(
    $model,
    ['field1', 'field2'],
    'combined text',
    'embedding'
);
```

**Code Location**: `app/Jobs/GenerateEmbedding.php``

## 💻 Development

### Debugging

**Laravel Telescope** is available for request inspection:

Visit: **http://localhost:8000/telescope**

**Laravel Pail** for real-time log streaming:

```bash
php artisan pail
```

### Database Management

**Fresh migration with seeding**:

```bash
php artisan migrate:fresh --seed
```

**Rollback last migration**:

```bash
php artisan migrate:rollback
```

**Generate model with migration**:

```bash
php artisan make:model ModelName -m
```

### Queue Management

**Process queue jobs**:

```bash
php artisan queue:work
```

**Listen for new jobs**:

```bash
php artisan queue:listen
```

**Clear failed jobs**:

```bash
php artisan queue:flush
```

### Asset Compilation

**Development**:

```bash
npm run dev
```

**Production build**:

```bash
npm run build
```

## 🗃️ Database Schema

### Core Tables

-   **users** - User accounts and profiles
-   **events** - Volunteer events and opportunities
-   **event_user** - Pivot table for volunteer applications
-   **reviews** - Event reviews and ratings
-   **certificates** - Volunteer certificates
-   **notifications** - System notifications
-   **messages** - Chat messages
-   **chats** - Chat channels
-   **badges** - Achievement badges
-   **contracts** - Legal agreements
-   **files** - File uploads
-   **tasks** - Event-specific tasks
-   **categories** - Event categories
-   **tags** - Event tags
-   **addresses** - Location data

## 🔒 Security

-   **Authentication**: Laravel's built-in authentication
-   **Authorization**: Role-based access control (RBAC)
-   **CSRF Protection**: Enabled on all forms
-   **XSS Prevention**: Blade template escaping
-   **SQL Injection**: Eloquent ORM parameterized queries
-   **Password Hashing**: Bcrypt algorithm
-   **API Security**: Rate limiting and throttling

## 🌐 API Integration

### OpenAI Integration

```php
// Embedding generation
$embedding = OpenAI::embeddings()->create([
    'model' => 'text-embedding-3-small',
    'input' => $text,
]);

// Chat completion
$result = OpenAI::chat()->create([
    'model' => 'gpt-4',
    'messages' => $messages,
]);
```

---

**Built with ❤️ using Laravel, Livewire, and AI**
