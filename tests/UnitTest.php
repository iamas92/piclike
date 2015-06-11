<?php

class UnitTest extends TestCase {

    public function testNotFound() {
        $response = $this->call("GET", "/404");
        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testGuest() {
        $response = $this->call("GET", "/alter");
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testGetUser() {
        $response = $this->call("GET", "/user/pruebas");
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas("usuario");
    }

    public function testGetPicture() {
        $response = $this->call("GET", "/picture/1");
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas("imagen");
    }

    public function testGetCategory() {
        $response = $this->call("GET", "/category/1");
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas("categoria");
    }

    public function testMiddleware() {
        $this->call("GET", "/alter");
        $this->assertRedirectedTo("/");
    }

    public function testActionToController() {
        $this->call("GET", "/user/pruebas");
        $this->action("GET", "Show@getUser");
    }

    public function testViewWithData() {
        $this->call("GET", "/");
        $this->assertViewHas("titulo");
    }

    public function testLoginWithNoData() {
        $response = $this->call("POST", "Auth\Authentication@postLogin", array());
        $this->assertEquals(500, $response->getStatusCode());
    }

    public function testRegisterWithNoData() {
        $response = $this->call("POST", "Auth\Authentication@getRegister", array());
        $this->assertEquals(500, $response->getStatusCode());
    }

}
