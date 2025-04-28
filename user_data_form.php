<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FitQuest | Input Form</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-50 to-purple-50 min-h-screen p-8">
  
  <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg ring-1 ring-gray-100">
    <div class="text-center mb-8">
      <h2 class="text-4xl font-bold text-indigo-600 mb-2">Create Your Fitness Profile</h2>
      <p class="text-gray-600">Help us craft your perfect workout routine</p>
    </div>

    <form action="generate_routine.php" method="POST" class="space-y-6">
      <!-- Name Field -->
      <div class="space-y-2">
        <label class="block text-sm font-medium text-gray-700">Name <span class="text-red-500">*</span></label>
        <div class="relative">
          <input name="name" type="text" required 
                 class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all"
                 placeholder="John Doe">
          <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
          </svg>
        </div>
      </div>

      <!-- Age & Gender -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-2">
          <label class="block text-sm font-medium text-gray-700">Age <span class="text-red-500">*</span></label>
          <div class="relative">
            <input name="age" type="number" required 
                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all"
                   placeholder="Ex: 25">
            <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
        </div>

        <div class="space-y-2">
          <label class="block text-sm font-medium text-gray-700">Gender <span class="text-red-500">*</span></label>
          <div class="relative">
            <select name="gender" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all appearance-none">
              <option>Male</option>
              <option>Female</option>
              <option>Other</option>
            </select>
            <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
          </div>
        </div>
      </div>

      <!-- Weight & Height -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-2">
          <label class="block text-sm font-medium text-gray-700">Weight (kg) <span class="text-red-500">*</span></label>
          <div class="relative">
            <input name="weight" type="number" required 
                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all"
                   placeholder="Ex: 70">
            <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
            </svg>
          </div>
        </div>

        <div class="space-y-2">
          <label class="block text-sm font-medium text-gray-700">Height (cm) <span class="text-red-500">*</span></label>
          <div class="relative">
            <input name="height" type="number" required 
                   class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all"
                   placeholder="Ex: 175">
            <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m-3 0l3-3m-3 3l3 3m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
        </div>
      </div>

      <!-- Fitness Goal -->
      <div class="space-y-2">
        <label class="block text-sm font-medium text-gray-700">Fitness Goal <span class="text-red-500">*</span></label>
        <div class="relative">
          <select name="goal" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all appearance-none">
            <option>Weight Loss</option>
            <option>Muscle Gain</option>
            <option>Maintenance</option>
          </select>
          <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
        </div>
      </div>

      <!-- Workout Place & Diet Type -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-2">
          <label class="block text-sm font-medium text-gray-700">Workout Location</label>
          <div class="relative">
            <select name="workout_place" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all appearance-none">
              <option>Home</option>
              <option>Gym</option>
            </select>
            <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
          </div>
        </div>

        <div class="space-y-2">
          <label class="block text-sm font-medium text-gray-700">Diet Preference</label>
          <div class="relative">
            <select name="diet" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 transition-all appearance-none">
              <option>Vegetarian</option>
              <option>Non-Vegetarian</option>
            </select>
            <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
          </div>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="pt-6">
        <button type="submit" 
                class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold py-4 px-8 rounded-lg transform transition-all duration-200 hover:scale-[1.02] shadow-lg">
          Generate My Custom Routine →
        </button>
      </div>
    </form>
  </div>

</body>
</html>