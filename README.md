# oonio-crm

# NGINX CONF
```bash
server {
    listen 80;
    server_name crm.sitename.ext
    root "/var/www/crm";

    index index.html index.htm index.php;

    location / {
        # index.php?q=xyz yi düzenlemek için
		if (!-e $request_filename){
			rewrite ^(.+)$ /index.php?q=$1;
		}

        try_files $uri $uri/ /index.php$is_args$args;
		autoindex on;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass php_upstream;		
        #fastcgi_pass unix:/run/php/php7.0-fpm.sock;
    }


    charset utf-8;

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
    location ~ /\.ht {
        deny all;
    }
}

```


## system/Router.php

| Kod | Kullanım |
| --- | -------- |
| Router::get('adres', 'Controller@method', 'name') |  |
| Router::post('adres', 'Controller@method', 'name') |  |
| Router::currentRequest() |  |
| Router::currentUrl(justRoot) | par true gelirse sadece a/b/c şeklinde verir. |
| Router::url(name) |  |
|  |  |
|  |  |
|  |  |
|  |  |
|  |  |

## system/View.php

#### Değişkenler
|   |   |
|---|---|
| $pathRoot | Görünüm dosyalarının bulunduğu dizin yolu |
| $includeBeforeView | Controller methodunda dahil edilen görünüm dosyasından önce dahil edilecek görünüm dosyaları |
| $includeAfterView | Controller methodunda dahil edilen görünüm dosyasından sonra dahil edilecek görünüm dosyaları |
|  |  |
|  |  |


#### Methodlar

##### include($path|string, $datas|array=[], $allowBeforeInc|boolean=true, $allowAfterInc|boolean=true)
Controller methodunda en son kullanılacak ve ekrana bir görünüm dosyası basacak olan fonksiyondur.  
.php dosyalarıdır ve php yazmak mecbur değildir.


---
## system/Controller.php

```php
class ProductController extends ASWController{

    public function index(){
        $this->render('index'); // app/views/index.php
    }

}
```

#### Methodlar

##### view($path|string, $datas|array=[])
system/View.php içerisindeki **include** methodunu çağırır.






## Models
```php
class Porduct extends ASWModel{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $columns = ['id', 'title', 'name', 'description', 'price']';
}
```
