# RelatedWord
Get related words through wikipedia.

[Demo](http://demo-laravel52.capilano-fw.com/related_words)

# Installation

Execute the following composer command.

    composer require sukohi/related-word:1.*

# Usage

    $related_word = new \Sukohi\RelatedWord\RelatedWord();
    $related_word->setTag('PHP');       // Required
    $related_word->setLocale('ja');     // Optional
    $related_word->setLimit(15);        // Optional
    $related_word->setMinCount(5);      // Optional
    $keywords = $related_word->get();

# Methods

+ setTag($keyword)

A keyword you'd like to get related words from.(Required)

+ setLocale($locale)

Your locale.(Default is `en`)(Optional)

+ setLimit($limit)

The number of keywords that you will get at most.(Optional)

+ setMinCount($count)

You can get keywords if each keyword appear over $count.(Optional)

# License

This package is licensed under the MIT License.  
Copyright 2016 Sukohi Kuhoh