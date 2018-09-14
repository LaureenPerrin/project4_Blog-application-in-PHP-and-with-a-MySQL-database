<?php
namespace projet4\model\interfaces;

//pour lire /récupérer item :
interface Readable
{
    public function readItems();
    public function readItemsById($idItem);
    public function readById($idItem);
}
