# TALENTIFY

## INTRO

E ae galera, tentei mostrar um pouco do meu conhecimento com symfony.
Apliquei o DDD, e criei uma pequena pipe para a validação.
Os testes, realizei poucos, baseados nos critérios de aceite (acabei fazendo de madrugada, estou terminando agora - to virado ;D )

## INSTALL

```bash
wget https://get.symfony.com/cli/installer -O - | bash
sudo mv /root/.symfony/bin/symfony /usr/local/bin/symfony

composer install

./bin/console doctrine:database:create
./bin/console doctrine:schema:update --force
./bin/console doctrine:fixtures:load

symfony server:start
````

### TEST

```bash
./vendor/bin/phpunit
```


### ADMIN

Para acessar o admin, utilize:

user: admin
pass: talentify