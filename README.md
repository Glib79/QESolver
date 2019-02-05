# QESolver

## Quadratic Equation Solver

User and password to database are committed to Github which is of course against all security rules but it is only an example project so I assumed that this is the easiest way.

Project is created in Cakephp 3.7 with Docker.
There is no vendor catalog on github so before running Cakephp needs to be installed.

## Installation guide:

1. Without docker:
You need only QESolver catalog (it is without vendor catalog so before running Cakephp needs to be installed).
db structure is in qes.sql file.
You need to change db parameters in config/app.php file.

2. With docker:

- git clone project from https://github.com/Glib79/QESolver
- docker-compose build
- docker-compose up -d
- docker exec -ti -u dev qes_php bash

There you should install Cakephp 3.7.

- exit
- docker exec -ti qes_mysql bash
- mysql -p
password is: root
run qes.sql file
- exit
- exit

### User guide:

The site with form is on /client (eg. http://localhost/client)


