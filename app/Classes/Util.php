<?php

namespace App\Classes;
use Illuminate\Support\Facades\Storage;

class Util{
    
    public static function convertYoutube($string){
        return preg_replace(
            "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
            "<iframe width=\"350\" height=\"200\" src=\"//www.youtube.com/embed/$2\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>",
            $string
        );
    }

    public static function convertStringToDate($string){
        $year = substr($string, 0, 4);
        $month = substr($string, 4, 2);
        $day = substr($string, 6, 2);

        return $day . "/" . $month . "/" . $year;
    }

    public static function convertDateToString($string){
        $year = substr($string, 6, 4);
        $month = substr($string, 3, 2);
        $day = substr($string, 0, 2);

        return $year . "-" . $month . "-" . $day;
    }

    public static function limparString($string) {
        $string = str_replace(' ', '', $string); // Remove espaços
     
        return preg_replace('/[^A-Za-z0-9]/', '', $string); // Remove caracteres especiais
     }

     public static function limparLivewireTemp(){
         $storage = Storage::disk('local');
         foreach($storage->allFiles('livewire-tmp') as $filePathname){
            $stamp = now()->subSeconds(4)->timestamp;
            if($stamp > $storage->lastModified($filePathname)){
                $storage->delete($filePathname);
            }
         }
     }

     public static function processa_editor($id, $conteudo, $caminho)
    {
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML(
            mb_convert_encoding($conteudo, 'HTML-ENTITIES', 'UTF-8'),
            LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
        );

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                if (!is_dir($caminho)) {
                    mkdir($caminho);
                }
                $mimeType = $groups['mime'];
                if (!is_dir($caminho)) {
                    mkdir($caminho);
                }
                $path = $caminho . uniqid('', true) . '.' . $mimeType;

                Image::make($src)
                    ->encode($mimeType, 80)
                    ->save(public_path($path));

                $image->removeAttribute('src');
                $image->setAttribute('src', asset($path));
            }
        }

        return $dom->saveHTML();
    }

}

?>
