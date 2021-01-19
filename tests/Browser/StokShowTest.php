<?php

namespace Tests\Browser;
// Stokモデルをインポート
use App\Stok;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StokShowTest extends DuskTestCase
{
    use DatabaseMigrations;

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
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/inventory-control/public/stoks/' . $this->stok->id)
                    ->assertInputValue('#name', 'テスト在庫')
                    ->screenshot('stok_show');
        });
    }

    public function testPost()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/inventory-control/public/stoks/' . $this->stok->id)
                ->assertInputValue('#name', 'テスト在庫')
                ->type('#name', 'test_zaiko')
                ->screenshot('stok_post_typed')
                ->press('更新')
                ->pause(1000)
                ->assertPathIs('/inventory-control/public/stoks/' . $this->stok->id)
                ->screenshot('stok_post_pressed');
        });
    }

    // エラ〜メッセージの確認
    public function testStokUpdateErrors()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/inventory-control/public/stoks/' . $this->stok->id)
                ->assertInputValue('#name', 'テスト在庫')
                ->assertInputValue('#price', 200)
                ->assertInputValue('#quantity', 2)
                ->type('#name', '')
                ->type('#price', '')
                ->type('#quantity', '')
                ->screenshot('stok_name_empty')
                ->press('更新')
                ->pause(1000)
                ->assertPathIs('/inventory-control/public/stoks/' . $this->stok->id)
                ->assertSee('The name field is required.')
                ->assertSee('The price field is required.')
                ->assertSee('The quantity field is required.')
                ->screenshot('stok_errors_messages');
        });
    }
}
