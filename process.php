<?php
// Get form data
$age = $_POST['age'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$goal = $_POST['goal'];
$diet = $_POST['diet']; // Diet type (Veg, Vegan, Keto, Gluten-free)
$allergies = $_POST['allergies'];

// Calculate daily macronutrient needs based on goal (rough estimation)
function calculateNutrition($goal, $weight) {
    if ($goal == "weight_loss") {
        $calories = $weight * 20;
        $carbs = $calories * 0.4 / 4;
        $protein = $calories * 0.3 / 4;
        $fats = $calories * 0.3 / 9;
    } elseif ($goal == "muscle_gain") {
        $calories = $weight * 25;
        $carbs = $calories * 0.5 / 4;
        $protein = $calories * 0.3 / 4;
        $fats = $calories * 0.2 / 9;
    } else {
        $calories = $weight * 22;
        $carbs = $calories * 0.5 / 4;
        $protein = $calories * 0.2 / 4;
        $fats = $calories * 0.3 / 9;
    }

    return [
        'calories' => $calories,
        'carbs' => $carbs,
        'protein' => $protein,
        'fats' => $fats
    ];
}

// Get nutritional info
$nutrition = calculateNutrition($goal, $weight);

// Define meal plans for each diet type
$mealPlans = [
    'veg' => [
        'Day 1' => ['Vegetable stir-fry with tofu', 'Lentil salad', 'Fruit salad', 'Grilled vegetables with quinoa'],
        'Day 2' => ['Oatmeal with almond butter', 'Vegetable curry', 'Carrot sticks with hummus', 'Stuffed bell peppers'],
        'Day 3' => ['Smoothie with spinach, banana, and almond milk', 'Chickpea salad', 'Roasted sweet potatoes', 'Mushroom risotto'],
        'Day 4' => ['Veggie and hummus wrap', 'Grilled veggie bowl', 'Apple with peanut butter', 'Spinach and feta salad'],
        'Day 5' => ['Chia pudding with berries', 'Vegetable stir-fry', 'Cucumber slices with guacamole', 'Quinoa and chickpea bowl'],
        'Day 6' => ['Whole wheat toast with avocado', 'Sweet potato and black bean chili', 'Greek yogurt with honey', 'Grilled veggie skewers'],
        'Day 7' => ['Smoothie bowl with fruit', 'Lentil soup', 'Rice cakes with almond butter', 'Zucchini noodles with marinara']
    ],
    'vegan' => [
        'Day 1' => ['Tofu scramble with spinach', 'Vegan lentil salad', 'Fresh fruit', 'Vegan pasta with marinara'],
        'Day 2' => ['Chia pudding with almond milk', 'Vegan tacos', 'Carrot sticks with hummus', 'Vegan stir-fry with tofu'],
        'Day 3' => ['Vegan smoothie with almond milk', 'Chickpea salad', 'Roasted sweet potatoes', 'Vegan sushi'],
        'Day 4' => ['Vegan avocado toast', 'Vegan Buddha bowl', 'Apple with almond butter', 'Lentil stew'],
        'Day 5' => ['Oatmeal with berries', 'Vegan curry', 'Rice cakes with guacamole', 'Vegan quinoa salad'],
        'Day 6' => ['Vegan pancakes with maple syrup', 'Vegan Buddha bowl', 'Hummus with cucumber', 'Vegan lasagna'],
        'Day 7' => ['Smoothie with banana and chia seeds', 'Vegan chili', 'Vegan yogurt with granola', 'Vegan stir-fry with tofu']
    ],
    'keto' => [
        'Day 1' => ['Avocado with eggs', 'Grilled chicken with broccoli', 'Cheese with almonds', 'Salmon with spinach'],
        'Day 2' => ['Eggs and bacon', 'Grilled shrimp with zucchini', 'Cheese with cucumber', 'Chicken with cauliflower rice'],
        'Day 3' => ['Keto smoothie with coconut milk', 'Chicken salad with avocado', 'Pork belly with greens', 'Beef stir-fry'],
        'Day 4' => ['Scrambled eggs with avocado', 'Grilled steak with spinach', 'Olives with cheese', 'Keto chicken soup'],
        'Day 5' => ['Bacon and avocado', 'Chicken with zucchini noodles', 'Cheese with almonds', 'Keto pizza'],
        'Day 6' => ['Omelette with spinach and feta', 'Grilled salmon with asparagus', 'Macadamia nuts', 'Beef burger with no bun'],
        'Day 7' => ['Eggs with avocado', 'Grilled chicken with avocado', 'Cucumber with ranch dip', 'Keto beef stir-fry']
    ],
    'gluten_free' => [
        'Day 1' => ['Oatmeal with almond butter', 'Grilled chicken salad', 'Fruit salad', 'Baked salmon with quinoa'],
        'Day 2' => ['Eggs with avocado', 'Chicken quinoa salad', 'Carrot sticks with hummus', 'Grilled chicken with veggies'],
        'Day 3' => ['Smoothie with banana and almond milk', 'Quinoa salad with chickpeas', 'Apple slices with almond butter', 'Chicken stir-fry'],
        'Day 4' => ['Gluten-free toast with peanut butter', 'Chicken and vegetable soup', 'Greek yogurt with berries', 'Grilled fish with steamed veggies'],
        'Day 5' => ['Quinoa porridge', 'Grilled turkey burger', 'Cucumber with hummus', 'Gluten-free pizza'],
        'Day 6' => ['Gluten-free pancakes', 'Grilled chicken with zucchini', 'Apple slices with peanut butter', 'Gluten-free pasta with pesto'],
        'Day 7' => ['Smoothie with berries', 'Grilled fish with quinoa', 'Rice cakes with almond butter', 'Chicken with roasted vegetables']
    ]
];

// Select the meal plan based on diet
$selectedMealPlan = $mealPlans[strtolower($diet)] ?? $mealPlans['veg']; // Default to Veg if diet is unknown

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personalized Meal Plan</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    .meal-row:hover {
      background-color: #f3f4f6;
    }
  </style>
</head>
<body class="bg-gray-100 p-6">

  <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6">Your Personalized Meal Plan</h1>

    

    <!-- Show the calculated nutritional values -->
    <div class="mb-4">
      <h2 class="text-xl font-semibold">Daily Nutritional Goals</h2>
      <p class="text-sm">Calories: <?php echo round($nutrition['calories']); ?> kcal</p>
      <p class="text-sm">Carbohydrates: <?php echo round($nutrition['carbs']); ?> g</p>
      <p class="text-sm">Protein: <?php echo round($nutrition['protein']); ?> g</p>
      <p class="text-sm">Fats: <?php echo round($nutrition['fats']); ?> g</p>
    </div>

    <!-- Meal plan button -->
    <button id="showMealPlanBtn" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
      View Your 7-Day Meal Plan
    </button>

    <!-- 7-Day Meal Plan Table -->
    <div id="mealPlanTable" class="mt-6 hidden">
      <table class="min-w-full table-auto">
        <thead>
          <tr class="bg-blue-100">
            <th class="px-4 py-2 text-left">Day</th>
            <th class="px-4 py-2 text-left">Breakfast</th>
            <th class="px-4 py-2 text-left">Lunch</th>
            <th class="px-4 py-2 text-left">Snack</th>
            <th class="px-4 py-2 text-left">Dinner</th>
          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($selectedMealPlan as $day => $meals) {
            echo "<tr class='meal-row'>
                    <td class='border px-4 py-2'>$day</td>
                    <td class='border px-4 py-2'>{$meals[0]}</td>
                    <td class='border px-4 py-2'>{$meals[1]}</td>
                    <td class='border px-4 py-2'>{$meals[2]}</td>
                    <td class='border px-4 py-2'>{$meals[3]}</td>
                  </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>

    <!-- Back to Home Button -->

    <div>
    <a href="index.html" class="inline-flex mt-10 items-center bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out mb-6">
    <i class="fas fa-home mr-2"></i> <!-- Font Awesome Home Icon -->
    Back to Home
  </a>
    </div>
  </div>


  <script>
    document.getElementById('showMealPlanBtn').addEventListener('click', function() {
      var mealPlanTable = document.getElementById('mealPlanTable');
      mealPlanTable.classList.toggle('hidden'); // Toggle visibility of the meal plan table
    });
  </script>

</body>
</html>
