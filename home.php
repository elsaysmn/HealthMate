<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthMate</title>
    <link rel="stylesheet" href="home.css" type="text/css">
</head>
<body>
    <header>
        <h1 class="title"><span style="color:#aef79d">Health</span><span style="color:#D8B4F8">Mate</span></h1>
   
    
    <nav role ="navigation">
        <ul class ="nav-bar">
            <a href="home.php">Home</a>
            <a href="aboutus.php">About Us</a>
            <a href="bmi.php">BMI Calculator</a>
            <a href ="login.php" class ="login-btn">Log In</a>
        </ul>
    </nav>
     </header> 

    <section class="home-section">
        <div class="container">
            <div class="about-wrapper">
                
                <div class="product-image">
                    <button id="prevBtn" class="scroll-btn left" >&#10094;</button>

                    <div class="image-slider"> 
                        <img class="slide active" src="pictures/products.png" alt="Amway Products">
                        <img class="slide" src="pictures/products2.png" alt="Amway products">
                        <img class="slide" src="pictures/products3.png" alt="Amway products">
                        <img class="slide" src="pictures/products4.png" alt="Amway products">
                    </div>
                    <button id="nextBtn" class="scroll-btn right">&#10095;</button>
                </div>

            <div class="about-section">
                <img src="pictures/logo.png" alt="Amway Logo"  class="amway-logo">
                <div class="about-amway"> 
                <h2> | About Amway </h2>
                <p>Amway is a global multi-level marketing (MLM) company that sells health, beauty, and home care products. Founded in 1959 in the United States, it operates in over 100 countries and territories.</p>
                <p>Amway is known for its direct selling approach, where independent distributors earn money through product sales and by recruiting others.</p>
                <p>Popular brands under Amway include Nutrilite (supplements), Artistry (skincare), and eSpring (water purifiers). The company emphasizes entrepreneurship, personal development, and a strong support network for its distributors.</p>
            </div>
        </div>

           
        </div>
        </div>
       
    </section>

    <footer>
        <div class="socials">
            <img src="instagram.png" alt="Instagram">
            <img src="twitter.png" alt="Twitter">
            <img src="pictures/facebook.png" alt="Facebook">
            <img src="pictures/youtube.png" alt="Youtube">           
        </div>

        <h5>Terms & Conditions         Privacy Policies</h5>
    </footer>

    <script>

        let currentSlide = 0;
        const slides = document.querySelectorAll(".slide");
        const prevBtn = document.getElementById("prevBtn");
        const nextBtn = document.getElementById("nextBtn"); /*function name*/

         function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.remove("active");
                if (i === index) {
                    slide.classList.add("active");
                }
            });
        }

        prevBtn.addEventListener("click", () =>{
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        });

        nextBtn.addEventListener("click", () =>{
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        });

        
        showSlide(currentSlide);
        
        </script>
</body>
</html>