<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Pengampu;
use App\Models\User;

class PengampuTest extends TestCase
{
    /**
     * Authenticate user.
     *
     * @return void
     */
    protected function authenticate()
    {
        $user = User::create([
            'name' => 'test',
            'email' => rand(12345,678910).'test@gmail.com',
            'password' => \Hash::make('secret9874'),
        ]);

        if (!auth()->attempt(['email'=>$user->email, 'password'=>'secret1234'])) {
            return response(['message' => 'Login credentials are invaild']);
        }

        return $accessToken = auth()->user()->createToken('authToken')->accessToken;
    }

    /**
     * test create pengampu.
     *
     * @return void
     */
    public function test_create_pengampu()
    {
        $token = $this->authenticate();
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST','api/pengampu',[
            'kodemk' => '1',
            'kodedosen' => '4',
            'kelas' => 'J',
            'tahunakademik' => '2019'
        ]);

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(201);
    }

    /**
     * test update pengampu.
     *
     * @return void
     */
    public function test_update_pengampu()
    {
        $token = $this->authenticate();
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('PUT','api/pengampu/1',[
            'kodemk' => '2',
            'kodedosen' => '5',
            'kelas' => 'L',
            'tahunakademik' => '2010'
        ]);

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }

    /**
     * test find pengampu.
     *
     * @return void
     */
    public function test_find_pengampu()
    {
        $token = $this->authenticate();
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET','api/pengampu/5');

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }

    /**
     * test get all pengampus.
     *
     * @return void
     */
    public function test_get_all_pengampu()
    {
        $token = $this->authenticate();
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET','api/pengampu');

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }

    /**
     * test delete pengampus.
     *
     * @return void
     */
    public function test_delete_pengampu()
    {
        $token = $this->authenticate();
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('DELETE','api/pengampu/2');

        //Write the response in laravel.log
        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }
}