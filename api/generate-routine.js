module.exports = async (req, res) => {
  res.setHeader('Access-Control-Allow-Origin', '*');
  res.setHeader('Access-Control-Allow-Methods', 'POST, OPTIONS');
  res.setHeader('Access-Control-Allow-Headers', 'Content-Type');
  
  if (req.method === 'OPTIONS') {
    return res.status(200).end();
  }
  
  if (req.method !== 'POST') {
    return res.status(405).json({ error: 'Method not allowed' });
  }

  const { age, weight, height, goal, diet, allergies } = req.body || {};

  if (!age || !weight || !height || !goal) {
    return res.status(400).json({ error: 'Missing required fields' });
  }

  try {
    // Calculate daily macronutrient needs based on goal
    function calculateNutrition(fitnessGoal, userWeight) {
      let calories, carbs, protein, fats;

      if (fitnessGoal.toLowerCase() === 'weight loss') {
        calories = userWeight * 20;
        carbs = (calories * 0.4) / 4;
        protein = (calories * 0.3) / 4;
        fats = (calories * 0.3) / 9;
      } else if (fitnessGoal.toLowerCase() === 'muscle gain') {
        calories = userWeight * 25;
        carbs = (calories * 0.5) / 4;
        protein = (calories * 0.3) / 4;
        fats = (calories * 0.2) / 9;
      } else {
        calories = userWeight * 22;
        carbs = (calories * 0.5) / 4;
        protein = (calories * 0.2) / 4;
        fats = (calories * 0.3) / 9;
      }

      return { calories: Math.round(calories), carbs: Math.round(carbs), protein: Math.round(protein), fats: Math.round(fats) };
    }

    const nutrition = calculateNutrition(goal, weight);

    // BMI calculation
    const bmi = parseFloat((weight / Math.pow(height / 100, 2)).toFixed(2));
    let bmiCategory = '';
    let bmiColor = 'blue';

    if (bmi < 18.5) {
      bmiCategory = 'Underweight';
      bmiColor = 'yellow';
    } else if (bmi < 24.9) {
      bmiCategory = 'Healthy';
      bmiColor = 'green';
    } else if (bmi < 29.9) {
      bmiCategory = 'Overweight';
      bmiColor = 'orange';
    } else {
      bmiCategory = 'Obese';
      bmiColor = 'red';
    }

    // Sample workout plans
    const workouts = ['Push-ups', 'Squats', 'Plank', 'Cardio', 'Weight Training'];
    
    // Sample meal plans based on diet type
    const mealPlans = {
      'veg': ['Vegetable stir-fry with tofu', 'Lentil salad', 'Grilled vegetables with quinoa'],
      'vegan': ['Vegan Buddha bowl', 'Tofu scramble', 'Vegan pasta with marinara'],
      'keto': ['Grilled salmon with spinach', 'Eggs and bacon', 'Chicken with cauliflower rice'],
      'gluten_free': ['Quinoa salad with chickpeas', 'Grilled chicken with veggies', 'Rice bowls']
    };

    const meals = mealPlans[diet] || mealPlans['veg'];

    return res.status(200).json({
      success: true,
      profile: {
        age,
        weight,
        height,
        goal,
        diet,
        allergies
      },
      nutrition,
      bmi: { value: bmi, category: bmiCategory, color: bmiColor },
      workout: workouts,
      meals: meals
    });
  } catch (error) {
    console.error('Generate routine error:', error);
    return res.status(500).json({ error: 'Server error: ' + error.message });
  }
};
