# PHP and MySQL Dockerized Application

This project demonstrates a PHP application connected to a MySQL database using Docker Compose. It includes a simple Docker Compose setup for development and deployment.

## Project Structure
├── Dockerfile          # Dockerfile for the PHP container
├── docker-compose.yml  # Docker Compose configuration
├── db.php              # Database connection class
├── db-dump.sql         # Initial MySQL database dump
└── README.md           # Documentation

## Prerequisites

Ensure you have the following installed on your system:
- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

## How to Run

Follow these steps to build and run the application:

### 1. Clone the Repository

```bash
git clone https://github.com/<your-username>/<repository-name>.git
cd <repository-name>

docker-compose build
docker-compose up -d
Open your browser and navigate to: http://localhost:8080
Make sure you have installed a web server on your host machine if required for additional services or configurations.
