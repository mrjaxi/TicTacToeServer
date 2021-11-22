<?php

namespace App\Controller\Admin;

use App\GameData\Model\GameData;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GameDataCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GameData::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('matchid'),
            BooleanField::new('bot'),
            BooleanField::new('winner'),
            TextField::new('left_state'),
            TextField::new('right_state'),
            ArrayField::new('images_id'),
            TextField::new('date')
        ];
    }
}
