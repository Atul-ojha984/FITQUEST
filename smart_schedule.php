<?php
// Start session to manage user info (name, goal)
session_start();

// Initialize variables (You could also fetch these from a session or form submission)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the selected day from the form
    $day = $_POST["day"];

    // Define user name and goal (Could be fetched from session or form)
    $name = isset($_SESSION['name']) ? $_SESSION['name'] : "User";  // Example: Retrieve name from session
    $goal = isset($_SESSION['goal']) ? $_SESSION['goal'] : "weight_loss";  // Example: Retrieve goal from session

    // Define workout sessions based on the goal
    $workouts = [
        "weight_loss" => ["HIIT", "Cardio", "Circuit Training"],
        "muscle_gain" => ["Weight Lifting", "Resistance Training", "Strength Circuits"],
        "endurance" => ["Running", "Cycling", "Swimming"],
        "flexibility" => ["Yoga", "Pilates", "Stretching"]
    ];

    // Generate workout schedule based on goal
    $selected_workout = $workouts[$goal][array_rand($workouts[$goal])];

    // You can also create a full schedule based on day and goal
    $schedule = [
        "Monday" => $selected_workout,
        "Tuesday" => "Cardio",
        "Wednesday" => "Rest Day",
        "Thursday" => "Yoga",
        "Friday" => $selected_workout,
        "Saturday" => "Running",
        "Sunday" => "Stretching"
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Smart Schedule</title>
  <!-- Adding Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-indigo-50 to-purple-50 min-h-screen p-8">

  <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-xl border border-gray-300">
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
      <!-- Updated Creative Heading with Icons -->
      <h1 class="text-5xl font-bold text-blue-700 mb-4 text-center font-poppins leading-tight">
        <span class="block text-5xl text-indigo-700">Hey <?php echo htmlspecialchars($name); ?>!</span>
        <span class="text-3xl text-gray-700 mt-7 block">Here's Your Smart Schedule 🧠💪</span>
      </h1>
      <p class="text-xl text-gray-700 mb-6 text-center">Tailored to your goal of <span class="font-semibold text-indigo-600"><?php echo ucfirst(str_replace('_', ' ', $goal)); ?></span>. Let's make every minute count!</p>

      <!-- Selected Day and Workout -->
      <div class="flex items-center space-x-3 mb-6">
        <i class="fas fa-calendar-day text-3xl text-indigo-600"></i>
        <span class="text-xl text-gray-800 font-semibold">Selected Day: <?php echo ucfirst($day); ?></span>
      </div>

      <!-- Display Workout for Selected Day -->
      <ul class="list-disc list-inside text-lg text-gray-800 space-y-3">
        <?php foreach ($schedule as $item): ?>
          <li class="flex items-center space-x-3">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span><?php echo $item; ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p class="text-red-600 font-semibold text-center text-xl mb-6">Oops! No data found. Please go back and submit the form first.</p>
    <?php endif; ?>

    <!-- Back Button with Icon -->
    <div class="text-center mt-6">
      <a href="index.html" class="inline-block bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-semibold text-lg transition duration-300 ease-in-out transform hover:scale-105">
        <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
      </a>
    </div>
  </div>

</body>
</html>
