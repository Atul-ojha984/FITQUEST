// Main JavaScript file
document.addEventListener('DOMContentLoaded', function() {
    console.log('FitQuest is ready!');
    // Check if user is logged in
    const user = localStorage.getItem('user');
    if (user) {
        console.log('User logged in:', JSON.parse(user));
    }
});

// Utility function to fetch with proper error handling
async function fetchAPI(endpoint, options = {}) {
    try {
        const response = await fetch(endpoint, {
            headers: {
                'Content-Type': 'application/json',
                ...options.headers
            },
            ...options
        });

        if (!response.ok) {
            throw new Error(`API error: ${response.statusText}`);
        }

        return await response.json();
    } catch (error) {
        console.error('Fetch error:', error);
        throw error;
    }
}
