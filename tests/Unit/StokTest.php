<?php

namespace Tests\Unit;

// Stokモデルをインポート
use App\Stok;
// use PHPUnit\Framework\TestCase;
// 追加の行
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StokTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testNotStokShow()
    {
        $stok = Stok::find(0);
        $this->assertNull($stok);
    }

    public function testUpdateTask()
    {
        $stok = Stok::create([
            'name' => '在庫テスト',
            'price' => 300,
            'quantity' => 2,
            'role' => '発注状態'
        ]);

        $this->assertEquals('在庫テスト', $stok->name);
        
        $stok->fill(['name' => 'テスト']);
        $stok->save();

        $stok2 = Stok::find($stok->id);
        $this->assertEquals('テスト', $stok2->name);
    }
}
