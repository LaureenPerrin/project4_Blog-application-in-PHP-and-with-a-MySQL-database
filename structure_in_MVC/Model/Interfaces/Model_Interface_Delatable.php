<?php

namespace projet4\Model\Interfaces;

//pour supprimer item :
interface Delatable
{
    public function delateItemByIds($idItemSecondary, $idMainItem);
    public function delateItemById($idMainItem);
    public function delateItemsById($idMainItem);
}
