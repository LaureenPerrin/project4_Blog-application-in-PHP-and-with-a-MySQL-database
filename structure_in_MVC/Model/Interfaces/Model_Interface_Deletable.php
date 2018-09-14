<?php
namespace projet4\model\interfaces;

//pour supprimer item :
interface Deletable
{
    public function deleteItemByIds($idItemSecondary, $idMainItem);
    public function deleteItemById($idMainItem);
    public function deleteItemsById($idMainItem);
}
