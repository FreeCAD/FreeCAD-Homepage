# 3D CAD Grid Background Pattern

## Overview

The FreeCAD website now features an enhanced 3D CAD-style grid pattern that represents a professional design environment, similar to what users would see in CAD software.

## Visual Design

### Grid Structure

The background uses a **two-tier grid system** that mimics professional CAD software:

1. **Major Grid Lines** (100px spacing)
   - Brighter, more prominent lines
   - Opacity: 30% (light mode), 40% (dark mode)
   - Represents primary reference planes

2. **Minor Grid Lines** (20px spacing)
   - Subtle, supporting lines
   - Opacity: 15% (light mode), 20% (dark mode)
   - Provides fine-grained reference

### 3D Perspective Effect

The grid includes a subtle perspective transform to create depth:

```css
transform: perspective(1000px) rotateX(1deg);
transform-origin: center top;
```

This creates a slight 3D tilt that:
- Adds visual interest
- References 3D modeling space
- Maintains readability
- Doesn't distract from content

## Implementation

### CSS Code

```css
body::before {
  content: "";
  position: fixed;
  inset: 0;
  pointer-events: none;
  opacity: 0.12;
  background-image: 
    /* Major grid lines */
    linear-gradient(to right, rgba(255, 255, 255, 0.3) 1px, transparent 1px),
    linear-gradient(to bottom, rgba(255, 255, 255, 0.3) 1px, transparent 1px),
    /* Minor grid lines */
    linear-gradient(to right, rgba(255, 255, 255, 0.15) 1px, transparent 1px),
    linear-gradient(to bottom, rgba(255, 255, 255, 0.15) 1px, transparent 1px);
  background-size: 
    100px 100px,  /* Major grid */
    100px 100px,
    20px 20px,    /* Minor grid */
    20px 20px;
}
```

### Visibility Levels

| Mode | Overall Opacity | Major Lines | Minor Lines |
|------|----------------|-------------|-------------|
| Light | 12% | 30% | 15% |
| Dark | 15% | 40% | 20% |

## Design Rationale

### Why This Grid?

1. **CAD Software Reference**
   - Familiar to FreeCAD users
   - Professional design tool aesthetic
   - Reinforces software purpose

2. **Brand Alignment**
   - Technical, engineering-focused
   - Complements the facet gradient
   - Supports 3D modeling context

3. **Visibility Balance**
   - More visible than previous grid (6% → 12-15%)
   - Doesn't overwhelm content
   - Creates depth without distraction

4. **Performance**
   - Pure CSS (no images to load)
   - GPU-accelerated gradients
   - Fixed positioning (no repaints on scroll)

## Adjusting Visibility

To make the grid **more visible**, increase opacity:

```css
body::before {
  opacity: 0.18; /* Increase from 0.12 */
}
```

To make it **less visible**, decrease opacity:

```css
body::before {
  opacity: 0.08; /* Decrease from 0.12 */
}
```

To adjust **grid density**, change background-size:

```css
background-size: 
  150px 150px,  /* Wider major grid */
  150px 150px,
  30px 30px,    /* Wider minor grid */
  30px 30px;
```

## Dark Mode

The grid automatically adapts for dark mode with:
- Higher opacity (15% vs 12%)
- Brighter line opacity (40% vs 30% for major lines)
- Maintains the same structure

```css
@media (prefers-color-scheme: dark) {
  body::before {
    opacity: 0.15;
    background-image: 
      linear-gradient(to right, rgba(255, 255, 255, 0.4) 1px, transparent 1px),
      linear-gradient(to bottom, rgba(255, 255, 255, 0.4) 1px, transparent 1px),
      linear-gradient(to right, rgba(255, 255, 255, 0.2) 1px, transparent 1px),
      linear-gradient(to bottom, rgba(255, 255, 255, 0.2) 1px, transparent 1px);
  }
}
```

## Accessibility

### Considerations

✅ **No interference with text**
- Grid is in background layer
- Content has proper z-index stacking
- Text contrast ratios maintained

✅ **No motion issues**
- Static pattern (no animation)
- Fixed position (no parallax)
- Safe for vestibular sensitivity

✅ **Performance**
- No additional HTTP requests
- Hardware-accelerated CSS
- Minimal repaints

## Browser Support

- **Modern browsers**: Full support with perspective effect
- **Older browsers**: Graceful degradation (flat grid, no perspective)
- **No JavaScript required**: Pure CSS implementation

## Comparison with Alternatives

### Previous Grid (Subtle Blueprint)
- Opacity: 6%
- Single line weight
- Diagonal pattern
- **Too subtle** for CAD context

### Current Grid (3D CAD)
- Opacity: 12-15%
- Two-tier line weights
- Orthogonal with perspective
- **Professional CAD aesthetic**

### Future Options
If this is still too subtle, we can add:
- Isometric grid option
- Axis indicators (X/Y markers)
- Grid plane highlighting
- Dynamic grid on hover

## Usage in Other Pages

The grid is applied globally via `body::before`, so it appears on all pages automatically. To disable on specific pages:

```css
body.no-grid::before {
  display: none;
}
```

Then add class to body:
```php
<body class="no-grid">
```

## Summary

The 3D CAD grid pattern:
- ✅ More visible than before (12-15% vs 6%)
- ✅ Professional CAD software aesthetic  
- ✅ Two-tier grid system (major + minor)
- ✅ Subtle 3D perspective effect
- ✅ Automatic dark mode adaptation
- ✅ Zero performance impact
- ✅ Brand-aligned and purposeful

**Result:** A background that feels like a professional 3D design workspace while maintaining excellent readability and accessibility.
