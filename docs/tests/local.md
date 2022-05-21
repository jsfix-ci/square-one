# Running Tests with Local on MacOS

Local requires some special setup steps. SO sets these up for you. If you are 
using Local you will need to set some of these services manually.

Start by following all the normal steps fro getting SquareOne up and running. After
running `composer install` you can start setting up the test suite.

## Install Selenium for WebDriver tests

We use Selenium to run WebDriver tests that require JavaScript. You can install
Selenium using node globally with `npm install selenium-standalone -g`.  

Once selenium is installed you can start the server by running `selenium-standalone install && selenium-standalone start`. This will provide you the ip address and port to enter in the .env file. 

## Create tests database

Using the same mysql instance as the site, create a new database named
`tests`.

## Create `dev/tests/.env` file

1. Copy the dev/tests/.env-dist to dev/tests/.env.
1. Update `TEST_DB_NAME` and `ACCEPTANCE_DB_NAME` values to `tests`.
1. Update `TEST_DB_HOST` and `ACCEPTANCE_DB_HOST` values to `localhost:path/to/socket.sock`.
1. Update `ACCEPTANCE_DB_DNS_HOST` value to `unix_socket=path/to/socket.sock`.
1. Update `TEST_DB_USER` and `ACCEPTANCE_DB_USER` value to `root`.
1. Update `TEST_DB_PASSWORD` and `ACCEPTANCE_DB_PASS` value to `root`.
1. Update `CHROMEDRIVER_HOST` value to the value provided from the Salenium (example: 10.15.252.113).
1. Update `CHROMEDRIVER_PORT` value to the value provided from the Salenium (example: 4444).

Once the .evn file is updated you should be able to run the tests suite with the
following commands from the root of the project::

```
vendor/bin/codecept run acceptance -c dev/tests/
vendor/bin/codecept run integration -c dev/tests/
vendor/bin/codecept run unit -c dev/tests/
```

In order to run the webdriver tests you must have the selenium server running.

```
selenium-standalone start
```

Then in a different prompt run the WebDriver tests.

```
vendor/bin/codecept run webdriver -c dev/tests/
```
Finally, you need to make sure that when the tests are called we are referencing the correct database. This can be accomplished by adding the below line in your local-config.php.

```
if( ( isset( $_SERVER['HTTP_X_TEST_REQUEST'] ) && $_SERVER['HTTP_X_TEST_REQUEST'] ) || ( isset( $_SERVER['HTTP_USER_AGENT'] ) && $_SERVER['HTTP_USER_AGENT'] == 'tribe-tester' ) ) {
	define( 'DB_NAME', 'tests' );
	$table_prefix = 'tribe_';
}
```

## Table of Contents

* [Overview](/docs/tests/README.md)
* [Jest](/docs/tests/jest.md)
