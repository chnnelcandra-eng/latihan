<?php

namespace App\Http\Controllers;

class ProductController extends Controller
{
    public function products()
    {
        echo "fungsi index product";
    }

    public function detailproducts()
    {
        echo "fungsi detail product";
    }
    public function notaproducts($id, $nama)
    {
        echo $id;
        echo "<br>";
        echo $nama;
    }
}
