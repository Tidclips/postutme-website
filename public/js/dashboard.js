// API Configuration
const API_URL = 'http://localhost/postutme-website/php';
let currentStudent = null;
let authToken = null;

// DOM Elements
const profileForm = document.getElementById('profile-form');
const scoresForm = document.getElementById('scores-form');
const contactForm = document.getElementById('contact-form');
const navLinks = document.querySelectorAll('.sidebar-nav .nav-link');
const contentSections = document.querySelectorAll('.content-section');
const payBtn = document.getElementById('pay-btn');
const logoutBtn = document.querySelector('.nav-link.logout');

// Initialize
document.addEventListener('DOMContentLoaded', async () => {
    authToken = localStorage.getItem('sessionId');

    if (!authToken) {
        window.location.href = 'index.html';
        return;
    }

    // Load student profile
    await loadStudentProfile();

    // Setup event listeners
    setupNavigation();
    setupEventListeners();
});

// Load Student Profile
async function loadStudentProfile() {
    try {
        const response = await fetch(`${API_URL}/students/profile.php`, {
            credentials: 'include',
            headers: {
                'Authorization': `Bearer ${authToken}`,
            },
        });

        const data = await response.json();

        if (data.success) {
            currentStudent = data.data.student;
            populateProfile();
            loadExams();
            loadResults();
        } else {
            showAlert('Error loading profile', 'error');
            logout();
        }
    } catch (error) {
        console.error('Error:', error);
        logout();
    }
}

// Populate Profile
function populateProfile() {
    document.getElementById('user-name').textContent = `${currentStudent.firstName} ${currentStudent.lastName}`;
    document.getElementById('first-name').value = currentStudent.firstName;
    document.getElementById('last-name').value = currentStudent.lastName;
    document.getElementById('email').value = currentStudent.email;
    document.getElementById('phone').value = currentStudent.phoneNumber || '';
    document.getElementById('gender').value = currentStudent.gender || '';
    document.getElementById('state').value = currentStudent.state || '';
    document.getElementById('lga').value = currentStudent.lga || '';
    document.getElementById('address').value = currentStudent.address || '';
    document.getElementById('dob').value = currentStudent.dateOfBirth ? currentStudent.dateOfBirth.split('T')[0] : '';

    // Update status cards
    document.getElementById('registration-status').textContent = currentStudent.registrationStatus || 'Pending';
    document.getElementById('payment-status').textContent = currentStudent.paymentStatus || 'Pending';
    document.getElementById('exam-status').textContent = currentStudent.examStatus || 'Not Taken';
    document.getElementById('admission-status').textContent = currentStudent.admissionStatus || 'Pending';

    // Update registration info
    document.getElementById('reg-number').textContent = currentStudent.registrationNumber || 'N/A';
    document.getElementById('reg-date').textContent = currentStudent.registrationDate ? new Date(currentStudent.registrationDate).toLocaleDateString() : 'N/A';
    document.getElementById('reg-status').textContent = currentStudent.registrationStatus || 'Pending';

    // Update payment info
    document.getElementById('current-payment-status').textContent = currentStudent.paymentStatus || 'Pending';

    // Update score form if scores exist
    if (currentStudent.jamb_score) document.getElementById('jamb-score').value = currentStudent.jamb_score;
    if (currentStudent.waec_score) document.getElementById('waec-score').value = currentStudent.waec_score;
    if (currentStudent.neco_score) document.getElementById('neco-score').value = currentStudent.neco_score;
    if (currentStudent.utme_score) document.getElementById('utme-score').value = currentStudent.utme_score;
    if (currentStudent.o_level_results) document.getElementById('o-level').value = currentStudent.o_level_results;
}

// Setup Navigation
function setupNavigation() {
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            if (link.classList.contains('logout')) return;

            e.preventDefault();
            const targetId = link.getAttribute('href').substring(1);
            switchSection(targetId);
        });
    });
}

// Switch Section
function switchSection(sectionId) {
    contentSections.forEach(section => section.classList.remove('active'));
    navLinks.forEach(link => link.classList.remove('active'));

    const targetSection = document.getElementById(sectionId);
    const targetLink = document.querySelector(`.nav-link[href="#${sectionId}"]`);

    if (targetSection) {
        targetSection.classList.add('active');
        document.getElementById('page-title').textContent = targetSection.querySelector('h2')?.textContent || 'Dashboard';
    }

    if (targetLink) {
        targetLink.classList.add('active');
    }

    window.scrollTo(0, 0);
}

// Setup Event Listeners
function setupEventListeners() {
    if (profileForm) {
        profileForm.addEventListener('submit', updateProfile);
    }

    if (scoresForm) {
        scoresForm.addEventListener('submit', updateScores);
    }

    if (payBtn) {
        payBtn.addEventListener('click', initiatePayment);
    }

    if (logoutBtn) {
        logoutBtn.addEventListener('click', (e) => {
            e.preventDefault();
            logout();
        });
    }
}

// Update Profile
async function updateProfile(e) {
    e.preventDefault();

    const profileData = {
        firstName: document.getElementById('first-name').value,
        lastName: document.getElementById('last-name').value,
        phoneNumber: document.getElementById('phone').value,
        gender: document.getElementById('gender').value,
        state: document.getElementById('state').value,
        lga: document.getElementById('lga').value,
        address: document.getElementById('address').value,
        dateOfBirth: document.getElementById('dob').value,
    };

    try {
        const response = await fetch(`${API_URL}/students/profile.php`, {
            method: 'PUT',
            credentials: 'include',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${authToken}`,
            },
            body: JSON.stringify(profileData),
        });

        const data = await response.json();

        if (data.success) {
            currentStudent = data.data.student;
            showAlert('Profile updated successfully', 'success');
        } else {
            showAlert(data.message || 'Error updating profile', 'error');
        }
    } catch (error) {
        showAlert('Error: ' + error.message, 'error');
    }
}

// Update Scores
async function updateScores(e) {
    e.preventDefault();

    const scoresData = {
        jamb_score: document.getElementById('jamb-score').value || null,
        waec_score: document.getElementById('waec-score').value || null,
        neco_score: document.getElementById('neco-score').value || null,
        utme_score: document.getElementById('utme-score').value || null,
        o_level_results: document.getElementById('o-level').value,
    };

    try {
        const response = await fetch(`${API_URL}/students/scores.php`, {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${authToken}`,
            },
            body: JSON.stringify(scoresData),
        });

        const data = await response.json();

        if (data.success) {
            currentStudent = data.data.student;
            showAlert('Scores updated successfully', 'success');
        } else {
            showAlert(data.message || 'Error updating scores', 'error');
        }
    } catch (error) {
        showAlert('Error: ' + error.message, 'error');
    }
}

// Initiate Payment
async function initiatePayment() {
    try {
        const response = await fetch(`${API_URL}/payments/payment.php`, {
            method: 'POST',
            credentials: 'include',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${authToken}`,
            },
            body: JSON.stringify({ amount: 5000 }),
        });

        const data = await response.json();

        if (data.success) {
            showAlert('Payment initiated. Redirecting to payment gateway...', 'success');
            // In a real scenario, redirect to Paystack or Flutterwave
            setTimeout(() => {
                alert(`Payment Reference: ${data.data.paymentReference}\nAmount: ₦${data.data.amount}`);
            }, 1500);
        } else {
            showAlert(data.message || 'Error initiating payment', 'error');
        }
    } catch (error) {
        showAlert('Error: ' + error.message, 'error');
    }
}

// Load Exams
async function loadExams() {
    try {
        const response = await fetch(`${API_URL}/exams/get_exams.php`, {
            credentials: 'include',
            headers: {
                'Authorization': `Bearer ${authToken}`,
            },
        });

        const data = await response.json();
        const examsList = document.getElementById('exams-list');

        if (data.success && data.data.exams.length > 0) {
            examsList.innerHTML = data.data.exams.map(exam => `
                <div class="exam-card">
                    <h4>${exam.title}</h4>
                    <p><strong>Subject:</strong> ${exam.subject || 'N/A'}</p>
                    <p><strong>Date:</strong> ${new Date(exam.examDate).toLocaleDateString()}</p>
                    <p><strong>Duration:</strong> ${exam.duration} minutes</p>
                    <p><strong>Questions:</strong> ${exam.totalQuestions}</p>
                    <p><strong>Status:</strong> ${exam.status}</p>
                    ${exam.status === 'ongoing' ? '<button class="btn btn-primary" onclick="startExam(\'' + exam._id + '\')">Start Exam</button>' : ''}
                </div>
            `).join('');
        } else {
            examsList.innerHTML = '<p>No exams available</p>';
        }
    } catch (error) {
        console.error('Error loading exams:', error);
    }
}

// Load Results
async function loadResults() {
    try {
        const response = await fetch(`${API_URL}/results/get_results.php`, {
            credentials: 'include',
            headers: {
                'Authorization': `Bearer ${authToken}`,
            },
        });

        const data = await response.json();
        const resultsList = document.getElementById('results-list');

        if (data.success && data.data.results.length > 0) {
            resultsList.innerHTML = data.data.results.map(result => `
                <div class="result-card">
                    <h4>${result.examId.title}</h4>
                    <p><strong>Score:</strong> ${result.score} / ${result.totalMarks}</p>
                    <p><strong>Percentage:</strong> ${result.percentage.toFixed(2)}%</p>
                    <p><strong>Status:</strong> ${result.status}</p>
                    <p><strong>Grade:</strong> ${result.grade || 'N/A'}</p>
                </div>
            `).join('');
        } else {
            resultsList.innerHTML = '<p>No results available yet</p>';
        }
    } catch (error) {
        console.error('Error loading results:', error);
    }
}

// Start Exam
function startExam(examId) {
    window.location.href = `exam.html?id=${examId}`;
}

// Utility Functions
function showAlert(message, type = 'info') {
    const alert = document.createElement('div');
    alert.className = `alert alert-${type}`;
    alert.textContent = message;
    alert.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem;
        border-radius: 8px;
        z-index: 1000;
        animation: slideIn 0.3s ease-in;
    `;

    if (type === 'success') {
        alert.style.backgroundColor = '#d1fae5';
        alert.style.color = '#065f46';
    } else if (type === 'error') {
        alert.style.backgroundColor = '#fee2e2';
        alert.style.color = '#7f1d1d';
    }

    document.body.appendChild(alert);

    setTimeout(() => {
        alert.remove();
    }, 5000);
}

function logout() {
    localStorage.removeItem('sessionId');
    window.location.href = 'index.html';
}

// Make switchSection accessible globally
window.switchSection = switchSection;
window.startExam = startExam;
