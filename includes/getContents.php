<?php	
require_once "MediaExtracterHandler.php";

if (isset($_GET['url']) && !empty($_GET['url']) && isset($_GET['type']) && $_GET['type'] == 'get') {
    $extracter = new MediaExtracterHandler();
    $data = $extracter->getDetails($_GET['url']);
    $res = array();
    if (!empty($data)) {
        $res = $data;
    }
    header('Content-Type: application/json');
    echo json_encode($res, true);
} elseif (isset($_POST['message']) && isset($_POST['type']) && $_POST['type'] == 'post') {
    $url = validateUrl($_POST['message']);
    if (!empty($url)) {
        $extracter = new MediaExtracterHandler();
        $data = $extracter->getDetails($url);
        $data['selected'] = ($data['type'] === 'url' && !empty($_POST['current_image'])) ? $_POST['current_image'] : 0;
        echo template($data);
    }
} else {
    die('Url cannot be empty');
}

function validateUrl($content)
{
    $pattern = '/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i';
    preg_match($pattern, $content, $match);
    if (!empty($match)) {
        return $match[0];
    }
    return false;
}
function template($data)
{
    $html = '';
    $html .= '<div class="panel panel-default panel-custom"><div class="panel-heading">
            <img src="http://0.gravatar.com/avatar/43a5669f2e4d2342701ed560d453a0dd?s=45&d=&r=G" class="pull-left" alt="Azhagu">
            <h3>Azhagu</h3>
            <h5><span>Shared publicly</span> </h5>
        </div>';
    $html .= '<div class="panel-body">';
    $html .= '<div class="media well">';
    if (!empty($data['images']) && $data['type'] == 'url') {
        $html .= '<a class="pull-left" href="'.$data['url'].'" target="_blank">
                <img src="'.$data['images'][$data['selected']-1].'" class="media-object" style="width: 100px; height: 80px;" alt="">
              </a>';
    }

    if (!empty($data['type']) && $data['type'] == 'video') {
        $html .= '<a class="'.$data['provider'].' pull-left" href="'.$data['url'].'">
                <img src="'.$data['video']['thumbnail'].'" class="media-object" style="width: 100px; height: 80px;" alt="">
              </a>';
    }

    if (!empty($data['type']) && $data['type'] == 'image') {
        $html .= '<a href="'.$data['url'].'" target="_blank">
                <img src="'.$data['images'][0].'" class="img-responsive"  alt="">
              </a>';
    }

    $html .= '<div class="media-body">
                        <a href="'.$data['url'].'" target="_blank">
                            <h4 class="media-heading">'.$data['title'].'</h4>
                        </a>
                        '.$data['description'].'
                      </div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    return $html;
}
