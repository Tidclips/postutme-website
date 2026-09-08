# Post-UTME Examination Portal
## Setup Guide & Quick Start

A web-based Post-UTME examination portal built with **PHP, MySQL, HTML, CSS, and JavaScript** using XAMPP.

---

## 🚀 Quick Start (3 Easy Steps)

1. **Install XAMPP** → https://www.apachefriends.org
2. **Copy project to** → `C:\xampp\htdocs\postutme-website\`
3. **Import database** → Use phpMyAdmin to import `mysql/database.sql`

Visit: **http://localhost/postutme-website/public/index.html**

If Apache uses a custom port, include it in the URL, for example:
`http://localhost:8080/postutme-website/public/index.html`.

If `localhost` shows a different XAMPP page or the project returns 404, make
sure Apache was started from the same XAMPP installation as the project. This
project is located in `C:\xampp\htdocs\postutme-website`; stop any older Apache
installation first, then start Apache from `C:\xampp\xampp-control.exe`.

For a development-only alternative, run this from the project folder:
`C:\xampp\php\php.exe -S 127.0.0.1:8000 -t .`
Then open `http://127.0.0.1:8000/public/index.html`.

---

## 📖 Complete Documentation

**👉 READ FIRST:** [`SETUP_GUIDE.md`](SETUP_GUIDE.md)

This comprehensive guide includes:
- ✅ XAMPP installation steps
- ✅ Database setup
- ✅ Configuration
- ✅ Making changes
- ✅ Troubleshooting

---

## ✨ Features

- ✅ Student Registration & Login
- ✅ Profile Management
- ✅ Exam Information
- ✅ Score Submission
- ✅ Payment Processing
- ✅ Results Display
- ✅ Admin Dashboard
- ✅ Contact Form
- ✅ Responsive Design

## 📁 Project Structure

```
postutme-website/
├── public/              # Frontend files
│   ├── index.html
│   ├── dashboard.html
│   ├── css/
│   └── js/
├── php/                 # Backend (PHP)
│   ├── config.php
│   ├── auth/
│   ├── students/
│   ├── exams/
│   └── ...
├── mysql/
│   └── database.sql     # Database schema
└── SETUP_GUIDE.md       # 📖 Complete guide
```

## 🔧 Requirements

- XAMPP (Apache + PHP 7.4+ + MySQL 5.7+)
- Web Browser
- 500MB Disk Space

## 🎯 Next Steps

1. Read [`SETUP_GUIDE.md`](SETUP_GUIDE.md)
2. Install XAMPP
3. Copy project files
4. Create database
5. Test at http://localhost/postutme-website/public/index.html

The supplied schema creates `elonmusk_postutme_db`. The current PHP configuration
uses MySQL/MariaDB port `3307`; change `DB_PORT` in `php/config.php` and
`db_connect.php` to `3306` if your XAMPP installation uses the default port.

---

**👉 START HERE:** [`SETUP_GUIDE.md`](SETUP_GUIDE.md) has everything you need!

- **Payment Portal**: Integrated payment system with multiple payment methods
- **Student Dashboard**: Personal dashboard with registration and payment status
- **Contact Form**: Direct communication channel with school administration
- **Admin Panel**: Dashboard for managing students, exams, and results
- **Responsive Design**: Works seamlessly on desktop, tablet, and mobile devices

## Project Structure

```
postutme-website/
├── public/                 # Frontend files
│   ├── index.html         # Home page
│   ├── dashboard.html     # Student dashboard
│   ├── css/
│   │   ├── styles.css     # Main styles
│   │   └── dashboard.css  # Dashboard styles
│   └── js/
│       ├── main.js        # Main page script
│       └── dashboard.js   # Dashboard script
├── php/                   # PHP backend modules
│   ├── config.php         # Database connection
│   ├── auth/
│   ├── students/
│   ├── exams/
│   ├── results/
│   ├── payments/
│   ├── admin/
│   └── contact/
├── mysql/                 # MySQL schema and seed data
│   └── database.sql
├── index.php              # Redirect entry point
├── README.md              # Docs
├── SETUP_GUIDE.md         # Setup instructions
└── .gitignore             # Git ignores
```

## Requirements

- XAMPP / Apache + PHP + MySQL
- PHP 7.4 or newer
- MySQL 5.7 or newer
- Modern web browser

## Installation

1. Place the project inside your XAMPP web folder:
```bash
C:\xampp\htdocs\postutme-website
```

2. Start Apache and MySQL from the XAMPP Control Panel.

3. Import the database:
- Open http://localhost/phpmyadmin
- Import `mysql/database.sql`; it creates `elonmusk_postutme_db`
- Import `mysql/database.sql`

4. Open the app in the browser:
- Main website: http://localhost/postutme-website/public/index.html
- Dashboard: http://localhost/postutme-website/public/dashboard.html

## PHP API Endpoints

### Authentication
- `POST /postutme-website/php/auth/register.php`
- `POST /postutme-website/php/auth/login.php`
- `POST /postutme-website/php/auth/logout.php`

### Students
- `GET /postutme-website/php/students/list.php`
- `GET /postutme-website/php/students/profile.php`
- `POST /postutme-website/php/students/scores.php`

### Exams
- `GET /postutme-website/php/exams/get_exams.php`
- `POST /postutme-website/php/exams/create.php`

### Results
- `GET /postutme-website/php/results/get_results.php`

### Payments
- `POST /postutme-website/php/payments/payment.php`

### Admin
- `GET /postutme-website/php/admin/stats.php`

### Contact
- `POST /postutme-website/php/contact/send_message.php`

## Database Model Overview

### Student
```sql
students (
  id INT PRIMARY KEY,
  firstName VARCHAR(100),
  lastName VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  phoneNumber VARCHAR(20),
  password VARCHAR(255),
  registrationNumber VARCHAR(50),
  registrationStatus ENUM('pending', 'approved', 'rejected', 'completed'),
  paymentStatus ENUM('pending', 'completed', 'failed'),
  examStatus ENUM('not_taken', 'completed', 'pending'),
  admissionStatus ENUM('pending', 'admitted', 'rejected', 'waitlisted')
)
```

### Exam
```sql
exams (
  id INT PRIMARY KEY,
  title VARCHAR(255),
  subject VARCHAR(100),
  duration INT,
  totalQuestions INT,
  passingScore INT,
  totalMarks INT,
  examDate DATETIME,
  status ENUM('scheduled', 'ongoing', 'completed', 'cancelled')
)
```
{
  title: String,
  date: Date,
  time: String,
  location: String,
  duration: Number (minutes),
  totalQuestions: Number,
  totalMarks: Number,
  syllabus: String,
  requirements: [String],
  status: String (upcoming/ongoing/completed),
  createdAt: Date
}
```

### Result
```javascript
{
  student_id: ObjectId (ref: Student),
  exam_id: ObjectId (ref: Exam),
  score: Number,
  percentage: Number,
  grade: String,
  status: String (admitted/waiting-list/rejected),
  remarks: String,
  publishedAt: Date,
  createdAt: Date
}
```

## Configuration Guide

### Email Setup (Gmail)
1. Enable 2-factor authentication on Gmail
2. Generate an app password: https://myaccount.google.com/apppasswords
3. Add to `.env`:
```
EMAIL_USER=your_email@gmail.com
EMAIL_PASSWORD=your_app_password
ADMIN_EMAIL=admin@school.edu
```

### Stripe Setup
1. Create Stripe account: https://stripe.com
2. Get API keys from dashboard
3. Add to `.env`:
```
STRIPE_SECRET_KEY=sk_test_your_key
```

### MongoDB Setup
- **Local**: `MONGODB_URI=mongodb://localhost:27017/postutme`
- **MongoDB Atlas**: `MONGODB_URI=mongodb+srv://username:password@cluster.mongodb.net/postutme`

## Usage Guide

### For Students
1. Visit the home page
2. Click "Get Started" or go to login/register section
3. Register with required information
4. Login to access your dashboard
5. Update profile if needed
6. Make payment
7. View exam information and results

### For Administrators
1. Use admin panel to:
   - View all registered students
   - Update student registration status
   - Create and manage exams
   - Upload and manage results
   - View dashboard statistics

## Security Considerations

- Passwords are hashed using bcryptjs
- JWT tokens for session management
- CORS enabled for API security
- Input validation on all forms
- Environment variables for sensitive data

## Customization

### Change School Name
Edit in:
- `public/index.html` - navbar brand and title
- `public/dashboard.html` - sidebar header
- `routes/contact.js` - admin email

### Modify Programs
Edit the programs list in:
- `public/index.html` - programs section
- `public/js/main.js` - registration form select options

### Adjust Fees
Edit in:
- `public/dashboard.html` - payment section amount

### Customize Colors
Edit CSS variables in:
- `public/css/styles.css` - `:root` section
- `public/css/dashboard.css` - `:root` section

## Troubleshooting

**Port already in use**:
```bash
# Change port in .env file
PORT=3000
```

**MongoDB connection failed**:
- Check MongoDB is running
- Verify connection string in .env
- Check firewall settings

**Email not sending**:
- Enable 2FA on Gmail
- Generate app password
- Check EMAIL_USER and EMAIL_PASSWORD in .env

**CORS errors**:
- Check API_URL in JavaScript files
- Ensure server is running
- Verify CORS middleware in server.js

## Future Enhancements

- Mobile app version
- Real-time notifications
- Advanced reporting features
- Video tutorials
- Chat support system
- SMS notifications
- Multi-language support
- Document verification system
- Interview scheduling

## Support

For issues or questions, contact: support@school.edu

## License

This project is licensed under the MIT License.

## Contributors

- Your Name/Organization

## Changelog

### Version 1.0.0
- Initial release
- Core features implemented
- API endpoints established
- Frontend UI completed
