<?php namespace Sukohi\RelatedWord\Locales;

class RelatedWordJa {

    public function isAvailable($tag) {

        if (strpos($tag, ':') !== false) {

            return false;

        } else if(preg_match('|^[0-9]{4}年[0-9]{1,2}月[0-9]{1,2}日$|u', $tag)) {

            return false;

        } else if(preg_match('|^[0-9]{1,2}月[0-9]{1,2}日$|u', $tag)) {

            return false;

        } else if(preg_match('|^[0-9]{4}年$|u', $tag)) {

            return false;

        }

        return true;

    }

}