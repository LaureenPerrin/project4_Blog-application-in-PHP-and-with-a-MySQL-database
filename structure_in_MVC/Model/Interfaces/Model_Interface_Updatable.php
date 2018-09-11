<?php

namespace projet4\Model\Interfaces;

//pour modifier item :
interface Updatable
{
    public function updateItemByIds($ContentItem, $idItem);
    public function updateItemById($idItem);
    public function updateItemByDataGet($idItem);
    public function updateItemByDataPost($titleItem, $ContentItem, $idItem);
}
