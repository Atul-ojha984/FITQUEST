# FitQuest - AI-Powered Fitness Platform

A personalized fitness application that uses AI to generate customized workout routines, track progress, and provide nutritional guidance.

## Features

✅ **Personalized Workout Plans** - AI-generated routines based on goals and fitness level
✅ **Progress Tracking** - Monitor weight, workouts, calories, and mood
✅ **Nutrition Guidance** - Customized meal plans for different dietary preferences
✅ **Smart Scheduling** - Intelligent workout scheduling recommendations
✅ **Mobile Responsive** - Works perfectly on desktop and mobile devices

## Technology Stack

- **Frontend**: HTML5, CSS3, Tailwind CSS, Vanilla JavaScript
- **Backend**: Node.js with serverless functions (Vercel)
- **Database**: MySQL
- **Authentication**: bcryptjs for password hashing
- **Charts**: Chart.js for progress visualization

## Quick Start

### Prerequisites
- Node.js 18+
- MySQL database
- Vercel account (for deployment)

### Installation

1. **Install dependencies**
   ```bash
   npm install
   ```

2. **Configure environment**
   ```bash
   cp .env.example .env
   # Edit .env with your database credentials
   ```

3. **Run locally**
   ```bash
   npm run dev
   ```

## Deployment on Vercel

1. Push code to GitHub
2. Go to vercel.com and import repository
3. Add environment variables:
   - `DB_HOST` - MySQL host
   - `DB_USER` - MySQL username
   - `DB_PASSWORD` - MySQL password
   - `DB_NAME` - Database name (fitquest2)
4. Click Deploy

## Project Structure

```
├── public/          # Static files (HTML, CSS, JS, images)
├── api/             # Serverless API functions
├── package.json     # Dependencies
├── vercel.json      # Vercel config
└── README.md        # This file
```

## API Endpoints

- `POST /api/signup` - Register user
- `POST /api/login` - Login user  
- `POST /api/generate-routine` - Generate workout plan
- `POST /api/save-progress` - Save progress entry
- `GET /api/progress-tracker` - Get progress data

## Environment Variables

```env
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=root
DB_NAME=fitquest2
NODE_ENV=production
```

## Troubleshooting

### "Database connection failed"
- Ensure MySQL is running
- Check credentials in .env file

### CSS/Images not loading
- Verify files are in public/ folder
- Check paths use leading `/`

### CORS errors
- Already configured in API functions
- Check Vercel environment variables

## Support

For issues or questions, please create an issue in the repository.

## License

MIT License
