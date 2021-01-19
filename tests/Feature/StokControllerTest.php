<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// 追加の行
use App\Stok;
// use Illuminate\Foundation\Testing\DatabaseTransactions;

class StokControllerTest extends TestCase
{
    use RefreshDatabase;

    private $stok;

    protected function setUp() :void
    {
        parent::setUp();
        $this->stok = Stok::create([
            'name' => 'テスト在庫',
            'price' => 200,
            'quantity' => 2,
            'role' => '発注状態'
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/stoks');

        $response->assertStatus(200)
            ->assertViewIs('stoks.index');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShow()
    {
        $response = $this->get('/stoks/' . $this->stok->id);

        $response->assertStatus(200)
            ->assertViewIs('stoks.show');
    }

    public function testShowNotStok()
    {
        $response = $this->get('/stoks/0');

        $response->assertStatus(404);
    }

    public function testStokUpdate()
    {
        $data = [
            'name' => 'test zaiko',
            'price' => 200,
            'quantity' => 4,
            'role' => '発注状態'
        ];
        $this->assertDatabaseMissing('stoks', $data);
        $response = $this->put('/stoks/' . $this->stok->id, $data);
        $response->assertStatus(302)
            ->assertRedirect('/stoks/' . $this->stok->id);

        $this->assertDatabaseHas('stoks', $data);
    }

    // 在庫更新で在庫名が空白
    public function testStokNameUpdateEmpty()
    {
        $data = [
            'name' => ''
        ];
        $response = $this->from('/stoks/' . $this->stok->id)
            ->put('/stoks/' . $this->stok->id, $data);
        
        $response->assertSessionHasErrors(['name' => 'The name field is required.']);
        $response->assertStatus(302)
            ->assertRedirect('/stoks/' . $this->stok->id);
    }

    // 在庫更新で在庫名が長い
    public function testStokNameUpdateMaxLengthPlus1()
    {
        $data = [
            'name' => str_random(256)
        ];
        $response = $this->from('/stoks/' . $this->stok->id)
            ->put('/stoks/' . $this->stok->id, $data);

        $response->assertSessionHasErrors(['name' => 'The name may not be greater than 255 characters.']);
        $response->assertStatus(302)
            ->assertRedirect('/stoks/' . $this->stok->id);
    }

    // 在庫更新での金額が空白
    public function testStokPriceUpdateEmpty()
    {
        $data = [
            'price' => ''
        ];
        $response = $this->from('/stoks/' . $this->stok->id)
            ->put('/stoks/' . $this->stok->id, $data);

        $response->assertSessionHasErrors(['price' => 'The price field is required.']);
        $response->assertStatus(302)
            ->assertRedirect('/stoks/' . $this->stok->id);
    }

    // 在庫更新での金額が整数以外
    public function testStokPriceUpdateNotInteger()
    {
        $data = [
            'price' => 'こんにちは'
        ];
        $response = $this->from('/stoks/' . $this->stok->id)
            ->put('/stoks/' . $this->stok->id, $data);

        $response->assertSessionHasErrors(['price' => 'The price must be an integer.']);
        $response->assertStatus(302)
            ->assertRedirect('/stoks/' . $this->stok->id);
    }

    // 在庫更新での個数が空白
    public function testStokQuantityUpdateEmty()
    {
        $data = [
            'quantity' => ''
        ];
        $response = $this->from('/stoks/' . $this->stok->id)
            ->put('/stoks/' . $this->stok->id, $data);

        $response->assertSessionHasErrors(['quantity' => 'The quantity field is required.']);
        $response->assertStatus(302)
            ->assertRedirect('/stoks/' . $this->stok->id);
    }

    // 在庫更新での個数が整数以外
    public function testStokQuantityUpdateNotInteger()
    {
        $data = [
            'quantity' => 'こんにちは'
        ];
        $response = $this->from('/stoks/' . $this->stok->id)
            ->put('/stoks/' . $this->stok->id, $data);

        $response->assertSessionHasErrors(['quantity' => 'The quantity must be an integer.']);
        $response->assertStatus(302)
            ->assertRedirect('/stoks/' . $this->stok->id);
    }

    public function testStokUpdate2()
    {
        $data = [
            'name' => 'テスト在庫2',
            'price' => 100,
            'quantity' => 2,
            'role' => '発注確認'
        ];
        $this->assertDatabaseMissing('stoks', $data);
        $response = $this->put('/stoks/' . $this->stok->id, $data);
        $response->assertStatus(302)
            ->assertRedirect('/stoks/' . $this->stok->id);

        $this->assertDatabaseHas('stoks', $data);
    }

    public function testStokNew()
    {
        $response = $this->get('/stok/new');

        $response->assertStatus(200)
            ->assertViewIs('stoks.new');
    }

    public function testPostStokPath()
    {
        $data = [
            'name' => 'test zaiko',
            'price' => 200,
            'quantity' => 4,
            'role' => '発注状態'
        ];
        $this->assertDatabaseMissing('stoks', $data);
        $response = $this->post('/stok', $data);

        $response->assertStatus(302)
            ->assertRedirect('/stoks');

        $this->assertDatabaseHas('stoks', $data);
    }

    // 在庫名が空
    public function testStokWithoutName()
    {
        $data = [];
        $response = $this->from('/stok/new')
            ->post('/stok/', $data);

        $response->assertSessionHasErrors(['name' => 'The name field is required.']);

        $response->assertStatus(302)
            ->assertRedirect('/stok/new');
    }

    // 在庫名が空白
    public function testStokEmptyName()
    {
        $data = [
            'name' => ''
        ];
        $response = $this->from('/stok/new')
            ->post('/stok/', $data);

        $response->assertSessionHasErrors(['name' => 'The name field is required.']);

        $response->assertStatus(302)
            ->assertRedirect('/stok/new');
    }

    // 在庫名の長さがちょうど
    public function testStokNameMaxLength()
    {
        $data = [
            'name' => str_random(255),
            'price' => 200,
            'quantity' => 3,
            'role' => '発注状態'
        ];

        $this->assertDatabaseMissing('stoks', $data);

        $response = $this->post('/stok/', $data);

        $response->assertStatus(302)
            ->assertRedirect('/stoks/');

        $this->assertDatabaseHas('stoks', $data);
    }

    // 在庫名が長い
    public function testStokNameMaxLengthPlus1()
    {
        $data = [
            'name' => str_random(256)
        ];

        $response = $this->from('/stok/new')
            ->post('/stok/', $data);

        $response->assertSessionHasErrors(['name' => 'The name may not be greater than 255 characters.']);
        $response->assertStatus(302)
            ->assertRedirect('/stok/new');
    }

    // 金額は空白
    public function testStokPriceEmpty()
    {
        $data = [
            'price' => ''
        ];

        $response = $this->from('/stok/new')
            ->post('/stok/', $data);

        $response->assertSessionHasErrors(['price' => 'The price field is required.']);
        $response->assertStatus(302)
            ->assertRedirect('/stok/new');
    }

    // 金額が整数以外
    public function testStokPriceNotInteger()
    {
        $data = [
            'price' => 'こんにちは'
        ];

        $response = $this->from('/stok/new')
            ->post('/stok/', $data);

        $response->assertSessionHasErrors(['price' => 'The price must be an integer.']);
        $response->assertStatus(302)
            ->assertRedirect('/stok/new');
    }

    // 個数が空白
    public function testStokQuantityEmpty()
    {
        $data = [
            'quantity' => ''
        ];

        $response = $this->from('/stok/new')
            ->post('/stok/', $data);

        $response->assertSessionHasErrors(['quantity' => 'The quantity field is required.']);
        $response->assertStatus(302)
            ->assertRedirect('/stok/new');
    }

    // 個数が数字以外
    public function testStokQuantityNotInteger()
    {
        $data = [
            'quantity' => '個数'
        ];

        $response = $this->from('/stok/new')
            ->post('/stok/', $data);

        $response->assertSessionHasErrors(['quantity' => 'The quantity must be an integer.']);
        $response->assertStatus(302)
            ->assertRedirect('/stok/new');
    }

    // 在庫削除のルート確認
    public function testStokDelete()
    {
        $this->assertDatabaseHas('stoks', $this->stok->toArray());

        $response = $this->delete('/stoks/' . $this->stok->id);

        $response->assertStatus(302)
            ->assertRedirect('/stoks/');

        $this->assertDatabaseMissing('stoks', $this->stok->toArray());
    }
}
