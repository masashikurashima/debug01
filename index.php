<?php
header('Content-Type: text/html; charset=UTF-8');

class Animal
{
  public function bark()
  {
    echo 'Yeah, it’s barking.' . PHP_EOL;
    var_dump('----------3-----------');
  }
}
class Dog extends Animal
{
  public $name;
  public $age;
  public function __construct($name, $age=1)
  {
    $this->name = $name;
    $this->age = $age;
     var_dump('----------1-----------');  //__constructを確認
  }
}
class MechaDog extends Dog
{
  private $data;
  public function __construct($name, $age=1)
  {
    parent::__construct($name);
    $this->data = array(
      'apache' => 'apache',
      'bsd' => 'mit',
      'chef' => 'apache'
    );
    var_dump('----------2-----------');//__constructを確認
  }
  public function proc($arg)
  {
    $path = explode("/", explode(" ", $arg)[0]);
    array_shift($path);
     var_dump('----------4-----------');  //array_shiftされた$pathの中身を確認
    if( is_null($path) ) {
      $keys = array();
      while (list($key, $val) = each($this->data)) {
        array_push($keys, $key);
      }
      var_dump($keys);
    }
    else if(count($path) == 2){
      $this->data[$path[0]] = $path[1];
      echo $path[1] . PHP_EOL;
      var_dump('----------5-----------'); //else ifを通っているか確認。$pathの中身を確認。
    }
    else {
      echo $path[0] . "=>" . $this->data[$path[0]] . PHP_EOL;
      // この変数の内容が「array(0) { }」になっているが、「array(1) { [0]=> string(3) "bsd" }」になるべき
      var_dump($path); //elseを通っているか確認。$pathと$dataの中身を確認。
    }
  }
}
$mdog = new MechaDog('tom');
$mdog->bark();
echo $mdog->name . PHP_EOL;
echo $mdog->age . PHP_EOL;
$mdog->proc("GET /bsd HTTP/1.1");

// 正しい出力
// Yeah, it’s barking.
// tom
// 1
// bsd=>mit
