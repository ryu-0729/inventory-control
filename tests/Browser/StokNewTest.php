<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class StokNewTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testNew()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/inventory-control/public/stok/new')
                    ->assertSee('New Stok');
        });
    }

    public function testShowNewEmptyName()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/inventory-control/public/stok/new')
                ->press('追加')
                ->pause(1000)
                ->assertPathIs('/inventory-control/public/stok/new')
                ->assertSee('The name field is required.')
                ->assertSee('The price field is required.')
                ->assertSee('The quantity field is required.')
                ->screenshot('stok_show_new_empty_name');
        });
    }
}
