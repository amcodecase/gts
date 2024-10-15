<?php
// Enable error reporting (for development)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

// Include database connection
include 'db.php';

// Include configuration
require_once '../src/config.php';
$config = new \MyLibrary\Config();

// Fetch user details from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows === 0) {
    echo "No user found with ID: " . htmlspecialchars($user_id);
    exit();
}

$user = $result->fetch_assoc();

// Logout functionality
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: ../"); // Redirect to login/home page
    exit();
}

// Initialize messages
$message = "";
$job_message = "";
$update_message = "";
$password_message = "";

// Create User functionality
if (isset($_POST['create_user'])) {
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $new_role = $_POST['new_role'];

    // Insert query
    $insert_query = "INSERT INTO users (username, email, role) VALUES (?, ?, ?)";
    $insert_stmt = $db->prepare($insert_query);

    if ($insert_stmt) {
        $insert_stmt->bind_param("sss", $new_username, $new_email, $new_role);
        if ($insert_stmt->execute()) {
            $message = "User created successfully.";
        } else {
            $message = "Error creating user: " . $db->error;
        }
    } else {
        $message = "Error preparing statement: " . $db->error;
    }
}

// Job Posting functionality
if (isset($_POST['post_job'])) {
    $job_title = isset($_POST['job_title']) ? $_POST['job_title'] : '';
    $job_description = isset($_POST['job_description']) ? $_POST['job_description'] : '';
    $expiry_date = isset($_POST['expiry_date']) ? $_POST['expiry_date'] : '';
    $people_needed = isset($_POST['people_needed']) ? (int)$_POST['people_needed'] : 0; // Ensure this is an integer
    $requirements = isset($_POST['requirements']) ? $_POST['requirements'] : '';
    $location = isset($_POST['location']) ? $_POST['location'] : '';

    // Handle file upload
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["job_pdf"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is a PDF
    if ($fileType != "pdf") {
        $job_message = "Sorry, only PDF files are allowed.";
        $uploadOk = 0;
    }

    // Check if uploadOk is set to 0 by an error
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["job_pdf"]["tmp_name"], $target_file)) {
            // Save job details, PDF path, expiry date, and number of people needed to the database
            $job_query = "INSERT INTO jobs (job_name, job_description, number_of_people_needed, requirements, location, job_pdf, expiry_date, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
            $job_stmt = $db->prepare($job_query);

            if ($job_stmt) {
                $job_stmt->bind_param("ssiisss", $job_title, $job_description, $people_needed, $requirements, $location, $target_file, $expiry_date);
                if ($job_stmt->execute()) {
                    $job_message = "Job posted successfully.";
                } else {
                    $job_message = "Error posting job: " . $db->error;
                }
            } else {
                $job_message = "Error preparing statement: " . $db->error;
            }
        } else {
            $job_message = "Sorry, there was an error uploading your file.";
        }
    }
}

// User Management functionality
$users = [];
$user_count = 0;

// Fetch all users for display automatically
$fetch_users_query = "SELECT * FROM users";
$fetch_users_stmt = $db->prepare($fetch_users_query);
$fetch_users_stmt->execute();
$user_result = $fetch_users_stmt->get_result();

while ($row = $user_result->fetch_assoc()) {
    $users[] = $row;
}
$user_count = count($users);

// User Edit/Delete/Suspend functionality
if (isset($_POST['edit_user'])) {
    $edit_user_id = $_POST['edit_user_id'];
    $edit_username = $_POST['edit_username'];
    $edit_email = $_POST['edit_email'];
    $edit_role = $_POST['edit_role'];

    $edit_query = "UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?";
    $edit_stmt = $db->prepare($edit_query);
    $edit_stmt->bind_param("sssi", $edit_username, $edit_email, $edit_role, $edit_user_id);
    $edit_stmt->execute();
}

if (isset($_POST['delete_user'])) {
    $delete_user_id = $_POST['delete_user_id'];

    $delete_query = "DELETE FROM users WHERE id = ?";
    $delete_stmt = $db->prepare($delete_query);
    $delete_stmt->bind_param("i", $delete_user_id);
    $delete_stmt->execute();
}

if (isset($_POST['suspend_user'])) {
    $suspend_user_id = $_POST['suspend_user_id'];

    $suspend_query = "UPDATE users SET role = 'suspended' WHERE id = ?";
    $suspend_stmt = $db->prepare($suspend_query);
    $suspend_stmt->bind_param("i", $suspend_user_id);
    $suspend_stmt->execute();
}

// Settings functionality
if (isset($_POST['update_details'])) {
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Update user details
    $update_query = "UPDATE users SET username = ?, email = ? WHERE id = ?";
    $update_stmt = $db->prepare($update_query);
    $update_stmt->bind_param("ssi", $new_username, $new_email, $user_id);
    
    if ($update_stmt->execute()) {
        $update_message = "User details updated successfully.";
    } else {
        $update_message = "Error updating user details: " . $db->error;
    }

    // If a new password is provided, update it
    if (!empty($new_password)) {
        if ($new_password === $confirm_password) {
            $hashed_password = md5($new_password); // Hash the password using MD5
            $update_password_query = "UPDATE users SET password = ? WHERE id = ?";
            $update_password_stmt = $db->prepare($update_password_query);
            $update_password_stmt->bind_param("si", $hashed_password, $user_id);
            if ($update_password_stmt->execute()) {
                $password_message = "Password updated successfully.";
            } else {
                $password_message = "Error updating password: " . $db->error;
            }
        } else {
            $password_message = "Passwords do not match.";
        }
    }
}

// Check which section to show
$show_create_user = isset($_GET['section']) && $_GET['section'] === 'create_user';
$show_post_job = isset($_GET['section']) && $_GET['section'] === 'post_job';
$show_user_management = isset($_GET['section']) && $_GET['section'] === 'user_management';
$show_settings = isset($_GET['section']) && $_GET['section'] === 'settings';
$show_home = isset($_GET['section']) && $_GET['section'] === 'home';

// Job Display functionality
$jobs = [];
if (isset($_GET['section']) && $_GET['section'] === 'home') {
    $job_query = "SELECT * FROM jobs";
    $job_stmt = $db->prepare($job_query);
    $job_stmt->execute();
    $job_result = $job_stmt->get_result();
    while ($job_row = $job_result->fetch_assoc()) {
        // Check if job is expired
        $expiry_date = isset($job_row['expiry_date']) && !empty($job_row['expiry_date']) ? strtotime($job_row['expiry_date']) : time();
        $is_expired = ($expiry_date < time());
        $job_row['status'] = $is_expired ? "Expired" : "Active";
        $jobs[] = $job_row;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($config->get('SITE_NAME')); ?> - Welcome <?php echo htmlspecialchars($user['username']); ?></title>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GFCSlAbNb5QDR+gtyZrV9xJ0gYf3o5pgo28/zT09Hv/dyFZIQTQQUHY24ZQ6V2Yv" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<style>
    /* Base Styles */
body {
    background-color: #f0f0f0; /* Almost white background */
    font-family: Arial, sans-serif; /* Set a clean font */
    margin: 0; /* Remove default margin */
    padding: 0; /* Remove default padding */
}


/* Welcome message styles */
.welcome-message {
    margin: 20px 0;
    text-align: center;
    font-size: 1.2em; /* Increase welcome message font size */
}

/* Container styles */
.container {
    padding: 30px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    max-width: 800px; /* Set max width for the container */
    margin: auto; /* Center the container */
}

/* Input and button styles */
input[type="text"],
input[type="email"],
input[type="password"],
textarea,
input[type="file"],
input[type="date"],
select {
    width: 100%; /* Full width for inputs */
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ced4da;
    border-radius: 4px;
    box-sizing: border-box; /* Include padding in width */
}

button {
    width: 100%; /* Full width for buttons */
    padding: 10px;
    margin: 10px 0;
    background-color: #007bff; /* Primary button color */
    color: white; /* Text color for buttons */
    border: none; /* Remove default border */
    border-radius: 4px; /* Rounded corners */
    cursor: pointer; /* Change cursor on hover */
}

button:hover {
    background-color: #0056b3; /* Darken button on hover */
}

/* Messages styles */
.success-message {
    color: green;
    text-align: center; /* Center success message */
}

.error-message {
    color: red;
    text-align: center; /* Center error message */
}

/* User table styles */
.user-table {
    width: 100%; /* Full width for tables */
    border-collapse: collapse; /* Collapse borders */
    margin-top: 20px; /* Add margin above table */
}

.user-table th,
.user-table td {
    padding: 10px; /* Add padding to table cells */
    text-align: center;
    border: 1px solid #ddd; /* Light gray border */
}

.user-table th {
    background-color: #f2f2f2; /* Light gray header */
}

==

@media (max-width: 576px) {
    .welcome-message {
        font-size: 1.1em; /* Smaller font size for welcome message */
    }

    .container {
        padding: 15px; /* Further reduce padding */
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    textarea,
    input[type="file"],
    input[type="date"],
    select {
        padding: 8px; /* Smaller padding for inputs */
    }
}
/* Navbar styles */
.navbar {
    background-color: #f8f9fa; /* Light background color */
    margin-bottom: 20px;
}

.navbar .nav-link {
    color: #333; /* Dark text color */
    font-weight: 500; /* Slightly bolder text */
    padding: 10px 15px; /* Spacing for links */
    transition: background-color 0.3s, color 0.3s; /* Smooth transitions */
}

.navbar .nav-link:hover {
    background-color: #e2e6ea; /* Light gray background on hover */
    color: #007bff; /* Change text color on hover */
}

.navbar .nav-item {
    position: relative; /* To allow positioning of dropdowns, if needed */
}

.navbar-toggler {
    border: none; /* No border for the toggler */
}

.navbar-toggler-icon {
    background-color: #007bff; /* Custom color for toggler icon */
}

.navbar-nav {
    flex-direction: row; /* Ensure items are in a row */
}

.navbar-nav.ml-auto {
    margin-left: auto; /* Align logout button to the far right */
}

.btn-link {
    color: #333; /* Match logout button text color */
    text-decoration: none; /* No underline on button */
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .navbar-nav {
        text-align: center; /* Center align items on small screens */
        margin-bottom: 10px; /* Space at the bottom */
    }

    .navbar-nav .nav-item {
        width: 100%; /* Full width for items in small screens */
    }
}


</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Toggler button for mobile view -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar items that collapse on smaller screens -->
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="home.php?section=home">
                    <i class="fas fa-home"></i> Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?section=create_user">
                    <i class="fas fa-user-plus"></i> Create User
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?section=post_job">
                    <i class="fas fa-briefcase"></i> Post Job
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?section=user_management">
                    <i class="fas fa-users"></i> User Management
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?section=settings">
                    <i class="fas fa-cog"></i> Settings
                </a>
            </li>
        </ul>

        <!-- Align the logout button to the far right -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <form method="post">
                    <button type="submit" name="logout" class="nav-link btn btn-link" style="padding: 0; margin: 0;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>



<div class="container">
    <?php if ($show_create_user): ?>
        <h2>Create User</h2>
        <form method="post">
            <input type="text" name="new_username" placeholder="Username" required>
            <input type="email" name="new_email" placeholder="Email" required>
            <select name="new_role" required>
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="superadmin">Super Admin</option>
            </select>
            <button type="submit" name="create_user" class="btn btn-primary"><i class="fas fa-user-plus"></i> Create User</button>
            <div class="success-message"><?php echo $message; ?></div>
        </form>
    <?php endif; ?>

    <?php if ($show_post_job): ?>
        <h2>Post a Job</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="job_title" placeholder="Job Title" required>
            <textarea name="job_description" placeholder="Job Description" required></textarea>
            <input type="number" name="people_needed" placeholder="Number of People Needed" required min="1">
            <textarea name="requirements" placeholder="Requirements" required></textarea>
            <input type="text" name="location" placeholder="Location" required>
            <input type="file" name="job_pdf" required>
            <input type="date" name="expiry_date" required>
            <button type="submit" name="post_job" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Post Job</button>
            <div class="success-message"><?php echo $job_message; ?></div>
        </form>
    <?php endif; ?>

    <?php if ($show_user_management): ?>
        <h2>User Management</h2>
        <?php if ($user_count > 0): ?>
            <table class="table user-table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($u['id']); ?></td>
                            <td><?php echo htmlspecialchars($u['username']); ?></td>
                            <td><?php echo htmlspecialchars($u['email']); ?></td>
                            <td><?php echo htmlspecialchars($u['role']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No users found.</p>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($show_settings): ?>
    <h2>Settings</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        <input type="password" name="new_password" placeholder="New Password">
        <input type="password" name="confirm_password" placeholder="Confirm Password">
        <button type="submit" name="update_details" class="btn btn-primary"><i class="fas fa-save"></i> Update Details</button>
    </form>
    <div class="success-message"><?php echo $update_message; ?></div>
    <div class="error-message"><?php echo $password_message; ?></div>
    <?php endif; ?>

    <?php if ($show_home): ?>
        <h2>Available Jobs</h2>
        <?php if (count($jobs) > 0): ?>
            <ul class="list-group">
                <?php foreach ($jobs as $job): ?>
                    <li class="list-group-item">
                        <h5><?php echo htmlspecialchars($job['job_name']); ?> <span class="badge bg-<?php echo $job['status'] == "Expired" ? 'danger' : 'success'; ?>"><?php echo $job['status']; ?></span></h5>
                        <p><?php echo htmlspecialchars($job['job_description']); ?></p>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?> | <strong>Expiry Date:</strong> <?php echo htmlspecialchars($job['expiry_date']); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No jobs available.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</body>
</html>
