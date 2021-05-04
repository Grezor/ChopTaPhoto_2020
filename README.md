![choptaphoto](https://user-images.githubusercontent.com/38507456/94994391-8d138780-0597-11eb-8c38-d5d0838b9abe.png)

   * [Introduction](#Introduction)
   * [Installation](#Installation)
   * [Technologies](#Technologies)
   * [Start](#Start)
   * [Illustration](#Illustration)
   * [Api](#Api)
   * [Functionality](#Functionality)
   * [Utilisation](#Utilisation)
   * [Project status](#Project-status)
   * [Contribute](#Contribute)
   * [Author](#Author)

# Information 
⚠️ Attention, the project is no longer up to date. I'm fixing the problems
## Introduction
As part of our schooling, we are led to make projects. This project consists of creating an e-commerce site, allowing to rent and buy photo terminals, in order to respond to events such as weddings, birthdays, integration day, trade fairs, conferences, events .....

## Installation
For the installation of the project everything is explained in the **chapters folder**, then the **installation** directory. 

## Technologies
```
HTML, CSS, JS
- PHP ^7.4 / 8.0
- MYSQL^
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
- Open your browser: **http://localhost:8000/**

## Illustration

## API
API is an acronym for Applications Programming Interface. An API is therefore a programming interface that allows you to "plug in" to an application to exchange data. It operates on an input/output agreement, it is a distribution channel. A API is open and offered by the program owner. It is a concept and an intangible element.

## Functionality


## Use


## Project status
❌ - the project has problems

## Contribute
It's hard. It's always hard the first time you do something. Especially when you are collaborating, making mistakes isn't a comfortable thing. We wanted to simplify the way new open-source contributors learn & contribute for the first time.

Reading articles & watching tutorials can help, but what's better than actually doing the stuff in a practice environment? This project aims at providing guidance & simplifying the way beginners make their first contribution. If you are looking to make your first contribution, follow the steps below.

## Author
**Duplessi Geoffrey** 
