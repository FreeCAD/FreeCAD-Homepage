# FreeCAD Homepage

This repository contains the files of the homepage at http://www.freecad.org.

## Features

- Modern, responsive design with brand-aligned color system
- Multi-language support (translate on [Crowdin](https://crowdin.com/project/freecad))
- Built with Bootstrap, Font Awesome, and custom fonts
- Automatic dark mode support
- Accessible (WCAG AA+ compliant)

**Note:** This repository doesn't contain the webapps (forum, wiki, and tracker) used on the main site.

## Quick Start (Local Development)

### Prerequisites

- Docker Desktop ([Download](https://www.docker.com/products/docker-desktop))
- Git

### Running Locally

```bash
# Clone the repository
git clone https://github.com/FreeCAD/FreeCAD-Homepage.git
cd FreeCAD-Homepage

# Start the Docker container
docker compose up -d --build

# Access the site
open http://localhost
```

The site will be available at **http://localhost**

### Stop the Server

```bash
docker compose down
```

For detailed instructions, see [LOCAL_DEVELOPMENT.md](LOCAL_DEVELOPMENT.md)

## Design System

The website uses a modern color system based on the FreeCAD logo manual:

- **Primary Blue:** `#389BE0`
- **Accent Red:** `#C34347`
- **Facet Gradient Background:** Deep Blue → Brand Blue → Soft Teal
- **Automatic Dark Mode:** Respects system preferences
- **Accessible:** WCAG AA+ compliant

### Documentation

- [Design System Guide](DESIGN_SYSTEM.md) - Complete design specifications
- [Style Guide](STYLE_GUIDE.md) - Developer quick reference
- [Visual Changes](VISUAL_CHANGES.md) - Before/after comparison
- [Deployment Guide](DEPLOYMENT.md) - Production deployment

## Development

### File Structure

- `/css/` - Stylesheets (freecad-colors.css, style.css)
- `/js/` - JavaScript files
- `/images/` - Images and assets
- `/lang/` - Language translations
- `*.php` - Page templates

### Making Changes

All files are mounted as volumes, so changes appear immediately:

1. Edit files in your preferred editor
2. Refresh browser to see changes
3. No rebuild needed for code changes

### Adding New Styles

Use CSS custom properties from `freecad-colors.css`:

```css
/* Good - uses design tokens */
color: var(--fc-blue);
background: var(--fc-bg-primary);

/* Avoid - hardcoded values */
color: #389BE0;
background: #ffffff;
```

## Translation

The page can be translated on [Crowdin](https://crowdin.com/project/freecad). Follow the "Translate" link on the homepage to contribute.

## Contributing

Contributions are welcome! Please:

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test locally with Docker
5. Submit a pull request

See [CONTRIBUTING.md](contributing.php) for guidelines.

## License

See [LICENSE](LICENSE) file for details.

## Support

- [FreeCAD Forum](https://forum.freecad.org/)
- [GitHub Issues](https://github.com/FreeCAD/FreeCAD-Homepage/issues)
- [Design System Docs](DESIGN_SYSTEM.md)
