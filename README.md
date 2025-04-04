# Modern PHP Development Environment with Docker

A comprehensive Docker-based development environment for modern PHP applications, featuring a complete stack with MySQL, Redis, RabbitMQ, and Nginx. This project aims to provide a consistent, reproducible development environment that closely mirrors production.

## 🎯 Project Goals

- Provide a consistent development environment across team members
- Simplify onboarding for new developers
- Ensure development-production parity
- Enable easy testing and debugging
- Support modern PHP development practices

## 🚀 Getting Started

### Prerequisites

- [Docker](https://www.docker.com/get-started) and Docker Compose installed
- Git (optional, for cloning the repository)

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/PortilloDev/opentrackerapi.git
   cd opentrackerapi
   ```

2. Configure environment variables:
   ```bash
   cp .env.example .env
   ```
   Edit the `.env` file to adjust database credentials and other settings.

3. Build and start the containers:
   ```bash
   docker-compose up -d
   ```

4. Install PHP dependencies:
   ```bash
   docker-compose exec app composer install
   ```

5. Set up the application:
   ```bash
   docker-compose exec app php artisan key:generate
   docker-compose exec app php artisan migrate
   ```

6. For frontend assets (if using Tailwind CSS):
   ```bash
   docker-compose exec node npm install
   docker-compose exec node npm run dev
   ```

7. Access your application at [http://localhost:8022](http://localhost:8022)

## 🛠️ Technologies

This development environment includes:

### Backend
- **PHP 8.2**: With essential extensions:
  - intl, zip, apcu, opcache
  - pcov (for code coverage)
  - pdo, pdo_mysql (for database connectivity)
  - amqp (for messaging)
  - redis (for caching)
  - xdebug (for debugging)
  - gd (for image processing)

- **MySQL 8.0**: Relational database management system
- **Redis 7.0.10**: In-memory data structure store for caching
- **RabbitMQ 3**: Message broker for asynchronous communication
- **Nginx**: High-performance web server

### Frontend
- **Node.js**: For asset compilation with Tailwind CSS

### Development Tools
- **Composer**: PHP dependency manager
- **Xdebug**: For debugging and code coverage analysis

## 📁 Project Structure

```
project/
├── docker/                  # Docker configurations
│   ├── nginx/               # Nginx configuration
│   │   ├── default.conf     # Web server configuration
│   │   └── Dockerfile       # Nginx image
│   ├── php/                 # PHP configuration
│   │   └── Dockerfile       # PHP image with extensions
│   └── node/                # Node.js configuration
│       └── Dockerfile       # Image for Tailwind CSS
├── docker-compose.yml       # Service definitions
├── .env                     # Environment variables
└── README.md                # This file
```

## 🧰 Useful Commands

### Container Management

```bash
# View logs from all containers
docker-compose logs -f

# View logs from a specific service
docker-compose logs -f app

# Restart all services
docker-compose restart

# Restart a specific service
docker-compose restart app

# Stop all containers
docker-compose down

# Stop and remove volumes (caution! data will be lost)
docker-compose down -v
```

### Working with the Application

```bash
# Run PHP commands
docker-compose exec app php -v

# Access MySQL
docker-compose exec mysql mysql -u app -p

# Run Composer commands
docker-compose exec app composer update

# Run npm commands
docker-compose exec node npm install <package>

# Run Laravel Artisan commands
docker-compose exec app php artisan migrate
```

## 🔄 Continuous Development

The environment is configured with volumes that allow real-time development. Changes to source code are immediately reflected without the need to rebuild containers.

## 🧪 Testing

To run tests inside the PHP container:

```bash
# PHPUnit
docker-compose exec app vendor/bin/phpunit

# With code coverage (PCOV is installed)
docker-compose exec app vendor/bin/phpunit --coverage-html ./coverage
```

## 📝 Additional Notes

- Xdebug is configured for development, debugging, and code coverage
- MySQL data is persisted in a Docker volume
- Nginx configuration is optimized for modern PHP applications
- Redis data is persisted with AOF (Append Only File)

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

Please make sure your code follows the project's coding standards and includes appropriate tests.

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📧 Contact

Your Name - [ivan.portillo@notasweb.me](mailto:ivan.portillo@notasweb.me)

Project Link: [https://github.com/PortilloDev/opentrackerapi.git](https://github.com/PortilloDev/opentrackerapi.git)

---

⭐️ Developed with ❤️ by [Iván Portillo](https://www.linkedin.com/in/ivan-portillo-perez/)