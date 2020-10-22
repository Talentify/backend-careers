## Setup guide

#### Create .env from sample:

```sh
cp .env.example .env
```

#### Build and start containers

```sh
docker-compose up -d --build
```

#### Run install script

```sh
./bin/setup
```

### Run tests
```sh
./bin/tests
```

### Endpoints

#### Login

```
{POST} http://localhost:8000/api/login

User credentials: 

email: root@gmail.com
password: root
```

#### List open jobs

```
{GET} http://localhost:8000/api/jobs
```

#### Create new job

```
{POST} http://localhost:8000/api/jobs

Example request body:

{
    "title": string // required
    "description": string // required
    "status": "open" or "closed" // required
    "salary":  int
    "workplace": string
}

```

