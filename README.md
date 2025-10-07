# FreeCAD Homepage

This repository contains the files of the homepage at http://www.freecad.org.


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

## Design System

The website uses a modern color system based on the FreeCAD logo manual:

- **Primary Blue:** `#389BE0`
- **Accent Red:** `#C34347`
- **Facet Gradient Background:** Deep Blue → Brand Blue → Soft Teal
- **Automatic Dark Mode:** Respects system preferences
- **Accessible:** WCAG AA+ compliant


## Translation

The page can be translated on [Crowdin](https://crowdin.com/project/freecad). Follow the "Translate" link on the homepage to contribute.


## License

See [LICENSE](LICENSE) file for details.

