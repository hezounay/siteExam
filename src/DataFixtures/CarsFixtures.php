<?php

namespace App\DataFixtures;

use Faker\Factory; 
use App\Entity\Gallery;
use App\Entity\Occasions;
use Faker\Provider\Image;
use Cocur\Slugify\Slugify;
use App\DataFixtures\CarsFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class CarsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Factory::create('Fr-fr');
        $slugify = new Slugify();



        for ($i=1; $i<=16  ; $i++) {

            $cars = new Occasions();
            $chMod= mt_rand(0,8);
            $chTransmi = mt_rand(0,1);
            $chCarbu = mt_rand(0,1);
            $transmi = ['manuelle','automatique'];
            $carbu = ['essence','diesel'];
            $carburant= $carbu[$chCarbu];
            $transmission= $transmi[$chTransmi];
            $modele = ['488 italia','f430','f360 modena','458','550 Maranello','328 GTS European Version','California','F355','612'];
            $modeleImg = ['https://pictures.dealer.com/f/ferrariofsanfrancisco/0594/cf672048f7ff966aad8ace7d6f93f53dx.jpg?impolicy=resize&w=414','https://photos.motorcar.com/used-2007-ferrari-f430--8431-17454076-1-640.jpg','https://cdn.bringatrailer.com/wp-content/uploads/2018/03/1520609046f66e7dff9f98764daDSC_3079-940x629.jpg','https://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/userdata/1/18976/3FAdVwEMPE/60543072-1.jpg','https://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/autoscout/387893901/060c96f1-4408-4b71-8530-57a10263afa6_01.jpg','https://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/autoscout/387966208/33a561b3-ad52-4d6d-ab52-4ecb0b4ca4f7_01.jpg','https://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/autoscout/380599327/fa5b1fb7-d729-4f07-9efc-87ee99d3c4b4_01.jpg','https://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/autoscout/378822625/253ae504-aa2f-462e-aa1d-44865c55c1e8_01.jpg','https://res.cloudinary.com/gocar/image/upload//f_auto,q_auto/uimages/autoscout/377021550/798d543f-d6ef-4ac0-b5f6-f09e36cb9c7f_01.jpg'];
            
            $coverImage = $modeleImg[$chMod];
            $descri = '<p>' . join('</p><p>',$faker->paragraphs(5)).'</p>';
            $options = $faker->paragraph(2);
          
    
            


            $cars->setMarque('Ferrari')
            
                 ->setModele($modele[$chMod])
                 ->setKm(mt_rand(550,200000))
                 ->setPrix(mt_rand(60000,200000))
                 ->setCylindree(mt_rand(1000,7000))
                 ->setPuissance(mt_rand(150,780))
                 ->setCarburant($carburant)
                 ->setAnneeCircu(mt_rand(1980,2019))
                 ->setTransmission($transmission)
                 ->setDescription($descri)
                 ->setOptions($options)
                 ->setNombreProprio(mt_rand(1,5))
                 ->setImgCouv($coverImage);

                 for($j=1; $j <= mt_rand(2,5) ; $j++){

                    $gallery = new Gallery();
    
                    $gallery->setUrl($faker->imageUrl())
                        ->setCaption($faker->sentence())
                        ->setOccasion($cars);
    
                    $manager->persist($gallery);
                }    
    
    
            $manager->persist($cars);


        

        }
        
         

            // $product = new Product();
            // $manager->persist($product);

        $manager->flush();
    }
}
