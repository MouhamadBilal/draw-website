<?php

namespace App\Controller\Admin;

use App\Entity\Draw;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DrawCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Draw::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
