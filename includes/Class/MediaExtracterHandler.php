<?php

class MediaExtracterHandler
{
    private static $providers = array(
        "imgur" => '/https?:\/\/[w\.]*imgur\.[^\/]*\/([^?]*)/is',
        "flickr" => '/https?:\/\/[w\.]*flickr\.com\/photos\/([^?]*)/is',
        "twitpic" => '/https?:\/\/[w\.]*twitpic\.com\/([^?]*)/is',
        "deviantart" => '/https?:\/\/[^\/]*\.*deviantart\.[^\/]*\/([^?]*)/is',
        "instagram" => '/https?:\/\/[w\.]*instagram\.[^\/]*\/([^?]*)/is',
        "youtube" => '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/',
        "vimeo" => '/^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/',
        "dailymotion" => '/^.+dailymotion.com\/(video|hub)\/([^_]+)[^#]*(#video=([^_&]+))?/',
        "metacafe" => '/^.*(metacafe\.com)(\/watch\/)(\d+)(.*)/i',
        "soundcloud" => '/^https?:\/\/(soundcloud\.com|snd\.sc)\/(.*)$/is',
        "url" => '/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'
    );

    private static $providerUrl = array(
        "imgur" => 'http://api.imgur.com/oembed/?format=json&url=%s',
        "flickr" => 'http://www.flickr.com/services/oembed/?format=json&maxwidth=800&maxheight=800&url=%s',
        "twitpic" => '',
        "deviantart" => 'http://backend.deviantart.com/oembed?format=json&thumbnail_width=500&thumbnail_height=380&url=%s',
        "instagram" => 'https://api.instagram.com/oembed/?format=json&maxwidth=600&maxheight=600&url=%s',
        "soundcloud" => 'https://soundcloud.com/oembed?url=%s&format=json'
    );

    private static $providerVideoDetails = array(
        'youtube' => 'https://www.youtube.com/oembed?url=%s&format=json',
        'vimeo' => 'http://vimeo.com/api/v2/video/%s.json',
        'metacafe' => 'http://www.metacafe.com/api/item/%s',
        'dailymotion' => 'https://api.dailymotion.com/video/%s?fields=id,title,thumbnail_480_url,description'
    );
    
    private $url;

    public function getDetails($url)
    {
        $this->url = $url;
        $response = array();
        $response['title'] = '';
        $response['description'] = '';
        $response['url'] = $this->url;
        $response['urlHost'] = getHost($response['url']);
        $response['url'] = $response['url'];
        $provider = $this->getProviderType($this->url);
        $provideName = array_keys($provider);
        switch ($provideName[0]) {
            case 'url':
                $content = $this->parseURLContent($this->url);
                $res = $this->parseHTMLContent($content);
                $res['url'] = $this->url;
                $res['urlHost'] = getHost($res['url']);
                return $res;
                break;
            case 'youtube':
                $response['type'] = 'video';
                $vdetails = $this->getVideoDetails($url, $provideName[0]);
                $response['video'] = array();
                if (!empty($vdetails)) {
                    $vdata = json_decode($vdetails, true);
                    $response['title'] = $vdata['title'];
                    $response['description'] = $vdata['title'];
                    $response['provider'] = $provideName[0];
                    $response['video']['thumbnail'] = get_youtube_thumbnail($url);
                }
                break;
            case 'vimeo':
                $response['type'] = 'video';
                $vid = $this->getProviderVideoId($url, $provideName[0]);
                $vdetails = $this->getVideoDetails($vid, $provideName[0]);
                if (!empty($vdetails)) {
                    $vdata = json_decode($vdetails, true);
                    $response['title'] = $vdata[0]['title'];
                    $response['description'] = $vdata[0]['description'];
                    $response['provider'] = $provideName[0];
                    $response['video']['id'] = $vdata[0]['id'];
                    $response['video']['thumbnail'] = $vdata[0]['thumbnail_large'];
                }
                break;
            case 'dailymotion':
                $response['type'] = 'video';
                $vid = $this->getProviderVideoId($url, $provideName[0]);
                $vdetails = $this->getVideoDetails($vid, $provideName[0]);
                if (!empty($vdetails)) {
                    $vdata = json_decode($vdetails, true);
                    $response['title'] = $vdata['title'];
                    $response['description'] = $vdata['description'];
                    $response['provider'] = $provideName[0];
                    $response['video']['id'] = $vdata['id'];
                    $response['video']['thumbnail'] = $vdata['thumbnail_480_url'];
                }
                break;
            case 'metacafe':
                $response['type'] = 'video';
                    $metacafe =  metacafe_video_details($url);
                    $data = get_meta($url);
                    $response['title'] = $data['description'];
                    $response['provider'] = $provideName[0];
                    $response['description'] = $data['description'];
                    $response['video']['id'] = $metacafe['id'];
                    $response['video']['thumbnail'] = $data['image'];
                break;
            case 'twitpic':
                $response['type'] = 'image';
                $response['images'][0] = sprintf('http://twitpic.com/show/large/%s.jpg', $provider[$provideName[0]]);
                break;
            case 'soundcloud':
                $detailsUrl = sprintf(self::$providerUrl[$provideName[0]], $this->url);
                $data = $this->getProviderDetails($detailsUrl);
                $response['title'] = !empty($data['title']) ? $data['title'] : '';
                $response['provider'] = 'souncloud';
                $response['description'] = !empty($data['description']) ? $data['description'] : '';
                $response['video']['thumbnail'] = $data['thumbnail_url'];
                $response['type'] = 'video';
                break;
            case 'instagram':
                $detailsUrl = sprintf(self::$providerUrl[$provideName[0]], $this->url);
                $data = $this->getProviderDetails($detailsUrl);
                $response['title'] = !empty($data['title']) ? $data['title'] : '';
                $response['images'][0] = $data['thumbnail_url'];
                $response['type'] = 'image';
                break;
            default:
                $detailsUrl = sprintf(self::$providerUrl[$provideName[0]], $this->url);
                $data = $this->getProviderDetails($detailsUrl);
                $response['title'] = !empty($data['title']) ? $data['title'] : '';
                $response['images'][0] = $data['url'];
                $response['type'] = 'image';
                break;
        }
        $response['description'] = $this->limitText($response['description'], 15);
        return $response;
    }

    private function getProviderDetails($providerUrl)
    {
        $json_response = $this->parseURLContent($providerUrl);
        $response = json_decode($json_response, true);
        if (is_array($response) && !empty($response)) {
            return $response;
        }
        return false;
    }

    private function getVideoDetails($vid, $provider)
    {
        $url = self::$providerVideoDetails[$provider];
        $providerUrl = sprintf($url, $vid);
        return $this->parseURLContent($providerUrl);
    }

    private function getProviderVideoId($url, $provider)
    {
        $videoId = '';
        switch ($provider) {
            case 'youtube':
                $queryString = array();
                parse_str(parse_url($url, PHP_URL_QUERY), $queryString);
                if (empty($queryString)) {
                    $segments = parse_url($url, PHP_URL_PATH);
                    $videoId = substr($segments, 1);
                } else {
                    $videoId = $queryString["v"];
                }
                break;
            case 'vimeo':
                $videoId = (int) substr(parse_url($url, PHP_URL_PATH), 1);
                break;
            case 'dailymotion':
                $videoId = strtok(basename($url), '_');
                break;
            case 'metacafe':
                $path = parse_url($url, PHP_URL_PATH);
                $pieces = explode('/', $path);
                $videoId = $pieces[2];
                break;
            default:
                break;
        }
        return $videoId;
    }

    private function getProviderType($url)
    {
        $providerDetail = array();
        $patterns = self::$providers;
        foreach ($patterns as $provider => $pattern) {
            preg_match($pattern, $url, $match);
            if (!empty($match)) {
                $providerDetail[$provider] = !empty($match[1]) ? $match[1] : '';
                return $providerDetail;
            }
        }
        return false;
    }

    private function parseHTMLContent($content)
    {
        $data = [];
        $dom = new \DOMDocument();
        @$dom->loadHTML($content);
        $x = new \DOMXPath($dom);
        $data['title'] = $this->getTitleHtml($x);
        $data['type'] = 'url';
        $data['description'] = $this->getDescriptionHtml($x);
        $data['images'] = [];
        $images = $x->query("//img");
        if ($images->length > 0) {
            foreach ($images as $key => $imgNode) {
                $url = $imgNode->getAttribute('src');
                if (filter_var($url, FILTER_VALIDATE_URL)) {
                    array_push($data['images'], $url);
                }
            }
        }
        return $data;
    }

    private function getTitleHtml($dom)
    {
        $title = '';
        $titleDom = $dom->query("//title");
        if ($titleDom->length > 0) {
            $title = $titleDom->item(0)->nodeValue;
        }
        return $title;
    }

    private function getDescriptionHtml($dom)
    {
        $description = '';
        $descriptionDom = $dom->query("//meta[contains(@property, 'description') or contains(@name, 'description')]");
        if ($descriptionDom->length > 0) {
            $description = $this->limitText($descriptionDom->item(0)->getAttribute('content'), 45);
        }
        return $description;
    }

    private function parseURLContent($url)
    {
        $ch = curl_init();
        $timeout = 20;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $data = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode === 200) {
            return $data;
        }
        return false;
    }

    private function limitText($text, $limit)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }
}
