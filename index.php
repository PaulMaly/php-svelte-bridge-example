<?php
require 'vendor/autoload.php';

use LightnCandy\LightnCandy;

$products = [
    [ "title" => "Product 1", "price" => 25, "count" => 1 ],
    [ "title" => "Product 2", "price" => 50, "count" => 2 ],
    [ "title" => "Product 3", "price" => 100, "count" => 1 ],
    [ "title" => "Product 4", "price" => 125, "count" => 1 ],
    [ "title" => "Product 5", "price" => 150, "count" => 1 ],
];

Flight::map('handlebars', function($file, $data) {
    $template = file_get_contents(Flight::get('flight.views.path') . $file);
    $php = LightnCandy::compile($template, [
        'flags' => LightnCandy::FLAG_STRINGPARAMS,
        'helpers' => [
            'each' => function(...$args) {
                $options = array_pop($args);
                list($arr, $as, $inst, $i, $key) = $args; // items as item, i
                $inst = rtrim($inst, ',');
                $context = $options['_this'][$arr];
                foreach($context as $key => $val) {
                    unset($context[$key]);
                    $context[$key] = [ $inst => $val ];
                }
                $ret = '';
                foreach ($context as $cx) {
                    $ret .= $options['fn']($cx);
                }
                return $ret;
            }
        ]
    ]);
    $render = LightnCandy::prepare($php);
    return $render($data);
});

Flight::route('/', function() use ($products)  {

    $data = [
        "title" => "PHP + Svelte exp",
        "header" => [
            "title" => "Cart",
            "subtitle" => "Your shopping cart"
        ],
        "cart" => [
            "products" => $products,
            "total" => array_reduce($products, function ($total, $p) {
                $total += $p['price'] * $p['count'];
                return $total;
            }, 0)
        ]
    ];

    Flight::render('index', $data);
});

Flight::start();