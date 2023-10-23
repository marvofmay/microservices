<?php

namespace App\Tests\Movie\Integration\Controller;

use App\Movie\Domain\Entity\Movie;
use DG\BypassFinals;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


class MovieControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManager $entityManager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->entityManager = $this->client->getContainer()->get('doctrine')->getManager();
        BypassFinals::enable();
    }

    private static function moviesList(): array
    {
        return [
            ['title' => 'Pulp Fiction', 'active' => true],
            ['title' => 'Incepcja', 'active' => true],
            ['title' => 'Skazani na Shawshank', 'active' => true],
            ['title' => 'Dwunastu gniewnych ludzi', 'active' => true],
            ['title' => 'Ojciec chrzestny', 'active' => true],
            ['title' => 'Django', 'active' => true],
            ['title' => 'Matrix', 'active' => true],
            ['title' => 'Leon zawodowiec', 'active' => true],
            ['title' => 'Siedem', 'active' => true],
            ['title' => 'Nietykalni', 'active' => true],
            ['title' => 'Władca Pierścieni: Powrót króla', 'active' => true],
            ['title' => 'Fight Club', 'active' => true],
            ['title' => 'Forrest Gump', 'active' => true],
            ['title' => 'Chłopaki nie płaczą', 'active' => true],
            ['title' => 'Gladiator', 'active' => true],
            ['title' => 'Człowiek z blizną', 'active' => true],
            ['title' => 'Pianista', 'active' => true],
            ['title' => 'Doktor Strange', 'active' => true],
            ['title' => 'Szeregowiec Ryan', 'active' => true],
            ['title' => 'Lot nad kukułczym gniazdem', 'active' => true],
            ['title' => 'Wielki Gatsby', 'active' => true],
            ['title' => 'Avengers: Wojna bez granic', 'active' => true],
            ['title' => 'Życie jest piękne', 'active' => true],
            ['title' => 'Pożegnanie z Afryką', 'active' => true],
            ['title' => 'Szczęki', 'active' => true],
            ['title' => 'Milczenie owiec', 'active' => true],
            ['title' => 'Dzień świra', 'active' => true],
            ['title' => 'Blade Runner', 'active' => true],
            ['title' => 'Labirynt', 'active' => true],
            ['title' => 'Król Lew', 'active' => true],
            ['title' => 'La La Land', 'active' => true],
            ['title' => 'Whiplash', 'active' => true],
            ['title' => 'Wyspa tajemnic', 'active' => true],
            ['title' => 'Django', 'active' => true],
            ['title' => 'American Beauty', 'active' => true],
            ['title' => 'Szósty zmysł', 'active' => true],
            ['title' => 'Gwiezdne wojny: Nowa nadzieja', 'active' => true],
            ['title' => 'Mroczny Rycerz', 'active' => true],
            ['title' => 'Władca Pierścieni: Drużyna Pierścienia', 'active' => true],
            ['title' => 'Harry Potter i Kamień Filozoficzny', 'active' => true],
            ['title' => 'Green Mile', 'active' => true],
            ['title' => 'Iniemamocni', 'active' => true],
            ['title' => 'Shrek', 'active' => true],
            ['title' => 'Mad Max: Na drodze gniewu', 'active' => true],
            ['title' => 'Terminator 2: Dzień sądu', 'active' => true],
            ['title' => 'Piraci z Karaibów: Klątwa Czarnej Perły', 'active' => true],
            ['title' => 'Truman Show', 'active' => true],
            ['title' => 'Skazany na bluesa', 'active' => true],
            ['title' => 'Infiltracja', 'active' => true],
            ['title' => 'Gran Torino', 'active' => true],
            ['title' => 'Spotlight', 'active' => true],
            ['title' => 'Mroczna wieża', 'active' => true],
            ['title' => 'Rocky', 'active' => true],
            ['title' => 'Casino Royale', 'active' => true],
            ['title' => 'Drive', 'active' => true],
            ['title' => 'Piękny umysł', 'active' => true],
            ['title' => 'Władca Pierścieni: Dwie wieże', 'active' => true],
            ['title' => 'Zielona mila', 'active' => true],
            ['title' => 'Requiem dla snu', 'active' => true],
            ['title' => 'Forest Gump', 'active' => true],
            ['title' => 'Requiem dla snu', 'active' => true],
            ['title' => 'Milczenie owiec', 'active' => true],
            ['title' => 'Czarnobyl', 'active' => true],
            ['title' => 'Breaking Bad', 'active' => true],
            ['title' => 'Nędznicy', 'active' => true],
            ['title' => 'Seksmisja', 'active' => true],
            ['title' => 'Pachnidło', 'active' => true],
            ['title' => 'Nagi instynkt', 'active' => true],
            ['title' => 'Zjawa', 'active' => true],
            ['title' => 'Igrzyska śmierci', 'active' => true],
            ['title' => 'Kiler', 'active' => true],
            ['title' => 'Siedem dusz', 'active' => true],
            ['title' => 'Dzień świra', 'active' => true],
            ['title' => 'Upadek', 'active' => true],
            ['title' => 'Lśnienie', 'active' => true],
            ['title' => 'Pan życia i śmierci', 'active' => true],
            ['title' => 'Gladiator', 'active' => true],
            ['title' => 'Granica', 'active' => true],
            ['title' => 'Hobbit: Niezwykła podróż', 'active' => true],
            ['title' => 'Pachnidło: Historia mordercy', 'active' => true],
            ['title' => 'Wielki Gatsby', 'active' => true],
            ['title' => 'Titanic', 'active' => true],
            ['title' => 'Sin City', 'active' => true],
            ['title' => 'Przeminęło z wiatrem', 'active' => true],
            ['title' => 'Królowa śniegu', 'active' => true],
        ];
    }

    private static function uniqueMovies (): array
    {
        return array_values(array_reduce(self::moviesList(), function ($items, $movie) {
                $title = $movie['title'];
                if (!isset($items[$title])) {
                    $items[$title] = $movie;
                }
                return $items;
            }, []));
    }

    private static function payload(): array
    {
        return ['movies' => self::uniqueMovies()];
    }

    public function testCreateMovies(): void
    {
        $this->client->request(
            'POST',
            '/api/movies',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(self::payload())
        );

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $responseData = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('data', $responseData);
        $this->assertEquals('movies has been created', $responseData['data']);
    }

    public function testCreateMoviesThrowException(): void
    {
        $this->client->request(
            'POST',
            '/api/movies',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['movies' => [
                [Movie::COLUMN_TITLE => 'Incepcja', Movie::COLUMN_ACTIVE => true],
            ]])
        );

        $responseData = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertSame(Response::HTTP_INTERNAL_SERVER_ERROR, $this->client->getResponse()->getStatusCode());
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $this->assertArrayHasKey('errors', $responseData);
        $this->assertEquals('Upss...', $responseData['errors']);
    }

    public function testIndex(): void
    {
        $this->client->request('GET', '/api/movies');
        $this->assertContains($this->client->getResponse()->getStatusCode(), [Response::HTTP_OK, Response::HTTP_INTERNAL_SERVER_ERROR]);
        $this->assertJson($this->client->getResponse()->getContent());
        $this->assertArrayHasKey('data', json_decode($this->client->getResponse()->getContent(), true));
    }

    public function testShow(): void
    {
        $movieRepository = $this->entityManager->getRepository('App\Movie\Domain\Entity\Movie');
        $movie = $movieRepository->findBy(['title' => 'Pulp Fiction']);
        $uuid = $movie[0]->getUUID()->toString();

        $this->client->request('GET', '/api/movies/' . $uuid);
        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $responseData = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('data', $responseData);
    }

    public function testShowAndMovieByUuidNotFound(): void
    {
        $uuid = 'fake-movie-uuid';
        $this->client->request('GET', '/api/movies/' . $uuid);
        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());
        $this->assertArrayHasKey('errors', json_decode($this->client->getResponse()->getContent(), true));
    }

    public function testRandomThreeMovies(): void
    {
        $this->client->request('GET', '/api/movies', ['algorithm' => 1]);

        $response = $this->client->getResponse();
        $content = $response->getContent();

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());
        $this->assertJson($content);

        $data = json_decode($content, true);

        $this->assertArrayHasKey('data', $data);
        $this->assertCount(3, $data['data']);
    }

    public function testEvenNumberOfLettersInMovieTitleAndStartWithW(): void
    {
        $this->client->request('GET', '/api/movies', ['algorithm' => 2, 'limit' => 100]);

        $response = $this->client->getResponse();
        $content = $response->getContent();

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());

        $data = json_decode($content, true);

        $this->assertArrayHasKey('data', $data);

        $this->assertCount(
            count($data['data']),
            array_filter(
                self::uniqueMovies(),
                fn ($movie) => preg_match('/\b(?:\w{2})*\w*\b/', $movie['title']) && strpos($movie['title'], 'W') === 0
            )
        );
    }

    public function testMoreThanOneWordInMovieTitle(): void
    {
        $this->client->request('GET', '/api/movies', ['algorithm' => 3, 'limit' => 100]);

        $response = $this->client->getResponse();
        $content = $response->getContent();

        $this->assertSame(Response::HTTP_OK, $response->getStatusCode());

        $data = json_decode($content, true);
        $this->assertArrayHasKey('data', $data);
        $this->assertCount(count($data['data']), array_filter(self::uniqueMovies(), fn ($item) =>  preg_match('/\s+/', $item['title'])));
    }

    public function testUpdateMovie(): void
    {
        $updatedTitle = 'Pulp Fiction after update';
        $movieRepository = $this->entityManager->getRepository('App\Movie\Domain\Entity\Movie');
        $movie = $movieRepository->findBy(['title' => 'Pulp Fiction']);
        $uuid = $movie[0]->getUUID()->toString();

        $this->client->request(
            'PUT',
            '/api/movies/' . $uuid,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'uuid' => $uuid,
                'title' => $updatedTitle,
                'active' => true,
            ])
        );

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $responseData = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('data', $responseData);
        $this->assertEquals('movie has been updated', $responseData['data']);

        $movieRepository = $this->entityManager->getRepository('App\Movie\Domain\Entity\Movie');
        $movie = $movieRepository->findBy(['title' => 'Pulp Fiction after update']);
        $this->assertEquals($updatedTitle, $movie[0]->getTitle());
    }

    public function testUpdateAndDifferentUUID(): void
    {
        $this->client->request(
            'PUT',
            '/api/movies/uuid-foo',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'uuid' => 'uuid-bar',
                'title' => 'title to update',
                'active' => true,
            ])
        );

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());
        $responseData = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('errors', $responseData);
        $this->assertEquals('different UUID in body raw and url', $responseData['errors']);
    }

    public function testDeleteMovie(): void
    {
        $movieRepository = $this->entityManager->getRepository('App\Movie\Domain\Entity\Movie');
        $movie = $movieRepository->findBy(['title' => 'Pulp Fiction after update']);
        $uuid = $movie[0]->getUUID()->toString();

        $this->client->request('DELETE', '/api/movies/' . $uuid);

        $this->assertSame(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
        $this->assertTrue($this->client->getResponse()->headers->contains('Content-Type', 'application/json'));
        $responseData = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('data', $responseData);
        $this->assertEquals('movie has been deleted', $responseData['data']);
    }

    public function testDeleteAndMovieByUuidNotFound(): void
    {
        $uuid = 'fake-movie-uuid';
        $this->client->request('DELETE', '/api/movies/' . $uuid);
        $this->assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $this->client->getResponse()->getStatusCode());
        $this->assertJson($this->client->getResponse()->getContent());
        $this->assertArrayHasKey('errors', json_decode($this->client->getResponse()->getContent(), true));
    }

    public function testEmptyDB(): void
    {
        $movieRepository = $this->entityManager->getRepository('App\Movie\Domain\Entity\Movie');
        $movies = $movieRepository->findAll();
        foreach ($movies as $movie) {
            $this->entityManager->remove($movie);
            $this->entityManager->flush();
        }
        $movies = $movieRepository->findAll();

        $this->assertEquals([], $movies);
    }
}