<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
#        DB::table('countries', 'country_translations')->delete();
        $country_list = array();

        # http://www.countries-list.info/Download-List

        $country_list['en'] = array(
            'AB' => 'Abkhazia',
            'AF' => 'Afghanistan',
            'AL' => 'Albania',
            'DZ' => 'Algeria',
            'AS' => 'American Samoa',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarctica',
            'AG' => 'Antigua and Barbuda',
            'AR' => 'Argentina',
            'AM' => 'Armenia',
            'AW' => 'Aruba',
            'AU' => 'Australia',
            'AT' => 'Austria',
            'AZ' => 'Azerbaijan',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BY' => 'Belarus',
            'BE' => 'Belgium',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivia',
            'BA' => 'Bosnia and Herzegovina',
            'BW' => 'Botswana',
            'BV' => 'Bouvet Island',
            'BR' => 'Brazil',
            'BQ' => 'British Antarctic Territory',
            'IO' => 'British Indian Ocean Territory',
            'VG' => 'British Virgin Islands',
            'BN' => 'Brunei',
            'BG' => 'Bulgaria',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'KH' => 'Cambodia',
            'CM' => 'Cameroon',
            'CA' => 'Canada',
            'CT' => 'Canton and Enderbury Islands',
            'CV' => 'Cape Verde',
            'KY' => 'Cayman Islands',
            'CF' => 'Central African Republic',
            'TD' => 'Chad',
            'CL' => 'Chile',
            'CN' => 'China',
            'CX' => 'Christmas Island',
            'CC' => 'Cocos [Keeling] Islands',
            'CO' => 'Colombia',
            'KM' => 'Comoros',
            'CG' => 'Congo - Brazzaville',
            'CD' => 'Congo - Kinshasa',
            'CK' => 'Cook Islands',
            'CR' => 'Costa Rica',
            'HR' => 'Croatia',
            'CU' => 'Cuba',
            'CY' => 'Cyprus',
            'CZ' => 'Czech Republic',
            'CI' => 'Côte d’Ivoire',
            'DK' => 'Denmark',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominican Republic',
            'NQ' => 'Dronning Maud Land',
            'DD' => 'East Germany',
            'EC' => 'Ecuador',
            'EG' => 'Egypt',
            'SV' => 'El Salvador',
            'GQ' => 'Equatorial Guinea',
            'ER' => 'Eritrea',
            'EE' => 'Estonia',
            'ET' => 'Ethiopia',
            'FK' => 'Falkland Islands',
            'FO' => 'Faroe Islands',
            'FJ' => 'Fiji',
            'FI' => 'Finland',
            'FR' => 'France',
            'GF' => 'French Guiana',
            'PF' => 'French Polynesia',
            'TF' => 'French Southern and Antarctic Territories',
            'GA' => 'Gabon',
            'GM' => 'Gambia',
            'GE' => 'Georgia',
            'DE' => 'Germany',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GR' => 'Greece',
            'GL' => 'Greenland',
            'GD' => 'Grenada',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GG' => 'Guernsey',
            'GN' => 'Guinea',
            'GW' => 'Guinea-Bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard Island and McDonald Islands',
            'HN' => 'Honduras',
            'HK' => 'Hong Kong SAR China',
            'HU' => 'Hungary',
            'IS' => 'Iceland',
            'IN' => 'India',
            'ID' => 'Indonesia',
            'IR' => 'Iran',
            'IQ' => 'Iraq',
            'IE' => 'Ireland',
            'IM' => 'Isle of Man',
            'IL' => 'Israel',
            'IT' => 'Italy',
            'JM' => 'Jamaica',
            'JP' => 'Japan',
            'JE' => 'Jersey',
            'JT' => 'Johnston Island',
            'JO' => 'Jordan',
            'KZ' => 'Kazakhstan',
            'KE' => 'Kenya',
            'KI' => 'Kiribati',
            'KW' => 'Kuwait',
            'KG' => 'Kyrgyzstan',
            'LA' => 'Laos',
            'LV' => 'Latvia',
            'LB' => 'Lebanon',
            'LS' => 'Lesotho',
            'LR' => 'Liberia',
            'LY' => 'Libya',
            'LI' => 'Liechtenstein',
            'LT' => 'Lithuania',
            'LU' => 'Luxembourg',
            'MO' => 'Macau SAR China',
            'MK' => 'Macedonia',
            'MG' => 'Madagascar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Maldives',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MH' => 'Marshall Islands',
            'MQ' => 'Martinique',
            'MR' => 'Mauritania',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'FX' => 'Metropolitan France',
            'MX' => 'Mexico',
            'FM' => 'Micronesia',
            'MI' => 'Midway Islands',
            'MD' => 'Moldova',
            'MC' => 'Monaco',
            'MN' => 'Mongolia',
            'ME' => 'Montenegro',
            'MS' => 'Montserrat',
            'MA' => 'Morocco',
            'MZ' => 'Mozambique',
            'MM' => 'Myanmar [Burma]',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NL' => 'Netherlands',
            'AN' => 'Netherlands Antilles',
            'NT' => 'Neutral Zone',
            'NC' => 'New Caledonia',
            'NZ' => 'New Zealand',
            'NI' => 'Nicaragua',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolk Island',
            'KP' => 'North Korea',
            'VD' => 'North Vietnam',
            'MP' => 'Northern Mariana Islands',
            'NO' => 'Norway',
            'OM' => 'Oman',
            'PC' => 'Pacific Islands Trust Territory',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PS' => 'Palestinian Territories',
            'PA' => 'Panama',
            'PZ' => 'Panama Canal Zone',
            'PG' => 'Papua New Guinea',
            'PY' => 'Paraguay',
            'YD' => 'People\'s Democratic Republic of Yemen',
            'PE' => 'Peru',
            'PH' => 'Philippines',
            'PN' => 'Pitcairn Islands',
            'PL' => 'Poland',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'QA' => 'Qatar',
            'RO' => 'Romania',
            'RU' => 'Russia',
            'RW' => 'Rwanda',
            'RE' => 'Réunion',
            'BL' => 'Saint Barthélemy',
            'SH' => 'Saint Helena',
            'KN' => 'Saint Kitts and Nevis',
            'LC' => 'Saint Lucia',
            'MF' => 'Saint Martin',
            'PM' => 'Saint Pierre and Miquelon',
            'VC' => 'Saint Vincent and the Grenadines',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'SA' => 'Saudi Arabia',
            'SN' => 'Senegal',
            'RS' => 'Serbia',
            'CS' => 'Serbia and Montenegro',
            'SC' => 'Seychelles',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapore',
            'SK' => 'Slovakia',
            'SI' => 'Slovenia',
            'SB' => 'Solomon Islands',
            'SO' => 'Somalia',
            'ZA' => 'South Africa',
            'GS' => 'South Georgia and the South Sandwich Islands',
            'KR' => 'South Korea',
            'ES' => 'Spain',
            'LK' => 'Sri Lanka',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard and Jan Mayen',
            'SZ' => 'Swaziland',
            'SE' => 'Sweden',
            'CH' => 'Switzerland',
            'SY' => 'Syria',
            'ST' => 'São Tomé and Príncipe',
            'TW' => 'Taiwan',
            'TJ' => 'Tajikistan',
            'TZ' => 'Tanzania',
            'TH' => 'Thailand',
            'TL' => 'Timor-Leste',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad and Tobago',
            'TN' => 'Tunisia',
            'TR' => 'Turkey',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks and Caicos Islands',
            'TV' => 'Tuvalu',
            'UM' => 'U.S. Minor Outlying Islands',
            'PU' => 'U.S. Miscellaneous Pacific Islands',
            'VI' => 'U.S. Virgin Islands',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'SU' => 'Union of Soviet Socialist Republics',
            'AE' => 'United Arab Emirates',
            'GB' => 'United Kingdom',
            'US' => 'United States',
            'ZZ' => 'Unknown or Invalid Region',
            'UY' => 'Uruguay',
            'UZ' => 'Uzbekistan',
            'VU' => 'Vanuatu',
            'VA' => 'Vatican City',
            'VE' => 'Venezuela',
            'VN' => 'Vietnam',
            'WK' => 'Wake Island',
            'WF' => 'Wallis and Futuna',
            'EH' => 'Western Sahara',
            'YE' => 'Yemen',
            'ZM' => 'Zambia',
            'ZW' => 'Zimbabwe',
            'AX' => 'Åland Islands',
        );

        $country_list['de'] = array(
            'AB' => 'Abchasien',
            'AF' => 'Afghanistan',
            'AX' => 'Alandinseln',
            'AL' => 'Albanien',
            'DZ' => 'Algerien',
            'UM' => 'Amerikanisch-Ozeanien',
            'PU' => 'US Verschiedene pazifische Inseln',
            'AS' => 'Amerikanisch-Samoa',
            'VI' => 'Amerikanische Jungferninseln',
            'AD' => 'Andorra',
            'AO' => 'Angola',
            'AI' => 'Anguilla',
            'AQ' => 'Antarktis',
            'AG' => 'Antigua und Barbuda',
            'AR' => 'Argentinien',
            'AM' => 'Armenien',
            'AW' => 'Aruba',
            'AZ' => 'Aserbaidschan',
            'AU' => 'Australien',
            'BS' => 'Bahamas',
            'BH' => 'Bahrain',
            'BD' => 'Bangladesh',
            'BB' => 'Barbados',
            'BE' => 'Belgien',
            'BZ' => 'Belize',
            'BJ' => 'Benin',
            'BM' => 'Bermuda',
            'BT' => 'Bhutan',
            'BO' => 'Bolivien',
            'BA' => 'Bosnien und Herzegowina',
            'BW' => 'Botswana',
            'BV' => 'Bouvetinsel',
            'BR' => 'Brasilien',
            'BQ' => 'Britisches Antarktis-Territorium',
            'VG' => 'Britische Jungferninseln',
            'IO' => 'Britisches Territorium im Indischen Ozean',
            'BN' => 'Brunei',
            'BG' => 'Bulgarien',
            'BF' => 'Burkina Faso',
            'BI' => 'Burundi',
            'CL' => 'Chile',
            'CN' => 'China',
            'CK' => 'Cookinseln',
            'CR' => 'Costa Rica',
            'CI' => 'Côte d’Ivoire',
            'CD' => 'Demokratische Republik Kongo',
            'KP' => 'Demokratische Volksrepublik Korea',
            'VD' => 'Nordvietnam',
            'DE' => 'Deutschland',
            'DJ' => 'Djibouti',
            'DM' => 'Dominica',
            'DO' => 'Dominikanische Republik',
            'NQ' => 'Dronning Maud Land',
            'DK' => 'Dänemark',
            'DD' => 'Ostdeutschland',
            'EC' => 'Ecuador',
            'SV' => 'El Salvador',
            'ER' => 'Eritrea',
            'EE' => 'Estland',
            'FK' => 'Falklandinseln',
            'FJ' => 'Fidschi',
            'FI' => 'Finnland',
            'FR' => 'Frankreich',
            'GF' => 'Französisch-Guayana',
            'PF' => 'Französisch-Polynesien',
            'TF' => 'Französische Süd- und Antarktisgebiete',
            'FO' => 'Färöer',
            'GA' => 'Gabun',
            'GM' => 'Gambia',
            'GE' => 'Georgien',
            'GH' => 'Ghana',
            'GI' => 'Gibraltar',
            'GD' => 'Grenada',
            'GR' => 'Griechenland',
            'GB' => 'Grossbritannien',
            'GL' => 'Grönland',
            'GP' => 'Guadeloupe',
            'GU' => 'Guam',
            'GT' => 'Guatemala',
            'GG' => 'Guernsey',
            'GN' => 'Guinea',
            'GW' => 'Guinea-Bissau',
            'GY' => 'Guyana',
            'HT' => 'Haiti',
            'HM' => 'Heard- und McDonald-Inseln',
            'HN' => 'Honduras',
            'IN' => 'Indien',
            'ID' => 'Indonesien',
            'IQ' => 'Irak',
            'IR' => 'Iran',
            'IE' => 'Irland',
            'IS' => 'Island',
            'IM' => 'Isle of Man',
            'IL' => 'Israel',
            'IT' => 'Italien',
            'JM' => 'Jamaika',
            'JP' => 'Japan',
            'YE' => 'Jemen',
            'JE' => 'Jersey',
            'JT' => 'Johnston Island',
            'JO' => 'Jordanien',
            'KY' => 'Kaimaninseln',
            'KH' => 'Kambodscha',
            'CM' => 'Kamerun',
            'CA' => 'Kanada',
            'CT' => 'Canton und Enderbury Islands',
            'CV' => 'Kapverden',
            'KZ' => 'Kasachstan',
            'QA' => 'Katar',
            'KE' => 'Kenia',
            'KG' => 'Kirgisistan',
            'KI' => 'Kiribati',
            'CC' => 'Kokosinseln',
            'CO' => 'Kolumbien',
            'KM' => 'Komoren',
            'CG' => 'Kongo',
            'HR' => 'Kroatien',
            'CU' => 'Kuba',
            'KW' => 'Kuwait',
            'LA' => 'Laos',
            'LS' => 'Lesotho',
            'LV' => 'Lettland',
            'LB' => 'Libanon',
            'LR' => 'Liberia',
            'LY' => 'Libyen',
            'LI' => 'Liechtenstein',
            'LT' => 'Litauen',
            'LU' => 'Luxemburg',
            'MG' => 'Madagaskar',
            'MW' => 'Malawi',
            'MY' => 'Malaysia',
            'MV' => 'Malediven',
            'ML' => 'Mali',
            'MT' => 'Malta',
            'MA' => 'Marokko',
            'MH' => 'Marshall-Inseln',
            'MQ' => 'Martinique',
            'MR' => 'Mauretanien',
            'MU' => 'Mauritius',
            'YT' => 'Mayotte',
            'FX' => 'Metropolitan Frankreich',
            'MK' => 'Mazedonien',
            'MX' => 'Mexiko',
            'FM' => 'Mikronesien',
            'MI' => 'Midway Islands',
            'MC' => 'Monaco',
            'MN' => 'Mongolei',
            'ME' => 'Montenegro',
            'MS' => 'Montserrat',
            'MZ' => 'Mosambik',
            'MM' => 'Myanmar',
            'NA' => 'Namibia',
            'NR' => 'Nauru',
            'NP' => 'Nepal',
            'NC' => 'Neukaledonien',
            'NZ' => 'Neuseeland',
            'NI' => 'Nicaragua',
            'NL' => 'Niederlande',
            'AN' => 'Niederländische Antillen',
            'NT' => 'Neutrale Zone',
            'NE' => 'Niger',
            'NG' => 'Nigeria',
            'NU' => 'Niue',
            'NF' => 'Norfolkinsel',
            'NO' => 'Norwegen',
            'MP' => 'Nördliche Marianen',
            'OM' => 'Oman',
            'PC' => 'Pacific Islands Trust Territory',
            'TL' => 'Osttimor',
            'PK' => 'Pakistan',
            'PW' => 'Palau',
            'PS' => 'Palästinensische Gebiete',
            'PA' => 'Panama',
            'PZ' => 'Panamakanal-Zone',
            'PG' => 'Papua-Neuguinea',
            'PY' => 'Paraguay',
            'YD' => 'Demokratische Volksrepublik Jemen',
            'PE' => 'Peru',
            'PH' => 'Philippinen',
            'PN' => 'Pitcairn',
            'PL' => 'Polen',
            'PT' => 'Portugal',
            'PR' => 'Puerto Rico',
            'KR' => 'Republik Korea',
            'MD' => 'Republik Moldau',
            'RO' => 'Rumänien',
            'RU' => 'Russische Föderation',
            'RW' => 'Rwanda',
            'RE' => 'Réunion',
            'SB' => 'Salomon-Inseln',
            'ZM' => 'Sambia',
            'WS' => 'Samoa',
            'SM' => 'San Marino',
            'ST' => 'Sao Tomé und Principe',
            'SA' => 'Saudi-Arabien',
            'SE' => 'Schweden',
            'CH' => 'Schweiz',
            'SN' => 'Senegal',
            'RS' => 'Serbien',
            'CS' => 'Serbien und Montenegro',
            'SC' => 'Seychellen',
            'SL' => 'Sierra Leone',
            'SG' => 'Singapur',
            'SK' => 'Slowakei',
            'SI' => 'Slowenien',
            'SO' => 'Somalia',
            'HK' => 'Sonderverwaltungszone Hongkong',
            'MO' => 'Sonderverwaltungszone Macao',
            'ES' => 'Spanien',
            'LK' => 'Sri Lanka',
            'BL' => 'St. Barthélemy',
            'SH' => 'St. Helena',
            'KN' => 'St. Kitts und Nevis',
            'LC' => 'St. Lucia',
            'MF' => 'St. Martin',
            'PM' => 'St. Pierre und Miquelon',
            'VC' => 'St. Vincent und die Grenadinen',
            'SD' => 'Sudan',
            'SR' => 'Suriname',
            'SJ' => 'Svalbard und Jan Mayen',
            'SZ' => 'Swasiland',
            'SY' => 'Syrien',
            'ZA' => 'Südafrika',
            'GS' => 'Südgeorgien und die Südlichen Sandwichinseln',
            'TJ' => 'Tadschikistan',
            'TW' => 'Taiwan',
            'TZ' => 'Tansania',
            'TH' => 'Thailand',
            'TG' => 'Togo',
            'TK' => 'Tokelau',
            'TO' => 'Tonga',
            'TT' => 'Trinidad und Tobago',
            'TD' => 'Tschad',
            'CZ' => 'Tschechische Republik',
            'TN' => 'Tunesien',
            'TM' => 'Turkmenistan',
            'TC' => 'Turks- und Caicosinseln',
            'TV' => 'Tuvalu',
            'TR' => 'Türkei',
            'UG' => 'Uganda',
            'UA' => 'Ukraine',
            'SU' => 'Union der Sozialistischen Sowjetrepubliken',
            'ZZ' => 'Unbekannte oder ungültige Region',
            'HU' => 'Ungarn',
            'UY' => 'Uruguay',
            'UZ' => 'Usbekistan',
            'VU' => 'Vanuatu',
            'VA' => 'Vatikanstadt',
            'VE' => 'Venezuela',
            'AE' => 'Vereinigte Arabische Emirate',
            'US' => 'Vereinigte Staaten',
            'VN' => 'Vietnam',
            'WK' => 'Wake Island',
            'WF' => 'Wallis und Futuna',
            'CX' => 'Weihnachtsinsel',
            'BY' => 'Weissrussland',
            'EH' => 'Westsahara',
            'CF' => 'Zentralafrikanische Republik',
            'ZW' => 'Zimbabwe',
            'CY' => 'Zypern',
            'EG' => 'Ägypten',
            'GQ' => 'Äquatorialguinea',
            'ET' => 'Äthiopien',
            'AT' => 'Österreich',
        );

        foreach ($country_list['en'] AS $s_iso => $s_name)
        {
            factory(App\Country::class)->create([
                'iso'           => $s_iso,
                'published'     => 1,
                'en'            => [ 'name' => $country_list['en'][$s_iso] ],
                'de'            => [ 'name' => $country_list['de'][$s_iso] ],
            ]);
        }

        echo 'finished countries' . "\n";
    }
}
