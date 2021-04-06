# routes.php
Sistem rotalarının girileceği dosyadır. Bu dosya içerisinde internet tarayıcısının adres satırı kısmına domainden sonraki girdilerde çalışacak olan Sınıf@method belirlemesi yapılır. 
Ayrıca bu belirlemeler içerisinde dinamik olarak gönderilecek parametre isimleride :parametre_adi şeklinde gönderilir. 

#### Methodlar
##### ASWRouter::get($mask, $path, $name)
##### ASWRouter::post($mask, $path, $name)
Sayfa post methodu ile açılırsa çalışır.

- **$mask**: Adres satırına yazılması beklenen string değer.
- **$path**: Çalıştırılacak sınıf ve o sınıf içerisinde çalışması beklenen method. Kullanım: ClassAdı@method
- **$name**: Rota için belirlenecek isim. Sistemde url veya redirect fonksiyonuna girilerek adres getirilecek.

Örnekler: 
```php 
/*
    Request Method: GET
    Adres:  domain.ext/articles
    Dosya:  app/controllers/ArticleController.php
    Class:  ArticleController
    Method: index 
    Adres: url('articles');
    Yönlendirme: redirect('articles');
*/ 
ASWRouter::get('articles', 'ArticleController@index', 'articles' );

/*
    Request Method: GET
    Adres:  domain.ext/article/:id/edit Örnek: atabasch.com/article/3/edit
    Dosya:  app/controllers/ArticleController.php
    Class:  ArticleController
    Method: edit 
    Adres: url('article.edit', ['id' => 3]);
    Yönlendirme: redirect('article.edit', ['id' => 3]);
*/
ASWRouter::get('article/:id/edit', 'ArticleController@edit', 'article.edit' );

/*
    Request Method: POST
    Adres:  domain.ext/article/:id/edit Örnek: atabasch.com/article/3/edit
    Dosya:  app/controllers/ArticleController.php
    Class:  ArticleController
    Method: edit_post
    Adres: url('article.edit.post', ['id' => 3]);
    Yönlendirme: redirect('article.edit.post', ['id' => 3]);
*/
ASWRouter::post('article/:id/edit', 'ArticleController@edit_post', 'article.edit.post' );
```

# Controllers
Sistemin çalışacağı ana dosyalar buralardır. Ortak bir köprü oluşturarak sistem içerisindeki diğer varlıkları kullanarak işlemler ve  sonuçlar oluşturur.
**routes.php** dosyasında belirtilen yönlendirmeler bu dosyalar içerisinde çalışacak olan fonksiyonları belirtir.
#### Controller dosyası oluşturmak.
Makaleler için oluşturulacak örnek bir controller dosyası.  

`app/controllers/ArticleController.php`
```php
class ArticleController extends ASWController{

    // $models değişkeni bu controller dosyası içerisinde kullanılacak olan Modelleri include ettirmek için kullanılır.
    protected $models = ['Article']; 
    
    public function index(){
        // app\views\article\index.php dosyasını ekrana basar.
        $this->view('article/index'); 
    }
    
    public function edit($id){
        /*  app\views\article\edit.php dosyasını ekrana basar
            $id değerini makale_id isimli bir değişken olarak edit.php ye gönderir.    */
        $datas = [
            'makale_id' => $id
        ];
        $this->view('article/edit', $datas);
    }

}
```



# Models 
Model dosyaları veritabanı ile ilişkili olan php sınıflarıdır. 
Bir model classı oluşturulur ve bu class içerisinde veritabanında senkronize olması istenilen tablo değerleri girilir.

`app\models\Article.php`
```php
class Article extends ASWModel{

    public $table = 'articles';         // tablo adı
    public $primaryKey = 'article_id';  // articles tablosundaki birincil anahtar hücresi
    public $columns = [ 'article_id', 'article_name'];  // Bu modelin üzerinde işlem yapacağı hücreler

    // ASWModel sınıfından işlemler çalıştırmak için zorunlu
    function __construct($obj=null){
        parent::__construct($obj);
    }

}
```

Yukarıdaki belirleme yapıldıktan sonra artık controller dosyalarında $models ile model sınıfını dahil ederek sql koduna gerek kalmadan veritabanı işlemleri yapılabilir.

| Method | Açıklama |
|--------|----------|
| $article = new Article() | Yeni bir nesne oluşturur. |
| $article = new Article(int) | Gönderilen parametre ile denk gelen bir kayıt varsa döndürür. |
| $article = new Article(object) | Gönderilen objedeki değerlerle modeli doldurur. |
| $article = new Article(array) | Gönderilen dizideki değerlerle modeli doldurur. |
| $newArticle = $article->create([key=>val]) | Parametredeki dizi değeleri ile veritabanına kayıt ekler. |
| $updatedArticle = $article->update([key=>val]); | Parametredeki dizi değeleri ile model içine doldurulmuş kayıtı günceller. |
| $article = $article->save() | Kayıt yoksa içeridiki veriler kayıt oluşturur varsa update yapar. |
| $deleted = $article->delete(); | Kaydı Siler |
| $r = $article->find(id) | id si girilen kaydı getirir. |
| $r = $article->find([id1, id2, id3]) | idleri girilen kayıtları getirir. |
| $r = $article->find(sql, params) | sql ile çekilen kayıtlar getirilir |
| $r = $article->findAll() | Bütün kayıtlar getirilir. |

# Views
Ekrana basılacak olan php dosyalarıdır `app\views` içerisinde bulunurlar ve controller dosyaları içindeki methodlarda 
**$this->view(filename, datas)** methodu ile çalıştırılırlar. 
- **filename**: İlk gönderilen parametre  `app\views` dizini altındaki çağırılacak php dosyasının adını alır.
- **datas**: 2. parametre zorunlu değil ve getirilen php view dosyasına gönderilecek verileri alır. 

# Fonksiyonlar

#### url($name_or_path, $params=null, $write=true)
Girilen parametrelere göre düzenlenen bir url getirir. 
- **$name_or_path**: ana domainden hemen sonra gelecek olan yol yada routes.php de tanımlanmış bir isim.
- **$params**: 1. parametrede bir routes ismi girildiye ve routerın alması geereken bir parametre varsa 2. parametrede bir dizi içerissinde key => val mantığı ile gönderilir.
- **$write**: 3. değişken false olarak girilirse ekrana basma işlemi yerine sonucu return eder.
```php
    
    // domain.ext/static/css/style.css
    url('static/css/style.css');   


    /* routes.php
     * ASWRouter::get('article/list', 'ArticleController@index', 'articles');
     */
    // domain.ext/article/list
    url('articles');                    
    
    
    /* routes.php
     * ASWRouter::get('article/:id/edit', 'ArticleController@edit', 'article.edit');
     */
    // domain.ext/article/3/edit
    url('article.edit', ['id' => 3] );  
```


#### redirect($name_or_path='', $params = null)
url ile aynı mantıkta çalışan bir sayfa yönlendirme fonksiyonudur. 