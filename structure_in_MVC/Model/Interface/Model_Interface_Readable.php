<?php

namespace projet4\Model\Interfaces;

//pour lire /récupérer item :
interface Readable
{
    public function readItems();
    public function readItemByGetPost($postName, $postPassword);
    public function readItemsById($idItem);
    public function readById($idItem);
}
