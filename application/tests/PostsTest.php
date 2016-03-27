<?php

require('../../vendor/autoload.php');

class PostsTest extends PHPUnit_Framework_TestCase
{
    protected $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost/'
        ]);
    }

    public function testGet_ValidInput_PostObject()
    {
        $response = $this->client->get('posts/index/1');
        $this->assertEquals(200, $response->getStatusCode());

        $data = json_decode($response->getBody(), true);

        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('title', $data);
        $this->assertArrayHasKey('content', $data);
        $this->assertArrayHasKey('author_id', $data);
        $this->assertArrayHasKey('emails_sent', $data);
        $this->assertArrayHasKey('created_at', $data);
        $this->assertArrayHasKey('updated_at', $data);
        $this->assertEquals(1, $data['id']);
    }

    public function testPost_NewPost_BookObject()
    {
        $bookId = uniqid();

        $response = $this->client->post('posts/index', [
            'form_params' => [
                'title' => 'My Random Post',
                'content' => 'Content',
                'author_id' => 1
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertGreaterThanOrEqual(1, $data['id']);
    }
}
