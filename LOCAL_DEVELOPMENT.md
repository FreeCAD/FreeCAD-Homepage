# Local Development Guide - FreeCAD Website

## Quick Start

Get the FreeCAD website running locally in minutes using Docker.

### Prerequisites

- Docker Desktop installed ([Download](https://www.docker.com/products/docker-desktop))
- Docker Compose (included with Docker Desktop)
- Git (to clone the repository)

### Starting the Development Server

1. **Navigate to the project directory:**
   ```bash
   cd /path/to/FreeCAD-Homepage
   ```

2. **Build and start the Docker container:**
   ```bash
   docker compose up -d --build
   ```

3. **Access the website:**
   Open your browser and go to:
   ```
   http://localhost
   ```

4. **View logs (optional):**
   ```bash
   docker compose logs -f web
   ```

### Stopping the Server

```bash
docker compose down
```

To also remove the built image:
```bash
docker compose down --rmi local
```

---

## Configuration

### Environment Variables

The development setup uses environment variables to control behavior:

| Variable | Default | Description |
|----------|---------|-------------|
| `APP_ENV` | `development` | Set to `development` to disable HTTPS redirects |

**Location:** `compose.yml`

```yaml
environment:
  - APP_ENV=development
```

### How HTTPS Redirect is Disabled

In local development, we don't have SSL certificates, so HTTPS redirects are disabled automatically:

1. **Docker Compose** sets `APP_ENV=development`
2. **Apache** passes this to the environment
3. **.htaccess** checks the variable and skips HTTPS redirect if in development mode

**In `.htaccess`:**
```apache
# Only redirect to HTTPS in production
RewriteCond %{ENV:APP_ENV} !^development$ [NC]
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

---

## Docker Setup Details

### Container Structure

- **Base Image:** `php:8.3-apache`
- **Web Server:** Apache 2.4
- **PHP Version:** 8.3
- **Document Root:** `/var/www/html/public`
- **Port Mapping:** `80:80` (host:container)

### Installed Extensions

The Dockerfile includes these PHP extensions:
- `gd` - Image processing
- `intl` - Internationalization
- `exif` - Image metadata
- `opcache` - Performance optimization
- `pdo_mysql` - MySQL database support
- `pdo_pgsql` - PostgreSQL database support
- `mysqli` - MySQL improved extension
- `amqp` - RabbitMQ support
- `pgsql` - PostgreSQL support

### Apache Modules Enabled

- `mod_rewrite` - URL rewriting
- `mod_env` - Environment variables
- `mod_setenvif` - Conditional environment variables
- `mod_headers` - HTTP header control
- `mod_expires` - Cache control

---

## Development Workflow

### Making Changes

All files in the project directory are mounted as volumes, so changes are reflected immediately:

1. **Edit PHP files** - Changes appear instantly
2. **Edit CSS files** - Refresh browser to see changes
3. **Edit HTML/templates** - Refresh browser to see changes

**No need to rebuild** the container for code changes!

### When to Rebuild

Rebuild the container only when:

- Dockerfile is modified
- Dependencies are added/removed
- Apache configuration changes

```bash
docker compose up -d --build
```

### File Permissions

If you encounter permission issues:

```bash
# On macOS/Linux
sudo chown -R $(whoami):$(whoami) .

# Or run commands as the container user
docker compose exec web chown -R www-data:www-data /var/www/html/public
```

---

## Troubleshooting

### Container Won't Start

**Check if port 80 is already in use:**
```bash
# macOS/Linux
lsof -i :80

# Windows (PowerShell)
netstat -ano | findstr :80
```

**Solution:** Stop the conflicting service or change the port in `compose.yml`:
```yaml
ports:
  - "8080:80"  # Use port 8080 instead
```
Then access via `http://localhost:8080`

### Website Shows 404 Errors

**Check volume mount:**
```bash
docker compose exec web ls -la /var/www/html/public
```

You should see all your PHP files. If not, verify the volume mapping in `compose.yml`.

### PHP Errors Not Showing

**Enable error display** by adding to `compose.yml`:
```yaml
environment:
  - APP_ENV=development
  - PHP_DISPLAY_ERRORS=1
```

Then rebuild:
```bash
docker compose down
docker compose up -d --build
```

### .htaccess Rules Not Working

**Verify mod_rewrite is enabled:**
```bash
docker compose exec web apache2ctl -M | grep rewrite
```

Should show: `rewrite_module (shared)`

**Check Apache error logs:**
```bash
docker compose exec web tail -f /var/log/apache2/error.log
```

### Still Getting HTTPS Redirects

**Verify APP_ENV is set:**
```bash
docker compose exec web printenv | grep APP_ENV
```

Should show: `APP_ENV=development`

If not set, rebuild the container:
```bash
docker compose down
docker compose up -d --build
```

---

## Testing Different Configurations

### Test Production Mode Locally

To test HTTPS redirects without deploying:

1. **Temporarily change environment:**
   ```yaml
   environment:
     - APP_ENV=production
   ```

2. **Restart container:**
   ```bash
   docker compose restart web
   ```

3. **Access the site** - You'll get HTTPS redirects

4. **Revert to development mode** when done

### Test with Different PHP Versions

**Edit Dockerfile:**
```dockerfile
FROM php:8.2-apache  # or 8.1-apache, 8.0-apache
```

**Rebuild:**
```bash
docker compose down
docker compose up -d --build
```

---

## Accessing the Container Shell

For debugging or manual inspection:

```bash
# Access bash shell
docker compose exec web bash

# Check Apache configuration
docker compose exec web apache2ctl -t

# View running processes
docker compose exec web ps aux

# Check PHP version
docker compose exec web php -v
```

---

## Database Setup (If Needed)

If your local development needs a database, add to `compose.yml`:

```yaml
services:
  web:
    # ... existing config ...
    depends_on:
      - db
  
  db:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: rootpass
      MYSQL_DATABASE: freecad
      MYSQL_USER: freecad
      MYSQL_PASSWORD: freecad
    ports:
      - "3306:3306"
    volumes:
      - db_data:/var/lib/mysql

volumes:
  db_data:
```

---

## Performance Tips

### Speed Up Container Builds

**Use BuildKit:**
```bash
DOCKER_BUILDKIT=1 docker compose build
```

**Cache dependencies:**
The Dockerfile is already optimized to cache dependency installations.

### Optimize Volume Performance (macOS)

macOS has slower volume performance. For better speed:

1. **Use cached volumes** (already in compose.yml)
2. **Exclude node_modules if using Node:**
   ```yaml
   volumes:
     - ./:/var/www/html/public
     - /var/www/html/public/node_modules
   ```

---

## Production Deployment

### Differences from Development

In production, you should:

1. **Remove or change APP_ENV:**
   ```bash
   export APP_ENV=production
   ```

2. **Use HTTPS** with proper SSL certificates

3. **Enable caching** in Apache and PHP

4. **Use environment-specific configuration**

5. **Remove development tools** (Composer dev dependencies, etc.)

### Production Docker Deployment

For production, create a separate `docker-compose.prod.yml`:

```yaml
services:
  web:
    build: 
      context: .
      dockerfile: Dockerfile
    ports:
      - "80:80"
      - "443:443"
    volumes:
      - ./:/var/www/html/public
      - ./ssl:/etc/ssl/certs
    environment:
      - APP_ENV=production
    restart: unless-stopped
```

---

## Useful Commands Reference

```bash
# Start containers
docker compose up -d

# Stop containers
docker compose down

# View logs
docker compose logs -f

# Rebuild containers
docker compose up -d --build

# Restart a service
docker compose restart web

# Execute command in container
docker compose exec web <command>

# Check container status
docker compose ps

# View resource usage
docker stats

# Clean up everything
docker compose down --rmi all --volumes
```

---

## Getting Help

### Check Logs

Always start with logs when troubleshooting:

```bash
# Application logs
docker compose logs web

# Apache error logs
docker compose exec web tail -f /var/log/apache2/error.log

# Apache access logs
docker compose exec web tail -f /var/log/apache2/access.log
```

### Common Issues

1. **Port already in use** - Change port in compose.yml
2. **Permission denied** - Check file ownership
3. **404 errors** - Verify volume mount and document root
4. **HTTPS redirect loop** - Check APP_ENV variable
5. **Slow performance** - macOS volume performance issue

### Resources

- [Docker Documentation](https://docs.docker.com/)
- [PHP Apache Docker Image](https://hub.docker.com/_/php)
- [Apache mod_rewrite Documentation](https://httpd.apache.org/docs/current/mod/mod_rewrite.html)

---

## Next Steps

Once you have the site running locally:

1. ✅ Make your code changes
2. ✅ Test in the browser (http://localhost)
3. ✅ Check the new design system in `/DESIGN_SYSTEM.md`
4. ✅ Review the style guide in `/STYLE_GUIDE.md`
5. ✅ Test dark mode (system preference)
6. ✅ Test on mobile viewport
7. ✅ Commit your changes

---

**Happy coding! 🚀**
