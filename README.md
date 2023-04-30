# README - Symfony Version 6 Project

This is a Symfony version 6 project that requires a few dependencies to be installed before it can be run. Below are the requirements and instructions on how to install them correctly.

## Requirements

* Docker
* Docker Compose
* PHP version 8 or later
* Composer
* Symfony CLI

## Installation

1. Clone the project repository to your local machine.

2. Open a terminal window and navigate to the project directory.

3. Install PHP version 8 or later. You can download it from the official website: `https://www.php.net/downloads`

4. Install Composer. You can download it from the official website: `https://getcomposer.org/download/`

5. Install Symfony CLI. You can download it from the official website: `https://symfony.com/download`

6. Run the following command to build and start the project's containers:

docker-compose up --build


7. Connect to the database through a MySQL client using the credentials from the `.env` file or by running the command `docker ps` to view the container's credentials.

8. Start the Symfony server by running the command:

symfony server:start


9. Load the fruits data to the database by running the command:

php bin/console app:load-fruits


10. The server app should now be ready to use.

Note: The above instructions assume that you have already installed Docker, Docker Compose, PHP version 8 or later, Composer, and Symfony CLI. If not, please install them before proceeding.

