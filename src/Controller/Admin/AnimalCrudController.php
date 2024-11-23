<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AnimalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Animal::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular("Animal")
            ->setEntityLabelInPlural("Animaux");
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel("Nom"),
            SlugField::new('slug')->setLabel("Slug")->setTargetFieldName("name"),
            NumberField::new('age', 'Age'),
            AssociationField::new('type', "Type associé"),
            AssociationField::new('race', "Race associé"),
            TextEditorField::new('description'),
            NumberField::new('price', 'Prix HT'),
            ChoiceField::new('tva', "TVA")->setChoices([
                '5,5%' => '5.5',
                '10%' => '10',
                '20%' => '20'
            ]),
            ImageField::new('images', "Images")->setUploadDir("/public/uploads/images")

        ];
    }
}
