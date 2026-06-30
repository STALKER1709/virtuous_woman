<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class AdminImageUploadTest extends TestCase
{
    use RefreshDatabase;

    private string $realPublicPath;

    private string $fakePublicPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->realPublicPath = $this->app->publicPath();
        $this->fakePublicPath = storage_path('framework/testing/public-'.uniqid());

        foreach (['uploads/products/thumbnails', 'uploads/categories', 'uploads/brands'] as $dir) {
            File::makeDirectory($this->fakePublicPath.'/'.$dir, 0755, true, true);
        }

        // Redirect public_path() to a scratch directory so the controller's real
        // image-processing code runs without writing into the production assets folder.
        $this->app->usePublicPath($this->fakePublicPath);
    }

    protected function tearDown(): void
    {
        $this->app->usePublicPath($this->realPublicPath);

        if (File::isDirectory($this->fakePublicPath)) {
            File::deleteDirectory($this->fakePublicPath);
        }

        parent::tearDown();
    }

    public function test_admin_can_create_a_product_with_an_image(): void
    {
        $admin = User::factory()->create(['utype' => 'ADM']);
        $category = Category::factory()->create();
        $brand = Brand::factory()->create();
        $image = UploadedFile::fake()->image('product.jpg', 540, 689);

        $response = $this->actingAs($admin)->post('/admin/product/store', [
            'name' => 'New Dress',
            'slug' => 'new-dress',
            'short_description' => 'desc',
            'description' => 'desc',
            'regular_price' => 50,
            'sale_price' => 40,
            'SKU' => 'SKU-NEW',
            'stock_status' => 'instock',
            'featured' => 0,
            'quantity' => 10,
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'image' => $image,
        ]);

        $response->assertRedirect(route('admin.products'));

        $product = Product::where('slug', 'new-dress')->firstOrFail();
        $this->assertNotEmpty($product->image);
        $this->assertFileExists($this->fakePublicPath.'/uploads/products/'.$product->image);
        $this->assertFileExists($this->fakePublicPath.'/uploads/products/thumbnails/'.$product->image);

        // The real production uploads directory must remain untouched.
        $this->assertFileDoesNotExist($this->realPublicPath.'/uploads/products/'.$product->image);
    }

    public function test_admin_can_create_a_category_with_an_image(): void
    {
        $admin = User::factory()->create(['utype' => 'ADM']);
        $image = UploadedFile::fake()->image('category.jpg', 300, 300);

        $response = $this->actingAs($admin)->post('/admin/category/store', [
            'name' => 'New Category',
            'slug' => 'new-category',
            'image' => $image,
        ]);

        $response->assertRedirect(route('admin.categories'));

        $category = Category::where('slug', 'new-category')->firstOrFail();
        $this->assertNotEmpty($category->image);
        $this->assertFileExists($this->fakePublicPath.'/uploads/categories/'.$category->image);
        $this->assertFileDoesNotExist($this->realPublicPath.'/uploads/categories/'.$category->image);
    }

    public function test_admin_can_create_a_brand_with_an_image(): void
    {
        $admin = User::factory()->create(['utype' => 'ADM']);
        $image = UploadedFile::fake()->image('brand.jpg', 300, 300);

        $response = $this->actingAs($admin)->post('/admin/brand/store', [
            'name' => 'New Brand',
            'slug' => 'new-brand',
            'image' => $image,
        ]);

        $response->assertRedirect(route('admin.brands'));

        $brand = Brand::where('slug', 'new-brand')->firstOrFail();
        $this->assertNotEmpty($brand->image);
        $this->assertFileExists($this->fakePublicPath.'/uploads/brands/'.$brand->image);
        $this->assertFileDoesNotExist($this->realPublicPath.'/uploads/brands/'.$brand->image);
    }
}
