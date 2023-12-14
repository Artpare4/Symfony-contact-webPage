<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->hasher = $passwordHasher;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('firstname'),
            TextField::new('lastname'),
            TextField::new('email'),
            TextField::new('password')->hideOnIndex()
            ->setFormType(PasswordType::class)
            ->setRequired(false)
            ->setEmptyData('')
            ->setFormTypeOption('attr', ['autocomplete' => 'new-password']),
            ArrayField::new('roles')
            ->formatValue(function ($role) {
                if ('ROLE_ADMIN' == $role) {
                    return '<span class="material-symbols-outlined">
manage_accounts </span>';
                } else {
                    return '<span class="material-symbols-outlined">
person
</span>';
                }
            }),
        ];
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $password = $this->getContext()->getRequest()->get('User')['password'];
        $this->setUserPassword($password, $entityInstance);
        parent::updateEntity($entityManager, $entityInstance);
    }

    public function setUserPassword(mixed $password, $entityInstance): void
    {
        if (!empty($password)) {
            $hashedPassword = $this->hasher->hashPassword($entityInstance, $password);
            $entityInstance->setPassword($hashedPassword);
        }
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $password = $this->getContext()->getRequest()->get('User')['password'];
        $this->setUserPassword($password, $entityInstance);
        parent::persistEntity($entityManager, $entityInstance);
    }
}
