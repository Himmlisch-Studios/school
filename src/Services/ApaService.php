<?php

namespace  App\Services;

use Carbon\Carbon;
use Symfony\Component\DomCrawler\Crawler;

class ApaService
{
    protected string $html;
    protected Crawler $root;
    protected array $schema;
    protected Crawler $article;
    protected bool $guess = false;
    protected string $url;

    protected function http(string $url)
    {
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_MAXREDIRS => 1,
            CURLOPT_TIMEOUT => 20,
        ]);
        $data = curl_exec($curl);
        curl_close($curl);

        return $data;
    }

    public function __construct(
        ?string $url = null
    ) {
        if (is_null($url)) {
            return;
        }

        $this->init($url);
    }

    public function startGuessing(bool $guess = true)
    {
        $this->guess = $guess;

        return $this;
    }

    public function init(string $url)
    {
        $this->url = $url;

        $this->html = $this->http($url);

        if (!$this->html) {
            throw new \Exception("Sitio web no encontrado.", 1);
        }

        $this->root = new Crawler($this->html);

        try {
            $this->schema = json_decode($this->root->filter('script[type="application/ld+json"]')->first()->text(), true);
        } catch (\Throwable $e) {
            $this->schema = [];
        }

        $posibilities = [];

        try {
            $posibilities[] = $this->root->filter('main')
                ->first()
                ->filter('article')
                ->first();
            $posibilities[] = $this->root
                ->filter('main')
                ->first();
            $posibilities[] = $this->root
                ->filter('article')
                ->first();
            $posibilities[] = $this->root;
        } catch (\Throwable $e) {
        }

        $this->article = $posibilities[0];

        return $this;
    }

    public function getTitle()
    {
        $title = $this->schema['name'] ?? $this->schema['headline'] ?? null;

        if ($title) {
            return $title;
        }

        return $this->root->filter('h1')->text(
            $this->root->filter('title')->text('')
        );
    }

    public function getDate()
    {
        try {
            $date = $this->schema['dateModified'] ?? $this->schema['datePublished'] ??
                $this->article->filter('[itemprop="dateModified"]')->first()->text(
                    $this->article->filter('[itemprop="datePublished"]')->first()->text('')
                );
            if ($date) {
                $date = Carbon::parse($this->article->filter('time')->first()->text());

                return $date->toFormattedDateString();
            }
        } catch (\Throwable $e) {
            return null;
        }

        if ($this->guess) {
            $title = $this->getTitle();
            $millenium = substr(Carbon::now()->year . '', 0, 2);

            preg_match("/$millenium\d{2}/", "$title", $matches);

            if (isset($matches[0])) {
                return $matches[0];
            }

            $url = urlencode($this->url);
            $data = json_decode($this->http("https://archive.org/wayback/available?url=$url"), true);
            if (isset($data['archived_snapshots']) && count($data['archived_snapshots']) > 0) {
                $date = Carbon::createFromFormat(
                    'Ymdhis',
                    $data['archived_snapshots']['closest']['timestamp']
                );
                return $date->year;
            }
        }
    }

    public function getPublisher()
    {
        return $this->schema['publisher']['name'] ?? '';
    }

    public function getPlace()
    {
        return ($this->schema['contentLocation'] ?? $this->schema['locationCreated'])['name'] ?? '';
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getAuthor()
    {
        $author = $this->schema['author']['name'] ?? $this->schema['creator'] ?? implode(' ', $this->article->filter('[rel=author]')->extract(['_text']));

        if (!$author && $this->guess) {
            $keywords = [
                'By',
                'BY',
                'by',
                'Por',
                'por',
                'POR'
            ];
            $xpath = implode(' or ', array_map(fn ($v) => "contains(., '$v')", $keywords));
            try {
                $posibilities = $this->root->filterXpath("//article//p[$xpath]")->extract(['_text']);
                $posibilities = array_filter($posibilities, function ($v) {
                    if (strlen($v) > 50) {
                        return false;
                    }

                    preg_match_all("/\w+/", $v, $matches);
                    $len = strlen(implode(' ', $matches[0] ?? []));
                    return  $len > 2 && $len <= 20;
                })[0] ?? '';
                $author = explode('.', substr($posibilities, strpos(strtolower($posibilities), 'by') + 2))[0];
            } catch (\Throwable $th) {
                return null;
            }
        }

        if ((isset($this->schema['author']['@type']) && $this->schema['author']['@type'] === 'Person') ||
            (!isset($this->schema['author']['@type']) && count(explode(' ', $author)) <= 4)
        ) {
            return $this->getNames($author);
        }

        return $this->getNames($author);
    }

    public function getNames(string $string)
    {
        $name = trim($string);
        $names = explode(' ', $name);
        if (count($names) == 1) {
            return [
                'surname' => $names[0],
                'names' => null,
            ];
        }

        return [
            'names' => implode(' ', array_slice($names, 0, count($names) - 1)),
            'surname' => $names[count($names) - 1],
        ];
    }

    public function formatAuthorName(string $author)
    {
        return implode(', ', $this->getNames($author));
    }

    public function getApaAsArray()
    {
        $data = array_filter([
            ...$this->getAuthor(),
            'date' => $this->getDate(),
            'title' => $this->getTitle(),
            'place' => $this->getPlace(),
            'publisher' => $this->getPublisher(),
            'url' => $this->url
        ], fn ($v) => $v);

        return $data;
    }

    public function getApa()
    {
        return trim(implode(
            ' ',
            $this->getApaAsArray()
        ), " .") . ". {$this->getUrl()}";
    }
}
