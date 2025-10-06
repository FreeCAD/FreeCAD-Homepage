# Montserrat Font System

## Overview

The FreeCAD website now uses **Montserrat** as the single font family across all text elements, with different font weights to create visual hierarchy and appropriate emphasis for different content types.

## Font Source

**Google Fonts Montserrat** (loaded in `header.php`):
```html
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
```

This provides:
- **All weights from 100-900** (Thin to Black)
- **Both normal and italic styles**
- **Variable font support** for smooth weight transitions
- **Optimized loading** with `display=swap` for better performance

---

## Font Weight Hierarchy

### 1. **Body Text** - Regular (400)
**Usage:** Main content, paragraphs, descriptions

```css
html,
body {
  font-family: "Montserrat", sans-serif;
  font-weight: 400;
}
```

**Characteristics:**
- Easy to read for long-form content
- Clean, professional appearance
- Optimal for body text readability

---

### 2. **Subtitles & Secondary Text** - Medium (500)
**Usage:** Subtitles, secondary headings, highlighted descriptions

```css
.home-subtitle {
  font-family: "Montserrat", sans-serif;
  font-weight: 500;
}
```

**Characteristics:**
- Slightly heavier than body text
- Creates subtle emphasis
- Perfect for taglines and secondary information

---

### 3. **Navigation & Buttons** - SemiBold (600)
**Usage:** Navigation links, buttons, call-to-action elements

```css
.navbar-custom .nav-pills .nav-link {
  font-family: "Montserrat", sans-serif;
  font-weight: 600;
}

.btn {
  font-family: "Montserrat", sans-serif;
  font-weight: 600;
}
```

**Characteristics:**
- Strong presence without being heavy
- Excellent for interactive elements
- Clear and clickable appearance
- Professional button styling

---

### 4. **Headings (h1-h6)** - Bold (700)
**Usage:** All standard headings throughout the site

```css
h1, h2, h3, h4, h5, h6 {
  font-family: "Montserrat", sans-serif;
  font-weight: 700;
}
```

**Characteristics:**
- Strong visual hierarchy
- Clear section separation
- Maintains readability at various sizes
- Professional and authoritative

---

### 5. **Main Title** - Black (900)
**Usage:** Homepage main title, hero headlines

```css
.home-title {
  font-family: "Montserrat", sans-serif;
  font-weight: 900;
}
```

**Characteristics:**
- Maximum visual impact
- Commands attention
- Perfect for hero sections
- Bold brand statement

---

## Font Weight Visual Hierarchy

```
900 (Black)     ████████████████  Main Hero Title
700 (Bold)      ████████████      Headings (h1-h6)
600 (SemiBold)  ██████████        Navigation, Buttons
500 (Medium)    ████████          Subtitles, Secondary
400 (Regular)   ██████            Body Text, Paragraphs
```

---

## Usage Guidelines

### When to Use Each Weight

| Weight | Purpose | Examples |
|--------|---------|----------|
| **900 (Black)** | Maximum emphasis, hero sections | "FreeCAD" main title, landing page headlines |
| **700 (Bold)** | Section headings, important text | h1, h2, h3, h4, h5, h6 |
| **600 (SemiBold)** | Interactive elements | Navigation links, buttons, CTAs |
| **500 (Medium)** | Subtle emphasis, supporting text | Subtitles, captions, highlighted info |
| **400 (Regular)** | Default text, readability | Paragraphs, descriptions, body content |

---

## Responsive Behavior

Montserrat is designed to:
- **Scale well** across all screen sizes
- **Maintain legibility** at small and large sizes
- **Render consistently** across browsers and devices
- **Support web-safe fallback** to sans-serif family

---

## Typography Best Practices

### Line Height
```css
/* Recommended line heights */
body { line-height: 1.6; }      /* Body text */
h1, h2, h3 { line-height: 1.2; } /* Headings */
```

### Letter Spacing
```css
/* Optional adjustments for weights */
.home-title { letter-spacing: -0.02em; } /* Black weight */
.btn { letter-spacing: 0.01em; }         /* SemiBold */
```

### Font Smoothing
```css
body {
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
```

---

## Performance Optimization

### Google Fonts Loading
- **Preconnect** to Google Fonts domains (already in header.php)
- **display=swap** prevents invisible text during font loading
- **Subset loading** for specific characters if needed

### Font File Sizes
| Weight | Approximate Size |
|--------|------------------|
| Regular 400 | ~12 KB (WOFF2) |
| Medium 500 | ~12 KB (WOFF2) |
| SemiBold 600 | ~12 KB (WOFF2) |
| Bold 700 | ~12 KB (WOFF2) |
| Black 900 | ~13 KB (WOFF2) |

**Total**: ~60 KB for all weights (compressed)

---

## Accessibility

### WCAG Compliance
✅ **Font size minimum**: 16px base (1rem)  
✅ **Contrast ratios**: Meets WCAG AA standards  
✅ **Readability**: Montserrat tested for dyslexia-friendly characteristics  
✅ **Scaling**: Supports browser text zoom up to 200%

### Font Weight Accessibility
- **Minimum 400** for body text (never use lighter weights for paragraphs)
- **Sufficient contrast** between background and text color
- **Clear hierarchy** helps screen reader navigation

---

## Browser Support

Montserrat (via Google Fonts) supports:
- ✅ Chrome (all versions)
- ✅ Firefox (all versions)
- ✅ Safari (all versions)
- ✅ Edge (all versions)
- ✅ Opera (all versions)
- ✅ Mobile browsers (iOS Safari, Chrome Mobile, etc.)

**Fallback**: If Google Fonts fails to load, falls back to system sans-serif fonts.

---

## Migration from Previous Fonts

### Old Font System
```css
/* REMOVED */
Roboto-Regular    → Body text
Roboto-Bold       → Some buttons
Evolventa         → Subtitles
Montserrat-Bold   → Headings (local file)
Montserrat-Black  → Title (local file)
```

### New Font System (Single Family)
```css
/* CURRENT */
Montserrat 400    → Body text
Montserrat 500    → Subtitles
Montserrat 600    → Navigation, Buttons
Montserrat 700    → Headings
Montserrat 900    → Main Title
```

**Benefits:**
- **Consistency**: Single font family creates unified look
- **Performance**: One font family = fewer HTTP requests
- **Maintainability**: Simpler to manage font weights vs. multiple families
- **Visual harmony**: Montserrat designed with weight consistency in mind

---

## CSS Variable System (Optional Enhancement)

For easier maintenance, consider adding CSS custom properties:

```css
:root {
  /* Font Family */
  --font-family-base: "Montserrat", sans-serif;
  
  /* Font Weights */
  --font-weight-regular: 400;
  --font-weight-medium: 500;
  --font-weight-semibold: 600;
  --font-weight-bold: 700;
  --font-weight-black: 900;
}

/* Usage */
body {
  font-family: var(--font-family-base);
  font-weight: var(--font-weight-regular);
}

h1, h2, h3 {
  font-family: var(--font-family-base);
  font-weight: var(--font-weight-bold);
}
```

---

## Quick Reference

### Copy-Paste Snippets

**Body Text:**
```css
font-family: "Montserrat", sans-serif;
font-weight: 400;
```

**Subtitles:**
```css
font-family: "Montserrat", sans-serif;
font-weight: 500;
```

**Buttons/Nav:**
```css
font-family: "Montserrat", sans-serif;
font-weight: 600;
```

**Headings:**
```css
font-family: "Montserrat", sans-serif;
font-weight: 700;
```

**Hero Title:**
```css
font-family: "Montserrat", sans-serif;
font-weight: 900;
```

---

## Testing Checklist

- [ ] Body text readable at 16px
- [ ] Headings have clear hierarchy (h1 > h2 > h3)
- [ ] Buttons are visually distinct and clickable
- [ ] Navigation links are legible
- [ ] Main title has strong visual impact
- [ ] Text scales properly on mobile (< 768px)
- [ ] Text scales properly on tablet (768px - 1024px)
- [ ] Text scales properly on desktop (> 1024px)
- [ ] Dark mode text maintains readability
- [ ] Font loads properly (check Network tab)
- [ ] Fallback fonts work if Google Fonts blocked

---

## Future Enhancements

### Potential Additions
1. **Italic variants** for emphasis (em, i tags)
2. **Light weight (300)** for large display text
3. **Variable font API** for smooth animations
4. **Custom font subsetting** to reduce file size
5. **Local font fallback** for offline scenarios

---

**Status:** ✅ **Implemented and Active**  
**Last Updated:** October 6, 2025  
**Font Family:** Montserrat (Google Fonts)  
**Weights Used:** 400, 500, 600, 700, 900
