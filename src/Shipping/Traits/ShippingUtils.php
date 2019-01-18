<?php
namespace AvoRed\Framework\Shipping\Traits;

trait ShippingUtils
{
    public function getProductAttributes($product)
    {
        $height = null;
        $width = null;
        $length = null;
        $weight = null;

        // If product has attributes;
        if ($product->height && $product->length && $product->width && $product->weight) {
            $height = $product->height;
            $length = $product->length;
            $width = $product->width;
            $weight = $product->weight;
        }
        // If is variable product, check if
        else if ($product->type == 'VARIABLE_PRODUCT') {
            $produtoPrincipal = $product->getVariableMainProduct($product->id);
            $height = $produtoPrincipal->height;
            $length = $produtoPrincipal->length;
            $width = $produtoPrincipal->width;
            $weight = $produtoPrincipal->weight;
        }

        return [$height, $width, $length, $weight];
    }

}
