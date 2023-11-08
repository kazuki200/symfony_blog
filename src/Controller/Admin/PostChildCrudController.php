<?php

namespace App\Controller\Admin;

use App\Entity\PostChild;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostChildCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PostChild::class;
    }

    public function configureCrud(Crud $crud): Crud
{

    return $crud 
    ->setEntityLabelInSingular('ブログ編集')
    ->setEntityLabelInPlural('ブログ一覧')
    ->setPageTitle('index', '%entity_label_plural% listing');
}


    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('headline'),
            TextEditorField::new('content'),
             ImageField::new('image')
                ->setBasePath('images/')
                ->setUploadDir('public/images/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
        ];
    }
    
}
