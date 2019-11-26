<?php

namespace App\Form;



use App\Entity\Occasions;
use App\Form\AnnonceType;
use App\Form\GalleryType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class AnnonceType extends AbstractType
{
      /**
     * Permet d'avoir la configuration de base d'un champ
     *
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    private function getConfiguration($label,$placeholder,$options=[]){
        return array_merge([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
            ],$options);

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('modele',TextType::class, $this->getConfiguration('Modèle','Modèle de votre voiture'))
        ->add('marque',TextType::class, $this->getConfiguration('Marque','Ferrari'))
        ->add('cylindree',IntegerType::class, $this->getConfiguration('Cylindrée','Donnez la cylindrée en cm³'))
        ->add('puissance', IntegerType::class, $this->getConfiguration('Puissance','Donnez la puissance en chevaux'))
        ->add('carburant', TextType::class, $this->getConfiguration('Carburant','Donnez le type de carburant adéquat'))
        ->add('annee_circu', IntegerType::class, $this->getConfiguration('Année de mise en circulation','Donnez l\'année de mise en circulation de votre voiture'))
        ->add('transmission', TextType::class, $this->getConfiguration('Transmission','Donnez le type de transmission disponible'))
        ->add('description',TextareaType::class, $this->getConfiguration('Description','Donnez une description de votre voiture'))
        ->add('options', TextareaType::class, $this->getConfiguration('Options','Donnez toutes les options  de votre voiture'))
        ->add('km', IntegerType::class, $this->getConfiguration('Nombre de kilomètres','Donnez le nombre de kilomètres parcourus'))
        ->add('nombre_proprio', IntegerType::class, $this->getConfiguration('Nombre de propriétaire(s)','Donnez le nombre de propriétaires de votre voiture'))
        ->add('slug', TextType::class, $this->getConfiguration('slug','Adresse web (automatique)',[
            'required' => false
        ]))
        ->add('imgCouv', UrlType::class, $this->getConfiguration('Url de l\'image','Donnez l\'adresse de votre image'))
        ->add('prix', MoneyType::class, $this->getConfiguration('Prix','indiquez le prix que vous voulez pour vendre votre voiture'))
        ->add(
            'gallery',
            CollectionType::class,
            [
                'entry_type' => GalleryType::class,
                'allow_add' => true, // permet d'ajouter de nouveaux éléments et ajouter un data_prototype (HTML)
                'allow_delete' => true
            ]
        )
     ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Occasions::class,
        ]);
    }
}
