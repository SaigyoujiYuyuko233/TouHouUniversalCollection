<?php

namespace Tests\Feature\Access;

use Colors\Color;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanCraftTest extends TestCase
{

    // test for Http code
    public function testHttpCode(){

        $color = new Color();

        $response = $this->get('/view/resources/lanCraft');
        $response->assertStatus(200);

        echo $color->apply("magenta","\n[Testing]");
        echo $color->apply("light_blue","[Access/LanCraftTest] ");
        echo $color->apply("light_green","Successfully to access '/view/resources/lanCraft' - 200 √\n");

    }

}
