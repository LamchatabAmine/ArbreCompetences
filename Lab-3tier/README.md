# Student Information Application
A simple PHP implementation of [3-tier architecture](https://en.wikipedia.org/wiki/Multitier_architecture) OOP application.

3-tier architecture is an implementation of [Layer Architecture](https://en.wikipedia.org/wiki/Multilayered_architecture). 
The general idea behind this architecture is to separate code logic. The following layers are used most commonly in a 
3-tier architecture.

* Presentation Layer
* Business Logic Layer
* Data Access Layer

Layers only communicates with adjacent layer. For example, presentation layer communicates to business logic layer and 
business logic layer communicates with both layers presentation and data access. But Data access layer can not directly 
communicate with presentation layer.

## Configuration / Install
You need a PHP-MySql server installation to run the application. Only thing, you need to change is database configuration.
Follow the instruction below.

1. Open the file `Application/DatabaseConnection.php` in any text editor.
2. In the constructor method, change the values for `$this->dbUser`, `$this->dbPassword`, `$this->dbName`, `$this->dbHost`

There is only one table is used for the application. Create the table using the following SQL code.

```sql
CREATE TABLE `student` (
    `Id` int(11) NOT NULL auto_increment,
    `Roll` varchar(50) default NULL,
    `Name` varchar(255) default NULL,
    `Email` varchar(255) default NULL,
    `DateOfBirth` datetime default NULL,
    PRIMARY KEY  (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```

Alternatively, you can also run the SQL script file named `stdinfo.sql` under the `__db` directory.

## 3rd-party Libraries Used
1. [ezSQL v2.03](https://github.com/ezSQL/ezSQL): This library gives very nice interface to interact with MySql database.
2. [Twitter Bootstrap v3.3.5](http://getbootstrap.com/): Very popular frontend framework.
3. [jQuery v1.11.3](https://jquery.com/) Most popular Javascript framework.

**Note 1:** This application can be used for educational purpose.<br>
**Note 2:** To avoid complexity, validation is kept to a minimum level and security check for 
[SQL Injection](https://en.wikipedia.org/wiki/SQL_injection) is not implemented.