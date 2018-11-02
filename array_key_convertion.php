$x = [
  ['a', '10'],
  ['b', '20'],
  ['a', '30'],
];

foreach($x as $key => $item) {
  $z[$item[0]][] = $item;
}

echo '<pre>';
print_r($z);

// http://www.writephponline.com/
