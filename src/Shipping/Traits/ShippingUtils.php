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

    public function getPackageData($products)
    {
        /**
         * Calcular cubagem
         */
        $count = 0;
        $height = [];
        $width = [];
        $length = [];
        $weight = [];

        foreach ($products as $product) {
            $productModel = $product['model'];
            $productQty = $product['qty'];

            if ($productQty > 0 && $productModel->needsShipping()) {
                list($_height, $_width, $_length, $_weight) = $this->getProductAttributes($productModel);

                $height[$count] = $_height;
                $width[$count] = $_width;
                $length[$count] = $_length;
                $weight[$count] = $_weight;

                if ($productQty > 1) {
                    $n = $count;
                    for ($i = 0; $i < $productQty; $i++) {
                        $height[$n] = $_height;
                        $width[$n] = $_width;
                        $length[$n] = $_length;
                        $weight[$n] = $_weight;
                    }
                    $count = $n;
                }
                $count++;
            }
        }


        return [
            'height' => array_values($height),
            'length' => array_values($length),
            'width'  => array_values($width),
            'weight' => array_sum($weight)
        ];
    }

    protected function cubageTotal($height, $width, $length)
    {
        // Sets the cubage of all products.
        $total       = 0;
        $total_items = count( $height );
        for ( $i = 0; $i < $total_items; $i++ ) {
            $total += $height[ $i ] * $width[ $i ] * $length[ $i ];
        }
        return $total;
    }


    /**
     * Get the max values.
     *
     * @param  array $height Package height.
     * @param  array $width  Package width.
     * @param  array $length Package length.
     *
     * @return array
     */
    protected function getMaxValues( $height, $width, $length ) {
        $find = array(
            'height' => max( $height ),
            'width'  => max( $width ),
            'length' => max( $length ),
        );
        return $find;
    }


    /**
     * Calculates the square root of the scaling of all products.
     *
     * @param  array $height     Package height.
     * @param  array $width      Package width.
     * @param  array $length     Package length.
     * @param  array $max_values Package bigger values.
     *
     * @return float
     */
    protected function calculateRoot( $height, $width, $length, $max_values ) {
        $cubage_total = $this->cubageTotal( $height, $width, $length );
        $root         = 0;
        $biggest      = max( $max_values );
        if ( 0 !== $cubage_total && 0 < $biggest ) {
            // Dividing the value of scaling of all products.
            // With the measured value of greater.
            $division = $cubage_total / $biggest;
            // Total square root.
            $root = round( sqrt( $division ), 1 );
        }
        return $root;
    }

    /**
     * Sets the final cubage.
     *
     * @param  array $height Package height.
     * @param  array $width  Package width.
     * @param  array $length Package length.
     *
     * @return array
     */
    protected function getCubage( $height, $width, $length ) {
        $cubage     = array();
        $max_values = $this->getMaxValues( $height, $width, $length );
        $root       = $this->calculateRoot( $height, $width, $length, $max_values );
        $greatest   = array_search( max( $max_values ), $max_values, true );
        switch ( $greatest ) {
            case 'height' :
                $cubage = array(
                    'height' => max( $height ),
                    'width'  => $root,
                    'length' => $root,
                );
                break;
            case 'width' :
                $cubage = array(
                    'height' => $root,
                    'width'  => max( $width ),
                    'length' => $root,
                );
                break;
            case 'length' :
                $cubage = array(
                    'height' => $root,
                    'width'  => $root,
                    'length' => max( $length ),
                );
                break;
            default :
                $cubage = array(
                    'height' => 0,
                    'width'  => 0,
                    'length' => 0,
                );
                break;
        }
        return $cubage;
    }

    /**
     * @param $product
     *
     * @return array
     */
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
        } // If is variable product, check if
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
