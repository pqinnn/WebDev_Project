<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="styles.css">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto" rel="stylesheet">
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

    <!-- Main content -->
    <main>
        <!-- Feedback Form Section -->
        <section class="feedback-form">
            <h2>Submit Your Feedback</h2>
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="feedback-type">Feedback Type</label>
                    <select id="feedback-type" name="feedback_type">
                        <option value="suggestion">Suggestion</option>
                        <option value="complaint">Complaint</option>
                        <option value="inquiry">Inquiry</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="feedback-message">Message</label>
                    <textarea id="feedback-message" name="feedback_message" rows="4" required></textarea>
                </div>
                <button type="submit" class="submit-feedback-btn">Submit Feedback</button>
            </form>
        </section>

        <!-- Submitted Feedback Section -->
        <section class="submitted-feedback">
            <h2>Recent Feedback Submissions</h2>
            <div class="feedback-list">
                <!-- Example Feedback entry -->
                <div class="feedback-entry">
                    <h3>Suggestion</h3>
                    <p>"The waiting time at the stations can be reduced if the trains run more frequently."</p>
                    <small>Submitted by: [user1] | Date: 2024-12-16</small>
                </div>
                <div class="feedback-entry">
                    <h3>Complaint</h3>
                    <p>"The air conditioning in some train cars is not functioning properly."</p>
                    <small>Submitted by: [user2] | Date: 2024-12-15</small>
                </div>
                <!-- More feedback will be dynamically added here -->
            </div>
        </section>
    </main>
</body>
</html>
