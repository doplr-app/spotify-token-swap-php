<?php

use PHPUnit\Framework\TestCase;
use emphaz\SpotifyTokenSwapper\SpotifyTokenSwapper;

/**
 * @cover SpotifyTokenSwapper
 */
class SpotifyTokenSwapperTest extends TestCase
{
    public function testCanBeCreatedFromProvidedData() : void
    {
        $this->assertInstanceOf(
            SpotifyTokenSwapper::class,
            new SpotifyTokenSwapper([
              'client_id'    => 'aaabbbccc',
              'secret'       => 'secret',
              'callback_url' => 'http://emphaz.io/callback-url'
            ])
        );
    }

    public function testThrowExceptionWhenNoArgumentProvided() : void
    {
        $this->expectException(ArgumentCountError::class);

        new SpotifyTokenSwapper();
    }

    public function testThrowExceptionWhenWrongArgumentsProvided() : void
    {
        $this->expectException(InvalidArgumentException::class);

        new SpotifyTokenSwapper([
          'client'     => 'aaabbbccc',
          'secret_key' => 'secret',
          'callback'   => 'http://emphaz.io/callback'
        ]);
    }
}
