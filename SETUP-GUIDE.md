# 🚀 Vyomexa.ai™ Setup Guide

## For Local Development (VS Code)

### Prerequisites
- Node.js (v16 or higher)
- VS Code
- Git (optional)

### Step 1: Open in VS Code
1. Download/clone this project
2. Open VS Code
3. File → Open Folder → Select the project folder
4. Open terminal in VS Code (Ctrl+` or View → Terminal)

### Step 2: Install Dependencies
```bash
npm install
```

### Step 3: Start Development Server
```bash
npm run dev
```

Your local development server will start at `http://localhost:5173`

### Step 4: Build for Production
```bash
npm run build
```

### Step 5: Build for InfinityFree
```bash
npm run build:infinityfree
```

This creates an `infinityfree-ready` folder with all files optimized for InfinityFree hosting.

## For InfinityFree Hosting

### Quick Deploy
1. Run `npm run build:infinityfree` (or use files from `public/` folder)
2. Upload all files from `infinityfree-ready/` to your InfinityFree `htdocs` folder
3. Update email addresses in `contact.php` and `business-inquiry.php`
4. Replace "yourdomain.com" in `sitemap.xml` with your actual domain

### File Structure for InfinityFree
```
htdocs/
├── index.html              # Main page
├── contact.php             # Contact form handler
├── business-inquiry.php    # Business inquiry handler
├── assets/
│   ├── css/style.css       # Styles
│   └── js/
│       ├── script.js       # Main JavaScript
│       └── forms.js        # Form handling
├── .htaccess              # Server configuration
├── 404.html               # Custom 404 page
├── 500.html               # Custom 500 page
├── robots.txt             # SEO robots file
└── sitemap.xml            # SEO sitemap
```

## 🔧 Configuration

### Email Setup
In `contact.php` and `business-inquiry.php`, update:
```php
$to = 'your-email@domain.com'; // Replace with your email
```

### Domain Setup
In `sitemap.xml`, replace:
```xml
<loc>https://yourdomain.com/</loc>
```
With your actual domain.

### Branding
- Replace "Vyomexa.ai™" with your brand name
- Update contact information (phone, email)
- Modify services and content as needed

## 📱 Features Included

✅ Responsive design (mobile-first)
✅ Contact form with PHP backend
✅ Business inquiry modal
✅ Animated background effects
✅ SEO optimized
✅ Fast loading
✅ Security headers
✅ Error pages (404, 500)
✅ Browser caching
✅ Form validation

## 🛠️ Development Commands

```bash
npm run dev          # Start development server
npm run build        # Build for production
npm run build:infinityfree  # Build for InfinityFree
npm run preview      # Preview production build
npm run lint         # Check code quality
```

## 📞 Support

- Template Support: vyomexa.ai@gmail.com
- Phone: +91 78911 59369

## 🎉 You're Ready!

Your professional AI business website is ready to deploy. The modern design and functionality will help you capture leads and showcase your services effectively.