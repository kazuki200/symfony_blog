<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureActions(Actions $actions): Actions
    {
      return $actions
        ->add(Crud::PAGE_INDEX,Action::DELETE);
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextField::new('summary'),
            TextEditorField::new('content')
                 ->hideOnIndex(),
            ImageField::new('thumbnail')
                ->setBasePath('images/')
                ->setUploadDir('public/images/')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            ChoiceField::new('status')
                ->setChoices([
                    '公開' => 1,
                    '非公開' => 0,
                ])
                ->renderExpanded(true),
            DateTimeField::new('post_date')
                    ->hideOnIndex(),
            AssociationField::new('category') 
                ->setRequired(true)
                ->autocomplete()
                 ->hideOnIndex(),
            AssociationField::new('tags')
                ->setRequired(false)
                ->autocomplete()
                 ->hideOnIndex(),
        ];
    }
    
}
