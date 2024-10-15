<?php
require __DIR__ . '/src/config.php';

// Use the Config class to access site details
use MyLibrary\Config;

$config = new Config();

// Access site details from the Config class
$siteName = $config->get('SITE_NAME');
$siteDescription = $config->get('SITE_DESCRIPTION');
$siteKeywords = $config->get('SITE_KEYWORDS');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo htmlspecialchars($siteName); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($siteDescription); ?>"
  <meta name="keywords" content="<?php echo htmlspecialchars($siteKeywords); ?>">

  <!-- Favicons -->
  <link href="assets/img/favicon.jpg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <style>
    #notification-banner {
  background-color: #000; /* Green background */
  opacity: .8;
  color: white; /* White text */
  padding: 15px;
  text-align: center;
  position: relative;
  z-index: 1000; /* Make sure it is on top */
}

#close-banner {
  background: none;
  border: none;
  color: white;
  font-size: 18px;
  position: absolute;
  top: 10px;
  right: 15px;
  cursor: pointer;
}

  </style>
</head>


<body class="index-page">

<div id="notification-banner" style="display: none;">
  <p>We have updated our site! Check out the new features and improvements.</p>
  <button id="close-banner">Close</button>
</div>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="index.php" class="logo d-flex align-items-center">
            <img src="assets/img/logo.jpg" alt="GTS Engineering" style="max-height: 60px;"> <!-- Logo for GTS Engineering -->
            <h1 class="sitename"><?php echo htmlspecialchars($siteName); ?></h1> <span>.</span> <!-- Dynamic site name -->
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="projects.php">Projects</a></li>
                <li class="dropdown"><a href="#"><span>Resources</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="jobs.php">Jobs</a></li>
                        <li><a href="team.php">Team</a></li>
                        <li><a href="users/">Login</a></li>
                    </ul>
                </li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>
</header>


  <main class="main">

    <!-- Hero Section -->
<section id="hero" class="hero section dark-background">

<div class="info d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
      <div class="col-lg-6 text-center">
        <h2>Welcome to <?php echo htmlspecialchars($siteName); ?></h2> <!-- Dynamic site name -->
        <p>Your partner in providing top-notch engineering and construction services. We specialize in Electrical, Mechanical, Civil Engineering, and Renewable Energy Solutions.</p>
        <a href="#get-started" class="btn-get-started">Get Started</a>
      </div>
    </div>
  </div>
</div>

<div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
  <div class="carousel-item active">
    <img src="assets/img/hero-carousel/hero1.jpg" alt="">
  </div>
  <div class="carousel-item">
    <img src="assets/img/hero-carousel/hero2.jpg" alt="">
  </div>
  <div class="carousel-item">
    <img src="assets/img/hero-carousel/hero3.jpg" alt="">
  </div>
  <div class="carousel-item">
    <img src="assets/img/hero-carousel/hero4.jpg" alt="">
  </div>
  <div class="carousel-item">
    <img src="assets/img/hero-carousel/hero5.jpg" alt="">
  </div>

  <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
  </a>

  <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
  </a>
</div>

</section><!-- /Hero Section -->

<!-- Get Started Section -->
<section id="get-started" class="get-started section">

<div class="container">
  <div class="row justify-content-between gy-4">

    <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
      <div class="content">
        <h3>8 Years of Quality Engineering Solutions, Tailored to Your Needs</h3>
        <p>At <?php echo htmlspecialchars($siteName); ?>, we are committed to delivering exceptional service and innovative solutions. Our team of experts works diligently to ensure every project meets the highest standards of quality.</p>
        <p>Whether it's a small renovation or a large construction project, we have the expertise to help you succeed. Let us be your trusted partner in achieving your goals.</p>

      </div>
    </div>

    <div class="col-lg-5" data-aos="zoom-out" data-aos-delay="200">
      <form action="forms/quote.php" method="post" class="php-email-form">
        <h3>Request a Quote</h3>
        <p>Fill out the form below to receive a personalized quote for your project. We look forward to collaborating with you!</p>
        <div class="row gy-3">

          <div class="col-12">
            <input type="text" name="name" class="form-control" placeholder="Name" required="">
          </div>

          <div class="col-12">
            <input type="email" class="form-control" name="email" placeholder="Email" required="">
          </div>

          <div class="col-12">
            <input type="text" class="form-control" name="phone" placeholder="Phone" required="">
          </div>

          <div class="col-12">
            <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
          </div>

          <div class="col-12 text-center">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your quote request has been sent successfully. Thank you!</div>

            <button type="submit">Get a Quote</button>
          </div>

        </div>
      </form>
    </div><!-- End Quote Form -->

  </div>

</div>

</section><!-- /Get Started Section -->


    <!-- Constructions Section -->
<section id="constructions" class="constructions section">

<!-- Section Title -->
<div class="container section-title" data-aos="fade-up">
  <h2>Our Projects</h2>
  <p>Delivering quality and innovation in every project.</p>
</div><!-- End Section Title -->

<div class="container">

  <div class="row gy-4">

    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
      <div class="card-item">
        <div class="row">
          <div class="col-xl-5">
            <div class="card-bg"><img src="assets/img/residential.jpg" alt=""></div>
          </div>
          <div class="col-xl-7 d-flex align-items-center">
            <div class="card-body">
              <h4 class="card-title">Residential Construction</h4>
              <p>We specialize in building quality homes with a focus on sustainability and modern design. Our projects enhance community living.</p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Card Item -->

    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
      <div class="card-item">
        <div class="row">
          <div class="col-xl-5">
            <div class="card-bg"><img src="assets/img/mikango5.jpg" alt=""></div>
          </div>
          <div class="col-xl-7 d-flex align-items-center">
            <div class="card-body">
              <h4 class="card-title">Commercial Development</h4>
              <p>Our expertise extends to commercial projects, delivering innovative spaces that meet the demands of modern businesses.</p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Card Item -->

    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
      <div class="card-item">
        <div class="row">
          <div class="col-xl-5">
            <div class="card-bg"><img src="assets/img/Infrastracture.jpeg" alt=""></div>
          </div>
          <div class="col-xl-7 d-flex align-items-center">
            <div class="card-body">
              <h4 class="card-title">Infrastructure Projects</h4>
              <p>We undertake significant infrastructure projects that improve public services and connectivity in urban and rural areas.</p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Card Item -->

    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
      <div class="card-item">
        <div class="row">
          <div class="col-xl-5">
            <div class="card-bg"><img src="assets/img/renewable.jpeg" alt=""></div>
          </div>
          <div class="col-xl-7 d-flex align-items-center">
            <div class="card-body">
              <h4 class="card-title">Renewable Energy Solutions</h4>
              <p>Our projects include the integration of renewable energy solutions, paving the way for sustainable construction practices.</p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Card Item -->

  </div>

</div>

</section><!-- /Constructions Section -->
<!-- Services Section -->
<section id="services" class="services section light-background">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>More of Our Services</h2>
    <p>Explore our comprehensive range of services designed to meet all your construction and engineering needs.</p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-4">

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="fa-solid fa-tile"></i>
          </div>
          <h3>Tiling</h3>
          <p>We provide professional tiling services for both residential and commercial projects. Our skilled team ensures precise and high-quality tile installation, transforming your spaces with beautiful and durable tiling solutions.</p>
          <a href="#" class="readmore stretched-link">Get a quote <i class="bi bi-receipt"></i></a>
        </div>
      </div><!-- End Service Item -->

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="fa-solid fa-house-chimney"></i>
          </div>
          <h3>Roofing</h3>
          <p>Our roofing services cover a wide range of options, from traditional to modern roofing systems. We offer roof installation, repair, and maintenance services, providing you with reliable and long-lasting roofing solutions.</p>
          <a href="#" class="readmore stretched-link">Get a quote <i class="bi bi-receipt"></i></a>
        </div>
      </div><!-- End Service Item -->

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="fa-solid fa-crown"></i>
          </div>
          <h3>Ceiling</h3>
          <p>Enhance the aesthetic appeal of your space with our ceiling services. We offer innovative and customized ceiling designs, installation, and repair to create stunning and functional ceilings that suit your style and requirements.</p>
          <a href="#" class="readmore stretched-link">Get a quote <i class="bi bi-receipt"></i></a>
        </div>
      </div><!-- End Service Item -->

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="fa-solid fa-brick"></i>
          </div>
          <h3>Paving</h3>
          <p>Transform your outdoor spaces with our paving services. Our team specializes in the construction of driveways, walkways, patios, and other paved areas. We use high-quality materials and expert craftsmanship to create beautiful and durable paving solutions.</p>
          <a href="#" class="readmore stretched-link">Get a quote <i class="bi bi-receipt"></i></a>
        </div>
      </div><!-- End Service Item -->

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="fa-solid fa-water"></i>
          </div>
          <h3>Septic Tanks</h3>
          <p>We offer professional septic tank installation, maintenance, and repair services. Our team ensures proper waste management and environmental sustainability with efficient and reliable septic tank solutions for residential and commercial properties.</p>
          <a href="#" class="readmore stretched-link">Get a quote <i class="bi bi-receipt"></i></a>
        </div>
      </div><!-- End Service Item -->

      <!-- <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="fa-solid fa-paint-roller"></i>
          </div>
          <h3>Plastering</h3>
          <p>Transform your walls and ceilings with our expert plastering services. We provide smooth and flawless plastering finishes that enhance the visual appeal of your spaces. Our team delivers precise and high-quality plastering solutions.</p>
          <a href="#" class="readmore stretched-link">Get a quote <i class="bi bi-receipt"></i></a>
        </div>
      </div>End Service Item -->

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="fa-solid fa-lightbulb"></i>
          </div>
          <h3>Electrical</h3>
          <p>Our electrical services cover a wide range of solutions, including wiring, lighting installations, and electrical system maintenance. We prioritize safety and efficiency, ensuring reliable electrical systems for residential and commercial properties.</p>
          <a href="#" class="readmore stretched-link">Get a quote <i class="bi bi-receipt"></i></a>
        </div>
      </div><!-- End Service Item -->

    </div>

  </div>

</section><!-- /Services Section -->


 <!-- Alt Services Section -->
<section id="alt-services" class="alt-services section">

<div class="container">

  <div class="row justify-content-around gy-4">
    <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100">
      <img src="assets/img/mikango1.jpg" alt="Various Construction Services">
    </div>

    <div class="col-lg-5 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
      <h3>We Are the Experts in Construction Solutions</h3>
      <p>We have been providing better solutions since 2016. At Greentech Sustainable Engineering Solutions, we are committed to building a sustainable future by fostering a collaborative spirit that creates exceptional experiences, balanced relationships, and a community-built environment. Building isn’t just a job—it's our passion. With every project we undertake, we set the bar high and provide the best in the industry.</p>

      <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="300">
        <i class="bi bi-tools flex-shrink-0"></i>
        <div>
          <h4><a href="" class="stretched-link">Professional & Expert</a></h4>
          <p>At Greentech Sustainable Engineering Solutions, we take pride in being professional and expert in all aspects of our work. From project planning to execution, our team of experienced professionals is dedicated to delivering excellence in every task we undertake.</p>
        </div>
      </div><!-- End Icon Box -->

      <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="400">
        <i class="bi bi-check-circle flex-shrink-0"></i>
        <div>
          <h4><a href="" class="stretched-link">Quality Servicing Center</a></h4>
          <p>As a quality servicing center, we are committed to maintaining the highest standards in the industry. We strive for perfection in every project, ensuring that our clients receive top-notch services that meet and exceed their expectations.</p>
        </div>
      </div><!-- End Icon Box -->

      <div class="icon-box d-flex position-relative" data-aos="fade-up" data-aos-delay="500">
        <i class="bi bi-people flex-shrink-0"></i>
        <div>
          <h4><a href="" class="stretched-link">Dedicated To Our Clients</a></h4>
          <p>Our clients are at the heart of everything we do. We are dedicated to providing exceptional service and building strong relationships. We listen to our clients' needs and work tirelessly to deliver tailored solutions that address their unique requirements.</p>
        </div>
      </div><!-- End Icon Box -->

    </div>
  </div>

</div>

</section><!-- /Alt Services Section -->


 <!-- Features Section -->
<section id="features" class="features section">

<div class="container">

  <ul class="nav nav-tabs row g-2 d-flex" data-aos="fade-up" data-aos-delay="100" role="tablist">

    <li class="nav-item col-3" role="presentation">
      <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1" aria-selected="true" role="tab">
        <h4>General Building</h4>
      </a>
    </li><!-- End tab nav item -->

    <li class="nav-item col-3" role="presentation">
      <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2" aria-selected="false" tabindex="-1" role="tab">
        <h4>Plumbing</h4>
      </a><!-- End tab nav item -->
    </li>

    <li class="nav-item col-3" role="presentation">
      <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3" aria-selected="false" tabindex="-1" role="tab">
        <h4>Electrical</h4>
      </a>
    </li><!-- End tab nav item -->

    <li class="nav-item col-3" role="presentation">
      <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-4" aria-selected="false" tabindex="-1" role="tab">
        <h4>Paving (Landscaping)</h4>
      </a>
    </li><!-- End tab nav item -->

  </ul>

  <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

    <div class="tab-pane fade active show" id="features-tab-1" role="tabpanel">
      <div class="row">
        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
          <h3>General Building Services</h3>
          <p class="fst-italic">
            Our general building services encompass a wide range of construction solutions, from residential to commercial projects. We focus on quality craftsmanship and attention to detail, ensuring every structure meets the highest standards.
          </p>
          <ul>
            <li><i class="bi bi-check2-all"></i> <span>Expert project management from start to finish.</span></li>
            <li><i class="bi bi-check2-all"></i> <span>Customized building solutions to meet client needs.</span></li>
            <li><i class="bi bi-check2-all"></i> <span>Commitment to sustainability and environmentally friendly practices.</span></li>
          </ul>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 text-center">
          <img src="assets/img/latest4.jpeg" alt="" class="img-fluid">
        </div>
      </div>
    </div><!-- End tab content item -->

    <div class="tab-pane fade" id="features-tab-2" role="tabpanel">
      <div class="row">
        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
          <h3>Plumbing Services</h3>
          <p class="fst-italic">
            Our plumbing services include installation, repair, and maintenance of plumbing systems for residential and commercial properties. We prioritize efficiency and reliability, ensuring that your plumbing operates smoothly.
          </p>
          <ul>
            <li><i class="bi bi-check2-all"></i> <span>Comprehensive plumbing inspections and diagnostics.</span></li>
            <li><i class="bi bi-check2-all"></i> <span>Expert installation of fixtures, pipes, and systems.</span></li>
            <li><i class="bi bi-check2-all"></i> <span>Emergency plumbing services available 24/7.</span></li>
          </ul>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 text-center">
          <img src="assets/img/slider11.jpeg" alt="" class="img-fluid">
        </div>
      </div>
    </div><!-- End tab content item -->

    <div class="tab-pane fade" id="features-tab-3" role="tabpanel">
      <div class="row">
        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
          <h3>Electrical Services</h3>
          <p class="fst-italic">
            We offer a full range of electrical services, ensuring safety and compliance with local regulations. From new installations to troubleshooting, our certified electricians are here to help.
          </p>
          <ul>
            <li><i class="bi bi-check2-all"></i> <span>Safe and reliable electrical installations and upgrades.</span></li>
            <li><i class="bi bi-check2-all"></i> <span>Energy-efficient solutions tailored to your needs.</span></li>
            <li><i class="bi bi-check2-all"></i> <span>Regular maintenance to prevent issues and ensure safety.</span></li>
          </ul>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 text-center">
          <img src="assets/img/slider8.jpeg" alt="" class="img-fluid">
        </div>
      </div>
    </div><!-- End tab content item -->

    <div class="tab-pane fade" id="features-tab-4" role="tabpanel">
      <div class="row">
        <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0 d-flex flex-column justify-content-center">
          <h3>Paving (Landscaping) Services</h3>
          <p class="fst-italic">
            Our paving services enhance outdoor spaces, providing functionality and aesthetic appeal. Whether it's driveways, patios, or walkways, we deliver durable and attractive solutions.
          </p>
          <ul>
            <li><i class="bi bi-check2-all"></i> <span>High-quality materials for lasting durability.</span></li>
            <li><i class="bi bi-check2-all"></i> <span>Custom designs to fit your landscape.</span></li>
            <li><i class="bi bi-check2-all"></i> <span>Professional installation with attention to detail.</span></li>
          </ul>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 text-center">
          <img src="assets/img/latest3.jpeg" alt="" class="img-fluid">
        </div>
      </div>
    </div><!-- End tab content item -->

  </div>

</div>

</section><!-- /Features Section -->



  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.php" class="logo d-flex align-items-center">
            <span class="sitename"><?php echo $siteName; ?></span> <!-- Fetch site name from config -->
          </a>
          <div class="footer-contact pt-3">
            <p><?php echo $config->get('SITE_NAME'); ?></p> <!-- Fetch site name from config -->
            <p><?php echo $config->get('LOCATION'); ?></p> <!-- Fetch location from config -->
              <p class="mt-3"><strong>Phone:</strong> <span><?php echo "+260977294035"; ?></span></p> <!-- Static WhatsApp number -->
              <p><strong>Email:</strong> <span><a href="mailto:<?php echo $config->get('CONTACT_EMAIL'); ?>"><?php echo $config->get('CONTACT_EMAIL'); ?></a></span></p> <!-- Fetch email from config -->
              <p><strong>WhatsApp:</strong> <span><a href="https://api.whatsapp.com/send?phone=<?php echo "260977294035"; ?>" target="_blank">Message us on WhatsApp</a></span></p> <!-- Static WhatsApp link -->
          </div>
          <div class="social-links d-flex mt-4">
            <a href="https://x.com/Greentechzm" target="_blank"><i class="bi bi-twitter"></i></a>
            <a href="https://web.facebook.com/profile.php?id=100088575034338&mibextid=ZbWKwL&_rdc=1&_rdr" target="_blank"><i class="bi bi-facebook"></i></a>
            <a href="https://www.tiktok.com/tag/tiktokgreentechzm" target="_blank"><i class="bi bi-tiktok"></i></a>
            <a href="https://api.whatsapp.com/send?phone=+260977294035" target="_blank"><i class="bi bi-whatsapp"></i></a> <!-- WhatsApp link -->
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="terms.php">Terms of Service</a></li>
            <li><a href="privacy.php">Privacy Policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="general-building.php">General Building</a></li>
            <li><a href="plumbing.php">Plumbing</a></li>
            <li><a href="electrical.php">Electrical</a></li>
            <li><a href="landscaping.php">Paving (Landscaping)</a></li>
            <li><a href="maintenance.php">Maintenance Services</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Customer Support</h4>
          <ul>
            <li><a href="faq.php">FAQ</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="careers.php">Careers</a></li>
            <li><a href="sitemap.php">Sitemap</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Connect With Us</h4>
          <ul>
            <li><a href="https://x.com/Greentechzm" target="_blank">Twitter</a></li>
            <li><a href="https://web.facebook.com/profile.php?id=100088575034338&mibextid=ZbWKwL&_rdc=1&_rdr" target="_blank">Facebook</a></li>
            <li><a href="https://www.tiktok.com/tag/tiktokgreentechzm" target="_blank">TikTok</a></li>
          </ul>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename"><?php echo $siteName; ?></strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        Powered by <a href="#">NATEC</a>
      </div>
    </div>

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Check if the user has visited before
    if (!localStorage.getItem('visited')) {
      // Show the notification banner if this is the first visit
      document.getElementById('notification-banner').style.display = 'block';

      // Mark the user as visited when the banner is closed
      document.getElementById('close-banner').onclick = function() {
        document.getElementById('notification-banner').style.display = 'none';
        localStorage.setItem('visited', 'true'); // Set "visited" flag in localStorage
      };
    }
  });
</script>



</body>

</html>
