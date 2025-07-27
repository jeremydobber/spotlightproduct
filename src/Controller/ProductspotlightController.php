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

namespace PrestaShop\Module\Ek_ProductSpotlight\Controller;

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Form\FormHandlerInterface;
use PrestaShopBundle\Controller\Admin\PrestaShopAdminController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/*
use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Adapter\Presenter\Product\ProductListingPresenter;
use PrestaShop\PrestaShop\Adapter\Presenter\Product\ProductPresenterFactory;
use PrestaShop\PrestaShop\Adapter\Product\PriceFormatter;
use PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever;
use ProductAssembler;
*/

class ProductspotlightController extends PrestaShopAdminController
{
    public function index(
        Request $request,
        #[Autowire(service: 'prestashop.module.ek_productspotlight.form.productspotlight_text_form_data_handler')]
        FormHandlerInterface $textFormDataHandler
    ): Response {
        $textForm = $textFormDataHandler->getForm();
        $textForm->handleRequest($request);

        if ($textForm->isSubmitted() && $textForm->isValid()) {
            /** You can return array of errors in form handler and they can be displayed to user with flashErrors */
            $errors = $textFormDataHandler->save($textForm->getData());

            if (empty($errors)) {
                $this->addFlash('success', $this->trans('Successful update.', [], 'Admin.Notifications.Success'));
                return $this->redirectToRoute('productspotlight_conf_form');
            }

            $this->addFlashErrors($errors);
        }

        return $this->render('@Modules/ek_productspotlight/views/templates/admin/productspotlight_conf_form.html.twig', [
            'ProductspotlightForm' => $textForm->createView(),
            // 'ProductList' => $product_list,
        ]);
    }

    /*
    protected function getProducts()
    {
        $sql = new \DbQuery();

        $sql->select('*');
        $sql->from('product');

        $rawProducts = \Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        $assembler = new ProductAssembler($this->context);

        $presenterFactory = new ProductPresenterFactory($this->context);
        $presentationSettings = $presenterFactory->getPresentationSettings();
        $presenter = new ProductListingPresenter(
            new ImageRetriever(
                $this->context->link
            ),
            $this->context->link,
            new PriceFormatter(),
            new ProductColorsRetriever(),
            $this->context->getTranslator()
        );

        // Now, we can present the products for the template.
        $products_for_template = [];

        $assembleInBulk = method_exists($assembler, 'assembleProducts');
        if ($assembleInBulk) {
            $rawProducts = $assembler->assembleProducts($rawProducts);
        }
        foreach ($rawProducts as $rawProduct) {
            $products_for_template[] = $presenter->present(
                $presentationSettings,
                ($assembleInBulk ? $rawProduct : $assembler->assembleProduct($rawProduct)),
                $this->context->language
            );
        }

        return $products_for_template;
    }
    */
}
