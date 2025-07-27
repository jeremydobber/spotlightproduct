<?php
/**
 * Copyright since 2025 Jeremy Dobberman
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade to newer
 * versions in the future. If you wish to customize it for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    Jeremy Dobberman <yellowyankee@proton.me>
 * @copyright Since 2025 Jeremy Dobberman
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */
declare(strict_types=1);

namespace PrestaShop\Module\Ek_ProductSpotlight\Form;

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductspotlightFormType extends TranslatorAwareType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            /*
            ->add('product', CollectionType::class, [
                'label' => $this->trans('Product', 'Modules.Ek_ProductSpotlight.Admin'),
                'help' => $this->trans('Select the product you want to display.', 'Modules.Ek_ProductSpotlight.Admin'),
                'entry_type' => ProductType::class,
                'entry_options' => [],
                'required' => true,
            ])
            */
            ->add('query', TextType::class, [
                'label' => $this->trans('Product name', 'Modules.Ek_ProductSpotlight.Admin'),
                'help' => $this->trans('Start a query with the product title.', 'Modules.Ek_ProductSpotlight.Admin'),
                'required' => true,
            ]);

        /*
        $formModifier = function (FormInterface $form, ?array $query = null): void {
            $product = null === $query ? [] : $query;

            $form->add('product', EntityType::class, [
                'class' => Product::class,
                'placeholder' => '',
                'choices' => $product,
            ]);
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier): void {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();

                $formModifier($event->getForm(), $data);
            }
        );

        $builder->get('query')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier): void {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $query = $event->getForm()->getData();

                $queryresult = Product::searchByName(Context::getContent()->language->id, $query);

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback function!
                $formModifier($event->getForm()->getParent(), $queryresult);
            }
        );
        */
    }
}
