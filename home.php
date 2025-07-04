<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HealthMate</title>
  <link rel="stylesheet" href="home.css" type="text/css" />
</head>
<body>
  <header>
    <div class="logo"><span>Health</span>Mate</div>
    <nav class="nav-bar">
      <a href="home.php">Home</a>
      <a href="aboutus.php">About Us</a>
      <a href="bmi.php">BMI Calculator</a>
      <a href="login.php" class="login-btn">Log In</a>
    </nav>
  </header>

  <section class="home-section">
    <div class="container">
      <div class="product-section">
        <h2 class="product-title">Best-selling products:</h2>
        <div class="product-image">
          <button id="prevBtn" class="scroll-btn left">&#10094;</button>
          <div class="image-slider">
            <img class="slide active" src="pictures/products.png" alt="Amway Products" />
            <img class="slide" src="pictures/products2.png" alt="Amway Products" />
            <img class="slide" src="pictures/products3.png" alt="Amway Products" />
            <img class="slide" src="pictures/products4.png" alt="Amway Products" />
          </div>
          <button id="nextBtn" class="scroll-btn right">&#10095;</button>
        </div>
      </div>

      <div class="about-wrapper">
        <div class="about-section">
          <img src="image/logo.png" alt="Amway Logo" class="amway-logo" />
          <div class="about-amway">
            <h2><span class="highlight-bar"></span> About Amway</h2>
            <p>
              Amway is a global multi-level marketing (MLM) company that sells health, beauty,
              and home care products. Founded in 1959 in the United States, it operates in over
              100 countries and territories.
            </p>
            <p>
              Amway is known for its direct selling approach, where independent distributors
              earn money through product sales and by recruiting others.
            </p>
            <p>
              Popular brands under Amway include Nutrilite (supplements), Artistry (skincare),
              and eSpring (water purifiers).
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

            <footer>
                <div class="footer-container">
                    <div class="social-icons">
                    <a href="https://www.instagram.com/" target="_blank"><img src="image/instagram.png" alt="Instagram"></a>
                    <a href="https://x.com/" target="_blank"><img src ="image/twitter.png" alt="Twitter"></a>
                    <a href="https://www.facebook.com/" target="_blank"><img src ="image/facebook.png" alt="Facebook"></a>
                    <a href="http://www.youtube.com/" target="_blank"><img src ="image/youtube.png" alt="YouTube"></a><br>
                    </div>
                    <div class="footer-links">
                    <a href="#">Terms & Conditions</a>
                    <a href="#">Privacy Policies</a>
                </div>
                </div>

  <script>
    let currentSlide = 0;
    const slides = document.querySelectorAll(".slide");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    function showSlide(index) {
      slides.forEach((slide, i) => {
        slide.classList.remove("active");
        if (i === index) {
          slide.classList.add("active");
        }
      });
    }

    prevBtn.addEventListener("click", () => {
      currentSlide = (currentSlide - 1 + slides.length) % slides.length;
      showSlide(currentSlide);
    });

    nextBtn.addEventListener("click", () => {
      currentSlide = (currentSlide + 1) % slides.length;
      showSlide(currentSlide);
    });

    showSlide(currentSlide);
  </script>
</body>
</html>