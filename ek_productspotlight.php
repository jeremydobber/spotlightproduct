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

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Adapter\Presenter\Product\ProductListingPresenter;
use PrestaShop\PrestaShop\Adapter\Product\PriceFormatter;
use PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever;

class Ek_ProductSpotlight extends Module
{
    public function __construct()
    {
        $this->name = 'ek_productspotlight';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Simon Fouilleul';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '9.0.0',
            'max' => '9.99.99',
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->trans('Product spotlight', [], 'Modules.Ek_ProductSpotlight.Admin');
        $this->description = $this->trans('Present a single product in a full width section.', [], 'Modules.Ek_ProductSpotlight.Admin');

        $this->confirmUninstall = $this->trans('Are you sure you want to uninstall?', [], 'Modules.Ek_ProductSpotlight.Admin');

        if (!Configuration::get('EK_PRODUCTSPOTLIGHT_NAME')) {
            $this->warning = $this->trans('No name provided.', [], 'Modules.Ek_ProductSpotlight.Admin');
        }
    }

    public function isUsingNewTranslationSystem(): bool
    {
        return true;
    }

    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        return
            parent::install()
            && $this->registerHook('displayHome')
            && $this->registerHook('actionFrontControllerSetMedia')
            && Configuration::updateValue('EK_PRODUCTSPOTLIGHT_NAME', 'Product spotlight');
    }

    public function uninstall()
    {
        return
            parent::uninstall()
            && $this->unregisterHook('displayHome')
            && $this->unregisterHook('actionFrontControllerSetMedia')
            && Configuration::deleteByName('EK_PRODUCTSPOTLIGHT_NAME');
    }

    public function getContent()
    {
        $route = $this->get('router')->generate('productspotlight_conf_form');
        Tools::redirectAdmin($route);
    }

    public function hookDisplayHome($params)
    {
        $product = $this->getProductDetail()[0];

        // dd($product);

        $this->context->smarty->assign([
            'ek_productspotlight_name' => Configuration::get('EK_PRODUCTSPOTLIGHT_NAME'),
            'ek_productspotlight_product' => $product,
        ]);

        return $this->display(__FILE__, 'ek_productspotlight.tpl');
    }

    public function hookActionFrontControllerSetMedia()
    {
        $this->context->controller->registerStylesheet(
            'ek_productspotlight-style',
            'modules/' . $this->name . '/views/css/ek_productspotlight.css',
            [
                'media' => 'all',
                'priority' => 1000,
            ]
        );
    }

    protected function getProductDetail()
    {
        $rawProducts = [];
        $product = new Product((int) Configuration::get('EK_PRODUCTSPOTLIGHT_PRODUCT'), true, $this->context->language->id);
        array_push($rawProducts, json_decode(json_encode($product), true));

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
                $assembleInBulk ? $rawProduct : $assembler->assembleProduct($rawProduct),
                $this->context->language,
            );
        }

        return $products_for_template;
    }
}
