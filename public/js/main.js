// API Configuration
const API_URL = new URL('../php', window.location.href).toString();
let currentUser = null;

// DOM Elements
const loginForm = document.getElementById('login-form');
const registerForm = document.getElementById('register-form');
const contactForm = document.getElementById('contact-form');
const examsList = document.getElementById('exams-list');
const loginModal = document.getElementById('login-modal');
const registerModal = document.getElementById('register-modal');
const loginLink = document.querySelector('[href="#login"]');
const registerLink = document.querySelector('[href="#register"]');

// Modal Functions
function openModal(modal) {
    modal.style.display = 'block';
}

function closeModal(modal) {
    modal.style.display = 'none';
}

// Setup modal close buttons
document.querySelectorAll('.close').forEach(closeBtn => {
    closeBtn.addEventListener('click', function() {
        this.closest('.modal').style.display = 'none';
    });
});

// Setup modal open links
if (loginLink) {
    loginLink.addEventListener('click', (e) => {
        e.preventDefault();
        openModal(loginModal);
    });
}

if (registerLink) {
    registerLink.addEventListener('click', (e) => {
        e.preventDefault();
        openModal(registerModal);
    });
}

// Close modal when clicking outside
window.addEventListener('click', function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
});

// Handle Login
if (loginForm) {
    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const email = document.getElementById('login-email').value;
        const password = document.getElementById('login-password').value;

        try {
            const response = await fetch(`${API_URL}/auth/login.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                credentials: 'include',
                body: JSON.stringify({ email, password }),
            });

            const data = await response.json();

            if (data.success) {
                localStorage.setItem('sessionId', data.data.token);
                currentUser = data.data.student;
                showAlert('Login successful! Redirecting...', 'success');
                setTimeout(() => {
                    window.location.href = 'dashboard.html';
                }, 1500);
            } else {
                showAlert(data.message || 'Login failed', 'error');
            }
        } catch (error) {
            showAlert('Unable to fetch. Please check that the server is running and try again.', 'error');
            console.error('Login fetch error:', error);
        }
    });
}

// Handle Registration
if (registerForm) {
    registerForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const firstName = document.getElementById('first-name').value;
        const lastName = document.getElementById('last-name').value;
        const email = document.getElementById('reg-email').value;
        const phoneNumber = document.getElementById('phone').value;
        const password = document.getElementById('password').value;

        try {
            const response = await fetch(`${API_URL}/auth/register.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                credentials: 'include',
                body: JSON.stringify({
                    firstName,
                    lastName,
                    email,
                    phoneNumber,
                    password,
                }),
            });

            const data = await response.json();

            if (data.success) {
                localStorage.setItem('sessionId', data.data.token);
                currentUser = data.data.student;
                showAlert('Registration successful! Redirecting...', 'success');
                setTimeout(() => {
                    window.location.href = 'dashboard.html';
                }, 1500);
            } else {
                showAlert(data.message || 'Registration failed', 'error');
            }
        } catch (error) {
            showAlert('Unable to fetch. Please check that the server is running and try again.', 'error');
            console.error('Registration fetch error:', error);
        }
    });
}

// Handle Contact Form
if (contactForm) {
    contactForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const subject = document.getElementById('subject').value;
        const message = document.getElementById('message').value;

        try {
            const response = await fetch(`${API_URL}/contact/send_message.php`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ name, email, subject, message }),
            });

            const data = await response.json();

            if (data.success) {
                showAlert(data.message, 'success');
                contactForm.reset();
            } else {
                showAlert(data.message || 'Error sending message', 'error');
            }
        } catch (error) {
            showAlert('Unable to fetch. Please check that the server is running and try again.', 'error');
            console.error('Contact form fetch error:', error);
        }
    });
}

// Load Exams
async function loadExams() {
    try {
        const response = await fetch(`${API_URL}/exams/get_exams.php`);
        const data = await response.json();

        if (data.success && data.data.exams.length > 0) {
            examsList.innerHTML = data.data.exams.map(exam => `
                <div class="exam-card">
                    <h3>${exam.title}</h3>
                    <p><strong>Subject:</strong> ${exam.subject || 'N/A'}</p>
                    <p><strong>Date:</strong> <span class="exam-date">${new Date(exam.examDate).toLocaleDateString()}</span></p>
                    <p><strong>Duration:</strong> ${exam.duration} minutes</p>
                    <p><strong>Total Questions:</strong> ${exam.totalQuestions}</p>
                    <p><strong>Status:</strong> <span style="color: ${exam.status === 'scheduled' ? '#ea580c' : '#16a34a'}">${exam.status}</span></p>
                    <p>${exam.description || ''}</p>
                </div>
            `).join('');
        } else {
            examsList.innerHTML = '<p>No exams available at the moment.</p>';
        }
    } catch (error) {
        console.error('Error loading exams:', error);
        examsList.innerHTML = '<p>Error loading exams. Please try again later.</p>';
    }
}

// Utility Functions
function showAlert(message, type = 'info') {
    // Create alert element
    const alert = document.createElement('div');
    alert.className = `alert alert-${type}`;
    alert.textContent = message;

    // Add to body
    document.body.prepend(alert);

    // Remove after 5 seconds
    setTimeout(() => {
        alert.remove();
    }, 5000);
}

// Check if user is logged in
function checkAuth() {
    const sessionId = localStorage.getItem('sessionId');
    if (sessionId) {
        const navLinks = document.querySelector('.nav-links');
        if (navLinks) {
            navLinks.innerHTML = `
                <li><a href="#home">Home</a></li>
                <li><a href="#exams">Exams</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="dashboard.html">Dashboard</a></li>
                <li><a href="#" id="logout-btn">Logout</a></li>
            `;

            document.getElementById('logout-btn').addEventListener('click', (e) => {
                e.preventDefault();
                localStorage.removeItem('sessionId');
                location.reload();
            });
        }
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    checkAuth();
    loadExams();
});
