``git clone https://github.com/UagrmSI2/ERP-Server.git``

``cd to project``

``composer install``

*CREATE A FILE WITH THE NAME: .env*

*COPY ALL FROM .env.example TO .env*

*START APACHE SERVER AND MYSQL DATABASE*

*GO TO http://localhost/phpmyadmin/ IN A BROWSER*

*CREATE A DATABASE WITH THE NAME: erp-si2*

``php artisan migrate --seed``

