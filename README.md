# FFP Photography — WordPress Theme

A premium, dark-aesthetic WordPress theme built for professional photographers. Features a full portfolio showcase with lightbox, category filtering, and a complete client booking system — all without any paid plugins.

---

## Features

| Feature | Details |
|---|---|
| **Design** | Dark, editorial aesthetic — black/charcoal + gold palette |
| **Portfolio Gallery** | Custom Post Type with masonry grid, lightbox, category filter |
| **Booking System** | Full booking form, AJAX submission, admin dashboard, email notifications |
| **Pages** | Homepage, Portfolio, About, Booking, Blog, 404 |
| **Responsive** | Mobile-first, tested down to 320px |
| **Performance** | No jQuery, no bloat — vanilla JS throughout |
| **Accessibility** | ARIA labels, keyboard navigation, focus management |
| **Customizer** | Photographer name, tagline, phone, Instagram, years of experience |

---

## Requirements

- WordPress 6.0+
- PHP 8.0+
- MySQL 5.7+ / MariaDB 10.3+
- A working SMTP setup (for booking email notifications)

---

## Installation

### 1. Copy the theme

Copy the `ffp-photography` folder to your WordPress installation:

```
wp-content/themes/ffp-photography/
```

### 2. Activate

Go to **Appearance → Themes** in your WordPress admin and activate **FFP Photography**.

### 3. Flush permalinks

Go to **Settings → Permalinks** and click **Save Changes** (even without changing anything) to register the custom post type routes.

### 4. Create the required pages

Create the following pages in **Pages → Add New**, assigning each the correct template:

| Page Title | Template | Slug |
|---|---|---|
| Home | (Default / Front Page) | `home` |
| Portfolio | **Portfolio** | `portfolio` |
| About | **About** | `about` |
| Book a Session | **Booking** | `booking` |

Then go to **Settings → Reading** and set *"Your homepage displays"* to **A static page**, selecting `Home`.

### 5. Set up navigation

Go to **Appearance → Menus**, create a menu, add your pages, and assign it to **Primary Navigation**.

### 6. Add portfolio items

Go to **Portfolio → Add New** in the admin sidebar to add your photography work:
- Set a **Featured Image** (this is the photo shown in the gallery)
- Assign it to a **Portfolio Category** (Weddings, Portraits, etc.)
- The title appears as the overlay caption

### 7. Customise

Go to **Appearance → Customize → Photography Settings** to configure:
- Photographer name
- Hero tagline
- Phone number
- Instagram handle
- Years of experience

---

## Booking System

### How it works

1. A visitor fills in the booking form (homepage or `/booking` page)
2. On submission, an AJAX request sends data to WordPress
3. The booking is stored as a `ffp_booking` custom post in the database
4. An email notification is sent to the site admin
5. A confirmation email is sent to the client

### Managing bookings

Go to **Bookings** in the admin sidebar. Each booking shows:
- Client name, email, phone
- Service type & package
- Event date & location
- Status (Pending → Confirmed → Completed / Cancelled)

Update the status from the booking detail screen sidebar.

### Email setup

For emails to send reliably, install an SMTP plugin such as:
- [WP Mail SMTP](https://wordpress.org/plugins/wp-mail-smtp/) (free)
- [FluentSMTP](https://wordpress.org/plugins/fluent-smtp/) (free)

Configure it with your email provider (Gmail, SendGrid, Mailgun, etc.).

---

## Recommended Plugins

| Plugin | Purpose |
|---|---|
| [WP Mail SMTP](https://wordpress.org/plugins/wp-mail-smtp/) | Reliable email delivery for booking notifications |
| [Yoast SEO](https://wordpress.org/plugins/wordpress-seo/) | SEO meta tags & sitemap |
| [Smush](https://wordpress.org/plugins/wp-smushit/) | Image optimisation |
| [Wordfence](https://wordpress.org/plugins/wordfence/) | Security |
| [WP Super Cache](https://wordpress.org/plugins/wp-super-cache/) | Page caching / performance |

---

## Adding Your Images

### Hero background
Go to **Appearance → Customize → Header Image** and upload your hero photograph (recommended: 1920×1080px).

### About photo
Go to **Appearance → Customize → Photography Settings → About Image** *(add this setting or use a page builder block for the About page)*.

### Portfolio images
Each portfolio item's featured image is used as the gallery photo. Recommended minimum size: **1200×900px**.

### Instagram strip (footer)
The footer shows 6 placeholder tiles. To use a real Instagram feed, install a plugin like [Smash Balloon Instagram Feed](https://wordpress.org/plugins/instagram-feed/) and output it in `footer.php`.

---

## File Structure

```
ffp-photography/
├── style.css                    # Theme header (required by WordPress)
├── functions.php                # Theme setup, CPTs, AJAX, email
├── header.php                   # Site header & navigation
├── footer.php                   # Site footer, lightbox markup
├── front-page.php               # Homepage
├── page.php                     # Generic page template
├── page-portfolio.php           # Portfolio gallery (Template: Portfolio)
├── page-booking.php             # Booking page (Template: Booking)
├── page-about.php               # About page (Template: About)
├── index.php                    # Blog index
├── single.php                   # Single blog post
├── single-ffp_portfolio.php     # Single portfolio item
├── archive-ffp_portfolio.php    # Portfolio CPT archive
├── 404.php                      # Error page
├── screenshot.svg               # Theme screenshot
├── assets/
│   ├── css/
│   │   └── main.css             # All CSS (copy of style.css minus WP header)
│   ├── js/
│   │   └── main.js              # All JavaScript (vanilla, no jQuery)
│   └── images/
│       ├── hero-bg.jpg          # Hero background (add your own)
│       └── insta-{1-6}.jpg     # Instagram strip images (add your own)
└── inc/
    └── booking-meta-boxes.php   # Admin booking detail panels
```

---

## Customisation Guide

### Colours
All colours are defined as CSS custom properties in `assets/css/main.css`:

```css
:root {
    --clr-gold:     #c9a84c;  /* Primary accent */
    --clr-bg:       #0a0a0a;  /* Page background */
    --clr-text:     #c8c2b8;  /* Body text */
    /* ... etc */
}
```

### Fonts
The theme uses **Cormorant Garamond** (serif, headings) and **Montserrat** (sans-serif, body) loaded from Google Fonts. Change them in `functions.php` → `ffp_enqueue_assets()`.

### Pricing
Service prices are hardcoded in `front-page.php`. Update them to match your rates:

```php
<div class="service-price"><?php esc_html_e( 'From $2,800', 'ffp-photography' ); ?></div>
```

### Adding booking packages
Edit the `$packages` array in `page-booking.php` to add or remove packages.

---

## License

GPL v2 or later — https://www.gnu.org/licenses/gpl-2.0.html

---

## Support

For issues or questions, please open an issue in this repository or reach out via the booking form on the live site.
