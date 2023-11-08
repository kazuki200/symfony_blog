<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Form\PostChildType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use PhpParser\Node\Expr\FuncCall;

class PostCrudController extends AbstractCrudController
{
    private $entityManager;

public function __construct(EntityManagerInterface $entityManager)
{
    $this->entityManager = $entityManager;
}

    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $clone = Action::new('clone', 'Clone')
            ->linkToCrudAction('cloneEntity');

        return $actions
            ->add(Crud::PAGE_INDEX, $clone)
            ->add(Crud::PAGE_EDIT, $clone);
    }

    public function cloneEntity(AdminContext $context)
    {
        $entity = $context->getEntity()->getInstance();
        $clonedEntity = clone $entity; // エンティティのクローンを作成

        // 必要に応じてクローンのプロパティを変更

        $this->entityManager->persist($clonedEntity);
        $this->entityManager->flush();

        return $this->redirect($context->getReferrer());
    }

    public function configureCrud(Crud $crud): Crud
    {

        return $crud 
        ->setEntityLabelInSingular('ブログ編集')
        ->setEntityLabelInPlural('ブログ一覧');
    }

  
    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('メインコンテンツ'),
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextField::new('summary'),
            TextEditorField::new('content')
                 ->hideOnIndex(),
            ImageField::new('thumbnail')
                ->setBasePath('images/')
                ->setUploadDir('public/images/')
                ->setUploadedFileNamePattern('[name].[extension]')
                ->setRequired(false)
                ->setFormTypeOptions([
        'mapped' => true,
        'required' => false
                ]),
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
            FormField::addTab('サブコンテンツ'),
             CollectionField::new('postChildren', 'Post Children')
           ->useEntryCrudForm(PostChildCrudController::class)
           ->hideOnIndex()
           ->setLabel("記事サブ")
        
            
        ];
    }
    
}
