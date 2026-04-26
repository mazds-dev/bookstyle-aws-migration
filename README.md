# BookStyle AWS Migration

BookStyle is a PHP/MySQL web application for barber shop appointment booking and grooming product sales. The original version of the application was hosted in a traditional Plesk environment. This project migrates the application to a cloud-based deployment on Amazon Web Services using Docker and Docker Compose.

The migration was completed as part of the Cloud Data Centre module. The main objective was to package the existing application into a reproducible container-based environment and deploy it on an AWS EC2 instance.

---

## Project Overview

The migrated application includes:

- Customer registration and login
- Barber service booking
- Product browsing and checkout
- Stripe sandbox payment integration
- Email notifications
- User dashboard
- Admin dashboard
- MySQL database persistence
- Docker-based deployment
- AWS EC2 hosting

---

## Cloud Migration Summary

The original application was moved from a Plesk-style hosting setup to AWS EC2.

The final cloud architecture uses:

- **AWS EC2** as the cloud virtual server
- **Ubuntu Server** as the operating system
- **Docker** for application containerisation
- **Docker Compose** for multi-container orchestration
- **Apache + PHP 8.2** for the web application container
- **MySQL 8.0** for the database container
- **phpMyAdmin** for local/admin database inspection
- **AWS Security Group** to allow HTTP traffic on port 80 and restrict SSH access
- **Stripe sandbox** for test payments
- **SMTP email service** for email notifications

---

## Architecture

The application is deployed using Docker Compose with the following services:

```text
User Browser
    |
    | HTTP
    v
AWS EC2 Instance
    |
    v
Docker Compose
    |
    |-- app container: PHP 8.2 + Apache + BookStyle
    |-- db container: MySQL 8.0
    |-- phpMyAdmin container: database inspection
    |
    |-- Docker volume: persistent MySQL data
```

External services used by the application:

```text
GitHub Repository  -> EC2 deployment source
Stripe Sandbox     -> test payment processing
SMTP Email Service -> email notifications
```

---

## Repository Contents

```text
app/                         Application controllers, models, helpers, and views
config/                      Database configuration
public/                      Public web root
public/assets/               CSS, JavaScript, images, and uploads
routes/                      Application routes
docker/apache/               Apache virtual host configuration
docker/mysql/init/           SQL seed file for database initialisation
Dockerfile                   PHP/Apache image build instructions
docker-compose.yml           Multi-container deployment configuration
.env.example                 Example environment configuration
README.md                    Project documentation
```

---

## Technologies Used

### Application

- PHP
- Custom MVC-style architecture
- Apache
- MySQL
- HTML, CSS, JavaScript
- Stripe API
- SMTP email

### Cloud / DevOps

- AWS EC2
- Ubuntu Server
- Docker
- Docker Compose
- AWS Security Groups
- GitHub

---

## Environment Variables

The real `.env` file is not committed to GitHub.

Create one from the example file:

```bash
cp .env.example .env
```

The Docker database configuration should use:

```env
DATABASE_HOST=edit_here
DATABASE_NAME=edit_here
DATABASE_USER=edit_here
DATABASE_PASS=edit_here
```

Other values such as Stripe keys and email credentials must be configured manually in `.env`.

---

## Running Locally with Docker

Clone the repository:

```bash
git clone https://github.com/mazds-dev/bookstyle-aws-migration.git
cd bookstyle-aws-migration
```

Create the environment file:

```bash
cp .env.example .env
```

Edit `.env` and configure the required database, Stripe, and email variables.

Build and start the containers:

```bash
docker compose up -d --build
```

Check running containers:

```bash
docker ps
```

Open the application:

```text
http://localhost/home
```

If running locally and port 80 is already in use, change the application port in `docker-compose.yml`, for example:

```yaml
ports:
  - "8080:80"
```

Then open:

```text
http://localhost:8080/home
```

---

## Database Initialisation

The MySQL database is initialised automatically from:

```text
docker/mysql/init/barbershop_services.sql
```

When the MySQL Docker volume is created for the first time, MySQL imports this SQL file and creates the required tables and fake demonstration data.

To recreate the database from scratch:

```bash
docker compose down -v
docker compose up -d --build
```

Warning: `docker compose down -v` removes the database volume and deletes existing container data.

---

## AWS Deployment Summary

The application was deployed on an AWS EC2 Ubuntu instance.

Main deployment steps:

```bash
sudo apt update
sudo apt install -y ca-certificates curl gnupg git
```

Docker Engine and the Docker Compose plugin were installed from the official Docker repository.

The project was then cloned onto the EC2 instance:

```bash
git clone https://github.com/mazds-dev/bookstyle-aws-migration.git
cd bookstyle-aws-migration
```

The environment file was created:

```bash
cp .env.example .env
nano .env
```

The application was started:

```bash
docker compose up -d --build
```

Deployment was verified with:

```bash
docker ps
curl -I http://localhost/home
```

The AWS Security Group was configured to allow:

```text
SSH  TCP 22  My IP
HTTP TCP 80  0.0.0.0/0
```

---

## Public Demo

The application was tested using the EC2 public IPv4 address:

```text
http://EC2_PUBLIC_IP/home
```

Note: this IP address is not an Elastic IP. It may change if the EC2 instance is stopped and started again.

---

## Validation

The following workflows were tested successfully after AWS deployment:

| Test | Result |
|---|---|
| Homepage loads from public EC2 IP | Pass |
| Static assets load correctly | Pass |
| User registration | Pass |
| User login | Pass |
| Database persistence | Pass |
| Stripe sandbox checkout | Pass |
| Email notification workflow | Pass |

---

## Security Notes

- The real `.env` file is excluded from GitHub.
- Database credentials, Stripe keys, and email credentials should not be committed.
- MySQL is not publicly exposed.
- phpMyAdmin should not be publicly exposed in the AWS Security Group.
- SSH should be restricted to the administrator's IP address.
- A production version should use HTTPS and a managed secret storage service such as AWS Secrets Manager or AWS Systems Manager Parameter Store.

---

## Limitations

This deployment is designed for an academic cloud migration demonstration. It uses a single EC2 instance and a MySQL container on the same host. It does not provide high availability, automatic database backups, HTTPS, load balancing, or managed database resilience.

---

## Future Improvements

- Move MySQL to Amazon RDS
- Add HTTPS using a domain name and AWS Certificate Manager
- Add monitoring and logging with Amazon CloudWatch
- Store secrets in AWS Secrets Manager or Systems Manager Parameter Store
- Add load balancing and horizontal scaling for the application container

---

## Author

Marvin Adorian Zanchi  
BSc (Hons) Software Development 
Cloud Data Centre College Module Project - April 2026

GitHub: https://github.com/mazds-dev
