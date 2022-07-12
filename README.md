# Introduction

This is a simple PHP app with a ready to run "sql injection". It simply generates a database called `users`
with a list of users.

## How to run this project

Simply run the following commands:

```bash
# This will run the web interface and the adminer (formerly phpmyadmin)
docker-compose up -d web adminer
```

Now create the database table with all of the users by accessing the URL:

http://localhost/create_db_users.php

Check that all of the users were created:

http://localhost/list_users.php

And now you can open up the main page with a simple form to allow you to search for users:

http://localhost
