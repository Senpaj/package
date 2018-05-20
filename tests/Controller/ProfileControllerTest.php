<?php

// tests/Controller/ProfileControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Member;
use App\Form\Type\MemberType;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\Type\ContactFormType;

class ProfileControllerTest extends WebTestCase
{
    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
        $this->crawler = $this->client->request('GET', '/');
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

    public function testResetPasswordSendsEmail()
    {
        $client = static::createClient();
        $crawler = $this->client->request('GET', '/resetPassword');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Atstatyti')->form();
        $crawler = $client->submit($form, array('reset_password_email[email]' => 'phexsprays@gmail.com'));
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }


    public function testContactSendsEmail()
    {
        $client = static::createClient();
        $crawler = $this->client->request('GET', '/contact');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Submit')->form();
        $crawler = $client->submit($form, array('contact_form[name]' => 'Fabien', 'contact_form[email]' => 'tomas@gmail.com',
        'contact_form[subject]' => 'anypass', 'contact_form[message]' => 'hello'    ));

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }





    public function testRegisterUser()
    {
        $client = static::createClient();
        $crawler = $this->client->request('GET', '/register');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Register')->form();
        $crawler = $client->submit($form, array('appbundle_member[username]' => 'Fabien', 'appbundle_member[email]' => 'tomas@gmail.com',
            'appbundle_member[plainPassword][first]' => 'anypass' ,  'appbundle_member[plainPassword][second]' => 'anypass'    ));
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

    }

    public function testCreateProfile()
    {
        $client = static::createClient();

        $crawler = $this->client->request('GET', '/login');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Sign in')->form();
        $crawler = $client->submit($form, array('_username' => 'Fabien',
            '_password' => 'anypass'    ));

        //$crawler = $this->client->followRedirect(true);
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

       // $crawler = $this->client->request('GET', '/profile/create');
     //   $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

    }


   /* public function testShowProfile()
    {
        $this->doLogin();
        $crawler = $this->client->request('GET', '/profile/details/1');
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }*/



      /*  public function testRegister()
        {
           // $crawler = $this->client->request('GET', '/register');
         //   $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
         //   $form = $crawler->selectButton('Register')->form();
           // var_dump($form);
       //     $form['username'] = 'symfonyfan';
           // var_dump($crawler);
           // var_dump($form);
         //   $form['username'] = 'symfonyfan';
          //  $form['email'] = 'symfonyfan@gmail.com';
          //  $form['first'] = 'anypass';
         //   $form['second'] = 'anypass';
         /*   $crawler = $this->client->submit($form);
            $crawler = $this->client->followRedirect(true);
            $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());*/

}






?>