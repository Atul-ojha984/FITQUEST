<?php
// Connect to DB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitquest2";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch entries
$sql = "SELECT * FROM progress ORDER BY date DESC";
$result = $conn->query($sql);

$entries = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $entries[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Progress Tracker | FitQuest</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  
</head>
<body class="bg-gradient-to-br from-blue-50 to-green-50 min-h-screen transition-colors duration-300">

<div class="max-w-5xl mx-auto py-10 px-4">
  

  <!-- Header -->
  <h1 class="text-3xl font-bold text-center -mt-5 mb-6">📊 Your Fitness Progress</h1>

  <!-- Chart Section -->
  <div class="bg-white p-6 rounded-2xl shadow-md mb-10">
    <h2 class="text-xl font-semibold mb-4">📈 Weight & Calories Over Time</h2>
    <canvas id="progressChart"></canvas>
  </div>

  <!-- Table Section -->
  <div class="bg-white p-6 rounded-2xl shadow-md">
    <h2 class="text-xl font-semibold mb-4">📅 Entry Logs</h2>

    <?php if (!empty($entries)): ?>
    <div class="overflow-x-auto">
      <table class="min-w-full table-auto border text-center">
        <thead class="bg-gray-200">
          <tr>
            <th class="p-2">Date</th>
            <th class="p-2">Weight (kg)</th>
            <th class="p-2">Workout Time</th>
            <th class="p-2">Calories</th>
            <th class="p-2">Mood</th>
            <th class="p-2">Notes</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($entries as $entry): ?>
          <tr class="border-t hover:bg-gray-100 dark:hover:bg-gray-700">
            <td class="p-2"><?= htmlspecialchars($entry['date']) ?></td>
            <td class="p-2"><?= htmlspecialchars($entry['weight']) ?></td>
            <td class="p-2"><?= htmlspecialchars($entry['workout_time']) ?></td>
            <td class="p-2"><?= htmlspecialchars($entry['calories']) ?></td>
            <td class="p-2"><?= htmlspecialchars($entry['mood']) ?></td>
            <td class="p-2"><?= htmlspecialchars($entry['notes']) ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php else: ?>
      <p class="text-center text-gray-600 italic">No progress data yet. Let's get started! 💪</p>
    <?php endif; ?>
  </div>
</div>
<!-- Back to Home Button -->
<div class="text-center mt-6">
  <a href="index.html">
    <button class="px-6 py-3 mb-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
    ← Go to Home Page
    </button>
  </a>
</div>


<!-- Chart Script -->
<script>
  const labels = <?= json_encode(array_column(array_reverse($entries), 'date')) ?>;
  const weights = <?= json_encode(array_column(array_reverse($entries), 'weight')) ?>;
  const calories = <?= json_encode(array_column(array_reverse($entries), 'calories')) ?>;

  const ctx = document.getElementById('progressChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [
        {
          label: 'Weight (kg)',
          data: weights,
          borderColor: 'rgb(75, 192, 192)',
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          tension: 0.3,
          fill: true
        },
        {
          label: 'Calories Burned',
          data: calories,
          borderColor: 'rgb(255, 99, 132)',
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          tension: 0.3,
          fill: true
        }
      ]
    },
    options: {
      responsive: true,
      plugins: { legend: { position: 'bottom' } }
    }
  });

  
</script>

</body>
</html>
