# Набор js и php методов для работы с адресной срокой в REST стиле.


```php
use infrajs\rest\Rest;
// pos/Kemppi/Minarc
$ans = Rest::get('pos', function($param, $query, $producer, $art) {
	$ans = array('msg' => 'ок');
	return $ans;
}); 
if ($ans) return Ans::ret($ans);
//Указывается класс, обработчик c именами для параметров. Path::encode всех параметров, массив с условиями для кэша
//Функция без встроенного кэша.
```