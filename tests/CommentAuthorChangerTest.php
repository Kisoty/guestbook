<?php

declare(strict_types=1);


namespace App\Tests;


use App\Entity\Comment;
use App\Service\CommentAuthorChanger;
use PHPUnit\Framework\TestCase;

class CommentAuthorChangerTest extends TestCase
{
    public function testChangeIfNonDomawniiCaban()
    {
        $cabanComment = new Comment();
        $cabanComment->setAuthor('caban');
        $commentHost = 'smth';

        $commentAuthorChanger = new CommentAuthorChanger();

        $this->assertTrue($commentAuthorChanger->changeIfNeeded($cabanComment, $commentHost));
        $this->assertEquals($cabanComment->getAuthor(), 'COBAN');
    }

    public function testChangeIfDomawniiCaban()
    {
        $cabanComment = new Comment();
        $cabanComment->setAuthor('caban');
        $commentHost = '127.0.0.1';

        $commentAuthorChanger = new CommentAuthorChanger();

        $this->assertTrue($commentAuthorChanger->changeIfNeeded($cabanComment, $commentHost));
        $this->assertEquals($cabanComment->getAuthor(), 'Domawnii COBAN');
    }

    public function testChangeIfDomawniiNonCaban()
    {
        $cabanComment = new Comment();
        $cabanComment->setAuthor('baklajan');
        $commentHost = '127.0.0.1';

        $commentAuthorChanger = new CommentAuthorChanger();

        $this->assertTrue($commentAuthorChanger->changeIfNeeded($cabanComment, $commentHost));
        $this->assertEquals($cabanComment->getAuthor(), 'Domawnii baklajan');
    }

    public function testChangeIfNonDomawniiNonCaban()
    {
        $cabanComment = new Comment();
        $cabanComment->setAuthor('baklajan');
        $commentHost = 'google.com';

        $commentAuthorChanger = new CommentAuthorChanger();

        $this->assertFalse($commentAuthorChanger->changeIfNeeded($cabanComment, $commentHost));
        $this->assertEquals($cabanComment->getAuthor(), 'baklajan');
    }
}
