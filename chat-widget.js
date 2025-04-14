// Predefined questions and answers
const chatResponses = {
    "hello": "Hi there! How can I assist you today?",
    "plans": "We offer Basic, Premium, and Elite plans. You can check them out on our Plans page.",
    "features": "FitQuest offers personalized plans, progress tracking, and expert support.",
    "help": "Sure! What do you need help with?",
    "thank you": "You're welcome! If you have more questions, feel free to ask.",
    "bye": "Goodbye! Have a great day!"
};

let conversationState = {
    step: 0,
    goal: null,
    plan: null,
    dietaryPreference: null,
    mealTrackerDetails: null,
    recipeDetails: null,
    mealPrepDetails: null,
    spreadsheetDetails: null,
};

function openChat() {
    document.getElementById('chatPopup').classList.remove('hidden');
    addMessageToChat('bot', "Hello there! How may I help you today?");
    addMessageToChat('bot', "1. Do you need assistance in choosing the right plan for you?\n2. Maybe you need me to assist you with your best fitness routine?\n3. Or maybe you need a reality check to stop overthinking? Let me present you with a simple diet chart!");
}

function closeChat() {
    document.getElementById('chatPopup').classList.add('hidden');
}

function handleKeyDown(event) {
    if (event.key === 'Enter') {
        const userInput = document.getElementById('chatInput').value.trim().toLowerCase();
        addMessageToChat('user', userInput);
        document.getElementById('chatInput').value = '';

        let response = handleConversation(userInput);
        addMessageToChat('bot', response);
    }
}

function addMessageToChat(sender, message) {
    const chatMessages = document.getElementById('chatMessages');
    const messageElement = document.createElement('div');
    messageElement.textContent = message;
    messageElement.classList.add(sender);
    chatMessages.appendChild(messageElement);
    chatMessages.scrollTop = chatMessages.scrollHeight; // Scroll to the bottom
}

function handleConversation(input) {
    let response = "I'm sorry, I didn't understand that. Can you please rephrase?";

    if (conversationState.step === 0) {
        if (input === '1') {
            conversationState.goal = 'plan';
            response = "I can help you select the best plan based on your needs.\nWhat is your primary goal?\n1. Weight Loss\n2. Muscle Gain\n3. General Fitness";
        } else if (input === '2') {
            conversationState.goal = 'fitness';
            response = "Fitness is a journey, and I’m here to guide you! Let’s start by understanding your goal.\nWhat is your primary fitness goal?\n1. Weight Loss\n2. Muscle Gain\n3. General Fitness";
        } else if (input === '3') {
            conversationState.goal = 'diet';
            response = "Let’s keep it simple! Your diet doesn’t need to be complicated—it just needs to work for you.\nWhich dietary preference do you follow?\n1. Vegetarian\n2. Vegan\n3. Non-Vegetarian\n4. No Restrictions";
        }
        conversationState.step = 1;
    } else if (conversationState.step === 1) {
        if (conversationState.goal === 'plan') {
            if (input === '1') {
                conversationState.plan = 'weight_loss';
                response = "Great! To lose weight, you need a structured approach that includes diet, exercise, and consistency.\nThere are three plans designed for different commitment levels:\n1. Basic Plan – Light workouts + easy-to-follow diet.\n2. Premium Plan – Balanced approach with workouts and customized meals.\n3. Elite Plan – Intense training with strict diet guidelines for faster results.";
            } else if (input === '2') {
                conversationState.plan = 'muscle_gain';
                response = "Great! Muscle Gain requires progressive strength training and proper nutrition.\nLet’s build a plan that suits you.\nChoose your training level:\n1. Basic – 3x a week, bodyweight & light weights.\n2. Premium – 4-5x a week, structured weight training.\n3. Elite – 5-6x a week, advanced training with high intensity.";
            } else if (input === '3') {
                conversationState.plan = 'general_fitness';
                response = "Great! General fitness is about staying active, maintaining strength, and ensuring a healthy body.\nHere are three general fitness plans based on your lifestyle:\n1. Basic Plan – Simple and easy workouts for beginners.\n2. Premium Plan – A balanced plan for maintaining fitness levels.\n3. Elite Plan – A performance-based plan for higher endurance and strength.";
            }
            conversationState.step = 2;
        } else if (conversationState.goal === 'fitness') {
            if (input === '1') {
                conversationState.plan = 'weight_loss';
                response = "Losing weight requires a mix of cardio, strength training, and a balanced diet.\nChoose your training level:\n1. Basic – 3x a week, light workouts.\n2. Premium – 4-5x a week, strength + cardio.\n3. Elite – 5-6x a week, advanced cardio + strength training.";
            } else if (input === '2') {
                conversationState.plan = 'muscle_gain';
                response = "Muscle Gain requires progressive strength training and proper nutrition.\nLet’s build a plan that suits you.\nChoose your training level:\n1. Basic – 3x a week, bodyweight & light weights.\n2. Premium – 4-5x a week, structured weight training.\n3. Elite – 5-6x a week, advanced training with high intensity.";
            } else if (input === '3') {
                conversationState.plan = 'general_fitness';
                response = "General fitness is about staying active, maintaining strength, and ensuring a healthy body.\nHere are three general fitness plans based on your lifestyle:\n1. Basic Plan – Simple and easy workouts for beginners.\n2. Premium Plan – A balanced plan for maintaining fitness levels.\n3. Elite Plan – A performance-based plan for higher endurance and strength.";
            }
            conversationState.step = 2;
        } else if (conversationState.goal === 'diet') {
            if (input === '1') {
                conversationState.dietaryPreference = 'vegetarian';
                response = "Great! Here’s a simple yet effective Vegetarian Diet Plan to keep you healthy and on track.\nWould you like a customized meal tracker?";
            } else if (input === '2') {
                conversationState.dietaryPreference = 'vegan';
                response = "Great! Here’s a simple yet effective Vegan Diet Plan to keep you healthy and on track.\nWould you like weekly recipe suggestions?";
            } else if (input === '3') {
                conversationState.dietaryPreference = 'non_vegetarian';
                response = "Great! Here’s a simple yet effective Non-Vegetarian Diet Plan to keep you healthy and on track.\nWould you like a meal prep guide?";
            } else if (input === '4') {
                conversationState.dietaryPreference = 'no_restrictions';
                response = "Great! Here’s a simple yet effective No Restrictions Diet Plan to keep you healthy and on track.\nWould you like a full meal tracking spreadsheet?";
            }
            conversationState.step = 3;
        }
    } else if (conversationState.step === 2) {
        if (conversationState.plan === 'weight_loss' || conversationState.plan === 'muscle_gain' || conversationState.plan === 'general_fitness') {
            if (input === '1') {
                response = "Great choice! Here’s your Basic Plan: [Insert Basic Plan Details]";
            } else if (input === '2') {
                response = "Great choice! Here’s your Premium Plan: [Insert Premium Plan Details]";
            } else if (input === '3') {
                response = "Great choice! Here’s your Elite Plan: [Insert Elite Plan Details]";
            }
            conversationState.step = 0; // Reset to initial step after providing plan details
        }
    } else if (conversationState.step === 3) {
        if (conversationState.dietaryPreference === 'vegetarian') {
            if (input.toLowerCase() === 'yes') {
                response = "Great! I’ll create a customized meal tracker for you.\nTo tailor this meal tracker to your needs, I need a few more details:\n1. What’s your goal?\n2. How many meals do you prefer daily?\n3. Do you have any food allergies?\n4. Would you like reminders for meal tracking?";
                conversationState.step = 4;
            } else {
                response = "No problem! Let me know if you need anything else.";
                conversationState.step = 0;
            }
        } else if (conversationState.dietaryPreference === 'vegan') {
            if (input.toLowerCase() === 'yes') {
                response = "Awesome! I’ll send you 7 meal ideas per week that fit your diet preference and goal.\nTo make sure the recipes are right for you, tell me:\n1. Do you prefer simple recipes or elaborate ones?\n2. Do you have any ingredients you dislike or avoid?\n3. Do you want budget-friendly meals?";
                conversationState.step = 4;
            } else {
                response = "No problem! Let me know if you need anything else.";
                conversationState.step = 0;
            }
        } else if (conversationState.dietaryPreference === 'non_vegetarian') {
            if (input.toLowerCase() === 'yes') {
                response = "Great choice! Meal prepping helps save time, money, and effort while keeping your diet on track.\nBefore I send your personalized meal prep guide, tell me:\n1. How many days do you want to prep for?\n2. What’s your storage preference?\n3. Would you like a shopping list with meal prep?";
                conversationState.step = 4;
            } else {
                response = "No problem! Let me know if you need anything else.";
                conversationState.step = 0;
            }
        } else if (conversationState.dietaryPreference === 'no_restrictions') {
            if (input.toLowerCase() === 'yes') {
                response = "Perfect! A meal tracking spreadsheet helps you log your food intake, monitor calories & macros, and stay on track.\nBefore I generate your sheet, I need:\n1. What level of detail do you want?\n2. Would you like automatic calculations?\n3. Would you like a visual progress tracker?";
                conversationState.step = 4;
            } else {
                response = "No problem! Let me know if you need anything else.";
                conversationState.step = 0;
            }
        }
    } else if (conversationState.step === 4) {
        response = "Thank you for the details! I’ll generate your custom plan now.";
        conversationState.step = 0; // Reset to initial step after gathering details
    }

    return response;
}
