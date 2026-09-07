# Post-UTME Examination Portal
## Complete Setup & Deployment Guide

**A web-based Post-UTME examination registration, payment, and results portal built with PHP, MySQL, HTML, CSS, and JavaScript using XAMPP.**

---

## 📋 Quick Navigation

- [Project Overview](#-project-overview)
- [System Requirements](#-system-requirements)
- [Project Structure](#-project-structure)
- [Installation Steps](#-installation-steps)
- [Database Setup](#-database-setup)
- [Running the Project](#-running-the-project)
- [Making Changes](#-making-changes-effectively)
- [Troubleshooting](#-troubleshooting)

---

## 🎯 Project Overview

### What is this?
A complete web application for Post-UTME examinations that enables:
- ✅ Student online registration
- ✅ Score submissions (JAMB, WAEC, NECO, UTME)
- ✅ Online payment processing
- ✅ Exam information display
- ✅ Results checking
- ✅ Admission status tracking
- ✅ Contact form for inquiries

### Tech Stack
| Component | Technology |
|-----------|-----------|
| **Frontend** | HTML5, CSS3, JavaScript (Vanilla) |
| **Backend** | PHP 7.4+ |
| **Database** | MySQL 5.7+ |
| **Server** | XAMPP (Apache + PHP + MySQL) |

### Key Advantages
- ✨ No Node.js required
- ✨ Simple PHP backend
- ✨ Standard MySQL database
- ✨ Easy to understand and modify
- ✨ Lightweight and fast
- ✨ Perfect for small to medium projects

---

## ⚙️ System Requirements

### Before Starting

1. **XAMPP** (Apache + PHP + MySQL)
   - Download: https://www.apachefriends.org
   - PHP Version: 7.4 or higher
   - MySQL Version: 5.7 or higher

2. **Web Browser**
   - Chrome, Firefox, Safari, Edge (latest versions)

3. **Text Editor** (optional, for code changes)
   - VS Code, Sublime Text, Notepad++, or any text editor

4. **System Resources**
   - RAM: 2GB minimum
   - Disk Space: 500MB
   - Operating System: Windows, Mac, or Linux

### Check Your Setup

After XAMPP installation, verify by opening:
- **phpMyAdmin:** http://localhost/phpmyadmin
- **Apache Welcome:** http://localhost
- **PHP Info:** http://localhost/xampp

If these pages load, XAMPP is installed correctly!

---

## 📁 Project Structure Explained

```
postutme-website/                      # Root folder
│
├── 📂 public/                         # Frontend files (HTML, CSS, JS)
│   ├── index.html                     # Home/landing page
│   ├── dashboard.html                 # Student dashboard (requires login)
│   │
│   ├── 📂 css/                        # Stylesheet files
│   │   ├── styles.css                 # Home page styles
│   │   └── dashboard.css              # Dashboard styles
│   │
│   └── 📂 js/                         # JavaScript files
│       ├── main.js                    # Home page logic
│       └── dashboard.js               # Dashboard logic
│
├── 📂 php/                            # Backend PHP files (Server logic)
│   ├── config.php                     # 🔑 Database connection config
│   │
│   ├── 📂 auth/                       # Authentication files
│   │   ├── register.php               # New student registration
│   │   ├── login.php                  # Student login
│   │   ├── verify.php                 # Verify session token
│   │   └── logout.php                 # Logout user
│   │
│   ├── 📂 students/                   # Student management
│   │   ├── profile.php                # Get/update student profile
│   │   ├── scores.php                 # Store exam scores
│   │   └── list.php                   # List all students
│   │
│   ├── 📂 exams/                      # Exam management
│   │   ├── get_exams.php              # Retrieve exam list
│   │   └── create.php                 # Create new exam (admin)
│   │
│   ├── 📂 results/                    # Results management
│   │   └── get_results.php            # Retrieve student results
│   │
│   ├── 📂 payments/                   # Payment processing
│   │   └── payment.php                # Handle payments
│   │
│   ├── 📂 admin/                      # Admin dashboard
│   │   └── stats.php                  # Get dashboard statistics
│   │
│   └── 📂 contact/                    # Contact form
│       └── send_message.php           # Process contact messages
│
├── 📂 mysql/                          # Database files
│   └── database.sql                   # 🗄️ Database schema & sample data
│
└── README.md                          # This file

```

### File Size Guide
- Each HTML file: ~5-10 KB
- Each CSS file: ~3-5 KB
- Each JS file: ~5-8 KB
- Each PHP file: ~2-3 KB
- Total project: ~100 KB

---

## 🚀 Installation Steps (Windows)

### Step 1: Download XAMPP

1. Visit: **https://www.apachefriends.org**
2. Click **Download** for your Windows version (32-bit or 64-bit)
3. Run the downloaded `.exe` file
4. Choose language and click **OK**
5. Accept the License Agreement

### Step 2: Install XAMPP

1. Choose installation folder (default: `C:\xampp`)
2. Select components to install:
   - ✅ Apache
   - ✅ MySQL
   - ☐ PHP (already included with Apache)
   - ☐ Perl (optional)
3. Click **Install** and wait for completion
4. When asked to start the Control Panel, click **Yes**

### Step 3: Verify Apache & MySQL Start

1. The XAMPP Control Panel should open
2. Click **Start** next to:
   - **Apache** → Should turn green ✅
   - **MySQL** → Should turn green ✅
3. If they don't start:
   - Check if ports 80 (Apache) or 3307 (MySQL) are in use
   - Close conflicting applications
   - Try starting again

### Step 4: Test XAMPP Installation

1. Open web browser
2. Type: `http://localhost`
3. You should see the XAMPP welcome page
4. If you see it, installation is successful! ✅

### Step 5: Copy Project Files

1. Open File Manager
2. Navigate to: `C:\xampp\htdocs`
3. Paste the entire `postutme-website` folder here
4. Result path should be: `C:\xampp\htdocs\postutme-website\`

---

## 📊 Database Setup Guide

### What is a Database?
A database stores all the information:
- Student registrations
- Exam details
- Results
- Payment records
- Contact messages

### Method 1: Using phpMyAdmin (Recommended)

**Step 1: Open phpMyAdmin**
1. Open web browser
2. Go to: `http://localhost/phpmyadmin`
3. You should see phpMyAdmin interface
4. Default login:
   - Username: `root`
   - Password: (leave blank, just press Tab or click Go)

**Step 2: Import Database**
1. Click the **Import** tab at the top
2. Click **Choose File**
3. Navigate to: `C:\xampp\htdocs\postutme-website\mysql\`
4. Select: `database.sql`
5. Click **Open**
6. Click **Go** button
7. Wait for the import to complete
8. You should see: "Import has been successfully finished" ✅

**Step 3: Verify Database**
1. On the left sidebar, click **Refresh** (circular arrow)
2. You should now see `elonmusk_postutme_db` in the database list
3. Click on it to expand and view the tables:
   - `students`
   - `exams`
   - `results`
   - `contact_messages`
   - `payments`

### Method 2: Using phpMyAdmin SQL Interface

**Step 1: Open SQL Editor**
1. Go to: `http://localhost/phpmyadmin`
2. Login if needed
3. Click the **SQL** tab

**Step 2: Copy & Paste SQL**
1. Open `mysql/database.sql` with a text editor
2. Copy all the content (Ctrl+A, then Ctrl+C)
3. Paste into phpMyAdmin SQL editor
4. Click **Go**
5. Wait for completion

### Step 3: Verify Tables Were Created

Run this query to see all tables:
```sql
SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'elonmusk_postutme_db';
```

You should see these tables:
- students
- exams
- results
- contact_messages
- payments

---

## ⚙️ Configuration Files

### Main Configuration: `php/config.php`

This file connects your PHP to MySQL:

```php
<?php
define('DB_HOST', 'localhost');      // Database location
define('DB_PORT', 3307);             // MySQL/MariaDB port
define('DB_USER', 'root');           // MySQL username (default: root)
define('DB_PASSWORD', '');           // MySQL password (default: empty)
define('DB_NAME', 'elonmusk_postutme_db'); // Database name
?>
```

**Default XAMPP Credentials:**
- Host: `localhost`
- Username: `root`
- Password: (empty - no password)
- Database: `elonmusk_postutme_db`
- Port: `3307` in the current configuration; use `3306` for a default XAMPP installation

### Frontend Configuration: `public/js/main.js` & `public/js/dashboard.js`

Both files use:
```javascript
const API_URL = 'http://localhost/postutme-website/php';
```

**Update this if:**
- You changed the project folder name
- You're deploying to a different server
- You changed the domain name

---

## 🏃 Running the Project

### Every Time You Work on the Project

**Step 1: Start XAMPP**
1. Open XAMPP Control Panel
2. Click **Start** for Apache and MySQL
3. Both should be green ✅

**Step 2: Access the Website**
1. Open web browser
2. Type: `http://localhost/postutme-website/public/index.html`
3. You should see the home page 🎉

**Step 3: Test Features**

**Test Registration:**
1. Click "Register" button
2. Fill in form:
   - First Name: John
   - Last Name: Doe
   - Email: john@example.com
   - Phone: 08012345678
   - Password: password123
3. Click Register
4. Should redirect to dashboard

**Test Login:**
1. Go back to home page
2. Click "Login"
3. Email: john@example.com
4. Password: password123
5. Click Login

**View Exams:**
1. Scroll down on home page
2. You'll see 3 sample exams (already loaded in database)

**Access Dashboard:**
1. After login, you're automatically on dashboard
2. View: Profile, Scores, Payment, Exams, Results

---

## 🔧 Making Changes Effectively & Efficiently

### ✏️ Adding a New Student (Using phpMyAdmin)

1. Go to: `http://localhost/phpmyadmin`
2. Click `elonmusk_postutme_db` → `students` table
3. Click **Insert** tab
4. Fill in the form with student details
5. Click **Go**

### ✏️ Adding an Exam

1. Go to: `http://localhost/phpmyadmin`
2. Click `elonmusk_postutme_db` → `exams` table
3. Click **Insert** tab
4. Fill in fields:
   - **title:** e.g., "Mathematics"
   - **subject:** e.g., "Mathematics"
   - **duration:** 120 (minutes)
   - **totalQuestions:** 50
   - **passingScore:** 40
   - **totalMarks:** 100
   - **examDate:** 2024-09-15 09:00:00
   - **status:** scheduled
5. Click **Go**

### ✏️ Updating Student Status

To mark a student as admitted:
1. Go to: `http://localhost/phpmyadmin`
2. Click `elonmusk_postutme_db` → `students`
3. Find the student row
4. Click the **Edit** icon (pencil)
5. Change `admissionStatus` to "admitted"
6. Click **Go**

### ✏️ Editing HTML Layout

**File:** `public/index.html` or `public/dashboard.html`

1. Open with text editor
2. Make changes to HTML
3. Save file (Ctrl+S)
4. Refresh browser (F5)

**Example: Change page title**
```html
<!-- Find this line: -->
<title>Post-UTME Examination Portal</title>

<!-- Change to: -->
<title>My School Post-UTME Portal</title>
```

### ✏️ Editing Styles (CSS)

**File:** `public/css/styles.css` or `public/css/dashboard.css`

1. Open with text editor
2. Find the CSS rule you want to change
3. Modify the values
4. Save file
5. Refresh browser (Ctrl+F5 for hard refresh)

**Example: Change primary color**
```css
/* Find this: */
:root {
    --primary-color: #2563eb;  /* Blue */
}

/* Change to: */
:root {
    --primary-color: #16a34a;  /* Green */
}
```

### ✏️ Editing JavaScript Logic

**File:** `public/js/main.js` or `public/js/dashboard.js`

1. Open with text editor
2. Find the function you want to change
3. Modify the code
4. Save file
5. Refresh browser

### ✏️ Editing PHP Backend

**File:** Any file in `php/` folder

1. Open with text editor
2. Make changes
3. Save file
4. Test in browser (changes are immediate)

**Example: Change database query**
```php
// Original query
$query = "SELECT * FROM students WHERE admissionStatus = 'admitted'";

// Modified query
$query = "SELECT * FROM students WHERE registrationStatus = 'completed'";
```

---

## 🎨 Example: Adding a New Form Field

### Goal: Add "State of Origin" to registration form

**Step 1: Update Database** (Optional - field might exist)
```sql
ALTER TABLE students ADD COLUMN state_origin VARCHAR(50);
```

**Step 2: Update HTML Form** (`public/index.html`)
```html
<!-- Add this field in the register form: -->
<div class="form-group">
    <label for="state">State of Origin</label>
    <input type="text" id="state" name="state" required>
</div>
```

**Step 3: Update JavaScript** (`public/js/main.js`)
```javascript
// In registerForm submit handler, add:
const state = document.getElementById('state').value;

// Then include in API call:
body: JSON.stringify({
    firstName,
    lastName,
    email,
    phoneNumber,
    password,
    state: state  // Add this line
}),
```

**Step 4: Update PHP** (`php/auth/register.php`)
```php
// Add to input extraction:
$state = $conn->real_escape_string($input['state'] ?? '');

// Add to SQL INSERT:
state='$state',
```

**Step 5: Test**
1. Save all files
2. Refresh browser
3. Go to registration form
4. New field should appear
5. Try registering with state

---

## 🐛 Troubleshooting

### ❌ Problem: "Cannot connect to database"

**Causes & Solutions:**
1. MySQL is not running
   - ✅ Open XAMPP Control Panel
   - ✅ Start MySQL service
   - ✅ Wait 5 seconds and refresh

2. Wrong database credentials in `php/config.php`
   - ✅ Check DB_USER is "root"
   - ✅ Check DB_PASSWORD is empty
   - ✅ Check DB_NAME is "elonmusk_postutme_db"

3. Database doesn't exist
   - ✅ Go to http://localhost/phpmyadmin
   - ✅ Import the database.sql file
   - ✅ Verify it appears in database list

### ❌ Problem: "Page not found (404 error)"

**Solutions:**
1. Wrong URL in browser
   - ✅ Correct URL: `http://localhost/postutme-website/public/index.html`
   - ✅ NOT: `http://localhost:5000`

2. Project not in correct folder
   - ✅ Should be: `C:\xampp\htdocs\postutme-website\`
   - ✅ NOT: Desktop or Documents

3. Apache not running
   - ✅ Open XAMPP Control Panel
   - ✅ Click Start for Apache

### ❌ Problem: "Cannot login/register"

**Solutions:**
1. Check browser console for errors
   - ✅ Press F12 to open Developer Tools
   - ✅ Click Console tab
   - ✅ Look for red error messages
   - ✅ Screenshot and troubleshoot

2. Database is empty
   - ✅ Go to phpMyAdmin
   - ✅ Check if students table has data
   - ✅ Re-import database.sql if empty

3. Session not working
   - ✅ Ensure PHP is running
   - ✅ Try logging in again
   - ✅ Clear browser cookies (Ctrl+Shift+Delete)

### ❌ Problem: "White/blank page displayed"

**Solutions:**
1. Enable PHP error reporting
   - ✅ Create file: `C:\xampp\htdocs\test.php`
   - ✅ Add: `<?php phpinfo(); ?>`
   - ✅ Visit: `http://localhost/test.php`
   - ✅ If error messages show, PHP is working

2. Check PHP error logs
   - ✅ Look in: `C:\xampp\apache\logs\error.log`
   - ✅ Look in: `C:\xampp\php\logs\php_error.log`

3. JavaScript error
   - ✅ Press F12 → Console tab
   - ✅ Look for red errors
   - ✅ Fix based on error message

### ❌ Problem: "Styles not loading (no CSS)"

**Solutions:**
1. Clear browser cache
   - ✅ Press Ctrl+Shift+Delete
   - ✅ Clear all cache
   - ✅ Refresh page (Ctrl+F5)

2. Wrong CSS file path
   - ✅ Open page source (Ctrl+U)
   - ✅ Check CSS link URLs
   - ✅ Verify files exist in css/ folder

---

## 📚 Useful URLs & Shortcuts

| Item | URL/Location |
|------|------|
| Home Page | http://localhost/postutme-website/public/index.html |
| Dashboard | http://localhost/postutme-website/public/dashboard.html |
| Database Manager | http://localhost/phpmyadmin |
| Apache Status | http://localhost |
| XAMPP Folder | C:\xampp |
| Project Folder | C:\xampp\htdocs\postutme-website |
| PHP Config | C:\xampp\htdocs\postutme-website\php\config.php |
| Database File | C:\xampp\htdocs\postutme-website\mysql\database.sql |

---

## 📱 Access from Mobile

### On Same WiFi Network

1. Find your computer IP:
   - Press `Win + R`
   - Type: `ipconfig`
   - Look for "IPv4 Address" (e.g., 192.168.1.100)

2. On mobile, visit:
   - `http://192.168.1.100/postutme-website/public/index.html`

### Via USB Cable (Android)

1. Connect phone with USB cable
2. Enable USB Debugging on phone
3. Use port forwarding:
   - Use ADB (Android Debug Bridge)
   - Or use Android Studio device emulator

---

## 🔒 Security Recommendations

### For Development (Current Setup)
- ✅ Current setup is good for learning
- ✅ No passwords exposed
- ✅ Database is protected by localhost

### Before Going Live

1. **Change MySQL Password:**
   ```sql
   ALTER USER 'root'@'localhost' IDENTIFIED BY 'StrongPassword123!';
   ```

2. **Update config.php:**
   ```php
   define('DB_PASSWORD', 'StrongPassword123!');
   ```

3. **Secure Input Validation:**
   - Already done with `real_escape_string()`
   - For production, use prepared statements

4. **Enable HTTPS:**
   - Get SSL certificate
   - Install on your server

5. **Remove Test Files:**
   - Delete any test.php files
   - Remove phpMyAdmin access (change URL)

---

## 💾 Backup & Restore

### Backup Database

1. Go to http://localhost/phpmyadmin
2. Click on `elonmusk_postutme_db`
3. Click **Export** tab
4. Format: SQL
5. Click **Go**
6. Save the file as `backup.sql`

### Restore Database

1. Delete current database:
   - Click `elonmusk_postutme_db`
   - Click **Operations** tab
   - Click **Drop** (delete)

2. Import backup:
   - Click **Import** tab
   - Choose `backup.sql`
   - Click **Go**

---

## 🚀 Next Steps

### Immediate Tasks
- [ ] Install XAMPP
- [ ] Copy project files to htdocs
- [ ] Create database from database.sql
- [ ] Test website at localhost
- [ ] Test registration
- [ ] Test login
- [ ] Test dashboard access

### Enhancement Tasks
- [ ] Customize school name and logo
- [ ] Change color scheme to match school
- [ ] Add more exams
- [ ] Set up payment gateway
- [ ] Configure email notifications
- [ ] Add exam interface

### Deployment Tasks
- [ ] Get web hosting
- [ ] Upload files via FTP
- [ ] Update database credentials
- [ ] Set up domain name
- [ ] Install SSL certificate
- [ ] Monitor performance

---

## 📞 Getting Help

### Common Issues Search
- Google: "XAMPP [your issue]"
- XAMPP Forum: https://www.apachefriends.org
- PHP Documentation: https://www.php.net
- MySQL Documentation: https://dev.mysql.com

### Debug Mode

**Enable PHP Debugging:**
1. Open: `C:\xampp\php\php.ini`
2. Find: `display_errors = Off`
3. Change to: `display_errors = On`
4. Find: `error_reporting = E_ALL & ~E_NOTICE`
5. Restart Apache

**Check PHP Error Logs:**
- Windows: `C:\xampp\php\logs\php_error.log`
- View with any text editor

---

## 📋 File Checklist

**Essential Files Present:**
- [ ] `public/index.html`
- [ ] `public/dashboard.html`
- [ ] `public/css/styles.css`
- [ ] `public/css/dashboard.css`
- [ ] `public/js/main.js`
- [ ] `public/js/dashboard.js`
- [ ] `php/config.php`
- [ ] `php/auth/register.php`
- [ ] `php/auth/login.php`
- [ ] `mysql/database.sql`
- [ ] `README.md` (this file)

---

## 📄 License

This project is open-source and free for educational use.

---

## 👨‍💻 Developer Notes

### Code Structure Philosophy
- **Simple & Readable:** Easy for beginners to understand
- **Well-Commented:** Each file explains what it does
- **Modular:** Each folder has a specific purpose
- **Scalable:** Easy to add new features

### Common Tasks & Where to Find Them

| Task | File Location |
|------|---|
| Add new registration field | `php/auth/register.php` + `public/index.html` + `public/js/main.js` |
| Add new exam | Use phpMyAdmin Insert |
| Change colors | `public/css/styles.css` (search `:root`) |
| Change homepage text | `public/index.html` |
| Add database field | Run SQL in phpMyAdmin |
| Modify student dashboard | `public/dashboard.html` |

---

## 🎉 You're All Set!

You now have a fully functional Post-UTME portal running locally. Start by:

1. ✅ Opening http://localhost/postutme-website/public/index.html
2. ✅ Registering a test student
3. ✅ Logging in
4. ✅ Exploring the dashboard
5. ✅ Adding exams via phpMyAdmin

**Happy coding! 🚀**

---

*Last Updated: 2024*  
*Version: 1.0 - PHP/MySQL*  
*For questions or issues, refer to the troubleshooting section above.*
