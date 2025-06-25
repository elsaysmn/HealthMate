<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Calculator</title>
    <link rel="stylesheet" href="bmi.css">
</head>

<body>
    <header class="navbar">
        <div class="logo">Health<span class="highlight">Mate</span></div>
        <nav class="nav-links">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="bmi.php">BMI Calculator</a></li>
                <li><a href="login.php" class="login-btn">Log In</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="bmi-section">
            <h1>BMI Calculator</h1>
            <p class="subtitle">Please enter the details:</p>

            <div class="container">
                <div class="bmi-table">
                    <table>
                        <tr><th>BMI</th><th>CLASSIFICATION</th></tr>
                        <tr><td>less than 18.5:</td><td>Underweight</td></tr>
                        <tr><td>18.5 - 24.9:</td><td>Normal weight</td></tr>
                        <tr><td>25 - 29.9:</td><td>Overweight</td></tr>
                        <tr><td>30 - 34.9:</td><td>Class I Obese</td></tr>
                        <tr><td>35 - 39.9:</td><td>Class II Obese</td></tr>
                        <tr><td>40 upwards:</td><td>Class III Obese</td></tr>
                    </table>
                </div>

                <div class="bmi-input">
                    <label for="weight">Weight:</label>
                    <input type="number" id="weight" placeholder="kg">
                    <label for="height">Height:</label>
                    <input type="number" id="height" placeholder="cm">
                    <button onclick="calculateBMI()">Calculate</button>
                </div>

                <div class="bmi-result" id="bmiResultBox">
                    <h3>YOUR BMI RESULT</h3>
                    <p id="bmiValue">BMI: </p>
                    <p id="bmiCategory">Body Type: </p>
                </div>
            </div>

            <div class="bmi-chart">
                <img src="image/bmipicture.jpg" alt="Body Mass Index Chart" width="650px">
            </div>
        </section>
    </main>

<script>
    function calculateBMI() {
        const weight = parseFloat(document.getElementById('weight').value);
        const height = parseFloat(document.getElementById('height').value) / 100;

        if (!weight || !height || height <= 0) {
            alert("Please enter valid weight and height.");
            return;
        }

        const bmi = (weight / (height * height)).toFixed(1);
        let category = '';

        if (bmi < 16) category = 'Severe Thinness';
        else if (bmi < 17) category = 'Moderate Thinness';
        else if (bmi < 18.5) category = 'Mild Thinness';
        else if (bmi < 25) category = 'Normal';
        else if (bmi < 30) category = 'Overweight';
        else if (bmi < 35) category = 'Obese Class I';
        else if (bmi < 40) category = 'Obese Class II';
        else category = 'Obese Class III';

        document.getElementById('bmiValue').innerText = `BMI: ${bmi}`;
        document.getElementById('bmiCategory').innerText = `Body Type: ${category}`;
        document.getElementById('modalBmiValue').innerText = `BMI: ${bmi}`;
        document.getElementById('modalBmiCategory').innerText = `Body Type: ${category}`;
        document.getElementById('bmiModal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('bmiModal').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('bmiModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }
    
</script>

    <footer>
        <div class="social-icons">
            <a href="#"><img src="image/instagram.png" alt="Instagram"></a>
            <a href="#"><img src="image/twitter.png" alt="Twitter"></a>
            <a href="#"><img src="image/facebook.png" alt="Facebook"></a>
            <a href="#"><img src="image/youtube.png" alt="YouTube"></a>
        </div>
        <div class="footer-links">
            <a href="#">Terms & Conditions</a>
            <a href="#">Privacy Policies</a>
        </div>
    </footer>

</body>
</html>