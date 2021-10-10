<?php

namespace AvoRed\Framework\Tests\Functional;

use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Tests\TestCase;

class ProductModelTest extends TestCase
{
    public function testProductFindBySlugMethod()
    {
        $slug = 'test-slug';
        $expectedProduct = Product::factory()->create(['slug' => $slug]);

        $repository = app(ProductModelInterface::class);
        $returnModel = $repository->findBySlug($slug);

        $this->assertEquals($returnModel->toArray(), $expectedProduct->toArray());
    }

    public function testProductFindByBarcodeMethod()
    {
        $barcode = 123456789;
        $expectedProduct = Product::factory()->create(['barcode' => $barcode]);

        $repository = app(ProductModelInterface::class);
        $returnModel = $repository->findByBarcode($barcode);

        $this->assertEquals($returnModel->toArray(), $expectedProduct->toArray());
    }
}
