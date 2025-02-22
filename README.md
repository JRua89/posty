
# Laravel Post Project

A simple Laravel-based web application for managing and sharing links. This project demonstrates core Laravel features like routing, database interactions, authentication, and pagination, using Laravel 10.x.

## Table of Contents
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Authentication](#authentication)
- [Routes](#routes)
- [Data Management](#data-management)
- [Pagination](#pagination)
- [Email Functionality](#email-functionality)
- [Contributing](#contributing)
- [License](#license)

## Features
- User authentication (login, registration, logout)
- CRUD operations for managing links (title and URL)
- Paginated list of links
- Basic form validation
- Responsive design with Tailwind CSS

## Requirements
- PHP >= 8.1
- Composer
- Node.js & npm (for Tailwind CSS compilation)
- SQLite (default database, though MySQL or others can be used)

## Installation
Follow these steps to set up the project locally, as shown in the crash course:

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/JRua89/posty.git
   cd posty
   ```

2. **Install PHP Dependencies**:
   ```bash
   composer install
   ```

3. **Install JavaScript/CSS Dependencies**:
   ```bash
   npm install
   ```

4. **Set Up Tailwind CSS with Laravel Mix**:
   - Install Tailwind CSS and its dependencies:
     ```bash
     npm install -D laravel-mix tailwindcss postcss autoprefixer
     ```
   - Create or update `webpack.mix.js` in the project root:
     ```javascript
     const mix = require('laravel-mix');

     mix.js('resources/js/app.js', 'public/js')
        .postCss('resources/css/app.css', 'public/css', [
            require('tailwindcss'),
            require('autoprefixer'),
        ]);
     ```
   - Initialize Tailwind CSS:
     ```bash
     npx tailwindcss init
     ```
   - Edit `tailwind.config.js` to include your template files:
     ```javascript
     module.exports = {
       content: [
         './resources/**/*.blade.php',
         './resources/**/*.js',
         './resources/**/*.vue',
       ],
       theme: {
         extend: {},
       },
       plugins: [],
     }
     ```
   - Update `resources/css/app.css` with Tailwind directives:
     ```css
     @tailwind base;
     @tailwind components;
     @tailwind utilities;
     ```
   - Compile assets:
     ```bash
     npm run watch
     ```
     (Use `npm run prod` for production builds.)

5. **Set Up Environment**:
   - Copy the `.env.example` file to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Configure SQLite in `.env` (default from the video):
     ```
     DB_CONNECTION=sqlite
     # Remove or comment out other DB_* settings
     ```
   - Create an empty SQLite database file:
     ```bash
     touch database/database.sqlite
     ```

6. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

7. **Run Database Migrations**:
   ```bash
   php artisan migrate
   ```

8. **Start the Server**:
   ```bash
   php artisan serve
   ```
   Visit `http://localhost:8000` in your browser.

## Authentication
The project uses Laravel Breeze for authentication, as demonstrated in the video.

- **Setup**:
  - Installed via:
    ```bash
    composer require laravel/breeze --dev
    php artisan breeze:install
    npm install && npm run dev
    php artisan migrate
    ```
  - Provides login, registration, and logout functionality.

- **Protected Routes**:
  - Dashboard and link management routes are guarded with the `auth` middleware.

- **Customization**:
  - Views are in `resources/views/auth/` and `resources/views/dashboard.blade.php`.

## Routes
Routes are defined in `routes/web.php`, following the video’s structure:

- **Public Routes**:
  - `GET /` - Home page (welcome view)
  - `GET /login` - Login page
  - `GET /register` - Registration page

- **Authenticated Routes**:
  - `GET /dashboard` - Displays paginated links (protected)
  - `GET /links/create` - Form to add a new link
  - `POST /links` - Store a new link
  - `GET /links/{link}/edit` - Edit a link
  - `PUT /links/{link}` - Update a link
  - `DELETE /links/{link}` - Delete a link

View all routes:
```bash
php artisan route:list
```

## Data Management
Data is managed using Eloquent ORM and migrations for a `links` table.

- **Model**:
  - `app/Models/Link.php` defines the `Link` model with fillable fields:
    ```php
    protected $fillable = ['title', 'url'];
    ```

- **Migration**:
  - Created with:
    ```bash
    php artisan make:model Link -m
    ```
  - Located in `database/migrations/xxxx_create_links_table.php`:
    ```php
    Schema::create('links', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->string('url');
        $table->timestamps();
    });
    ```
  - Run `php artisan migrate` to apply.

- **Controller**:
  - `app/Http/Controllers/LinkController.php` handles CRUD operations.

## Pagination
Pagination is implemented for the links list on the dashboard.

- **Controller Example**:
  ```php
  public function index()
  {
      $links = auth()->user()->links()->paginate(10); // 10 links per page
      return view('dashboard', compact('links'));
  }
  ```

- **Blade Template**:
  - In `resources/views/dashboard.blade.php`:
    ```blade
    @foreach ($links as $link)
        <div>{{ $link->title }} - {{ $link->url }}</div>
    @endforeach
    {{ $links->links() }} <!-- Pagination links -->
    ```

- **Styling**:
  - Uses Tailwind CSS classes for a responsive layout.

## Email Functionality
The crash course doesn’t implement email functionality, but Laravel’s foundation supports it. Here’s how to add it (e.g., for new user notifications):

- **Configuration**:
  - Update `.env` with mail settings (e.g., using Mailtrap):
    ```
    MAIL_MAILER=smtp
    MAIL_HOST=smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME=your_username
    MAIL_PASSWORD=your_password
    MAIL_ENCRYPTION=tls
    ```

- **Mail Class**:
  - Generate a mailable:
    ```bash
    php artisan make:mail NewLinkNotification
    ```
  - Edit `app/Mail/NewLinkNotification.php`:
    ```php
    public function build()
    {
        return $this->subject('New Link Added')
                    ->view('emails.new-link');
    }
    ```

- **Sending Email**:
  - In `LinkController.php`:
    ```php
    use App\Mail\NewLinkNotification;
    use Illuminate\Support\Facades\Mail;

    public function store(Request $request)
    {
        $link = auth()->user()->links()->create($request->validated());
        Mail::to(auth()->user()->email)->send(new NewLinkNotification($link));
        return redirect('/dashboard');
    }
    ```

- **Note**: Email setup is an optional extension beyond the video.

## Contributing
1. Fork the repository.
2. Create a feature branch (`git checkout -b feature-name`).
3. Commit your changes (`git commit -m "Add feature"`).
4. Push to the branch (`git push origin feature-name`).
5. Open a pull request.

## License
This project is licensed under the [MIT License](LICENSE).

