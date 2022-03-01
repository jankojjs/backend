1. Git clone repo
2. Add .env file
3. Run "docker-compose up"
4. Happy hunting

docker-compose up --build -> run if something is changed in Dockerfile

docker-compose exec activetask php tasks/task.php -> run scripts

To run composer try:
docker-compose run composer require package/name

Enter bash with: 
docker-compose exec activetask bash