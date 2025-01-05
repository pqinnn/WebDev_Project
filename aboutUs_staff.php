<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <table>
                <tr>
                    <td><img src="src/logo_miniktm.png" alt="KTMB Logo"></td>
                    <td><h3>KERETAPI TANAH MELAYU BERHAD</h3></td>
                    <td><h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Owner - Alya Farisah</h3></td>
                    <td><h3>&nbsp;&nbsp;&nbsp;Welcome, [username] !</h3></td>
                </tr>
            </table>
        </div>
    </header>
        
    <!-- Navigation Bar -->
    <nav class="navbar2">
        <ul class="trytgok">
            <li><a href="staff_dash.html">Dashboard</a></li>
            <li><a href="#">Issue Report</a></li>
            <li><a href="#">Feedback</a></li>
            <li><a href="#">History</a></li>
            <li><a href="aboutUs_staff.php">About Us</a></li>
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


    <main>
        
        <div class="picture">
            <img class="ktmb-image" src="src/web-img.png" alt="Welcome to KTMB Maintenance Management System">
        </div>        

        <!-- Introduction text -->
        <div class="introduction">
            <p>Welcome to KTMB's railway management system!</p>
            <p><b>Keretapi Tanah Melayu Berhad (KTMB)</b> is Malaysia's leading railway operator, providing safe, reliable, and efficient rail services across the country. With over 70 years of history, KTMB plays a crucial role in connecting communities, fostering economic growth, and supporting Malaysia's transportation infrastructure.</p>
            <p>Central to KTMB’s operations is our focus on <b>Maintenance System</b>. This system ensures the ongoing reliability, safety, and efficiency of our rail services by effectively managing maintenance tasks, optimizing equipment performance, and minimizing downtime.</p>
            <ul>
                <li>Electric Train Service (ETS): High-speed, intercity connections that offer comfort and efficiency.</li>
                <li>Komuter Services: Affordable and dependable transportation for daily commuters in urban and suburban areas.</li>
                <li>Intercity Services: Connecting long-distance passengers to key rural and remote locations.</li>
                <li>Freight Services: Secure and efficient rail transport for goods across Malaysia.</li>
            </ul>
            <br>
            <P>The Maintenance System is vital to maintaining the integrity and safety of KTMB’s operations, ensuring that we meet the highest standards for service quality and reliability. KTMB is committed to continually improving the efficiency of our services while prioritizing the well-being of our passengers and the sustainability of our infrastructure.</P>
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
