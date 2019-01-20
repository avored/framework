<?php
namespace AvoRed\Framework\Shipping\Traits;

trait ShippingUtils
{
    /**
     * @var int
     */

    private $minHeight = 2;

    private $minLength = 16;

    private $minWidth = 11;

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

        $height = $height > $this->minHeight ? $height : $this->minHeight;
        $width = $width > $this->minWidth ? $width : $this->minWidth;
        $length = $length > $this->minLength ? $length : $this->minLength;

        return [$height, $width, $length, $weight];
    }

}
