<!-- Still Editing -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="styles.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat" rel="stylesheet">
    </head>

    <body>
        <header>
            <div class="logo">
                <table>
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;<img src="src/logo_miniktm.png" alt="KTMB Logo"></td>
                        <td><h3>KERETAPI TANAH MELAYU BERHAD</h3></td>
                        <td><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Owner - ALYA FARISAH</h3></td>
                        <td><h3>&nbsp;&nbsp;&nbsp;Welcome, [username] !</h3></td>
                    </tr>
                </table>
            </div>

            <!-- User Icon -->
            <div class="user-icon">
                <img src="src/user icon.png" alt="User Icon" id="userIcon">
                <div class="dropdown-menu">
                    <a href="#">User Profile</a>
                    <a href="#">Log Out</a>
                </div>
            </div>
        </header>

        <!-- Navigation Bar -->
        <nav class="navbar">
            <ul>
                <li><a href="admindashboard.php" class="active">Dashboard</a></li>
                <li><a href="maintenance.html">Maintenance Task Management</a></li>
                <li><a href="#">User Management</a></li>
                <li><a href="#">Feedback Management</a></li>
                <li><a href="#">Reported Issue</a></li>
            </ul>
        </nav>   

        <main>
            <div class="dashboard-row">
                <!-- Maintenance Task Management Section -->
                <section class="dashboard-summary" id="maintenance">
                    <div class="summary-box">
                        <h2>Maintenance Task Management</h2>
                        <p>This section is dedicated to managing maintenance tasks for the railway. Administrators can create, update, and monitor tasks.</p>
                        <a href="maintenance.html" class="view-more">View More</a>
                    </div>
                </section>

                <!-- User Management Section -->
                <section class="dashboard-summary" id="user-management">
                    <div class="summary-box">
                        <h2>User Management</h2>
                        <p>Manage the users and access permissions within the system. Create new users and manage their roles.</p>
                        <a href="#" class="view-more">View More</a>
                    </div>
                </section>
            </div>

            <div class="dashboard-row">
                <!-- Feedback Management Section -->
                <section class="dashboard-summary" id="feedback-management">
                    <div class="summary-box">
                        <h2>Feedback Management</h2>
                        <p>Gather and manage feedback from users about the services. Handle feedback for better service improvement.</p>
                        <a href="#" class="view-more">View More</a>
                    </div>
                </section>

                <!-- Reported Issues Section -->
                <section class="dashboard-summary" id="reported-issue">
                    <div class="summary-box">
                        <h2>Reported Issues</h2>
                        <p>Monitor and resolve any issues reported by users. Track issues and their resolution status.</p>
                        <a href="#" class="view-more">View More</a>
                    </div>
                </section>
            </div>
        </main>

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
        </script>
    
    </body>
</html>