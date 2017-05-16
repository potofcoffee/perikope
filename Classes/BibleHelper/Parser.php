<?php
/*
 * perikope
 *
 * Copyright (c) 2017 Christoph Fischer, chris@toph.de 
 * http://christoph-fischer.org
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


namespace Peregrinus\Perikope\BibleHelper;


class Parser
{

    static private $bookMatches = [
        'Gen' => [
            'no' => 1,
            'regex' => '/((?:1\.?\s?Mos?e?\.?)|(?:Gen(?:(?:esis?)|\.?))\s+)/',
        ],
        'Exod' => [
            'no' => 2,
            'regex' => '/((?:2\.?\s?Mos?e?\.?)|(?:Ex(?:o(d(us)?)?)?\.?)\s+)/',
        ],
        'Lev' => [
            'no' => 3,
            'regex' => '/((?:3\.?\s?Mos?e?\.?)|(?:Le(?:v(iticus?)?)?\.?)\s+)/',
        ],
        'Num' => [
            'no' => 4,
            'regex' => '/((?:4\.?\s?Mos?e?\.?)|(?:Nu(?:m(eri?)?)?\.?)\s+)/',
        ],
        'Deut' => [
            'no' => 5,
            'regex' => '/((?:5\.?\s?Mos?e?\.?)|(?:De(u(t(eronomium)?)?)?\.?)\s+)/',
        ],
        'Josh' => [
            'no' => 6,
            'regex' => '/Jos(\.|(ua))?\s+/',
        ],
        'Judg' => [
            'no' => 7,
            'regex' => '/Ri(c(h(ter)?)?)?\.?\s+/',
        ],
        'Ruth' => [
            'no' => 8,
            'regex' => '/Ru?th?\.?\s+/',
        ],
        '1Sam' => [
            'no' => 9,
            'regex' => '/1\.? ?Sa(m(uel)?)?\.?\s+/',
        ],
        '2Sam' => [
            'no' => 10,
            'regex' => '/2\.? ?Sa(m(uel)?)?\.?\s+/',
        ],
        '1Kgs' => [
            'no' => 11,
            'regex' => '/1\.? ?K(ö(ni?)?)?(ge?)?\.?\s+/',
        ],
        '2Kgs' => [
            'no' => 12,
            'regex' => '/2\.? ?K(ö(ni?)?)?(ge?)?\.?\s+/',
        ],
        '1Chr' => [
            'no' => 13,
            'regex' => '/1\.? ?Ch(r(on(ika?)?)?)?\.?\s+/',
        ],
        '2Chr' => [
            'no' => 14,
            'regex' => '/2\.? ?Ch(r(on(ika?)?)?)?\.?\s+/',
        ],
        'Ezra' => [
            'no' => 15,
            'regex' => '/Esr(a|\.)?\s+/',
        ],
        'Neh' => [
            'no' => 16,
            'regex' => '/Neh((emia)|\.)?\s+/',
        ],
        'Esth' => [
            'no' => 17,
            'regex' => '/Esth?((er)|\.)?\s+/',
        ],
        'Job' => [
            'no' => 18,
            'regex' => '/H?(ij?|j)ob\s+/',
        ],
        'Ps' => [
            'no' => 19,
            'regex' => '/Ps(a(l((m(en)?)|(ter)))?)?\.?\s+/',
        ],
        'Prov' => [
            'no' => 20,
            'regex' => '/Spr(((ü|ue)che)|\.)?\s+/',
        ],
        'Eccl' => [
            'no' => 21,
            'regex' => '/((Qu?oh(elet)?)|(Koh(elet)?)|(Pre?d(iger)?( Salomos?)?)|(Eccl(esiastes)?))\.?\s+/',
        ],
        'Song' => [
            'no' => 22,
            'regex' => '/Hoh(es?lied)?( Salomos)?\.?\s+/',
        ],
        'Isa' => [
            'no' => 23,
            'regex' => '/Jes((aja)|\.)?\s+/',
        ],
        'Jer' => [
            'no' => 24,
            'regex' => '/Jer((emia)|\.)?\s+/',
        ],
        'Lam' => [
            'no' => 25,
            'regex' => '/Kla?g(elied(er)?)?\.?\s+/',
        ],
        'Ezek' => [
            'no' => 26,
            'regex' => '/(Hes((ekiel)|\.)?)|(Ez((e(chiel)?)|\.)?)\s+/',
        ],
        'Dan' => [
            'no' => 27,
            'regex' => '/Dan((iel)|\.)?\s+/',
        ],
        'Hos' => [
            'no' => 28,
            'regex' => '/Hos((ea)|\.)?\s+/',
        ],
        'Joel' => [
            'no' => 29,
            'regex' => '/Joel\s+/',
        ],
        'Amos' => [
            'no' => 30,
            'regex' => '/Am((os?)|\.)?\s+/',
        ],
        'Obad' => [
            'no' => 31,
            'regex' => '/Oba?(d(ja)?)?\.?\s+/',
        ],
        'Jonah' => [
            'no' => 32,
            'regex' => '/Jon(ah?)?\.?\s+/',
        ],
        'Mic' => [
            'no' => 33,
            'regex' => '/Mic((ha)|\.)?\s+/',
        ],
        'Nah' => [
            'no' => 34,
            'regex' => '/Nah((um)|\.)?\s+/',
        ],
        'Hab' => [
            'no' => 35,
            'regex' => '/Hab((b?akk?uk)|\.)?\s+/',
        ],
        'Zeph' => [
            'no' => 36,
            'regex' => '/Ze(f|ph)((an(i|j)a)|\.)?\s+/',
        ],
        'Hag' => [
            'no' => 37,
            'regex' => '/Hag((gai)|\.)?\s+/',
        ],
        'Zech' => [
            'no' => 38,
            'regex' => '/Sach((ar(i|j)a)|\.)?\s+/',
        ],
        'Mal' => [
            'no' => 39,
            'regex' => '/Mal((eachi)|\.)?\s+/',
        ],
        'Matt' => [
            'no' => 40,
            'regex' => '/(M(?:(?:a(?:t(?:t(?:h(?:(?:ä|ae)(?:us?)?)?)?)?)|t))(?:\.?))\s+/'
        ],
        'Mark' => [
            'no' => 41,
            'regex' => '/M(k\.?|ar((k(us)|\.)?)?)?\s+/'
        ],
        'Luke' => [
            'no' => 42,
            'regex' => '/Lu?k(as|\.)?\s+/'
        ],
        // need to match 1 John before John!
        '1John' => [
            'no' => 62,
            'regex' => '/1\.? ?J((hs|n)\.?|o(h?(\.|annes)?))?\s+/'
        ],
        '2John' => [
            'no' => 63,
            'regex' => '/2\.? ?J((hs|n)\.?|o(h?(\.|annes)?))?\s+/'
        ],
        '3John' => [
            'no' => 64,
            'regex' => '/3\.? ?J((hs|n)\.?|o(h?(\.|annes)?))?\s+/'
        ],
        'John' => [
            'no' => 43,
            'regex' => '/J((hs|n)\.?|oh(\.|annes)?)\s+/'
        ],
        'Acts' => [
            'no' => 44,
            'regex' => '/Ap(g.?|(o(stelgeschichte|\.)?))?/'
        ],
        'Rom' => [
            'no' => 45,
            'regex' => '/R(ö|oe)m(er|\.)?\s+/'
        ],
        '1Cor' => [
            'no' => 46,
            'regex' => '/1\.?\s?((Co)|(Ko(r(inther)?)?))\.?\s+/'
        ],
        '2Cor' => [
            'no' => 47,
            'regex' => '/2\.?\s?((Co)|(Ko(r(inther)?)?))\.?\s+/'
        ],
        'Gal' => [
            'no' => 48,
            'regex' => '/Gal((ater)|\.)?\s+/'
        ],
        'Eph' => [
            'no' => 49,
            'regex' => '/Eph((eser)|\.)?\s+/'
        ],
        'Phil' => [
            'no' => 50,
            'regex' => '/Ph(p|il((ipper)|\.)?)\s+/'
        ],
        'Col' => [
            'no' => 51,
            'regex' => '/Kol((osser)|\.)?\s+/'
        ],
        '1Thes' => [
            'no' => 52,
            'regex' => '/1\.? ?Th(es(s(alonicher)?)?)?\.?\s+/'
        ],
        '2Thes' => [
            'no' => 53,
            'regex' => '/2\.? ?Th(es(s(alonicher)?)?)?\.?\s+/'
        ],
        '1Tim' => [
            'no' => 54,
            'regex' => '/1\.? ?Ti(m(otheus)?)?\.?\s+/'
        ],
        '2Tim' => [
            'no' => 55,
            'regex' => '/2\.? ?Ti(m(otheus)?)?\.?\s+/'
        ],
        'Titus' => [
            'no' => 56,
            'regex' => '/Tit((us)|\.)?\s+/'
        ],
        'Phlm' => [
            'no' => 57,
            'regex' => '/Ph(ilemon?|m\.?|lm\.?)\s+/'
        ],
        'Heb' => [
            'no' => 58,
            'regex' => '/Heb(r((ä|(ae))er)?)?\.?\s+/'
        ],
        'Jas' => [
            'no' => 59,
            'regex' => '/Ja?(s|k(obus)?)\.?\s+/'
        ],
        '1Pe' => [
            'no' => 60,
            'regex' => '/1\.? ?Pe(t(r(us)?)?)?\.?\s+/'
        ],
        '2Pe' => [
            'no' => 61,
            'regex' => '/2\.? ?Pe(t(r(us)?)?)?\.?\s+/'
        ],
        'Jude' => [
            'no' => 65,
            'regex' => '/Jud((as)|\.)?\s+/'
        ],
        'Rev' => [
            'no' => 66,
            'regex' => '/Off(b|(enbarung))?\.?\s+/'
        ],
    ];

    /**
     * Parse a biblical reference
     *
     * Assumptions:
     * ============
     * 1. There is only one book in the reference.
     *
     * @param string $rawReference Reference as text
     * @param bool $unifiedRange Return a single range covering all possible sub-ranges?
     * @param bool $wrapInArray Wrap result in array?
     * @return array
     */
    public static function parse($rawReference, $unifiedRange = true, $wrapInArray = true)
    {
        $rawReference = trim(str_replace('-', '-', $rawReference));

        // some replacements
        $rawReference = str_replace(' oder ', ' / ', $rawReference);
        $rawReference = preg_replace('/(\d)\(/', '\1 \(', $rawReference);
        $rawReference = preg_replace('/\)(\d)/', '\) \1', $rawReference);

        $originalReference = $rawReference;


        // do we have to handle several references?
        if (strpos($rawReference, ' / ') > 0) {
            $references = explode(' / ', $rawReference);
            $result = [];
            foreach ($references as $reference) {
                $result[] = self::parse($reference, $unifiedRange, false);
            }
            return $result;
        }

        // 1. get the book:
        // replace all book names by their OSIS codes
        foreach (self::$bookMatches as $osisCode => $data) {
            if (preg_match($data['regex'], $rawReference)) {
                $book = $osisCode;
                $rawReference = preg_replace($data['regex'],'', $rawReference);
            }
        }
        if (!$book) {
            die ('No book for: '.$originalReference);
        }


        // 2. separate ranges
        $ranges = preg_split('/( |\.)/', strtr($rawReference, array('(' => '', ')' => '')));
        $chapter = self::getChapter($ranges[0]);

        // 3. process ranges
        foreach ($ranges as $rangeKey => $range) {
            $elements = explode('-', $range);
            foreach ($elements as $key => $element) {
                if ($ch = self::getChapter($element, $chapter)) {
                    $chapter = $ch;
                }
                $element = str_replace($chapter.',', '', $element);
                $element = preg_replace('/[a-z]/', '', $element);
                $elements[$key] = self::addNumeric([
                    'book' => $book,
                    'chapter' => $chapter,
                    'verse' => $element,
                ]);
            }
            $ranges[$rangeKey] = $elements;
        }


        if ($unifiedRange) {
            $start = 10000000000000000;
            $end = 0;
            foreach ($ranges as $key => $range) {
                foreach ($range as $element) {
                    $start = min($start, $element['numeric']);
                    $end = max($end, $element['numeric']);
                }
            }
            $result = ['start' => $start, 'end' => $end];
            if ($wrapInArray) $result = [$result];
            return $result;
        } else {
            if ($wrapInArray) $ranges = [$ranges];
            return $ranges;
        }


    }


    public static function getChapter($range, $default = 0) {
        if (preg_match('/(\d+)(?:,(?:.*)?)/', $range, $tmp)) {
            return $tmp[1];
        } else return $default;

    }

    public static function addNumeric($reference) {
        $reference['numeric'] = self::$bookMatches[$reference['book']]['no']
        . str_pad($reference['chapter'], 3, '0', STR_PAD_LEFT)
        . str_pad($reference['verse'], 3, '0', STR_PAD_LEFT);
        return $reference;
    }

}