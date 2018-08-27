<?php

namespace projet4\Blog\Model;

//pour lire /récupérer item :
interface Readable
{
    public function readItems();
    public function readItemsById($idItem);
    public function readById($idItem);
}
