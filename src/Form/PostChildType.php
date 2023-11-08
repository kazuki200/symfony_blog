<?php
namespace App\Form;

use App\Entity\Post;
use App\Entity\PostChild;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use FOS\CKEditorBundle\Form\Type\CKEditorType; // CKEditorのため
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType; // 画像アップロードのため
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostChildType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('headline')
            ->add('imageFile', FileType::class, [ // VichUploaderを使用する場合、フィールド名は'imageFile'になることが多い
                'required' => false,
                'label' => 'Image',
            ])
            ->add('content', TextEditorField::class) 
            ->add('post', null, [
                'data' => $options['default_post'], // デフォルトのPostを設定
            ]);
    }
    
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PostChild::class,
            'default_post' => null, // デフォルトのPostをオプションとして追加
        ]);
    }
}
