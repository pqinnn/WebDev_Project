<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <table>
                <tr>
                    <td><img src="src/logo_miniktm.png" alt="KTMB Logo"></td>
                    <td><h3>KERETAPI TANAH MELAYU BERHAD</h3></td>
                    <td><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Owner - Haziq</h3></td>
                    <td><h3>&nbsp;&nbsp;&nbsp;Welcome, [username] !</h3></td>
                </tr>
            </table>
        </div>
    </header>
        
        
        <!-- Navigation Bar -->
        <nav class="navbar2">
            <ul class="trytgok">
                <li><a href="index.html">Dashboard</a></li>
                <li><a href="maintenance.html">Maintenance Task Management</a></li>
                <li><a href="UserManagementPage.html">User Management</a></li>
                <li><a href="#">Reported Issue</a></li>
                <li><a href="aboutUs_staff.php" class="active">About Us</a></li>
            </ul>
        
            <!-- User Icon -->
            <div class="user-icon2">
                <img src="src/user icon.png" alt="User Icon" id="userIcon">
                <div class="dropdown-menu">
                    <a href="#">User Profile</a>
                    <a href="#">Log Out</a>
                </div>
            </div>
        </nav>

    <!-- FAQ Section -->
    <div class="faq-container">
        <h1>Frequently Asked Questions</h1>
        
        <div class="faq-section">
            <h2>General Questions</h2>
            <div class="faq-item">
                <div class="faq-question">What is the Railway Maintenance Management System?</div>
                <div class="faq-answer">The Railway Maintenance Management System is a comprehensive platform designed for KTMB to manage and track maintenance tasks, user roles, and system security through RBAC and MFA implementation.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">How does the Role-Based Access Control (RBAC) work?</div>
                <div class="faq-answer">RBAC assigns specific permissions to different user roles (e.g., admin, maintenance staff, supervisor) to ensure users can only access the features and information relevant to their responsibilities.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">What is Multi-Factor Authentication (MFA)?</div>
                <div class="faq-answer">MFA adds an extra layer of security by requiring users to verify their identity through multiple methods (e.g., password + SMS code or email verification) before accessing the system.</div>
            </div>
        </div>

        <div class="faq-section">
            <h2>Maintenance Management</h2>
            <div class="faq-item">
                <div class="faq-question">How do I create a new maintenance task?</div>
                <div class="faq-answer">Navigate to the Maintenance Task Management section, click on "Create New Task," fill in the required details including task description, priority, and deadline, then submit the form.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">How can I track the progress of maintenance tasks?</div>
                <div class="faq-answer">The system provides real-time status updates and tracking features in the dashboard. You can view task status, completion percentage, and maintenance history.</div>
            </div>
        </div>

        <div class="faq-section">
            <h2>User Management & Security</h2>
            <div class="faq-item">
                <div class="faq-question">How do I reset my password?</div>
                <div class="faq-answer">Click on "Forgot Password" on the login page, enter your registered email, and follow the instructions sent to your email to reset your password.</div>
            </div>

            <div class="faq-item">
                <div class="faq-question">What should I do if I can't access my account?</div>
                <div class="faq-answer">Contact your system administrator or the IT support team for assistance. They can help verify your identity and restore access to your account.</div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript for Dropdown Menu
        const userIcon = document.getElementById('userIcon');
        const dropdownMenu = document.querySelector('.dropdown-menu');

        userIcon.addEventListener('click', () => {
            dropdownMenu.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        window.addEventListener('click', (e) => {
            if (!userIcon.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });

        // FAQ Toggle Functionality
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const faqItem = question.parentElement;
                faqItem.classList.toggle('active');
            });
        });
    </script>

</body>
</html>