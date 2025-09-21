{*
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
 *}
<!-- Block ek_productspotlight -->
<div id="ek_productspotlight_block_home" class="block">
    <div id="ek_productspotlight_container" class="container">
        <div id="ek_productspotlight_image_container">
            {if !empty($ek_productspotlight_product.available_date)}
                <ul class="product-flags js-product-flags">
                    <li class="badge">{l s='Megjelenik: %date%' sprintf=['%date%' => '{$ek_productspotlight_product.available_date|date_format:"%Y %B %d" %}'] d='Modules.Productspotlight.Shop'}</li>
                </ul>
            {/if}
            {if isset($ek_productspotlight_product.cover)}
                <picture>
                    {if !empty($ek_productspotlight_product.cover.bySize.large_default.sources.avif)}
                        <source srcset="{$ek_productspotlight_product.cover.bySize.large_default.sources.avif}"
                        type="image/avif">{/if}
                    {if !empty($ek_productspotlight_product.cover.bySize.large_default.sources.webp)}
                        <source srcset="{$ek_productspotlight_product.cover.bySize.large_default.sources.webp}"
                        type="image/webp">{/if}
                    <img class="card-img-top card-img-bottom"
                        src="{$ek_productspotlight_product.cover.bySize.large_default.url}"
                        alt="{if !empty($ek_productspotlight_product.cover.legend)}{$ek_productspotlight_product.cover.legend}{else}{$ek_productspotlight_product.name|truncate:30:'...'}{/if}"
                        loading="lazy" data-full-size-image-url="{$ek_productspotlight_product.cover.large.url}"
                        width="{$ek_productspotlight_product.cover.bySize.large_default.width}"
                        height="{$ek_productspotlight_product.cover.bySize.large_default.height}" />
                </picture>
            {else}
                <picture>
                    {if !empty($urls.no_picture_image.bySize.large_default.sources.avif)}
                        <source srcset="{$urls.no_picture_image.bySize.large_default.sources.avif}" type="image/avif">
                    {/if}
                    {if !empty($urls.no_picture_image.bySize.large_default.sources.webp)}
                        <source srcset="{$urls.no_picture_image.bySize.large_default.sources.webp}" type="image/webp">
                    {/if}
                    <img src="{$urls.no_picture_image.bySize.large_default.url}" loading="lazy"
                        width="{$urls.no_picture_image.bySize.large_default.width}"
                        height="{$urls.no_picture_image.bySize.large_default.height}" />
                </picture>
            {/if}
        </div>
        <div class="block_content">
            <h2 id="ek_productspotlight_title">{$ek_productspotlight_product.name}</h2>
            {$ek_productspotlight_product.description nofilter}
            <a class="btn btn-outline-primary btn-with-icon" href="{$ek_productspotlight_product.url}">{l s='Megrendelem!' d='Modules.Productspotlight.Shop'}</a>
        </div>
    </div>
</div>
<!-- /Block ek_productspotlight -->