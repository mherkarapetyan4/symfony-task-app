## Start
```copy .example.env and rename .env```
***
### Build project
```docker-compose up -d --build```

### Run migrations

```bash 
docker exec app_fpm php /var/www/html/bin/console doctrine:migrations:migrate
```
### Install dependencies and generate users

```bash 
docker exec app_fpm composer i 
```

## Usage

[POST] - http://localhost/api/v1/auth/login 

***
Doc is located in ``swagger.json`` or ``openapi.yaml``

> **Note**:
> ##### usernames 
> user_1, user_2, user_3
> ***
> ##### password is "password"
 

 

 
