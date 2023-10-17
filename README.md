# Exam
   - Starting time: 16 th oct 2023
   - Completed time: 17 th oct 2023

## This project includes 3 docker containers 
    1. Database > db-capricon
    2. Nginx > nginx-capricon
    3. Php > php-app-capricon

## Run the project 

   ##  Clone the project
      `git clone https://github.com/sachin56/Capricon-blog-app.git`

   ## Run command   
      `docker compose up -d`

   ## Migarete table
   1 Go to php container > docker exec -it php-app-capricon sh
   2 Migarte table > php artisan migrate
   3 Running Seeders > php artisan db:seed

   ## If you want db backup add
   please copy and pase below command database Backup is in the folder
   # Restore
   `cat backup.sql | docker exec -i db-capricon /usr/bin/mysql -u root --password=capricon#1234 capricon`

   *NOTE DATABASE WILL BE AUTOMATICLY CREATE WHEN DOCKER UP

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


   
