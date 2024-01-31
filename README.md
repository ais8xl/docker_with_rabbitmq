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
   4.1 Creating a new user, giving him full rights and deleting all others
   -   rabbitmqctl list_users | awk '{print $1}' | xargs -I {} rabbitmqctl delete_user {}
   -   rabbitmqctl add_user <new_user_name> <password>
   -   rabbitmqctl set_permissions -p '/' <user_name> '.*' '.*' '.*'
   -   rabbitmqctl set_user_tags <user_name> administrator
   4.2 Structure
   -   php bin/console rabbitmq:setup-fabric
   4.3 Consumers
   -   php bin/console rabbitmq:consumer messaging
   ```
