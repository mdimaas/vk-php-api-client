[![Dependency Status](https://www.versioneye.com/user/projects/559a5faa61663400210000ef/badge.svg?style=flat)](https://www.versioneye.com/user/projects/559a5faa61663400210000ef)

VKontakte API Client for PHP
=================

##Installation


If you're usage <a href="https://getcomposer.org/">Composer</a>, which we recommend, add record in your <b>composer.json</b> file

```
{
  "require":{
    ...
    "deliciousdishes/vk-api-client": "dev-master"
    ...
  },
  "repositories":[
        ...
        {
            "type": "git",
            "url": "https://github.com/mdimaas/vk-php-api-client"
        }
        ...
  ]
  
}
```

##Example usage

For get URL by authorization in VK
```
$helper = new \DeliciousDishes\VKLoginHelper("http://yoursite.com", "your_app_id", "your_app_secret", array("email", ...,"offline"));
$url = $helper->getLoginUrl();
```

After click by link VK redirected in back with secure code in GET parameter. Now get VK session by secure code. Example: 
```
$helper = new \DeliciousDishes\VKLoginHelper("http://yoursite.com", "your_app_id", "your_app_secret", array("email", ...,"offline"));
$helper->getSession(); 
// or if your secure code saved in var
// $helper->getSession($secureCode); 
```
Session stores current user id `$session->getUserId()`
For send request in VK API. Example get user information by ids:
```
$request = new \DeliciousDishes\VKRequest($session, "users.get", array("user_ids" => $session->getUserId(),"fields" => "email,..."));
$response = $request->execute()->getResponseData();
```

Result query: mixed the value encoded in <b>json</b> in appropriate PHP type.
