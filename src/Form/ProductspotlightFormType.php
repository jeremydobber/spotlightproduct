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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductspotlightFormType extends TranslatorAwareType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $product_list = [];
        $products = \Product::getNewProducts((int)$this->getTranslator()->getLocale());

        foreach ($products as $product) {
            $product_name = \Product::getProductName($product['id_product']);
            $product_list[$product_name] = $product['id_product'];
        }

        $builder
            ->add('product', ChoiceType::class, [
                'label' => $this->trans('Product', 'Modules.Productspotlight.Admin'),
                'help' => $this->trans('Select the product you want to display.', 'Modules.Productspotlight.Admin'),
                'choices' => $product_list,
                'required' => true,
            ]);
    }
}
