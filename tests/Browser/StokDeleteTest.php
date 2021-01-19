<?php

namespace Tests\Browser;

// Stokモデルをインポート
use App\Stok;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StokDeleteTest extends DuskTestCase
{
    private $stok;

    protected function setUp() :void
    {
        parent::setUp();
        $this->stok = Stok::create([
            'name' => 'テスト在庫',
            'price' => 100,
            'quantity' => 3,
            'role' => '発注状態'
        ]);
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testStokDelete()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/inventory-control/public/stoks/' . $this->stok->id)
                ->press('削除')
                ->pause(1000)
                ->assertPathIs('/inventory-control/public/stoks');
        });
    }
}
