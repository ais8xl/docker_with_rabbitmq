## Setup clean project
1. Build/run containers

   ```
   docker-compose up -d
   ```
2. Enter to container

   ```
   2.1 Show docker containers
   -   docker container ls
   2.2 Enter to container
   -   docker exec -it <CONTAINER ID> sh
   ```
3. Run commands for project installation:

   ```
   composer install
   ```
4. Setting up the RabbitMQ

   ```
   4.1 Structure
   -   php bin/console rabbitmq:setup-fabric
   4.2 Consumers
   -   php bin/console rabbitmq:consumer messaging
   ```