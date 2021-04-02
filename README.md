Trial Work Application
================================
This is a trail work mady by Hongyi Chen. 

Requirements
------------
    * Docker 
    * Docker-compose


Install
------------
* Cloning the repo
```bash
$ git clone https://github.com/imbiss/SchwarzIT.git
```

* Building an image

Under directory dev-ops

```bash
$ docker-compose up --build
```
It will create and run a container with name hongyi_apache-php7.4. The image contains following components and expose port 80:

    * apache
    * php7.4
    * nodeJs
    * yarn
    * symfony 5.2.6 and CLI

Usage
-----
* To start container type:
```bash
$ docker-compose up
```

Now you can access project at http://localhost from your host system.

* To stop container:
```bash
$ docker-compose down
```

Task 1
------
To access the application in your browser at the given URL <http://localhost>


Task 2
------
To access the REST API document interface (base on API Platform) under <http://localhost/api>

To direct query with GET /api/imprint/{locale}. Example to get imprint in english :
```bash
  GET http://localhost/api/en
```


Task 3
-------
To access the user page under <http://localhost/users>

Task 4
-------
To run the unit test :

Enter the container:

```bash
 $ docker exec -it hongyi_apache-php7.4 bash
```

Switch to project directory

```bash
 # cd trialwork
```

Run PhpUnit
```bash
 # ./bin/phpunit
```

