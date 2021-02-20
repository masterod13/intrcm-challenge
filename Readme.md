# PHP Skeleton

This is implemented in PHP 7.3 using a Docker container to run the code and Composer to install dependencies.
## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Install dependencies

Using composer install dependencies. In order to install composer please follow [this](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos) 
```
composer install --ignore-platform-reqss
```

### Run docker image
For more information how to install docker and docker-compose please use [this link](https://docs.docker.com/compose/install/)

Once installed docker and docker-compose, please run this command
```
docker-compose up
```
This will build the image and start the container.

### Test the code

```
http://localhost:8090/
```

As a response in the browser you expect to see this message

```
{
    message: "Results match! Congratulations!"
}
```
