# Quick Start Guide - Vercel Deployment

## Step 1: Prepare Your Project

1. Open terminal in project root
2. Verify all files are in place:
   ```bash
   # Check directory structure
   ls -la public/
   ls -la api/
   ls -la public/css/
   ls -la public/js/
   ```

## Step 2: Install Dependencies

```bash
npm install
```

This installs:
- express
- cors
- dotenv
- mysql2
- bcryptjs

## Step 3: Create Environment Configuration

### For Local Testing:

1. Create `.env` file:
   ```bash
   cp .env.example .env
   ```

2. Edit `.env` with your MySQL credentials:
   ```env
   DB_HOST=localhost
   DB_USER=root
   DB_PASSWORD=root
   DB_NAME=fitquest2
   NODE_ENV=development
   ```

### For Vercel Deployment:

You'll set these in Vercel dashboard as environment variables

## Step 4: Set Up MySQL Database (Local Testing)

```bash
# Start MySQL
mysql -u root -p

# Create database
CREATE DATABASE fitquest2 CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

## Step 5: Push to GitHub

```bash
# Initialize git (if not already done)
git init

# Add all files
git add .

# Commit
git commit -m "FITQUEST - Production Ready for Vercel"

# Add remote repository
git remote add origin https://github.com/YOUR_USERNAME/FITQUEST.git

# Push to GitHub
git push -u origin main
```

## Step 6: Deploy to Vercel

### Option A: Via Vercel CLI

```bash
npm install -g vercel
vercel login
vercel
```

Follow the prompts to deploy.

### Option B: Via Vercel Dashboard

1. Go to [vercel.com](https://vercel.com)
2. Click "New Project"
3. Select "Import Git Repository"
4. Choose your FITQUEST repository
5. Click "Import"

## Step 7: Configure Environment Variables on Vercel

In Vercel Dashboard:

1. Go to Project Settings → Environment Variables
2. Add the following variables:
   ```
   DB_HOST = your-mysql-host.com (or IP address)
   DB_USER = your-db-username
   DB_PASSWORD = your-db-password
   DB_NAME = fitquest2
   ```

## Step 8: Deploy

Click "Deploy" button

Wait 2-5 minutes for deployment to complete.

## Step 9: Verify Deployment

1. Visit your Vercel domain (e.g., fitquest-xyz.vercel.app)
2. Test homepage loads
3. Try signup: `/signup.html`
4. Try login: `/login.html`
5. Try profile form: `/user-form.html`

## Step 10: Add Database to Your MySQL Host

Make sure your MySQL database is:
- Created
- Accessible from Vercel IP addresses
- Has proper user permissions

## Troubleshooting

### "Build Failed"
- Check that `package.json` has all dependencies
- Verify no syntax errors in files
- Check vercel.json is valid JSON

### "Database Connection Failed"
- Verify DB credentials in Vercel environment variables
- Ensure MySQL host is accessible externally
- Check database user has remote access enabled

### "404 errors on page load"
- Verify `vercel.json` routing configuration
- Check files are in `/public/` folder
- Ensure paths have leading `/`

### "API endpoints not working"
- Check API functions are in `/api/` folder
- Verify function names match route names
- Check CORS headers are set

## Environment Variables Reference

### Required
- `DB_HOST` - MySQL server hostname
- `DB_USER` - MySQL username
- `DB_PASSWORD` - MySQL password
- `DB_NAME` - Database name (fitquest2)

### Optional
- `NODE_ENV` - Set to "production" for Vercel
- `SESSION_SECRET` - For session management

## MySQL Setup for Vercel

### Option 1: External MySQL (Recommended)
- Use AWS RDS
- Use DigitalOcean Managed Database
- Use MySQL from your hosting provider

### Option 2: MongoDB (Alternative)
- Could be adapted to use MongoDB instead
- Easier to set up with Vercel

### Get MySQL Database

Popular Options:
- **AWS RDS**: https://aws.amazon.com
- **DigitalOcean**: https://digitalocean.com
- **Aiven**: https://aiven.io
- **Linode**: https://linode.com

## After Deployment

### Recommended Next Steps

1. **Add Custom Domain**
   - Vercel Settings → Domains
   - Add your custom domain

2. **Set Up HTTPS**
   - Automatic with Vercel
   - Provided free by Let's Encrypt

3. **Configure Email**
   - For signup confirmations
   - For password resets

4. **Add Analytics**
   - Vercel Web Analytics
   - Google Analytics

5. **Set Up Monitoring**
   - Monitor API errors
   - Check database performance

## Example Deployment Commands

```bash
# Install dependencies
npm install

# Test locally (if you have Express server)
npm run dev

# Deploy to Vercel
vercel

# View deployment logs
vercel logs

# View environment variables
vercel env ls
```

## Support Resources

- **Vercel Docs**: https://vercel.com/docs
- **MySQL Docs**: https://dev.mysql.com/doc/
- **Node.js Docs**: https://nodejs.org/docs/
- **bcryptjs**: https://github.com/dcodeIO/bcrypt.js

## Project Status: ✅ READY FOR DEPLOYMENT

All files have been fixed and organized. The project is production-ready!

---

Need Help? Check the DEPLOYMENT_CHECKLIST.md file for detailed verification steps.
