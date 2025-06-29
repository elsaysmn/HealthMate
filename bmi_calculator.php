<?php
session_start();
require('connect.php'); // contains $conn

$username = $_SESSION['username'] ?? 'guest'; // Default username if session missing

$bmiResult = "";
$successMessage = "";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['calculate'])) {
    $weight = $_POST['weight'];
    $height = $_POST['height'];

    if ($weight > 0 && $height > 0) {
        $bmi = $weight / (($height / 100) ** 2);
        $bmiResult = round($bmi, 2);

        if ($bmi < 18.5) $classification = "Underweight";
        elseif ($bmi < 25) $classification = "Normal";
        elseif ($bmi < 30) $classification = "Overweight";
        elseif ($bmi < 35) $classification = "Class I Obese";
        elseif ($bmi < 40) $classification = "Class II Obese";
        else $classification = "Class III Obese";

        $today = date("Y-m-d");

        $stmt = $conn->prepare("INSERT INTO progress_record (username, weight, height, bmi, classification, date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sdddss", $username, $weight, $height, $bmiResult, $classification, $today);
        $stmt->execute();
        $stmt->close();

        $successMessage = "BMI {$bmiResult} ({$classification}) added successfully!";
    }
}


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM progress_record WHERE id = ? AND username = ?");
    $stmt->bind_param("is", $id, $username);
    $stmt->execute();
    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


if (isset($_POST['clear_all'])) {
    $stmt = $conn->prepare("DELETE FROM progress_record WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->close();
    $successMessage = "All records cleared.";
}


$records = [];
$stmt = $conn->prepare("SELECT * FROM progress_record WHERE username = ? ORDER BY date DESC");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $records[] = $row;
}
$stmt->close();


$availableMonths = array_unique(array_map(function($r) {
    return date('Y-m', strtotime($r['date']));
}, $records));
sort($availableMonths);

$selectedMonth = $_GET['month'] ?? date('Y-m');


$filteredRecords = array_filter($records, function($r) use ($selectedMonth) {
    return date('Y-m', strtotime($r['date'])) === $selectedMonth;
});
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>BMI Calculator Dashboard</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
body { font-family: Arial, sans-serif; margin: 0; background: #f4f6f9; display: flex; flex-direction: column; min-height: 100vh; }
header {
  background-color: #2c2c63; color: white; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center;
}
.logo { font-size: 26px; font-weight: bold; }
.logo span { color: #c084fc; }
nav a { color: white; text-decoration: none; margin: 0 15px; font-size: 16px; }
nav a:hover { text-decoration: underline; }
.container { padding: 40px; max-width: 1000px; margin: auto; flex: 1; }
h2, h3 { color: #2c2c63; }
.card { background: #20205c; color: white; padding: 20px; border-radius: 10px; margin-bottom: 30px; }
.card input, .card select { margin: 0 10px 0 5px; padding: 6px; border: none; border-radius: 5px; }
.card button { background: #6d72f6; border: none; padding: 8px 15px; color: white; border-radius: 5px; cursor: pointer; }
.success-box, .result-box { margin: 20px 0; padding: 15px 20px; background: #d3f0d3; border: 2px solid #70c170; border-radius: 8px; color: #333; font-size: 18px; text-align: center; }
table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; margin-top: 20px; }
th, td { padding: 12px 10px; border: 1px solid #ddd; text-align: center; }
th { background: #2c2c63; color: white; }
.btn-delete { background: #f56565; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; }
.btn-delete:hover { background: #e53e3e; }
.btn-clear { background: #f56565; border: none; padding: 8px 15px; color: white; border-radius: 5px; margin-top: 10px; cursor: pointer; }
.chart-container { background: #fff; padding: 20px; border-radius: 8px; margin-top: 30px; }
footer { background-color: #2c2c63; color: white; padding: 20px; text-align: center; margin-top: 40px; }
.footer-links a { color: #c084fc; text-decoration: none; margin: 0 10px; }
.footer-links a:hover { text-decoration: underline; }
</style>
</head>
<body>

<header>
  <div class="logo">Health<span>Mate</span></div>
  <nav>
    <a href="home.php">Home</a>
    <a href="aboutus.php">About</a>
    <a href="bmi.php">BMI</a>
    <a href="#">Profile</a>
  </nav>
</header>

<div class="container">
  <h2>📊 USER</h2>
  <form method="POST">
    <div class="card">
      <label>Weight (kg):</label>
      <input type="number" name="weight" required>
      <label>Height (cm):</label>
      <input type="number" name="height" required>
      <button type="submit" name="calculate">Calculate</button>
    </div>
  </form>

  <?php if ($successMessage) echo "<div class='success-box'>$successMessage</div>"; ?>

  <form method="GET">
    <div class="card">
      <label>Select Month:</label>
      <select name="month" onchange="this.form.submit()">
        <?php foreach ($availableMonths as $month): ?>
          <option value="<?= $month ?>" <?= ($month == $selectedMonth) ? 'selected' : '' ?>><?= date('F Y', strtotime($month."-01")) ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </form>

  <?php if (!empty($filteredRecords)) : ?>
  <table>
  
    <tr><th>No.</th><th>Date</th><th>Weight</th><th>Height</th><th>BMI</th><th>Status</th><th>Action</th></tr>
    <?php foreach ($filteredRecords as $i => $r): ?>
      <tr>
        <td><?= $i+1 ?></td>
        <td><?= $r['date'] ?></td>
        <td><?= $r['weight'] ?></td>
        <td><?= $r['height'] ?></td>
        <td><?= $r['bmi'] ?></td>
        <td><?= $r['classification'] ?></td>
        <td><a class="btn-delete" href="?delete=<?= $r['id'] ?>" onclick="return confirm('Delete this record?')">Delete</a></td>

      </tr>
      
   

    <?php endforeach; ?>
  </table>
  
  <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 30px;">
  <?php foreach ($filteredRecords as $r): ?>
    <?php
    $img = "";
    switch ($r['classification']) {
      case "Underweight": $img = "underweight.png"; break;
      case "Normal": $img = "normal.png"; break;
      case "Overweight": $img = "overweight.png"; break;
      case "Class I Obese": $img = "class1.png"; break;
      case "Class II Obese": $img = "class2.png"; break;
      case "Class III Obese": $img = "class3.png"; break;
    }
    ?>
    <?php if ($img): ?>
      <div style="text-align: center; width: 200px;">
        <img src="<?= $img ?>" alt="<?= $r['classification'] ?>" style="width: 100%; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
        <div style="margin-top: 8px; font-weight: bold;"><?= $r['classification'] ?> (<?= $r['date'] ?>)</div>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
</div>
  <form method="POST">
    <button class="btn-clear" type="submit" name="clear_all">Clear All</button>
  </form>

  <div class="chart-container">
    <canvas id="bmiChart"></canvas>
  </div>
  
  <div style="margin-top: 20px; display: flex; gap: 20px; flex-wrap: wrap;">
  <div><span style="display:inline-block;width:16px;height:16px;background:#38bdf8;margin-right:6px;border-radius:3px;"></span>Underweight</div>
  <div><span style="display:inline-block;width:16px;height:16px;background:#22c55e;margin-right:6px;border-radius:3px;"></span>Normal</div>
  <div><span style="display:inline-block;width:16px;height:16px;background:#eab308;margin-right:6px;border-radius:3px;"></span>Overweight</div>
  <div><span style="display:inline-block;width:16px;height:16px;background:#f97316;margin-right:6px;border-radius:3px;"></span>Class I Obese</div>
  <div><span style="display:inline-block;width:16px;height:16px;background:#ef4444;margin-right:6px;border-radius:3px;"></span>Class II Obese</div>
  <div><span style="display:inline-block;width:16px;height:16px;background:#dc2626;margin-right:6px;border-radius:3px;"></span>Class III Obese</div>
</div>


  <script>
  const labels = <?= json_encode(array_column($filteredRecords, 'date')) ?>;
  const data = <?= json_encode(array_column($filteredRecords, 'bmi')) ?>;
  const status = <?= json_encode(array_column($filteredRecords, 'classification')) ?>;

  const colors = status.map(s => {
    if (s === 'Underweight') return '#38bdf8';
    if (s === 'Normal') return '#22c55e';
    if (s === 'Overweight') return '#eab308';
    if (s === 'Class I Obese') return '#f97316';
    if (s === 'Class II Obese') return '#ef4444';
    if (s === 'Class III Obese') return '#dc2626';
    return '#6d72f6';
  });

  new Chart(document.getElementById('bmiChart'), {
  type: 'bar',
  data: {
    labels: labels,
    datasets: [{
      data: data,
      backgroundColor: colors,
      borderRadius: 5
    }]
  },
  options: {
    plugins: {
      legend: {
        display: false
      },
      tooltip: {
        callbacks: {
          afterLabel: function(context) {
            return 'Status: ' + status[context.dataIndex];
          }
        }
      }
    },
    scales: {
      y: {
        beginAtZero: false,
        title: {
          display: true,
          text: 'BMI Value'
        }
      },
      x: {
        title: {
          display: true,
          text: 'Date'
        }
      }
    }
  }
});

  </script>

  <?php else: ?>
    <p>No BMI records for this month.</p>
  <?php endif; ?>
</div>

<footer>
  <div class="footer-links">
    <a href="terms.php">Terms & Conditions</a>
    <a href="privacy.php">Privacy Policy</a>
  </div>
  <div>&copy; <?= date('Y') ?> HealthMate. All rights reserved.</div>
</footer>

</body>
</html>