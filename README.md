# Manchester United Season Tracker

A comprehensive web application for tracking Manchester United's match statistics, lineups, and performance throughout the season. This project provides an intuitive interface for managing and viewing detailed match information, including formations, player statistics, and match analytics.

## Features

### Match Management
- Add new matches with comprehensive details
- Edit existing match information
- Delete matches from the database
- Track scores, statistics, and performance metrics
- Upload and manage match images with automatic thumbnail generation

### Team Formations
- Interactive formation display using SVG
- Support for various formation patterns (4-4-2, 4-3-3, etc.)
- Player positioning visualization
- Starting lineup management
- Substitutes tracking (both used and unused)

### Statistics Tracking
- Match possession statistics
- Shot accuracy and conversion rates
- Pass completion percentages
- Cards and fouls tracking
- Corner kicks and offsides
- Detailed match descriptions

### User Interface
- Responsive design using Bootstrap 5
- Clean and intuitive navigation
- Advanced search functionality
- Pagination for match listings
- Detailed individual match views
- Administrative dashboard

### Security
- Secure user authentication system
- Protected administrative functions
- Input validation and sanitization
- Prepared SQL statements to prevent injection

## Technologies Used

- **Backend:** PHP 7.4+
- **Database:** MySQL
- **Frontend:** 
  - HTML5
  - CSS3
  - JavaScript
  - Bootstrap 5.2.3
  - Bootstrap Icons
- **Image Processing:** PHP GD Library
- **Version Control:** Git

## Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- GD Library for PHP
- mod_rewrite enabled (for Apache)

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/man-united-tracker.git
   ```

2. Create a MySQL database and import the schema:
   ```bash
   mysql -u your_username -p your_database_name < database/schema.sql
   ```

3. Configure the database connection:
   - Navigate to `/data/`
   - Copy `connect-sample.php` to `connect.php`
   - Update the database credentials in `connect.php`:
   ```php
   $connection = new mysqli('localhost', 'your_username', 'your_password', 'your_database');
   ```

4. Set up the upload directories:
   ```bash
   mkdir -p public/uploads/images/full
   mkdir -p public/uploads/images/thumbs
   chmod 775 public/uploads/images/full
   chmod 775 public/uploads/images/thumbs
   ```

5. Configure your web server:
   - Set the document root to the `public` directory
   - Ensure PHP has write permissions to the upload directories

6. Create an admin user:
   ```sql
   INSERT INTO catalogue_admin (username, hashed_pass) 
   VALUES ('admin', '$2y$10$your_hashed_password');
   ```

## Project Structure

```
├── data/
│   └── connect.php
├── private/
│   ├── admin/
│   │   ├── add.php
│   │   ├── admin.php
│   │   ├── delete.php
│   │   └── edit.php
│   └── lib/
│       ├── authentication.php
│       ├── image_processing.php
│       └── prepared.php
├── public/
│   ├── includes/
│   │   ├── footer.php
│   │   ├── header.php
│   │   ├── pagination.php
│   │   └── validation.php
│   ├── uploads/
│   │   └── images/
│   ├── browse.php
│   ├── index.php
│   ├── login.php
│   ├── logout.php
│   ├── search.php
│   └── view.php
└── README.md
```

## Configuration

### Apache (.htaccess)

```apache
RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]
```

### Image Upload Settings

The application supports:
- Maximum file size: 2MB
- Allowed formats: JPG, PNG, WebP
- Auto-generated thumbnails: 300x300px
- Full-size images: 720px width (maintaining aspect ratio)

## Usage

### Administrative Functions

1. Log in to the admin panel at `/login.php`
2. Add new matches using the "Add New Match" button
3. Edit existing matches through the admin dashboard
4. Upload match images during match creation/editing
5. Manage team formations and lineups

### Public Interface

1. Browse matches using the pagination system
2. Search for specific matches using various filters
3. View detailed match statistics and formations
4. Access match history and performance metrics

## Security Considerations

- All user inputs are validated and sanitized
- Passwords are hashed using PHP's password_hash()
- File uploads are strictly validated
- SQL injection prevention using prepared statements
- Authentication required for administrative functions

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- Bootstrap framework for responsive design
- PHP GD Library for image processing
- Manchester United for inspiration and data structure design
