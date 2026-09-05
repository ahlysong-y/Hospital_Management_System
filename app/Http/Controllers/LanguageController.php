<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * ផ្លាស់ប្តូរភាសាប្រព័ន្ធ (Switch application locale)
     */
    public function switch($locale)
    {
        if (in_array($locale, ['km', 'en', 'zh', 'ja', 'ko'])) {
            session(['locale' => $locale]);
        }

        return redirect()->back();
    }
}
