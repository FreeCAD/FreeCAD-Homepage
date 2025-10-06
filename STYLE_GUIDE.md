# FreeCAD Website - Quick Style Guide

## Quick Reference for Developers

### Color Variables

Use CSS custom properties instead of hardcoded hex values:

```css
/* ✅ Good */
color: var(--fc-blue);
background: var(--fc-bg-primary);

/* ❌ Avoid */
color: #389BE0;
background: #ffffff;
```

### Common Color Variables

```css
--fc-blue          /* #389BE0 - Primary brand blue */
--fc-ink           /* #212529 - Primary text */
--fc-red           /* #C34347 - Brand accent */
--fc-red-bright    /* #FF595E - Hover/highlight */

/* Backgrounds */
--fc-bg-primary    /* White in light mode, dark in dark mode */
--fc-bg-secondary  /* N050 in light mode, N700 in dark mode */
--fc-bg-hero       /* Gradient background */

/* Text */
--fc-text-primary  /* Main text color (auto-adjusts) */
--fc-text-secondary /* Secondary text */
--fc-text-on-dark  /* White text on dark backgrounds */

/* Neutrals */
--fc-n050 to --fc-n900  /* Neutral ramp */
```

### Button Classes

```html
<!-- Primary action button (blue background) -->
<a class="btn btn-primary rounded-pill" href="#">Action</a>

<!-- Light button (white background on dark) -->
<a class="btn btn-light rounded-pill" href="#">Download</a>

<!-- Outline button (transparent with border) -->
<a class="btn btn-outline-light rounded-pill" href="#">Learn More</a>
```

### Section Layouts

```html
<!-- Section with white card background -->
<section class="row section d-flex align-items-center justify-content-around rounded">
  <div class="col-lg-7 rounded model-backround p-2">
    <img class="img-fluid" src="..." alt="..."/>
  </div>
  
  <div class="col-lg-4 text-backround">
    <h3 class="section-title mt-3">Title</h3>
    <p class="section-body">Content...</p>
  </div>
</section>
```

### Utility Classes

```html
<!-- Backgrounds -->
<div class="bg-gradient-hero">Gradient background</div>
<div class="bg-primary">Auto-switching background</div>

<!-- Text colors -->
<p class="text-primary-theme">Adaptive text color</p>
<p class="text-brand-blue">Brand blue text</p>
<p class="text-on-dark">White text on dark</p>

<!-- Shadows -->
<div class="shadow-md-theme">Card with shadow</div>

<!-- Borders -->
<div class="border-brand-blue">Blue border</div>
```

### Cards

```html
<!-- Standard card -->
<div class="card shadow-md-theme">
  <div class="card-body">
    <h4>Card Title</h4>
    <p>Card content...</p>
  </div>
</div>

<!-- Featured card (with blue top border) -->
<div class="card featured shadow-md-theme">
  <div class="card-body">
    <h4>Featured Card</h4>
    <p>Important content...</p>
  </div>
</div>
```

### Responsive Classes

The design automatically adapts at these breakpoints:

- **Small:** < 576px
- **Medium:** ≥ 576px
- **Large:** ≥ 992px (cards get backgrounds)
- **XL:** ≥ 1200px
- **2XL:** ≥ 1800px
- **3XL:** ≥ 2400px
- **4XL:** ≥ 3500px

### Dark Mode

Automatic via `prefers-color-scheme`. No special classes needed - all color variables auto-adjust.

### JavaScript Utilities

**Navbar scroll effect** (already implemented in index.php):
```javascript
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar-custom');
    if (window.scrollY > 100) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});
```

### Common Patterns

#### Hero Section
```html
<section class="row section-cover d-flex align-items-center">
  <div class="col-lg-8">
    <img class="img-fluid" src="images/cover-photo.avif" alt=""/>
  </div>
  <div class="col-lg-4 text-center text-lg-start">
    <h1 class="home-title text-light">Title</h1>
    <h2 class="home-subtitle text-light">Subtitle</h2>
    <a class="btn btn-light rounded-pill mt-2" href="#">CTA</a>
  </div>
</section>
```

#### Feature Section (Alternating)
```html
<!-- Image on left, text on right -->
<section class="row section d-flex align-items-center rounded">
  <div class="col-lg-7 model-backround p-2">
    <img class="img-fluid" src="..." alt=""/>
  </div>
  <div class="col-lg-4 text-backround">
    <h3 class="section-title mt-3">Feature</h3>
    <p class="section-body">Description...</p>
  </div>
</section>

<!-- Image on right, text on left (add order-lg-last to image) -->
<section class="row section d-flex align-items-center rounded">
  <div class="col-lg-7 order-lg-last model-backround p-2">
    <img class="img-fluid" src="..." alt=""/>
  </div>
  <div class="col-lg-4 text-backround">
    <h3 class="section-title mt-3">Feature</h3>
    <p class="section-body">Description...</p>
  </div>
</section>
```

### Accessibility Checklist

When adding new components:

- [ ] Use semantic HTML (nav, section, article, etc.)
- [ ] Ensure color contrast ≥ 4.5:1 for normal text
- [ ] Ensure color contrast ≥ 3:1 for large text
- [ ] Add alt text to all images
- [ ] Test with keyboard navigation
- [ ] Test in both light and dark modes
- [ ] Use ARIA labels where appropriate

### Performance Tips

1. **Images:** Use `.avif` format when possible, with `.png` fallback
2. **Icons:** Use SVG for crisp rendering at any size
3. **Fonts:** Font files are already optimized with `font-display: swap`
4. **CSS:** Color variables are already defined; reuse them
5. **JavaScript:** Minimize DOM queries; cache selectors

### Files to Edit

- **Colors/Tokens:** `/css/freecad-colors.css`
- **Styles:** `/css/style.css`
- **Legacy Wiki:** `/css/freecad.css` (wiki pages only)
- **Header:** `/header.php` (navigation)
- **Footer:** `/footer.php` (footer content)
- **Pages:** `index.php`, `features.php`, `downloads.php`, etc.

### Testing

Before committing changes:

1. Test on Chrome, Firefox, Safari
2. Test on mobile viewport (< 768px)
3. Toggle system dark mode
4. Run accessibility checker (browser DevTools)
5. Verify no console errors
6. Check page load performance

### Common Issues

**Issue:** Colors not updating  
**Fix:** Make sure you've imported `freecad-colors.css` before `style.css`

**Issue:** Dark mode not working  
**Fix:** Use CSS custom properties, not hardcoded colors

**Issue:** Buttons look wrong  
**Fix:** Use Bootstrap's `.btn` class with our custom modifiers

**Issue:** Text not readable on white cards  
**Fix:** Use `.text-backround` class for automatic color switching

### Getting Help

- Read `/DESIGN_SYSTEM.md` for comprehensive documentation
- Check existing pages for implementation examples
- Test your changes in both light and dark modes
- Verify WCAG contrast ratios
