#**cutter_urls**


**requirements: mysql, composer**

----------

**steps to start:**

1. composer install + input mysql params
2. php app/console doctrine:database:create
3. php app/console doctrine:migrations:migrate
4. php app/console server:run

----------

**customs commands:**
* ***url:compress*** : this command give you short link of your url-address
* ***url:remove:old*** : this command remove old urls which older then **% days**[^stackedit]


----------

You can use **cron** for auto-removing olds urls.
Like this `0 0 * * * {your_php_path} {path_to_project}/cutter_urls/app/console url:remove:old`


----------


A Symfony project created on July 22, 2017, 1:57 pm.

[^stackedit]: you can change your  **% days** here `cutter_urls/app/config/parameters.yml`
