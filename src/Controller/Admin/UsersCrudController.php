<?php

namespace App\Controller\Admin;

use App\Users\Model\Users;
use Doctrine\ORM\Mapping\Builder\FieldBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\DomCrawler\Field\ChoiceFormField;

class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Users::class;
    }

    public function configureFields(string $pageName): iterable
    {

        return [
            IdField::new('id')
                ->hideWhenCreating(),
            TextField::new('username'),
            TextField::new('password'),
            TextField::new('usertoken')
        ];
    }
}
