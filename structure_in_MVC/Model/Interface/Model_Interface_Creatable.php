<?php

namespace projet4\Blog\Model;

//créer/ajouter item :
interface Creatable
{
    public function createItemsByIds($idMainItem, $authorSecondaryItem, $contentSecondaryItem);
}
