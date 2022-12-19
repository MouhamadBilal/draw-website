<?php

namespace App\Controller\Admin;

use App\Entity\Draw;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class DrawCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Draw::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            ImageField::new ("post")
                ->setBasePath("uploads/draws")
                ->setUploadDir('public/uploads/draws')
        ];
    }



}
