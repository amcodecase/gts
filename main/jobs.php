<?php
// Enable error reporting (for development)
error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__ . '/src/config.php';
include 'users/db.php';

// Use the Config class to access site details
use MyLibrary\Config;

$config = new Config();

// Access site details from the Config class
$siteName = $config->get('SITE_NAME');
$siteDescription = $config->get('SITE_DESCRIPTION');
$siteKeywords = $config->get('SITE_KEYWORDS');

// Fetch active jobs from the database using mysqli
$result = $db->query("SELECT * FROM jobs WHERE expiry_date > NOW() ORDER BY created_at DESC");

$jobs = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo htmlspecialchars($siteName); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($siteDescription); ?>">
  <meta name="keywords" content="<?php echo htmlspecialchars($siteKeywords); ?>">

  <!-- Favicons -->
  <link href="assets/img/favicon.jpg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
            <img src="assets/img/logo.jpg" alt="GTS Engineering" style="max-height: 60px;">
            <h1 class="sitename"><?php echo htmlspecialchars($siteName); ?></h1>
        </a>
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="index.php?get-started">About</a></li>
                <li><a href="index.php?#services">Services</a></li>
                <li><a href="index.php?#projects">Projects</a></li>
                <li class="dropdown"><a href="#"><span>Resources</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="jobs.php">Jobs</a></li>
                        <li><a href="users/">Login</a></li>
                    </ul>
                </li>
                <li><a href="index.php#footer">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>

<main class="main">
    <div class="page-title dark-background" style="background-image: url(assets/img/page-title-bg.jpg);">
        <h1>Available Jobs</h1>
    </div>

    <section id="job-list" class="job-list section">
      <div class="container">
        <div class="row gy-4">

          <?php if (empty($jobs)): ?>
              <div class="col-12">
                  <p>No jobs available, check back later.</p>
              </div>
          <?php else: ?>
              <?php foreach ($jobs as $job): ?>
              <div class="col-lg-4">
                <article class="position-relative h-100">
                  <div class="post-content d-flex flex-column">
                    <h3 class="post-title"><?php echo htmlspecialchars($job['job_name']); ?></h3>
                    <p><?php echo htmlspecialchars($job['job_description']); ?></p>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?></p>
                    <p><strong>Number of People Needed:</strong> <?php echo htmlspecialchars($job['number_of_people_needed']); ?></p>
                    <p><strong>Applications not later than:</strong> <?php echo htmlspecialchars($job['expiry_date']); ?></p>
                    <a href="download.php?file=<?php echo urlencode(basename($job['job_pdf'])); ?>" class="readmore stretched-link">
                        <span>Download Job Details</span><i class="bi bi-arrow-right"></i>
                    </a>
                  </div>
                </article>
              </div><!-- End job item -->
              <?php endforeach; ?>
          <?php endif; ?>

        </div>
      </div>
    </section><!-- End Job List Section -->
</main>

<footer id="footer" class="footer">
    <!-- Your footer content here -->
</footer>

</body>
</html>
