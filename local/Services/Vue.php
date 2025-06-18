<?php

namespace Services;

use Bitrix\Main\Page\Asset;

class Vue
{

    public static function fileJs($fileJs)
    {
        if($GLOBALS['fileJs'] && in_array($fileJs, $GLOBALS['fileJs'])){
           return false;
        }
        $GLOBALS['fileJsOnce'][] = $fileJs;

        $fileVueComponent = self::createFileInclude($fileJs);

        self::initJs();

        $js = "<script type='text/javascript'>
            document.addEventListener('DOMContentLoaded', function() {
                if(window.mountedJs){
                      window.mountedJs('{$fileVueComponent}')
                }
            });
          </script>";

        Asset::getInstance()->addString($js);
    }

    public static function file($fileVue, $data = false, $textLoader = '...', $isReturnHtml = false){

        $fileVueComponent = self::createFileInclude($fileVue);

        $dataParams = '';
        if($data){
            foreach ($data as $nameParams => $itemData){

                $dataParams .= "data-{$nameParams}='" . htmlspecialchars(
                    json_encode($itemData,JSON_UNESCAPED_UNICODE)
                        , ENT_QUOTES, 'UTF-8')."' ";
            }
        }

        $html =  "<div data-vue-file='{$fileVueComponent}' $dataParams>$textLoader</div>";

        self::initJs();

        if($isReturnHtml){
            return $html;
        }

        echo $html;

    }

    public static function createFileInclude($fileVue)
    {
        $fileVueComponent = str_replace('/','_',$fileVue);
        $fileVueInclude = $_SERVER["DOCUMENT_ROOT"] . "/local/js/vue/" . $fileVueComponent . ".js";

        if(!file_exists($fileVueInclude)){

            if(!file_exists($_SERVER["DOCUMENT_ROOT"] . "/local/" . $fileVue)){
                echo "НЕТ ФАЙЛА: ROOT/local/" . $fileVue;
                exit();
            }

            $jsContent = "export default () => { return import ('../../$fileVue')}";
            if(!file_put_contents($fileVueInclude, $jsContent)){
                echo "Не создался файл: $fileVueInclude";
                exit();
            }

        }

        return $fileVueComponent;
    }

    public static function getHot(){
        $file = $_SERVER['DOCUMENT_ROOT']."/local/dist/hot";
        if (file_exists($file)){
            return file_get_contents($file);
        }
        return false;
    }

    public static function initJs()
    {

        $hot = self::getHot();

        if(!$hot){
            $manifestFile = $_SERVER['DOCUMENT_ROOT'].'/local/dist/manifest.json';
            $fileDataJson = file_get_contents($manifestFile);
            $data = json_decode($fileDataJson, true);
            echo "
                <link rel='stylesheet' href='/local/dist/{$data['css/main.scss']['file']}'>
                <script type='module' src='/local/dist/{$data['js/main.js']['file']}'></script>
            ";
            if(isset($data['js/main.js']['css'])){
                foreach ($data['js/main.js']['css'] as $item){
                    echo "  <link rel='stylesheet' href='/local/dist/{$item}'>";
                }
            }
        }else{
            echo "
                <script type='module' src='$hot/@vite/client'></script>
                <link rel='stylesheet' href='$hot/css/main.scss'>
                <script type='module' src='$hot/js/main.js'></script>
            ";
        }

    }
}
