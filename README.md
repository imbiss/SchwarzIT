Trial Work Application
================================
This is a trail work mady by Hongyi Chen. 

Requirements
------------
    * Docker 
    * Docker-compose


Install
------------
* Cloning the repo from github
```bash
$ git clone https://github.com/imbiss/SchwarzIT.git
```

* Building an image and run the container

Under directory dev-ops

```bash
$ cd dev-ops
$ docker-compose up --build
```
It will create and run 2 containers. The 2 images contain following components:

hongyi_apache-php7.4 expose port 80 and include:

    * apache
    * php7.4
    * nodeJs
    * yarn
    * symfony CLI

hongyi_mysql5.7 include:

    * MySQL 5.7
 
Task 1
------

* To start container:
```bash
$ docker-compose up
```

Now you can access project at http://localhost from your host system.

* To stop container:
```bash
$ docker-compose down
```

* To change in impressum content:

The imprint page content stores under *{projcect}/data/imprint.csv*


Task 2
------
There are 2 solutions are implemented. 

 * Simple soulution
```bash
 GET http://localhost/en/imprint.json
```

```bash
 GET http://localhost/de/imprint.json
```



 * Full solution (with API Platform)

To access the full REST API document interface under <http://localhost/api>

To get imprint in english as JSON:
```bash
  GET http://localhost/api/portals/en.json
```

To get imprint in german as JSON:
```bash
  GET http://localhost/api/portals/de.json
```


Task 3
-------
The value-object are stored unde *{project}/src/ValueObject*.

There 4 objects are created:
- User
- Address
- Geo
- Company


To access the user page under <http://localhost/users>

Task 4
-------
To run the unit test :

Enter the container from your host:

```bash
 $ docker exec -it hongyi_apache-php7.4 bash
```

Switch to project directory

```bash
 # cd trialwork
 # ./bin/phpunit
```

