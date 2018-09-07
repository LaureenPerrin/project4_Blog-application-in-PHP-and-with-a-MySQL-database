<?php

namespace projet4\Model\Interfaces;

//pour lire /récupérer item :
interface Readable
{
    public function readItems();
    public function readItemsById($idItem);
    public function readById($idItem);
}
