# Heravolution

The database is made with _MySQL_.

To work you need to add a file called _Connection.php_ in the folder sites, it must contain the following code:

```php
<?php
	session_start();
	$conn = new mysqli("server ip", "username", "password" , "database name");
?>
```

This is a database project for university.