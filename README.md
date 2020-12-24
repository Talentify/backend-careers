### Setup

To setup the application for the first time, execute under the root of the application:

```$ make setup```

Create a test user

```$ make create-user```

After this, a user will be available for login with the data below:
```
{
    "username": "test.user", 
    "password": "123456"
}
``` 

With these two steps, you're ready to go!

### Aditional make commands

#### Start docker
```$ make start-docker```

#### Stop docker
```$ make stop-docker```

### Endpoints request examples

#### Login
```
curl --location --request POST 'localhost:8080/login' \
--header 'Content-Type: application/json' \
--data-raw '{
    "username": "test.user",
    "password": "123456"
}'
```


#### Create user
```
curl --location --request POST 'localhost:8080/users' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "test2",
    "username": "test.2",
    "password": "123456",
    "email": "test2@example.com"
}
'
```

#### Create job posting
```
curl --location --request POST 'localhost:8080/admin/jobs' \
--header 'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MDg4MjM0NjgsImV4cCI6MTYwODgyNzA2OCwicm9sZXMiOltdLCJ1c2VybmFtZSI6InJ1YmVucy5jb3JyZWRvciJ9.Cn7UKy-oUoIKaTW8aH-LCns_68SIvbNobIilHWFBiEvbPuDMY8ocVj1HY-mIDvcaSjUAD3k0Z0sP78BCQPDbtQea9mjwWEVB6zp6wAQo--oHJOW9ycAu6FTgeD1S2OH1sMmyN3rn8SfzC300or2QCyz9Ie33KAW9552CeP25A3_vj-k5Wu6SIRO2_XFd-m65RmAPJAD4t3EeQHzVtO2xxqCInY0eHPfqVPH3b558qRbzk8kXUnLaUrwcw1kA-5_JyNkJFQfaqOHSRkQFedvSikNkx8g7oQawzQ5EhySwT18UY3LKSc73-6GtLpuG7abYJSrUdM7oCG5-t0YHQlgcNwb_outzvThXpVxqqUyCip_HAANLsbBeRpaqcZm0gk3AtZp0azZFjtzOlnMnGVQCPT3g0ZCMR7_QOwI4X0l30QUAVgKvvQx9BhVnYu-7nK6230A85XvoYVcQncsuhbxm3E89HEbzD9vz6_kVFKRtGSqBwPGZbB0o9VlLmm0YDO1yNfC1I_VOFMV3ILscZm8bN_jK-jV6JvOIseGRKxuhIX272nNyyLei3hGDWtxRjpENGvUI2OG7FW7ogf-gaZmGLq8EBnVcwmM0QYhDCm78WJdvPN7uPwcj6py6SrIIAq5XV8loKG2fw-sYv8n-bpFGozshdueGn8Wd1NEaIeAHN5s' \
--header 'Content-Type: application/json' \
--header 'Cookie: sf_redirect=%7B%22token%22%3A%22f3f042%22%2C%22route%22%3A%22jobopening-create%22%2C%22method%22%3A%22POST%22%2C%22controller%22%3A%7B%22class%22%3A%22App%5C%5CInfra%5C%5CControllers%5C%5CJobOpeningController%22%2C%22method%22%3A%22create%22%2C%22file%22%3A%22%5C%2Fhome%5C%2Fapplication%5C%2Fsrc%5C%2FInfra%5C%2FControllers%5C%2FJobOpeningController.php%22%2C%22line%22%3A23%7D%2C%22status_code%22%3A201%2C%22status_text%22%3A%22Created%22%7D' \
--data-raw '{
    "title": "Teste 3",
    "description": "Lorem ipsum",
    "status": "active",
    "workplace": {
        "street": "Rua blablabla, 15",
        "postalCode": "11060-430",
        "city": "Santos",
        "country": "Brasil"
    },
    "salary": {
        "amount": 10000.00,
        "currency": "R$"
    }
}
'
```

The endpoint for job posting creation requires that you pass an `Authorization` header, with the token you receive after logging in.


#### List job postings
```
curl --location --request GET 'localhost:8080/jobs'
```

#### To test API endpoints, download collection and import to postman

Download and import postman collection [here](postman_collection.json).