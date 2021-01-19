<?php

namespace Tests\Browser;
// Stokモデルをインポート
use App\Stok;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StoksIndexTest extends DuskTestCase
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
    public function testIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/inventory-control/public/stoks')
                ->assertSee("テスト在庫")
                ->screenshot('stoks_index');
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    // ページ遷移のテスト
    public function testIndexToShow()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/inventory-control/public/stoks')
                ->assertSeeLink('詳細')
                ->clickLink('詳細')
                ->waitForLocation('/inventory-control/public/stoks/' . $this->stok->id, 3)
                ->assertPathIs('/inventory-control/public/stoks/' . $this->stok->id)
                ->assertInputValue('#name', 'テスト在庫');

        });
    }

    // 在庫作成画面へ遷移
    public function testIndexToNew()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/inventory-control/public/stoks')
                ->assertSeeLink('在庫作成')
                ->clickLink('在庫作成')
                ->waitForLocation('/inventory-control/public/stok/new')
                ->assertPathIs('/inventory-control/public/stok/new');
        });
    }
}
