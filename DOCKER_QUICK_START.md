# 🚀 FreeCAD Website - Docker Quick Reference

## Start Development

```bash
docker compose up -d --build
```

**Access:** http://localhost

---

## Common Commands

| Command | Description |
|---------|-------------|
| `docker compose up -d` | Start containers in background |
| `docker compose down` | Stop and remove containers |
| `docker compose ps` | List running containers |
| `docker compose logs -f` | Follow container logs |
| `docker compose restart web` | Restart web container |
| `docker compose exec web bash` | Access container shell |

---

## Troubleshooting

### ❌ HTTPS Redirect Loop

**Problem:** Site keeps redirecting to HTTPS

**Solution:** Verify APP_ENV is set to development
```bash
docker compose exec web printenv | grep APP_ENV
# Should show: APP_ENV=development
```

If not set, rebuild:
```bash
docker compose down
docker compose up -d --build
```

---

### ❌ Port 80 Already in Use

**Problem:** Error binding port 80

**Solution 1:** Stop conflicting service
```bash
# macOS/Linux - find what's using port 80
lsof -i :80

# Stop it
sudo kill -9 <PID>
```

**Solution 2:** Use different port

Edit `compose.yml`:
```yaml
ports:
  - "8080:80"
```

Access: http://localhost:8080

---

### ❌ Changes Not Appearing

**Problem:** Code changes not showing

**Solution:** 
1. Hard refresh browser: `Cmd+Shift+R` (Mac) or `Ctrl+Shift+R` (Windows/Linux)
2. Clear browser cache
3. Check file is in correct location

---

### ❌ Permission Errors

**Problem:** Can't write files

**Solution:**
```bash
# macOS/Linux
sudo chown -R $(whoami):$(whoami) .

# Or fix inside container
docker compose exec web chown -R www-data:www-data /var/www/html/public
```

---

## Environment Variables

Set in `compose.yml`:

```yaml
environment:
  - APP_ENV=development        # development | production
  - PHP_DISPLAY_ERRORS=1       # Show PHP errors
```

---

## Testing Production Mode

**Temporarily enable HTTPS redirect:**

1. Edit `compose.yml`:
   ```yaml
   environment:
     - APP_ENV=production
   ```

2. Restart:
   ```bash
   docker compose restart web
   ```

3. Test HTTPS redirect (will fail locally but you can verify it triggers)

4. Revert to `development` when done

---

## File Structure

```
/
├── index.php              # Homepage
├── header.php             # Header template
├── footer.php             # Footer template
├── css/
│   ├── freecad-colors.css # Design system colors
│   └── style.css          # Main styles
├── js/                    # JavaScript files
├── images/                # Images and assets
├── compose.yml            # Docker Compose config
├── Dockerfile             # Docker build config
└── .htaccess             # Apache rewrite rules
```

---

## Logs

### View Application Logs
```bash
docker compose logs -f web
```

### View Apache Error Logs
```bash
docker compose exec web tail -f /var/log/apache2/error.log
```

### View Apache Access Logs
```bash
docker compose exec web tail -f /var/log/apache2/access.log
```

---

## Clean Up

### Remove Containers
```bash
docker compose down
```

### Remove Everything (containers + images)
```bash
docker compose down --rmi all --volumes
```

### Rebuild from Scratch
```bash
docker compose down --rmi all
docker compose up -d --build
```

---

## Performance

### Faster Builds (macOS)
```bash
DOCKER_BUILDKIT=1 docker compose build
```

### Check Resource Usage
```bash
docker stats freecad-website
```

---

## Design System

### Color Variables (CSS)

```css
/* Brand Colors */
--fc-blue: #389BE0
--fc-red: #C34347
--fc-ink: #212529

/* Backgrounds */
--fc-bg-primary        /* Auto light/dark */
--fc-bg-secondary
--fc-bg-hero           /* Gradient */

/* Text */
--fc-text-primary      /* Auto light/dark */
--fc-text-secondary
--fc-text-on-dark
```

### Button Classes

```html
<a class="btn btn-light rounded-pill">Primary Action</a>
<a class="btn btn-outline-light rounded-pill">Secondary</a>
<a class="btn btn-primary rounded-pill">Alternative</a>
```

---

## Quick Tests

### Test Homepage
```bash
curl http://localhost
```

### Test for HTTPS Redirect (should not redirect in dev)
```bash
curl -I http://localhost
# Should show: HTTP/1.1 200 OK
# Should NOT show: 301 or 302 redirect
```

### Check PHP Version
```bash
docker compose exec web php -v
```

### Check Apache Modules
```bash
docker compose exec web apache2ctl -M
```

---

## Documentation

- 📘 [LOCAL_DEVELOPMENT.md](LOCAL_DEVELOPMENT.md) - Complete setup guide
- 🎨 [DESIGN_SYSTEM.md](DESIGN_SYSTEM.md) - Design specifications
- ⚡ [STYLE_GUIDE.md](STYLE_GUIDE.md) - Developer reference
- 🚀 [DEPLOYMENT.md](DEPLOYMENT.md) - Production deployment

---

## Need Help?

1. Check logs: `docker compose logs -f`
2. Read [LOCAL_DEVELOPMENT.md](LOCAL_DEVELOPMENT.md)
3. Check [GitHub Issues](https://github.com/FreeCAD/FreeCAD-Homepage/issues)
4. Ask on [FreeCAD Forum](https://forum.freecad.org/)

---

**🎉 Happy Coding!**
