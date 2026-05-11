# Complete Guide: Database Setup + Vercel Deployment

---

## 📋 TABLE OF CONTENTS

1. [Option 1: Using External Database Services (Recommended)](#option-1-external-database)
2. [Option 2: Local MySQL Setup (Testing Only)](#option-2-local-mysql)
3. [Deploy to Vercel](#vercel-deployment)
4. [Verify Deployment](#verify-deployment)
5. [Troubleshooting](#troubleshooting)

---

# PART 1: DATABASE SETUP

## Option 1: External Database Services (Recommended for Vercel) ⭐

### Why External? 
Vercel is serverless - local databases aren't accessible. You need an external MySQL service.

---

### **Choice A: MySQL on AWS RDS** (Most Popular)

#### Step 1: Create AWS Account
1. Go to https://aws.amazon.com
2. Sign up (free tier available)
3. Log in to AWS Console

#### Step 2: Create RDS MySQL Instance
1. Go to **RDS** → **Databases**
2. Click **Create Database**
3. Choose:
   - **Engine**: MySQL
   - **Version**: 8.0.28 (or latest)
   - **DB Instance Class**: db.t3.micro (free tier)
   - **Storage**: 20 GB (free tier)

#### Step 3: Configure Database
```
DB Instance Identifier: fitquest-db
Master Username: admin
Master Password: StrongPassword123! (copy this)
Publicly Accessible: YES (important!)
```

#### Step 4: Get Connection Details
After creation (5-10 minutes), go to **Connectivity & security**:
```
Endpoint: fitquest-db.xxxxx.us-east-1.rds.amazonaws.com (copy this)
Port: 3306
Username: admin
Password: StrongPassword123!
Database: (we'll create it)
```

#### Step 5: Create Database
1. Use MySQL client or tool like MySQL Workbench:
```bash
mysql -h fitquest-db.xxxxx.us-east-1.rds.amazonaws.com -u admin -p
```

2. Create database:
```sql
CREATE DATABASE fitquest2 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

✅ **Done! You now have:**
- Host: `fitquest-db.xxxxx.us-east-1.rds.amazonaws.com`
- Username: `admin`
- Password: `StrongPassword123!`
- Database: `fitquest2`

---

### **Choice B: MySQL on DigitalOcean**

#### Step 1: Create DigitalOcean Account
1. Go to https://www.digitalocean.com
2. Sign up (free $200 credit)

#### Step 2: Create Managed MySQL Database
1. Click **Create** → **Databases**
2. Choose:
   - Engine: MySQL
   - Version: 8.0
   - Size: Basic (smallest, ~$15/month)
   - Region: Closest to you

#### Step 3: Configure
- DB Name: `fitquest2`
- DB User: `fitquest_user`
- Password: (auto-generated, copy it)

#### Step 4: Get Connection Details
After creation, you'll see:
```
Host: db-xxxxx.ondigitalocean.com
Port: 3306
Username: fitquest_user
Password: xxxxx (copied)
Database: fitquest2
```

✅ **Done!** Use these credentials for Vercel.

---

### **Choice C: MySQL on Aiven** (Free Tier Available)

#### Step 1: Create Aiven Account
1. Go to https://aiven.io
2. Sign up (free tier available)

#### Step 2: Create MySQL Service
1. Click **Create Service** → **MySQL**
2. Choose Plan: **Free** ($0/month)
3. Region: Closest to you
4. Service Name: `fitquest-db`

#### Step 3: Get Connection Details
After creation:
```
Host: mysql-xxxxx.a.aivencloud.com
Port: 3306 or 21121
Username: avnadmin
Password: (auto-generated, copy it)
SSL: Required
```

#### Step 4: Create Database
```bash
mysql -h mysql-xxxxx.a.aivencloud.com -u avnadmin -p --ssl-mode=REQUIRED
```

```sql
CREATE DATABASE fitquest2 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

✅ **Done!** Use these credentials for Vercel.

---

## Option 2: Local MySQL Setup (Testing Only)

### ⚠️ Only for Local Development - NOT for Vercel

#### Step 1: Install MySQL
**Windows:**
1. Download from https://dev.mysql.com/downloads/mysql/
2. Run installer
3. Choose setup type: Developer Default
4. Follow installation wizard

**Mac:**
```bash
brew install mysql
```

**Linux:**
```bash
sudo apt-get install mysql-server
```

#### Step 2: Start MySQL
**Windows (PowerShell):**
```powershell
mysql -u root -p
```

**Mac/Linux:**
```bash
mysql -u root -p
```

#### Step 3: Create Database
```sql
CREATE DATABASE fitquest2 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

#### Step 4: Create .env File
```env
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=root
DB_NAME=fitquest2
NODE_ENV=development
SESSION_SECRET=your_secret_key_here
```

#### Step 5: Test Locally
```bash
npm install
npm run dev
```

Visit `http://localhost:3000` to test.

---

# PART 2: VERCEL DEPLOYMENT

## Step 1: Prepare Project

```bash
cd "c:\Users\kumar\Downloads\FITQUEST-main (2)\FITQUEST-main"

# Verify files exist
ls public/
ls api/
```

---

## Step 2: Ensure GitHub is Updated

```bash
git status
git add .
git commit -m "Final update before Vercel deployment"
git push origin main
```

---

## Step 3: Deploy to Vercel

### **Option A: Using Vercel Dashboard (Easiest)** ⭐

#### Step 1: Go to Vercel
1. Visit https://vercel.com
2. Click **Sign Up** (or **Log In** if you have account)
3. Sign up with GitHub account (recommended)

#### Step 2: Import Repository
1. Click **New Project**
2. Click **Import Git Repository**
3. Select your FITQUEST repository from the list
4. Click **Import**

#### Step 3: Configure Project
```
Framework Preset: Other
Root Directory: ./
```

#### Step 4: Add Environment Variables
Click **Environment Variables** and add:

```
DB_HOST = fitquest-db.xxxxx.us-east-1.rds.amazonaws.com
DB_USER = admin
DB_PASSWORD = StrongPassword123!
DB_NAME = fitquest2
NODE_ENV = production
SESSION_SECRET = your_random_secret_key_12345
```

**Replace with YOUR database credentials from Step 1**

#### Step 5: Deploy
1. Click **Deploy**
2. Wait 2-5 minutes for deployment
3. You'll see a success message with your URL: `https://fitquest.vercel.app`

---

### **Option B: Using Vercel CLI**

#### Step 1: Install Vercel CLI
```bash
npm install -g vercel
```

#### Step 2: Login to Vercel
```bash
vercel login
```
(Opens browser to authenticate)

#### Step 3: Deploy
```bash
cd "c:\Users\kumar\Downloads\FITQUEST-main (2)\FITQUEST-main"
vercel
```

#### Step 4: Follow Prompts
```
? Set up and deploy "C:\Users\...\FITQUEST-main"? [Y/n] → Y
? Which scope? → Your Account
? Link to existing project? [y/N] → N
? What's your project's name? → fitquest
? In which directory is your code located? → ./
? Want to modify these settings? [y/N] → N
```

#### Step 5: Add Environment Variables
After initial deploy:
```bash
vercel env add DB_HOST
vercel env add DB_USER
vercel env add DB_PASSWORD
vercel env add DB_NAME
vercel env add NODE_ENV
vercel env add SESSION_SECRET
```

#### Step 6: Redeploy with Variables
```bash
vercel --prod
```

---

## Step 4: After Deployment

Your project is now live at a URL like:
```
https://fitquest.vercel.app
```

---

# PART 3: VERIFY DEPLOYMENT

## Test Your Deployment

### ✅ Test 1: Homepage Loads
```
Visit: https://yoursite.vercel.app
Expected: Homepage with features, pricing, testimonials
```

### ✅ Test 2: Signup Works
```
1. Click "Get Started" or go to /signup.html
2. Fill form: name, email, password
3. Submit
Expected: Success message (check browser console)
```

### ✅ Test 3: Login Works
```
1. Go to /login.html
2. Use credentials from signup
3. Submit
Expected: Redirects to /progress-tracker.html
```

### ✅ Test 4: Profile Form Works
```
1. Fill fitness profile form
2. Submit
Expected: Shows personalized routine
```

### ✅ Test 5: Progress Tracker Works
```
1. Add progress entry (weight, calories, mood)
2. Submit
Expected: Entry saved and displayed
```

---

# PART 4: TROUBLESHOOTING

## Issue 1: "Database Connection Failed"

**Solution:**
1. Check environment variables in Vercel:
   - Go to Project Settings → Environment Variables
   - Verify all DB_* variables are correct
   
2. Test database connection locally:
   ```bash
   mysql -h YOUR_HOST -u YOUR_USER -p
   ```
   
3. Check database accessibility:
   - If using AWS RDS, verify **Security Group** allows inbound on port 3306
   - If using DigitalOcean, check firewall rules

---

## Issue 2: "Cannot GET /signup.html"

**Solution:**
- File path issue. Check that files are in `/public/` folder
- Verify `vercel.json` routes are correct

---

## Issue 3: "404 on API Call"

**Solution:**
- API function not found
- Check files exist in `/api/` folder with correct names:
  - `/api/login.js`
  - `/api/signup.js`
  - `/api/generate-routine.js`
  - `/api/save-progress.js`
  - `/api/progress-tracker.js`

---

## Issue 4: "Build Failed"

**Solution:**
```bash
# Check for errors
npm run build

# Check for syntax errors
npm run dev
```

---

## Issue 5: "CSS/Images Not Loading"

**Solution:**
- Verify paths use leading `/`
- Check files exist in `/public/css/`, `/public/js/`, `/public/images/`
- Add missing images to `/public/images/`

---

# COMPLETE CHECKLIST

## Before Deployment

- [ ] Database created (AWS RDS, DigitalOcean, or Aiven)
- [ ] Database credentials noted:
  - [ ] Host: ________________
  - [ ] Username: ________________
  - [ ] Password: ________________
  - [ ] Database Name: ________________
- [ ] Project pushed to GitHub
- [ ] All files in `/public/`, `/api/`, etc.

## During Deployment

- [ ] Created Vercel account
- [ ] Imported GitHub repository
- [ ] Added environment variables (all 6)
- [ ] Clicked Deploy

## After Deployment

- [ ] Homepage loads
- [ ] Signup works
- [ ] Login works
- [ ] Profile form works
- [ ] Progress tracker works
- [ ] No console errors

---

# QUICK REFERENCE

## Database Credentials You Need

```
DB_HOST = [from database service]
DB_USER = [from database service]
DB_PASSWORD = [from database service]
DB_NAME = fitquest2
NODE_ENV = production
SESSION_SECRET = [generate random string]
```

## Recommended Database Service

**AWS RDS** - Most reliable, free tier available
- https://aws.amazon.com/rds/

**DigitalOcean** - Easiest setup, $5/month
- https://www.digitalocean.com/products/managed-databases/

**Aiven** - Free tier, very reliable
- https://aiven.io

---

# CONTACT & SUPPORT

If deployment fails:

1. Check logs in Vercel dashboard
2. Verify environment variables
3. Test database connection
4. Check GitHub repository is up to date

---

## 🚀 YOU'RE READY TO DEPLOY!

Follow the steps above and your FITQUEST app will be live in minutes.

**Start with database setup → Then Vercel deployment → Then verify everything works!**

---

*Last Updated: May 11, 2026*
