<?php

namespace Tests\Feature;

use App\Contact;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ContactTest extends TestCase
{


    /** @test */
    public function contact_can_be_added(){

        $this->withExceptionHandling();
        $this->post('/api/contacts', ['name' => 'Test name']);
        $this->assertCount(6, Contact::all());
    }
}
