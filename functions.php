<?
/**
 * Вывод $debug_data в консоль браузера
 *
 * @param $debug_data
 */
function console_log($debug_data) {
    $js = is_array($debug_data) ? json_encode($debug_data) : '"'.$debug_data.'"' ;
    ?><script type="text/javascript">console.log(<?=$js?>)</script><?
}


/**
 * print_r обёрнутая тегом pre
 *
 * @param $debug_data
 */
function p($debug_data) {
    ?><pre><?print_r($debug_data)?></pre><?
}


/**
 * Вариант функции strpos(), где искомое значение может быть массивом любой вложенности
 *
 * @param $haystack
 * @param $needles
 * @return int
 */
function strpos_array($haystack, $needles) {
    if ( is_array($needles) ) {
        foreach ($needles as $str) {
            if ( is_array($str) ) {
                $pos = strpos_array($haystack, $str);
            } else {
                $pos = strpos($haystack, $str);
            }
            if ($pos !== FALSE) {
                return $pos;
            }
        }
    } else {
        return strpos($haystack, $needles);
    }

    return false;
}


/**
 * Функция заменяет ключ массива на другой
 *
 * @param $key
 * @param $new_key
 * @param $arr
 * @param bool $rewrite
 * @return bool
 */
function arrayChangeKey($key,$new_key,&$arr,$rewrite=true){
    if(!array_key_exists($new_key,$arr) || $rewrite){
        $arr[$new_key]=$arr[$key];
        unset($arr[$key]);
        return true;
    }
    return false;
}


/**
 * Конвертирует переносы строк в windows-понятные
 *
 * @param string $string
 * @return string
 */
function normalizeLine($string) {
    // Replace all the CRLF ending-lines by something uncommon
    $DontReplaceThisString = "\r\n";
    $specialString = "!£#!Dont_wanna_replace_that!#£!";
    $string = str_replace($DontReplaceThisString, $specialString, $string);

    // Convert the CR ending-lines into CRLF ones
    $string = str_replace("\r", "\r\n", $string);

    // Replace all the CRLF ending-lines by something uncommon
    $string = str_replace($DontReplaceThisString, $specialString, $string);

    // Convert the LF ending-lines into CRLF ones
    $string = str_replace("\n", "\r\n", $string);

    // Restore the CRLF ending-lines
    $string = str_replace($specialString, $DontReplaceThisString, $string);

    // Update the file contents
    return $string;
}


/**
 * Определяет мобильное устройство
 * @return bool
 */
function mobile_detect()
{
    $request_true = $_REQUEST['mobile'] === 'Y';
    $useragent_true =
        preg_match('/ipad|(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$_SERVER['HTTP_USER_AGENT']) ||
        preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($_SERVER['HTTP_USER_AGENT'],0,4)) ||
        preg_match('/(lenovo\sB[0-9]+)|yoga\stablet/i', $_SERVER['HTTP_USER_AGENT']);
    if($request_true || $useragent_true)
        return true;
    else
        return false;
}


/**
 * true если на сайте поисковый робот
 *
 * @return bool
 */
function isBot(){
    $bots = array(
        'rambler','googlebot','aport','yahoo','msnbot','turtle','mail.ru','omsktele',
        'yetibot','picsearch','sape.bot','sape_context','gigabot','snapbot','alexa.com',
        'megadownload.net','askpeter.info','igde.ru','ask.com','qwartabot','yanga.co.uk',
        'scoutjet','similarpages','oozbot','shrinktheweb.com','aboutusbot','followsite.com',
        'dataparksearch','google-sitemaps','appEngine-google','feedfetcher-google',
        'liveinternet.ru','xml-sitemaps.com','agama','metadatalabs.com','h1.hrn.ru',
        'googlealert.com','seo-rus.com','yaDirectBot','yandeG','yandex',
        'yandexSomething','Copyscape.com','AdsBot-Google','domaintools.com',
        'Nigma.ru','bing.com','dotnetdotcom'
    );
    foreach($bots as $bot) {
        if(stripos($_SERVER['HTTP_USER_AGENT'], $bot) !== false){
            return true;
        }
    }

    return false;
}


/**
 * Функция подготавливает строку к адресной. Транслитерирует и убирает всё лишнее
 *
 * @param $string
 * @return mixed|string
 */
function strToAliasUrl($string) {
    // преобразуем специальные HTML-сущности в соответствующие символы
    $string = htmlentities($string, ENT_QUOTES, "UTF-8");
    $a = array('&Agrave;'=>'A','&#192;'=>'A','&Aacute;'=>'A','&#193;'=>'A','&Acirc;'=>'A','&#194;'=>'A','&Atilde;'=>'A','&#195;'=>'A','&Auml;'=>'A','&#196;'=>'A','&Aring;'=>'A','&#197;'=>'A','&AElig;'=>'AE','&#198;'=>'AE','&Ccedil;'=>'C','&#199;'=>'C','&Yacute;'=>'Y','&#221;'=>'Y','&ETH;'=>'D','&#208;'=>'D','&Ntilde;'=>'N','&#209;'=>'N','&Egrave;'=>'E','&#200;'=>'E','&Eacute;'=>'E','&#201;'=>'E','&Ecirc;'=>'E','&#202;'=>'E','&Euml;'=>'E','&#203;'=>'E','&Igrave;'=>'I','&#204;'=>'I','&Iacute;'=>'I','&#205;'=>'I','&Icirc;'=>'I','&#206;'=>'I','&Iuml;'=>'I','&#207;'=>'I','&Ograve;'=>'O','&#210;'=>'O','&Oacute;'=>'O','&#211;'=>'O','&Ocirc;'=>'O','&#212;'=>'O','&Otilde;'=>'O','&#213;'=>'O','&Ouml;'=>'O','&#214;'=>'O','&Ugrave;'=>'U','&#217;'=>'U','&Uacute;'=>'U','&#218;'=>'U','&Ucirc;'=>'U','&#219;'=>'U','&Uuml;'=>'U','&#220;'=>'U','&agrave;'=>'a','&#224;'=>'a','&aacute;'=>'a','&##225;'=>'a','&acirc;'=>'a','&##226;'=>'a','&atilde;'=>'a','&#227;'=>'a','&auml;'=>'a','&#228;'=>'a','&aring;'=>'a','&#229;'=>'a','&aelig;'=>'ae','&#230;'=>'ae','&egrave;'=>'e','&#232;'=>'e','&eacute;'=>'e','&#233;'=>'e','&ecirc;'=>'e','&#234;'=>'e','&euml;'=>'e','&#235;'=>'e','ё'=>'e','&igrave;'=>'i','&#236;'=>'i','&iacute;'=>'i','&#237;'=>'i','&icirc;'=>'i','&#238;'=>'i','&iuml;'=>'i','&#239;'=>'i','&ograve;'=>'o','&#242;'=>'o','&oacute;'=>'o','&#243;'=>'o','&ocirc;'=>'o','&#244;'=>'o','&otilde;'=>'o','&#245;'=>'o','&ouml;'=>'o','&#246;'=>'o','&ugrave;'=>'u','&#249;'=>'u','&uacute;'=>'u','&#250;'=>'u','&ucirc;'=>'u','&#251;'=>'u','&uuml;'=>'u','&#252;'=>'u','&yacute;'=>'y','&#253;'=>'y','&yuml;'=>'y','&#255;'=>'y','&ntilde;'=>'n','&#241;'=>'n','&ccedil;'=>'c','&#231;'=>'c','&ndash;'=>'-','&#8211;'=>'-','&mdash;'=>'-','&#8212;'=>'-','&oline;'=>'-','&#8254;'=>'-');
    $string = strtr($string, $a);

    // переводим в строчные, убираем теги и пробелы/дефисы по краям
    $string = trim(mb_strtolower(strip_tags($string), 'utf8'));
    $string = trim($string, '-');

    // удаляем прочие символы-сущности, которые по какии-либо причинам не отфильтровались выше
    $string = preg_replace('/&[a-zA-Z0-9#]+\;/', '', $string);

    // транслируем
    $tr = array("а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d","е"=>"e","ё"=>"e","ж"=>"j","з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l","м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h","ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y","ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya");
    $string = strtr($string,$tr);

    // разрешенные символы, убираем те, что отсутствуют в этом списке
    $new_name = '';
    $mix = array('q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m','0','1','2','3','4','5','6','7','8','9','-',' ');
    for($i=0; $i<=strlen($string)-1; $i++) {
        $j = substr($string,$i,1);
        if (in_array($j, $mix)) {
            $new_name .= $j;
        }
    }
    $string = $new_name;

    // убираем подряд идущие пробелы и дефисы
    $string = preg_replace("/\\s+/", ' ', $string);
    $string = preg_replace("/-+/",   '-', $string);

    // заменяем пробелы на дефисы
    $string = str_replace(array(' - ', '- ', ' -', ' ', '_', '—'), '-', $string);
    $string = trim($string, ' ');
    $string = trim($string, '-');

    return $string;
}


/**
 * Функция удаляет все атрибуты в html-коде
 *
 * @param $string
 * @return mixed
 */
function removeAllAttr($string) {
    return preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $string);
}


/**
 * Функция преобразует первый символ строки в верхний регистр
 *
 * @param $string
 * @param string $encoding
 * @return string
 */
function stringToUpperFirst($string, $encoding='UTF-8') {
    $string = mb_ereg_replace('^[\ ]+', '', $string);
    $string = mb_strtoupper(mb_substr($string, 0, 1, $encoding), $encoding).
        mb_substr($string, 1, mb_strlen($string), $encoding);
    return $string;
}


/**
 * Обрамляем абзацы текста в тег <p>
 *
 * @param $string
 * @return string
 */
function paragraphToTag($string) {
    $res = '';
    $a = explode("\n", $string);
    foreach($a as $val) {
        $val = str_replace("\r", "", $val);
        if (strlen($val) > 1) {
            $res .= '<p>'.$val.'</p>'."\n";
        }
    }
    return $res;
}


/**
 * Генерация кода из цифр и букв в нижнем и верхнем регистрах
 *
 * @param integer $len
 * @return string
 */
function randHardCode($len) {
    $arSymbols = array(
        "a","b","c","d","e","f","g","h","j","k","l","m","n","p","q","r","s","t","u","v","w","x","y","z",
        "A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z",
        0,1,2,3,4,5,6,7,8,9
    );
    $code = '';
    for($i = 0; $i < $len; $i++) {
        $a = rand(0, 57);
        $code = $code.$arSymbols[$a];
    }
    return $code;
}


/**
 * Генерация кода из цифр и букв нижнего регистра
 *
 * @param integer $len
 * @return string
 */
function randEasyCode($len) {
    $arSymbols = array("a","b","c","d","e","f","g","h","j","k","l","m","n","p","q","r","s","t","u","v","w","x","y","z",0,1,2,3,4,5,6,7,8,9);
    $code = '';
    for($i = 0; $i < $len; $i++) {
        $a = rand(0, 33);
        $code = $code.$arSymbols[$a];
    }
    return $code;
}


/**
 * Class Filter_BBCode
 */
class Filter_BBCode {
    protected $codes = array(
        "\n"    => '<br />',
        '[b]'   => '<strong>',
        '[/b]'  => '</strong>',
        '[i]'   => '<i>',
        '[/i]'  => '</i>',
        '[u]'   => '<u>',
        '[/u]'  => '</u>'
    );

    public function filter($string) {
        $v = str_ireplace(array_flip($this->codes), $this->codes, $string);

        // links
        $p = '/(http:\/\/|https:\/\/)?([a-zA-Z0-9]+[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}([\/a-zA-Z0-9\-_\?%&=]+)?)/';
        $r = '<a href="http://$2" target="_blank">$1$2</a>';
        $v = preg_replace($p, $r, $v);

        return $v;
    }

    public function Decode($string) {
        $v = str_ireplace($this->codes, array_flip($this->codes), $string);
        $v = preg_replace('/<a href="(.*)" target="_blank">(.*)<\/a>/', '$2', $v);
        return $v;
    }
}


/**
 * Рекурсвная смена прав для файлов и папок. Функция взята из курса Битрикс "Администратор. Базовый"
 *
 * @param $path
 */
function chmod_R($path) {
    $BX_FILE_PERMISSIONS = 0644;
    $BX_DIR_PERMISSIONS = 0755;

    $handle = opendir($path);
    while ( false !== ($file = readdir($handle)) ) {
        if ( ($file !== ".") && ($file !== "..") ) {
            if ( is_file($path."/".$file) ) {
                chmod($path . "/" . $file, $BX_FILE_PERMISSIONS);
            }
            else {
                chmod($path . "/" . $file, $BX_DIR_PERMISSIONS);
                chmod_R($path . "/" . $file);
            }
        }
    }
    closedir($handle);
}