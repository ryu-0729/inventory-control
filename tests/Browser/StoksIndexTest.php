<?php

namespace Tests\Browser;
// Stokモデルをインポート
use App\Stok;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StoksIndexTest extends DuskTestCase
{

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/inventory-control/public/stoks')
                ->assertSee("テスト在庫")
                ->screenshot('stoks_index');
        });
    }
}
