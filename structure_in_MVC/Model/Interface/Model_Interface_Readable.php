<?php

namespace projet4\Blog\Model;

//pour lire /récupérer item :
interface Readable
{
    public function readItems();
    public function readById($var);//readById
}
