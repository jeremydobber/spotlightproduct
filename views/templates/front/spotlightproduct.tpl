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
<div id="spotlightproduct-block-home" class="my-5">
    <div class="container">
        <div class="row align-items-center justify-content-between py-5">
            <div class="col-md img-fluid position-relative">
                {if ($spotlightproduct_product.available_date != "0000-00-00")}
                    <ul class="product-flags js-product-flags">
                        <li class="badge">{l s='Presale' d='Modules.Spotlightproduct.Shop'}</li>
                    </ul>
                {/if}
                {if ($spotlightproduct_product.cover)}
                    <picture>
                        {if !empty($spotlightproduct_product.cover.bySize.large_default.sources.avif)}
                            <source srcset="{$spotlightproduct_product.cover.bySize.large_default.sources.avif}"
                            type="image/avif">{/if}
                        {if !empty($spotlightproduct_product.cover.bySize.large_default.sources.webp)}
                            <source srcset="{$spotlightproduct_product.cover.bySize.large_default.sources.webp}"
                            type="image/webp">{/if}
                        <img class="img-fluid w-100 rounded border"
                            src="{$spotlightproduct_product.cover.bySize.large_default.url}"
                            alt="{if !empty($spotlightproduct_product.cover.legend)}{$spotlightproduct_product.cover.legend}{else}{$spotlightproduct_product.name|truncate:30:'...'}{/if}"
                            loading="lazy" data-full-size-image-url="{$spotlightproduct_product.cover.large.url}"
                            width="{$spotlightproduct_product.cover.bySize.large_default.width}"
                            height="{$spotlightproduct_product.cover.bySize.large_default.height}" />
                    </picture>
                {else}
                    <picture>
                        {if !empty($urls.no_picture_image.bySize.large_default.sources.avif)}
                            <source srcset="{$urls.no_picture_image.bySize.large_default.sources.avif}" type="image/avif">
                        {/if}
                        {if !empty($urls.no_picture_image.bySize.large_default.sources.webp)}
                            <source srcset="{$urls.no_picture_image.bySize.large_default.sources.webp}" type="image/webp">
                        {/if}
                        <img class="img-fluid w-100 rounded border"
                            src="{$urls.no_picture_image.bySize.large_default.url}" loading="lazy"
                            width="{$urls.no_picture_image.bySize.large_default.width}"
                            height="{$urls.no_picture_image.bySize.large_default.height}" />
                    </picture>
                {/if}
            </div>
            <div class="col-md text-center text-md-start mt-5 mt-md-0 mx-md-5">
                <h2>{$spotlightproduct_product.name}</h2>
                {$spotlightproduct_product.description nofilter}
                <a class="btn btn-outline-primary btn-with-icon"
                    href="{$spotlightproduct_product.url}">{l s='Order!' d='Modules.Spotlightproduct.Shop'}</a>
            </div>
        </div>
    </div>
</div>
