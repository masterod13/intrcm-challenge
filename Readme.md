# PHP - take home test

This is implemented in PHP 7.3 using a Docker container to run the code and Composer to install dependencies.
## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Install dependencies

Using composer install dependencies. In order to install composer please follow [this](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos) 
```
composer install --ignore-platform-reqs
```

### Run docker image
For more information how to install docker and docker-compose please use [this link](https://docs.docker.com/compose/install/)

Once installed docker and docker-compose, please run this command
```
docker-compose up
```
This will build the image and start the container.

### Run Tests
From host environment, run this command inside the project folder
```
docker-compose exec web php  ./vendor/bin/phpunit .
```

### Run the code

```
http://localhost:8090/
```

As a response in the browser you expect to see this message

```
[
  {"user_id": 4, "name": "Ian Kehoe"},
  {"user_id": 5, "name": "Nora Dempsey"},
  {"user_id": 6, "name": "Theresa Enright"},
  {"user_id": 8, "name": "Eoin Ahearn"},
  {"user_id": 11, "name": "Richard Finnegan"},
  {"user_id": 12, "name": "Christina McArdle"},
  {"user_id": 13, "name": "Olive Ahearn"},
  {"user_id": 15, "name": "Michael Ahearn"},
  {"user_id": 17, "name": "Patricia Cahill"},
  {"user_id": 23, "name": "Eoin Gallagher"},
  {"user_id": 24, "name": "Rose Enright"},
  {"user_id": 26, "name": "Stephen McArdle"},
  {"user_id": 29, "name": "Oliver Ahearn"},
  {"user_id": 30, "name": "Nick Enright"},
  {"user_id": 31, "name": "Alan Behan"},
  {"user_id": 39, "name": "Lisa Ahearn"}
]
```

