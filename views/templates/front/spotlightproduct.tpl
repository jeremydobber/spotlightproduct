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
                {include file='catalog/_partials/product-flags.tpl'}

                {if ($product.cover)}
                    <picture>
                        {if !empty($product.cover.bySize.product_main.sources.avif)}
                            <source
                                srcset="{$product.cover.bySize.product_main.sources.avif} 720w, {$product.cover.bySize.medium_default.sources.avif} 452w"
                                sizes="(min-width: 1200px) 720px, (min-width: 768px) 452px, (min-width: 477px) 720px, 452px"
                            type="image/avif">{/if}
                        {if !empty($product.cover.bySize.product_main.sources.webp)}
                            <source
                                srcset="{$product.cover.bySize.product_main.sources.webp} 720w, {$product.cover.bySize.medium_default.sources.webp} 452w"
                                sizes="(min-width: 1200px) 720px, (min-width: 768px) 452px, (min-width: 477px) 720px, 452px"
                            type="image/webp">{/if}
                        <img class="img-fluid w-100 rounded" src="{$product.cover.bySize.product_main.url}"
                            srcset="
                            {$product.cover.bySize.product_main.url} 720w, 
                            {$product.cover.bySize.medium_default.url} 452w"
                            sizes="(min-width: 1200px) 720px, (min-width: 768px) 452px, (min-width: 477px) 720px, 452px"
                            alt="{if !empty($product.cover.legend)}{$product.cover.legend}{else}{$product.name|truncate:30:'...'}{/if}"
                            width="{$product.cover.bySize.product_main.width}"
                            height="{$product.cover.bySize.product_main.height}" fetchpriority=high />
                    </picture>
                {else}
                    <picture>
                        {if !empty($urls.no_picture_image.bySize.large_default.sources.avif)}
                            <source srcset="{$urls.no_picture_image.bySize.large_default.sources.avif}"
                                sizes="(min-width: 1200px) 720px, (min-width: 768px) 452px, (min-width: 477px) 720px, 452px"
                                type="image/avif">
                        {/if}
                        {if !empty($urls.no_picture_image.bySize.large_default.sources.webp)}
                            <source srcset="{$urls.no_picture_image.bySize.large_default.sources.webp}"
                                sizes="(min-width: 1200px) 720px, (min-width: 768px) 452px, (min-width: 477px) 720px, 452px"
                                type="image/webp">
                        {/if}
                        <img class="img-fluid w-100 rounded border" src="{$urls.no_picture_image.bySize.large_default.url}"
                            srcset="{$urls.no_picture_image.bySize.product_main.url} 720w, {$urls.no_picture_image.bySize.medium_default.url} 452w"
                            sizes="(min-width: 1200px) 720px, (min-width: 768px) 452px, (min-width: 477px) 720px, 452px"
                            width="{$urls.no_picture_image.bySize.large_default.width}"
                            height="{$urls.no_picture_image.bySize.large_default.height}" fetchpriority=high />
                    </picture>
                {/if}
            </div>
            <div class="col-md text-center text-md-start mt-5 mt-md-0 px-5">
                <h2>{$product.name}</h2>
                {$product.description nofilter}
                <a class="btn btn-outline-primary btn-with-icon"
                    href="{$product.url}">{l s='Order!' d='Modules.Spotlightproduct.Shop'}</a>
            </div>
        </div>
    </div>
</div>