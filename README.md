Trial Work Application
================================
This is a trail version mady by Hongyi Chen. 

Requirements
------------
    * Docker 
    * Docker-compose


Install
------------
To create docker container at the first time just run this command under directory dev-ops

```bash
$ docker-compose up --build
```
It will create and run a container with name hongyi_apache-php7.4. Following package will be included:

    * apache
    * php7.4
    * nodeJs
    * yarn
    * symfony CLI

Usage
-----
Start docker with:
```bash
$ docker-compose up
```

Task 1
------
To access the application in your browser at the given URL <http://localhost>.


Task 2
------
To access the API under <http://localhost/api/>

Task 3
-------
To access the user page under <http://localhost/users>

Task 4
-------
To run the unit test 
