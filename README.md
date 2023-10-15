# Exam
   - Starting time: 15 th oct 2023
   - Completed time: 

## This project includes 3 docker containers 
    1. Database > db-capricon
    2. Nginx > nginx-capricon
    3. Php > php-app-capricon

## Run the project 

   ##  Clone the project
      `git clone `

   ## Run command   
      `docker compose up -d`

   ## Migarete table
   1 Go to php container > docker exec -it php-app-capricon sh
   2 Migarte table > php artisan migrate

   NOTE DATABASE WILL BE AUTOMATICLY CREATE WHEN DOCKER UP 

   ## Container Down command   
      `docker compose down`   
      
   ## Change the .env file database credentials 
          DB_CONNECTION=mysql
          DB_HOST=db-capricon
          DB_PORT=3306
          DB_DATABASE=capricon
          DB_USERNAME=root
          DB_PASSWORD=capricon#1234
          
   ## Once Container is getting up run the following commands 

       docker exec -it php-app-capricon sh  ----> it can go to inside container
       docker exec -it db-capricon sh  ----> it can go to inside container


   
