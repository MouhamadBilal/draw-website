<?php

namespace App\Controller\Admin;

use App\Entity\Draw;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DrawCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Draw::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield ImageField::new('post')
                ->setUploadDir('public/uploads/draws')
                ->setBasePath('uploads/draws'),

            yield TextField::new('name'),
            yield TextareaField::new('description')
        ];


    }
}
