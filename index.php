<?php
class Animal
{
  public function bark()
  {
    echo 'Yeah, it’s barking.' . PHP_EOL;
  }
}

class Dog extends Animal
{
  public $name;
  public $age;

  public function __construct($name, $age=1)
  {
    $this->name = $name;  var_dump('----------1-----------'); //$nameを確認
    $this->age = $age;  var_dump('----------2-----------');  //$ageを確認
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
    );  var_dump('----------3-----------');  //$dataを確認
  }

  public function proc($arg)
  {
    $path = explode("/", explode(" ", $arg)[0]);
     var_dump('----------4-----------');  //$argを確認
    array_shift($path);
    var_dump('----------5-----------');  //$pathを確認
    if( is_null($path) ) {
      $keys = array();
      while (list($key, $val) = each($this->data)) {
        array_push($keys, $key);
        var_dump('----------6-----------');  //$keyを確認
      }
      var_dump($keys);
    }
    else if(count($path) == 2){
      $this->data[$path[0]] = $path[1];
      echo $path[1] . PHP_EOL;
    }
    else {
      echo $path[0] . "=>" . $this->data[$path[0]] . PHP_EOL;
    }
  }
}

$mdog = new MechaDog('tom');
$mdog->bark();
echo $mdog->name . PHP_EOL;
echo $mdog->age . PHP_EOL;
$mdog->proc("GET /bsd HTTP/1.1");
