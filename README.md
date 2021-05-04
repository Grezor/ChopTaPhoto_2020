![choptaphoto](https://user-images.githubusercontent.com/38507456/94994391-8d138780-0597-11eb-8c38-d5d0838b9abe.png)

# Table of content: 
   * [Introduction](#Introduction)
   * [Installation](#Installation)
   * [Technologies](#Technologies)
   * [Start](#Start)
   * [Illustration](#Illustration)
   * [Api](#Api)
   * [Functionality](#Functionality)
   * [Utilisation](#Utilisation)
   * [Project status](#Project-status)
   * [Deployment](#Deployment)
   * [Contribute](#Contribute)
   * [Author](#Author)

## Introduction
As part of our schooling, we are led to make projects. This project consists of creating an e-commerce site, allowing to rent and buy photo terminals, in order to respond to events such as weddings, birthdays, integration day, trade fairs, conferences, events .....

## Installation
For the installation of the project everything is explained in the **chapters folder**, then the **installation** directory. 

## Technologies
```
HTML, CSS, JS, PHP, MYSQL
```
## Start
- On Github, go to the main page of the project
- Open a terminal, or git bash
- Replace the current working directory with the location where you want to clone it.
- Type ```git clone https://github.com/Grezor/ChopTaPhoto_2020.git ```
- Press on ```Entry```
- put the project in (wamp) in the www directory.
- open your phpmyadmin, insert the file database.sql. In the database folder of the project.
- create file **db.php** in the folder **include**
- add this code : 
```php
// file db.php
<?php 
$pdo = new PDO('mysql:dbname=choptaphoto;host=localhost', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
```
- Open your browser: **http://localhost/ChopTaPhoto2020/**

## Illustration
```
In progress
```
## API
API is an acronym for Applications Programming Interface. An API is therefore a programming interface that allows you to "plug in" to an application to exchange data. It operates on an input/output agreement, it is a distribution channel. A API is open and offered by the program owner. It is a concept and an intangible element.

[more infos](https://github.com/Grezor/Todolist/blob/master/server.js)
- all task : http://localhost:3000/api/todolists
- task n°2 : http://localhost:3000/api/todolists/2

## Functionality
- Create 
- Read
- Update
- Delete

## Use
- Creates a new task
- Update a task
- Delete a task

## Project status
✔️ - the application works correctly
## Deployment 
```
In progress
```
## Contribute
```
In progress
```

## Author
**Duplessi Geoffrey** 