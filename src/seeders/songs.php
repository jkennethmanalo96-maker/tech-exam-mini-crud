<?php
require __DIR__ . '/../db.php'; 

$songs = [
    [
        'title' => 'Imagine',
        'artist' => 'John Lennon',
        'lyrics' => "
        Imagine there's no heaven
        It's easy if you try
        No hell below us
        Above us only sky
        Imagine all the people
        Living for today, ah
        Imagine there's no countries
        It isn't hard to do
        Nothing to kill or die for
        And no religion too
        Imagine all the people
        Living life in peace, you
        You may say I'm a dreamer
        But I'm not the only one
        I hope someday you'll join us
        And the world will be as one
        Imagine no possessions
        I wonder if you can
        No need for greed or hunger
        A brotherhood of man
        Imagine all the people
        Sharing all the world, you
        You may say I'm a dreamer
        But I'm not the only one
        I hope someday you'll join us
        And the world will live as one"
    ],
    [
        'title' => 'Bohemian Rhapsody',
        'artist' => 'Queen',
        'lyrics' => "
        Is this the real life?
        Is this just fantasy?
        Caught in a landslide
        No escape from reali
        Open your eyes
        Look up to the skies and see
        I'm just a poor boy, I need no sympathy
        Because I'm easy come, easy go
        Little high, little low
        Any way the wind blows
        Doesn't really matter to me, to 
        Mama, just killed a man
        Put a gun against his head
        Pulled my trigger, now he's dead
        Mama, life had just begun
        But now I've gone and thrown it all aw
        Mama, ooh
        Didn't mean to make you cry
        If I'm not back again this time tomorrow
        Carry on, carry on as if nothing really matte
        Too late, my time has come
        Sends shivers down my spine
        Body's aching all the time
        Goodbye, everybody, I've got to go
        Gotta leave you all behind and face the tru
        Mama, ooh (Any way the wind blows)
        I don't wanna die
        I sometimes wish I'd never been born at a
        I see a little silhouetto of a man
        Scaramouche, Scaramouche, will you do the Fandango?
        Thunderbolt and lightning very, very frightening me
        (Galileo) Galileo
        (Galileo) Galileo
        Galileo Figaro
        Magnifico-o-o-o
        I'm just a poor boy, nobody loves me
        He's just a poor boy from a poor family
        Spare him his life from this monstrosi
        Easy come, easy go, will you let me go?
        Bismillah! No, we will not let you go (Let him go!)
        Bismillah! We will not let you go (Let him go!)
        Bismillah! We will not let you go (Let me go!)
        Will not let you go (Let me go!)
        Never let you go (Never, never, never, never let me go)
        Oh oh oh oh
        No, no, no, no, no, no, no
        Oh, mamma mia, mamma mia (Mamma mia, let me go)
        Beelzebub has a devil put aside for me, for me, for 
        So you think you can stone me and spit in my eye?
        So you think you can love me and leave me to die?
        Oh, baby, can't do this to me, baby
        Just gotta get out, just gotta get right outta he
        Ooh, ooh yeah, ooh ye
        Nothing really matters
        Anyone can see
        Nothing really matters
        Nothing really matters to 
        Any way the wind blows"
    ]
];

try {
    $stmt = $pdo->prepare("INSERT INTO songs (title, artist, lyrics) VALUES (?, ?, ?)");

    foreach ($songs as $song) {
        $stmt->execute([
            $song['title'],
            $song['artist'],
            $song['lyrics']
        ]);
    }

    echo "Seeder completed successfully! " . count($songs) . " songs added.";
} catch (PDOException $e) {
    die("Seeding failed: " . $e->getMessage());
}
