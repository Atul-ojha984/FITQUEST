<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = (object)[
        'name' => $_POST['name'],
        'age' => $_POST['age'],
        'gender' => $_POST['gender'],
        'weight' => $_POST['weight'],
        'height' => $_POST['height'],
        'goal' => $_POST['goal'],
        'workout_place' => $_POST['workout_place'],
        'diet' => $_POST['diet'],
    ];

    // Calculate BMI
    $bmi = round($user->weight / pow($user->height / 100, 2), 2);
    $bmiCategory = '';
    $bmiColor = 'blue';

    if ($bmi < 18.5) {
        $bmiCategory = 'Underweight';
        $bmiColor = 'yellow';
    } elseif ($bmi < 24.9) {
        $bmiCategory = 'Healthy';
        $bmiColor = 'green';
    } elseif ($bmi < 29.9) {
        $bmiCategory = 'Overweight';
        $bmiColor = 'orange';
    } else {
        $bmiCategory = 'Obese';
        $bmiColor = 'red';
    }

    // Placeholder workout and meal plans
    $workouts = ["Push-ups", "Squats", "Plank"];
    $meals = [
        "Breakfast" => "Oatmeal + Banana",
        "Lunch" => "Rice + Paneer + Veggies",
        "Dinner" => "Roti + Mixed Veg Curry"
    ];

    // Start HTML output
    echo '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Routine</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-50 to-green-50 min-h-screen p-8">
  <div class="max-w-4xl mx-auto space-y-8">
    <!-- Header Section -->
    <div class="bg-white rounded-2xl shadow-lg p-8 text-center">
      <h1 class="text-4xl font-bold text-gray-800 mb-2">Hello ' . htmlspecialchars($user->name) . '! 👋</h1>
      <p class="text-gray-600">Your personalized fitness plan based on:</p>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6 text-sm">
        <div class="bg-gray-50 p-3 rounded-lg">
          <p class="font-semibold">Age</p>
          <p>' . htmlspecialchars($user->age) . ' years</p>
        </div>
        <div class="bg-gray-50 p-3 rounded-lg">
          <p class="font-semibold">Weight</p>
          <p>' . htmlspecialchars($user->weight) . ' kg</p>
        </div>
        <div class="bg-gray-50 p-3 rounded-lg">
          <p class="font-semibold">Height</p>
          <p>' . htmlspecialchars($user->height) . ' cm</p>
        </div>
        <div class="bg-gray-50 p-3 rounded-lg">
          <p class="font-semibold">Goal</p>
          <p>' . htmlspecialchars($user->goal) . '</p>
        </div>
      </div>
    </div>

    <!-- BMI Section -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-xl font-bold text-gray-800">Body Mass Index (BMI)</h3>
        <span class="px-4 py-1 rounded-full bg-'.$bmiColor.'-100 text-'.$bmiColor.'-800 text-sm">'.$bmiCategory.'</span>
      </div>
      <div class="flex items-center space-x-4">
        <div class="text-4xl font-bold text-gray-800">'.$bmi.'</div>
        <div class="flex-1 bg-gray-200 rounded-full h-3">
          <div class="bg-'.$bmiColor.'-500 h-3 rounded-full" style="width: '.min(100, ($bmi/40)*100).'%"></div>
        </div>
      </div>
    </div>

    <!-- Workout Plan -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
      <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
        </svg>
        Workout Plan
      </h3>
      <div class="grid gap-4">';

    foreach ($workouts as $w) {
        echo '<div class="flex items-center p-4 bg-gray-50 rounded-lg">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white mr-4">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                  </svg>
                </div>
                <span class="font-medium">' . htmlspecialchars($w) . '</span>
              </div>';
    }

    echo '</div></div>

    <!-- Meal Plan -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
      <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
        <svg class="w-6 h-6 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Nutrition Plan
      </h3>
      <div class="grid md:grid-cols-3 gap-4">';

    foreach ($meals as $k => $m) {
        echo '<div class="bg-gray-50 p-4 rounded-lg">
                <div class="font-medium text-blue-600 mb-2">' . htmlspecialchars($k) . '</div>
                <p class="text-gray-700">' . htmlspecialchars($m) . '</p>
              </div>';
    }

    echo '</div></div>

    <!-- Water Intake -->
    <div class="bg-white rounded-2xl shadow-lg p-8">
      <div class="flex items-center justify-between">
        <div>
          <h3 class="text-xl font-bold text-gray-800 mb-2">Water Intake</h3>
          <p class="text-gray-600">Daily hydration goal</p>
        </div>
        <div class="text-2xl font-bold text-blue-500">' . round($user->weight * 35) . ' ml</div>
      </div>
      <div class="mt-4 bg-gray-200 rounded-full h-3">
        <div class="bg-blue-500 h-3 rounded-full w-1/3"></div>
      </div>
    </div>

    <!-- Back Button -->
    <a href="index.html" class="block w-full bg-white hover:bg-gray-50 text-gray-700 font-semibold py-4 px-8 rounded-2xl shadow-lg transition-all duration-200 text-center">
      ← Back to Home
    </a>
  </div>
</body>
</html>';
}
?>