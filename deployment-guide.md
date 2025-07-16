# InfinityFree Deployment Guide for Vyomexa.ai™

## 🚀 Step-by-Step Deployment Instructions

### Prerequisites
- InfinityFree account (free at infinityfree.net)
- FTP client (FileZilla recommended) or use InfinityFree File Manager

### Step 1: Prepare Your Files
1. Download all files from the `public/` folder
2. Ensure you have all these files:
   ```
   index.html
   contact.php
   business-inquiry.php
   assets/css/style.css
   assets/js/script.js
   assets/js/forms.js
   .htaccess
   404.html
   500.html
   robots.txt
   sitemap.xml
   ```

### Step 2: Create InfinityFree Account
1. Go to [infinityfree.net](https://infinityfree.net)
2. Click "Create Account"
3. Choose a subdomain or use your own domain
4. Complete the registration process

### Step 3: Access File Manager
1. Login to your InfinityFree control panel
2. Click on "File Manager" or use FTP details for FileZilla
3. Navigate to the `htdocs` folder (this is your website root)

### Step 4: Upload Files
1. Upload all files maintaining the folder structure:
   ```
   htdocs/
   ├── index.html
   ├── contact.php
   ├── business-inquiry.php
   ├── assets/
   │   ├── css/style.css
   │   └── js/
   │       ├── script.js
   │       └── forms.js
   ├── .htaccess
   ├── 404.html
   ├── 500.html
   ├── robots.txt
   └── sitemap.xml
   ```

### Step 5: Configure Email Settings
1. Open `contact.php` in the file manager editor
2. Find this line: `$to = 'cosmotech09solutions@gmail.com';`
3. Replace with your email address
4. Repeat for `business-inquiry.php`

### Step 6: Update Domain References
1. Open `sitemap.xml`
2. Replace `yourdomain.com` with your actual domain
3. Update any other domain references in the files

### Step 7: Test Your Website
1. Visit your website URL
2. Test the contact form
3. Test the business inquiry modal
4. Check mobile responsiveness
5. Verify email delivery

## 🔧 Configuration Options

### Email Configuration
```php
// In contact.php and business-inquiry.php
$to = 'your-email@domain.com';  // Your email address
$headers = "From: noreply@yourdomain.com\r\n";  // Update domain
```

### Domain Configuration
```xml
<!-- In sitemap.xml -->
<loc>https://yourdomain.com/</loc>  <!-- Update to your domain -->
```

### Branding Updates
1. Replace "Vyomexa.ai™" with your brand name
2. Update contact information:
   - Phone: +91 78911 59369
   - Email: vyomexa.ai@gmail.com
3. Modify services and content as needed

## 📧 Email Setup Tips

### For InfinityFree Email
1. InfinityFree provides basic email functionality
2. Use the built-in `mail()` function (already configured)
3. Ensure your domain is properly configured

### For External Email Services
If you want to use Gmail SMTP or other services:
1. You'll need to modify the PHP files
2. Use PHPMailer library (may require premium hosting)
3. Configure SMTP settings

## 🛠️ Troubleshooting

### Common Issues

**1. Forms not working**
- Check PHP file permissions (should be 644)
- Verify email configuration
- Check error logs in control panel

**2. CSS/JS not loading**
- Verify file paths are correct
- Check .htaccess file is uploaded
- Clear browser cache

**3. Email not sending**
- Verify email address is correct
- Check spam folder
- Test with different email providers

**4. 404 errors**
- Ensure .htaccess file is uploaded
- Check file permissions
- Verify file names are correct

### File Permissions
Set these permissions:
- PHP files: 644
- HTML files: 644
- CSS/JS files: 644
- Folders: 755
- .htaccess: 644

## 🔍 SEO Optimization

### After Deployment
1. Submit sitemap to Google Search Console
2. Verify website in Google Search Console
3. Set up Google Analytics (optional)
4. Test website speed with PageSpeed Insights
5. Check mobile-friendliness with Google's Mobile-Friendly Test

### Meta Tags to Update
```html
<title>Your Business Name - AI Business Automation</title>
<meta name="description" content="Your business description">
<meta name="keywords" content="your, keywords, here">
```

## 📱 Mobile Testing

Test your website on:
- Various mobile devices
- Different screen sizes
- Touch functionality
- Form submissions
- Navigation menu

## 🚀 Going Live Checklist

- [ ] All files uploaded correctly
- [ ] Email configuration updated
- [ ] Domain references updated
- [ ] Contact forms tested
- [ ] Mobile responsiveness verified
- [ ] SEO elements configured
- [ ] Error pages working
- [ ] SSL certificate active (if available)
- [ ] Analytics setup (optional)
- [ ] Backup created

## 📞 Support

If you need help with deployment:
- InfinityFree Support: Check their knowledge base
- Template Support: vyomexa.ai@gmail.com

## 🎉 Success!

Once deployed, your website will be live at your chosen domain. The professional design and functionality will help you:
- Capture leads through contact forms
- Showcase your AI business services
- Provide excellent user experience
- Rank well in search engines

Remember to regularly backup your website and keep content updated!