<?php

namespace Tests\Feature\Download;

use Colors\Color;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanCraftTest extends TestCase
{

    public function testDownload(){

        $color = new Color();

        $response = $this->get('/download/resources/lanCraft/10000');
        $response->assertStatus(200);

        echo $color->apply("magenta","\n[Testing]");
        echo $color->apply("light_blue","[Download/LanCraftTest] ");
        echo $color->apply("light_green","Successfully to pass test —— [Download 200] √\n");

    }

}
