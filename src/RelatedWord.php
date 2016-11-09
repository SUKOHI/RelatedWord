<?php namespace Sukohi\RelatedWord;

class RelatedWord {

    private $_tag = '',
            $_locale = 'en';
    private $_limit = 15,
        $_min_count = 3;

    public function setTag($tag) {

        $this->_tag = $tag;

    }

    public function setLimit($limit) {

        $this->_limit = $limit;

    }

    public function setMinCount($count) {

        $this->_min_count = $count;

    }

    public function setLocale($locale) {

        $this->_locale = $locale;

    }

    public function get() {

        try {

            $url = 'https://'. $this->_locale .'.wikipedia.org/w/index.php';
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $url, [
                'query' => [
                    'search' => $this->_tag
                ]
            ]);

        } catch (\Exception $e) {

            return collect();

        }

        $body = $response->getBody();
        $keywords = [];

        if(preg_match_all('|<a href="/wiki/[^"]+" title="([^"]+)">|', $body, $matches)) {

            $count = count($matches[0]);

            for ($i = 0; $i < $count; $i++) {

                $tag = $matches[1][$i];

                if ($this->isAvailable($tag)) {

                    $tag = preg_replace('| \(.*|u', '', $tag);

                    if (isset($keywords[$tag])) {

                        $keywords[$tag] = [
                            'count' => ($keywords[$tag]['count'] + 1)
                        ];

                    } else {

                        $keywords[$tag] = [
                            'count' => 1
                        ];

                    }

                }

            }

            $keywords = collect($keywords)->sortByDesc('count')
                ->take($this->_limit)
                ->filter(function($value, $key) {

                    return $value['count'] >= $this->_min_count;

                });
            return $keywords->keys();

        }

    }

    private function isAvailable($tag) {

        $class = '\Sukohi\RelatedWord\Locales\RelatedWord'. ucfirst($this->_locale);

        if(class_exists($class)) {

            $available_obj = new $class;
            return $available_obj->isAvailable($tag);

        }

        return true;

    }

}