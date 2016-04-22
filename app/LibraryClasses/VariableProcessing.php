<?php namespace App\LibraryClasses;

class VariableProcessing {
	public function transliterate($input) {
        $gost = array(
            "Є" => "YE", "І" => "I", "Ѓ" => "G", "і" => "i", "№" => "-", "є" => "ye", "ѓ" => "g",
            "А" => "A", "Б" => "B", "В" => "V", "Г" => "G", "Д" => "D",
            "Е" => "E", "Ё" => "YO", "Ж" => "ZH",
            "З" => "Z", "И" => "I", "Й" => "J", "К" => "K", "Л" => "L",
            "М" => "M", "Н" => "N", "О" => "O", "П" => "P", "Р" => "R",
            "С" => "S", "Т" => "T", "У" => "U", "Ф" => "F", "Х" => "X",
            "Ц" => "C", "Ч" => "CH", "Ш" => "SH", "Щ" => "SHH", "Ъ" => "'",
            "Ы" => "Y", "Ь" => "", "Э" => "E", "Ю" => "YU", "Я" => "YA",
            "а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d",
            "е" => "e", "ё" => "yo", "ж" => "zh",
            "з" => "z", "и" => "i", "й" => "j", "к" => "k", "л" => "l",
            "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
            "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "x",
            "ц" => "c", "ч" => "ch", "ш" => "sh", "щ" => "shh", "ъ" => "",
            "ы" => "y", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
            " " => "-", "," => "_", "!" => "_", "@" => "_",
            "#" => "-", "$" => "", "%" => "", "^" => "", "&" => "", "*" => "",
            "(" => "", ")" => "", "+" => "", "=" => "", ";" => "", ":" => "",
            ".jpg" => "", ".jpeg" => "", "/" => "-"
        );
        $input = trim($input, "\x00..\x1F");
        $input = trim($input, "-");
        $input = trim($input, "_");
        return strtr($input, $gost);
    }
    public function requestProcessing($input) {
        if(isset($input->files[0])&&$input->images != ""){
            $images = array_merge($input->images, $input->files);
            $input->images = implode(",", $images);
        }
        elseif($input->images != "") {
            $input->images = implode(",", $input->images);
        }
        elseif(isset($input->files[0])) {
            $images = $input->files;
            $input->images = implode(",", $images);
        }
        if(isset($input->cats[0])){
            $input->cats = implode(',', $input->cats);
        }
        if(isset($input->attrs[0])){
            $input->attrs = implode(',', $input->attrs);
        }
        if($input->sku == ""){
            $input->sku = 'sku-'.md5($input->title);
        }
        $input->slug = $this->transliterate($input->slug);
        return $input;
    }

}
