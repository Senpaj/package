<?php

// tests/Controller/ProfileControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class ProfileControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testShowHomepage()
    {
        $client = static::createClient();

        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    public function testShowAboutUs()
    {
        $crawler = $this->client->request('GET', '/aboutus');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testShowPrices()
    {
        $crawler = $this->client->request('GET', '/prices');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testShowServices()
    {
        $crawler = $this->client->request('GET', '/services');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }


 /*   public function testCreateProfile()
    {
        $this->doLogin();
        $crawler = $this->client->request('GET', '/profile/create');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $form = $crawler->selectButton('Submit')->form();
        $form['UserInfo[firstName]'] = 'Tomas';
        $form['UserInfo[lastName]'] = 'Jasulaitis';
        $form['UserInfo[bornAt]'] = '2017-02-04';

        $crawler = $this->client->submit($form);
        $crawler = $this->client->followRedirect();

    }*/

   /* public function testShowProfile()
    {
        $this->doLogin();
        $crawler = $this->client->request('GET', '/profile/details/1');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }*/




        public function doLogin()
        {
            $client = static::createClient();
            $client->followRedirects(false);
            $session = $client->getContainer()->get('session');
            $session->start();
            $client->getCookieJar()->set(new \Symfony\Component\BrowserKit\Cookie($session->getName(), $session->getId()));
            $token = new UsernamePasswordToken('info', 'userpass', 'secured_area', array('ROLE_USER'));
            $session->set('_security_secured_area', serialize($token));
            $session->save();

        }

}






?>