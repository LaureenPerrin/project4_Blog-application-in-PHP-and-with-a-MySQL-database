<?php

namespace projet4\Model\Interfaces;

//créer/ajouter item :
interface Creatable
{
    public function createItemsByIds($idMainItem, $authorSecondaryItem, $contentSecondaryItem);
    public function createItemByDataPost($titleItem, $contentItem);
}
