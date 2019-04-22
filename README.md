# Rest Apı With Symfony

This is a sample REST API application whic is include some posts. I cant find any 
creative name for the simple API. So I set lorem ipsum as name.

**Technologies used**
- Docker
- PHP 7
- Symfony 4.2.7
- Mysql 5.7
- Nginx 

## Installation
* Clone the repository 

  `git clone https://github.com/umutbariskarasar/lorem-ipsum-api.git`

* Up the containers
`docker-compose up`

* You should make migration in the container. First enter the container.

  `docker exec -it lorem_ipsum_api_php /bin/bash`

* Go to directory for migration
  
  ` cd /var/www/html/api`

* Make migration for creating table on DB.

  `php bin/console doctrine:migrations:migrate`


## Sending Requests
You can send POST requests to the URL below using environments like **Postman.** 

**Base URLs for local environment**

http://127.0.0.1:8181/list

http://127.0.0.1:8181/create

http://127.0.0.1:8181/update

http://127.0.0.1:8181/delete



**Reguests**

| Method | URL            | Header Key    | Header Value     |
| -------|----------------|---------------|----------------- |
| POST   | /create        | Content-Type  | application/json |
| PUT    | /update        | Content-Type  |application/json  |
| DELETE | /delete        |               |                  |
| GET    | /list          |               |                  |



**Sample Bodies**

```
{
"title": "test title",
"content": "test content",
"description": "test description",
"content": "test content",
"mail": "example@mail.com",

}

{
"id": "1",
"post_status": "approved",
}
```
## Improvement Points
* Unit Test
* Forms
* Update request should sent as PUT request. 
