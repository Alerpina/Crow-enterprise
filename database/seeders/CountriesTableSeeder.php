<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('countries')->delete();

        \DB::table('countries')->insert(array (
            0 =>
            array (
                'id' => 1,
                'country_code' => 'AF',
                'country_name' => 'Afghanistan',
            ),
            1 =>
            array (
                'id' => 2,
                'country_code' => 'AL',
                'country_name' => 'Albania',
            ),
            2 =>
            array (
                'id' => 3,
                'country_code' => 'DZ',
                'country_name' => 'Algeria',
            ),
            3 =>
            array (
                'id' => 4,
                'country_code' => 'DS',
                'country_name' => 'American Samoa',
            ),
            4 =>
            array (
                'id' => 5,
                'country_code' => 'AD',
                'country_name' => 'Andorra',
            ),
            5 =>
            array (
                'id' => 6,
                'country_code' => 'AO',
                'country_name' => 'Angola',
            ),
            6 =>
            array (
                'id' => 7,
                'country_code' => 'AI',
                'country_name' => 'Anguilla',
            ),
            7 =>
            array (
                'id' => 8,
                'country_code' => 'AQ',
                'country_name' => 'Antarctica',
            ),
            8 =>
            array (
                'id' => 9,
                'country_code' => 'AG',
                'country_name' => 'Antigua and Barbuda',
            ),
            9 =>
            array (
                'id' => 10,
                'country_code' => 'AR',
                'country_name' => 'Argentina',
            ),
            10 =>
            array (
                'id' => 11,
                'country_code' => 'AM',
                'country_name' => 'Armenia',
            ),
            11 =>
            array (
                'id' => 12,
                'country_code' => 'AW',
                'country_name' => 'Aruba',
            ),
            12 =>
            array (
                'id' => 13,
                'country_code' => 'AU',
                'country_name' => 'Australia',
            ),
            13 =>
            array (
                'id' => 14,
                'country_code' => 'AT',
                'country_name' => 'Austria',
            ),
            14 =>
            array (
                'id' => 15,
                'country_code' => 'AZ',
                'country_name' => 'Azerbaijan',
            ),
            15 =>
            array (
                'id' => 16,
                'country_code' => 'BS',
                'country_name' => 'Bahamas',
            ),
            16 =>
            array (
                'id' => 17,
                'country_code' => 'BH',
                'country_name' => 'Bahrain',
            ),
            17 =>
            array (
                'id' => 18,
                'country_code' => 'BD',
                'country_name' => 'Bangladesh',
            ),
            18 =>
            array (
                'id' => 19,
                'country_code' => 'BB',
                'country_name' => 'Barbados',
            ),
            19 =>
            array (
                'id' => 20,
                'country_code' => 'BY',
                'country_name' => 'Belarus',
            ),
            20 =>
            array (
                'id' => 21,
                'country_code' => 'BE',
                'country_name' => 'Belgium',
            ),
            21 =>
            array (
                'id' => 22,
                'country_code' => 'BZ',
                'country_name' => 'Belize',
            ),
            22 =>
            array (
                'id' => 23,
                'country_code' => 'BJ',
                'country_name' => 'Benin',
            ),
            23 =>
            array (
                'id' => 24,
                'country_code' => 'BM',
                'country_name' => 'Bermuda',
            ),
            24 =>
            array (
                'id' => 25,
                'country_code' => 'BT',
                'country_name' => 'Bhutan',
            ),
            25 =>
            array (
                'id' => 26,
                'country_code' => 'BO',
                'country_name' => 'Bolivia',
            ),
            26 =>
            array (
                'id' => 27,
                'country_code' => 'BA',
                'country_name' => 'Bosnia and Herzegovina',
            ),
            27 =>
            array (
                'id' => 28,
                'country_code' => 'BW',
                'country_name' => 'Botswana',
            ),
            28 =>
            array (
                'id' => 29,
                'country_code' => 'BV',
                'country_name' => 'Bouvet Island',
            ),
            29 =>
            array (
                'id' => 30,
                'country_code' => 'BR',
                'country_name' => 'Brazil',
            ),
            30 =>
            array (
                'id' => 31,
                'country_code' => 'IO',
                'country_name' => 'British Indian Ocean Territory',
            ),
            31 =>
            array (
                'id' => 32,
                'country_code' => 'BN',
                'country_name' => 'Brunei Darussalam',
            ),
            32 =>
            array (
                'id' => 33,
                'country_code' => 'BG',
                'country_name' => 'Bulgaria',
            ),
            33 =>
            array (
                'id' => 34,
                'country_code' => 'BF',
                'country_name' => 'Burkina Faso',
            ),
            34 =>
            array (
                'id' => 35,
                'country_code' => 'BI',
                'country_name' => 'Burundi',
            ),
            35 =>
            array (
                'id' => 36,
                'country_code' => 'KH',
                'country_name' => 'Cambodia',
            ),
            36 =>
            array (
                'id' => 37,
                'country_code' => 'CM',
                'country_name' => 'Cameroon',
            ),
            37 =>
            array (
                'id' => 38,
                'country_code' => 'CA',
                'country_name' => 'Canada',
            ),
            38 =>
            array (
                'id' => 39,
                'country_code' => 'CV',
                'country_name' => 'Cape Verde',
            ),
            39 =>
            array (
                'id' => 40,
                'country_code' => 'KY',
                'country_name' => 'Cayman Islands',
            ),
            40 =>
            array (
                'id' => 41,
                'country_code' => 'CF',
                'country_name' => 'Central African Republic',
            ),
            41 =>
            array (
                'id' => 42,
                'country_code' => 'TD',
                'country_name' => 'Chad',
            ),
            42 =>
            array (
                'id' => 43,
                'country_code' => 'CL',
                'country_name' => 'Chile',
            ),
            43 =>
            array (
                'id' => 44,
                'country_code' => 'CN',
                'country_name' => 'China',
            ),
            44 =>
            array (
                'id' => 45,
                'country_code' => 'CX',
                'country_name' => 'Christmas Island',
            ),
            45 =>
            array (
                'id' => 46,
                'country_code' => 'CC',
            'country_name' => 'Cocos (Keeling) Islands',
            ),
            46 =>
            array (
                'id' => 47,
                'country_code' => 'CO',
                'country_name' => 'Colombia',
            ),
            47 =>
            array (
                'id' => 48,
                'country_code' => 'KM',
                'country_name' => 'Comoros',
            ),
            48 =>
            array (
                'id' => 49,
                'country_code' => 'CD',
                'country_name' => 'Democratic Republic of the Congo',
            ),
            49 =>
            array (
                'id' => 50,
                'country_code' => 'CG',
                'country_name' => 'Republic of Congo',
            ),
            50 =>
            array (
                'id' => 51,
                'country_code' => 'CK',
                'country_name' => 'Cook Islands',
            ),
            51 =>
            array (
                'id' => 52,
                'country_code' => 'CR',
                'country_name' => 'Costa Rica',
            ),
            52 =>
            array (
                'id' => 53,
                'country_code' => 'HR',
            'country_name' => 'Croatia (Hrvatska)',
            ),
            53 =>
            array (
                'id' => 54,
                'country_code' => 'CU',
                'country_name' => 'Cuba',
            ),
            54 =>
            array (
                'id' => 55,
                'country_code' => 'CY',
                'country_name' => 'Cyprus',
            ),
            55 =>
            array (
                'id' => 56,
                'country_code' => 'CZ',
                'country_name' => 'Czech Republic',
            ),
            56 =>
            array (
                'id' => 57,
                'country_code' => 'DK',
                'country_name' => 'Denmark',
            ),
            57 =>
            array (
                'id' => 58,
                'country_code' => 'DJ',
                'country_name' => 'Djibouti',
            ),
            58 =>
            array (
                'id' => 59,
                'country_code' => 'DM',
                'country_name' => 'Dominica',
            ),
            59 =>
            array (
                'id' => 60,
                'country_code' => 'DO',
                'country_name' => 'Dominican Republic',
            ),
            60 =>
            array (
                'id' => 61,
                'country_code' => 'TP',
                'country_name' => 'East Timor',
            ),
            61 =>
            array (
                'id' => 62,
                'country_code' => 'EC',
                'country_name' => 'Ecuador',
            ),
            62 =>
            array (
                'id' => 63,
                'country_code' => 'EG',
                'country_name' => 'Egypt',
            ),
            63 =>
            array (
                'id' => 64,
                'country_code' => 'SV',
                'country_name' => 'El Salvador',
            ),
            64 =>
            array (
                'id' => 65,
                'country_code' => 'GQ',
                'country_name' => 'Equatorial Guinea',
            ),
            65 =>
            array (
                'id' => 66,
                'country_code' => 'ER',
                'country_name' => 'Eritrea',
            ),
            66 =>
            array (
                'id' => 67,
                'country_code' => 'EE',
                'country_name' => 'Estonia',
            ),
            67 =>
            array (
                'id' => 68,
                'country_code' => 'ET',
                'country_name' => 'Ethiopia',
            ),
            68 =>
            array (
                'id' => 69,
                'country_code' => 'FK',
            'country_name' => 'Falkland Islands (Malvinas)',
            ),
            69 =>
            array (
                'id' => 70,
                'country_code' => 'FO',
                'country_name' => 'Faroe Islands',
            ),
            70 =>
            array (
                'id' => 71,
                'country_code' => 'FJ',
                'country_name' => 'Fiji',
            ),
            71 =>
            array (
                'id' => 72,
                'country_code' => 'FI',
                'country_name' => 'Finland',
            ),
            72 =>
            array (
                'id' => 73,
                'country_code' => 'FR',
                'country_name' => 'France',
            ),
            73 =>
            array (
                'id' => 74,
                'country_code' => 'FX',
                'country_name' => 'France, Metropolitan',
            ),
            74 =>
            array (
                'id' => 75,
                'country_code' => 'GF',
                'country_name' => 'French Guiana',
            ),
            75 =>
            array (
                'id' => 76,
                'country_code' => 'PF',
                'country_name' => 'French Polynesia',
            ),
            76 =>
            array (
                'id' => 77,
                'country_code' => 'TF',
                'country_name' => 'French Southern Territories',
            ),
            77 =>
            array (
                'id' => 78,
                'country_code' => 'GA',
                'country_name' => 'Gabon',
            ),
            78 =>
            array (
                'id' => 79,
                'country_code' => 'GM',
                'country_name' => 'Gambia',
            ),
            79 =>
            array (
                'id' => 80,
                'country_code' => 'GE',
                'country_name' => 'Georgia',
            ),
            80 =>
            array (
                'id' => 81,
                'country_code' => 'DE',
                'country_name' => 'Germany',
            ),
            81 =>
            array (
                'id' => 82,
                'country_code' => 'GH',
                'country_name' => 'Ghana',
            ),
            82 =>
            array (
                'id' => 83,
                'country_code' => 'GI',
                'country_name' => 'Gibraltar',
            ),
            83 =>
            array (
                'id' => 84,
                'country_code' => 'GK',
                'country_name' => 'Guernsey',
            ),
            84 =>
            array (
                'id' => 85,
                'country_code' => 'GR',
                'country_name' => 'Greece',
            ),
            85 =>
            array (
                'id' => 86,
                'country_code' => 'GL',
                'country_name' => 'Greenland',
            ),
            86 =>
            array (
                'id' => 87,
                'country_code' => 'GD',
                'country_name' => 'Grenada',
            ),
            87 =>
            array (
                'id' => 88,
                'country_code' => 'GP',
                'country_name' => 'Guadeloupe',
            ),
            88 =>
            array (
                'id' => 89,
                'country_code' => 'GU',
                'country_name' => 'Guam',
            ),
            89 =>
            array (
                'id' => 90,
                'country_code' => 'GT',
                'country_name' => 'Guatemala',
            ),
            90 =>
            array (
                'id' => 91,
                'country_code' => 'GN',
                'country_name' => 'Guinea',
            ),
            91 =>
            array (
                'id' => 92,
                'country_code' => 'GW',
                'country_name' => 'Guinea-Bissau',
            ),
            92 =>
            array (
                'id' => 93,
                'country_code' => 'GY',
                'country_name' => 'Guyana',
            ),
            93 =>
            array (
                'id' => 94,
                'country_code' => 'HT',
                'country_name' => 'Haiti',
            ),
            94 =>
            array (
                'id' => 95,
                'country_code' => 'HM',
                'country_name' => 'Heard and Mc Donald Islands',
            ),
            95 =>
            array (
                'id' => 96,
                'country_code' => 'HN',
                'country_name' => 'Honduras',
            ),
            96 =>
            array (
                'id' => 97,
                'country_code' => 'HK',
                'country_name' => 'Hong Kong',
            ),
            97 =>
            array (
                'id' => 98,
                'country_code' => 'HU',
                'country_name' => 'Hungary',
            ),
            98 =>
            array (
                'id' => 99,
                'country_code' => 'IS',
                'country_name' => 'Iceland',
            ),
            99 =>
            array (
                'id' => 100,
                'country_code' => 'IN',
                'country_name' => 'India',
            ),
            100 =>
            array (
                'id' => 101,
                'country_code' => 'IM',
                'country_name' => 'Isle of Man',
            ),
            101 =>
            array (
                'id' => 102,
                'country_code' => 'ID',
                'country_name' => 'Indonesia',
            ),
            102 =>
            array (
                'id' => 103,
                'country_code' => 'IR',
            'country_name' => 'Iran (Islamic Republic of)',
            ),
            103 =>
            array (
                'id' => 104,
                'country_code' => 'IQ',
                'country_name' => 'Iraq',
            ),
            104 =>
            array (
                'id' => 105,
                'country_code' => 'IE',
                'country_name' => 'Ireland',
            ),
            105 =>
            array (
                'id' => 106,
                'country_code' => 'IL',
                'country_name' => 'Israel',
            ),
            106 =>
            array (
                'id' => 107,
                'country_code' => 'IT',
                'country_name' => 'Italy',
            ),
            107 =>
            array (
                'id' => 108,
                'country_code' => 'CI',
                'country_name' => 'Ivory Coast',
            ),
            108 =>
            array (
                'id' => 109,
                'country_code' => 'JE',
                'country_name' => 'Jersey',
            ),
            109 =>
            array (
                'id' => 110,
                'country_code' => 'JM',
                'country_name' => 'Jamaica',
            ),
            110 =>
            array (
                'id' => 111,
                'country_code' => 'JP',
                'country_name' => 'Japan',
            ),
            111 =>
            array (
                'id' => 112,
                'country_code' => 'JO',
                'country_name' => 'Jordan',
            ),
            112 =>
            array (
                'id' => 113,
                'country_code' => 'KZ',
                'country_name' => 'Kazakhstan',
            ),
            113 =>
            array (
                'id' => 114,
                'country_code' => 'KE',
                'country_name' => 'Kenya',
            ),
            114 =>
            array (
                'id' => 115,
                'country_code' => 'KI',
                'country_name' => 'Kiribati',
            ),
            115 =>
            array (
                'id' => 116,
                'country_code' => 'KP',
                'country_name' => 'Korea, Democratic People\'s Republic of',
            ),
            116 =>
            array (
                'id' => 117,
                'country_code' => 'KR',
                'country_name' => 'Korea, Republic of',
            ),
            117 =>
            array (
                'id' => 118,
                'country_code' => 'XK',
                'country_name' => 'Kosovo',
            ),
            118 =>
            array (
                'id' => 119,
                'country_code' => 'KW',
                'country_name' => 'Kuwait',
            ),
            119 =>
            array (
                'id' => 120,
                'country_code' => 'KG',
                'country_name' => 'Kyrgyzstan',
            ),
            120 =>
            array (
                'id' => 121,
                'country_code' => 'LA',
                'country_name' => 'Lao People\'s Democratic Republic',
            ),
            121 =>
            array (
                'id' => 122,
                'country_code' => 'LV',
                'country_name' => 'Latvia',
            ),
            122 =>
            array (
                'id' => 123,
                'country_code' => 'LB',
                'country_name' => 'Lebanon',
            ),
            123 =>
            array (
                'id' => 124,
                'country_code' => 'LS',
                'country_name' => 'Lesotho',
            ),
            124 =>
            array (
                'id' => 125,
                'country_code' => 'LR',
                'country_name' => 'Liberia',
            ),
            125 =>
            array (
                'id' => 126,
                'country_code' => 'LY',
                'country_name' => 'Libyan Arab Jamahiriya',
            ),
            126 =>
            array (
                'id' => 127,
                'country_code' => 'LI',
                'country_name' => 'Liechtenstein',
            ),
            127 =>
            array (
                'id' => 128,
                'country_code' => 'LT',
                'country_name' => 'Lithuania',
            ),
            128 =>
            array (
                'id' => 129,
                'country_code' => 'LU',
                'country_name' => 'Luxembourg',
            ),
            129 =>
            array (
                'id' => 130,
                'country_code' => 'MO',
                'country_name' => 'Macau',
            ),
            130 =>
            array (
                'id' => 131,
                'country_code' => 'MK',
                'country_name' => 'North Macedonia',
            ),
            131 =>
            array (
                'id' => 132,
                'country_code' => 'MG',
                'country_name' => 'Madagascar',
            ),
            132 =>
            array (
                'id' => 133,
                'country_code' => 'MW',
                'country_name' => 'Malawi',
            ),
            133 =>
            array (
                'id' => 134,
                'country_code' => 'MY',
                'country_name' => 'Malaysia',
            ),
            134 =>
            array (
                'id' => 135,
                'country_code' => 'MV',
                'country_name' => 'Maldives',
            ),
            135 =>
            array (
                'id' => 136,
                'country_code' => 'ML',
                'country_name' => 'Mali',
            ),
            136 =>
            array (
                'id' => 137,
                'country_code' => 'MT',
                'country_name' => 'Malta',
            ),
            137 =>
            array (
                'id' => 138,
                'country_code' => 'MH',
                'country_name' => 'Marshall Islands',
            ),
            138 =>
            array (
                'id' => 139,
                'country_code' => 'MQ',
                'country_name' => 'Martinique',
            ),
            139 =>
            array (
                'id' => 140,
                'country_code' => 'MR',
                'country_name' => 'Mauritania',
            ),
            140 =>
            array (
                'id' => 141,
                'country_code' => 'MU',
                'country_name' => 'Mauritius',
            ),
            141 =>
            array (
                'id' => 142,
                'country_code' => 'TY',
                'country_name' => 'Mayotte',
            ),
            142 =>
            array (
                'id' => 143,
                'country_code' => 'MX',
                'country_name' => 'Mexico',
            ),
            143 =>
            array (
                'id' => 144,
                'country_code' => 'FM',
                'country_name' => 'Micronesia, Federated States of',
            ),
            144 =>
            array (
                'id' => 145,
                'country_code' => 'MD',
                'country_name' => 'Moldova, Republic of',
            ),
            145 =>
            array (
                'id' => 146,
                'country_code' => 'MC',
                'country_name' => 'Monaco',
            ),
            146 =>
            array (
                'id' => 147,
                'country_code' => 'MN',
                'country_name' => 'Mongolia',
            ),
            147 =>
            array (
                'id' => 148,
                'country_code' => 'ME',
                'country_name' => 'Montenegro',
            ),
            148 =>
            array (
                'id' => 149,
                'country_code' => 'MS',
                'country_name' => 'Montserrat',
            ),
            149 =>
            array (
                'id' => 150,
                'country_code' => 'MA',
                'country_name' => 'Morocco',
            ),
            150 =>
            array (
                'id' => 151,
                'country_code' => 'MZ',
                'country_name' => 'Mozambique',
            ),
            151 =>
            array (
                'id' => 152,
                'country_code' => 'MM',
                'country_name' => 'Myanmar',
            ),
            152 =>
            array (
                'id' => 153,
                'country_code' => 'NA',
                'country_name' => 'Namibia',
            ),
            153 =>
            array (
                'id' => 154,
                'country_code' => 'NR',
                'country_name' => 'Nauru',
            ),
            154 =>
            array (
                'id' => 155,
                'country_code' => 'NP',
                'country_name' => 'Nepal',
            ),
            155 =>
            array (
                'id' => 156,
                'country_code' => 'NL',
                'country_name' => 'Netherlands',
            ),
            156 =>
            array (
                'id' => 157,
                'country_code' => 'AN',
                'country_name' => 'Netherlands Antilles',
            ),
            157 =>
            array (
                'id' => 158,
                'country_code' => 'NC',
                'country_name' => 'New Caledonia',
            ),
            158 =>
            array (
                'id' => 159,
                'country_code' => 'NZ',
                'country_name' => 'New Zealand',
            ),
            159 =>
            array (
                'id' => 160,
                'country_code' => 'NI',
                'country_name' => 'Nicaragua',
            ),
            160 =>
            array (
                'id' => 161,
                'country_code' => 'NE',
                'country_name' => 'Niger',
            ),
            161 =>
            array (
                'id' => 162,
                'country_code' => 'NG',
                'country_name' => 'Nigeria',
            ),
            162 =>
            array (
                'id' => 163,
                'country_code' => 'NU',
                'country_name' => 'Niue',
            ),
            163 =>
            array (
                'id' => 164,
                'country_code' => 'NF',
                'country_name' => 'Norfolk Island',
            ),
            164 =>
            array (
                'id' => 165,
                'country_code' => 'MP',
                'country_name' => 'Northern Mariana Islands',
            ),
            165 =>
            array (
                'id' => 166,
                'country_code' => 'NO',
                'country_name' => 'Norway',
            ),
            166 =>
            array (
                'id' => 167,
                'country_code' => 'OM',
                'country_name' => 'Oman',
            ),
            167 =>
            array (
                'id' => 168,
                'country_code' => 'PK',
                'country_name' => 'Pakistan',
            ),
            168 =>
            array (
                'id' => 169,
                'country_code' => 'PW',
                'country_name' => 'Palau',
            ),
            169 =>
            array (
                'id' => 170,
                'country_code' => 'PS',
                'country_name' => 'Palestine',
            ),
            170 =>
            array (
                'id' => 171,
                'country_code' => 'PA',
                'country_name' => 'Panama',
            ),
            171 =>
            array (
                'id' => 172,
                'country_code' => 'PG',
                'country_name' => 'Papua New Guinea',
            ),
            172 =>
            array (
                'id' => 173,
                'country_code' => 'PY',
                'country_name' => 'Paraguay',
            ),
            173 =>
            array (
                'id' => 174,
                'country_code' => 'PE',
                'country_name' => 'Peru',
            ),
            174 =>
            array (
                'id' => 175,
                'country_code' => 'PH',
                'country_name' => 'Philippines',
            ),
            175 =>
            array (
                'id' => 176,
                'country_code' => 'PN',
                'country_name' => 'Pitcairn',
            ),
            176 =>
            array (
                'id' => 177,
                'country_code' => 'PL',
                'country_name' => 'Poland',
            ),
            177 =>
            array (
                'id' => 178,
                'country_code' => 'PT',
                'country_name' => 'Portugal',
            ),
            178 =>
            array (
                'id' => 179,
                'country_code' => 'PR',
                'country_name' => 'Puerto Rico',
            ),
            179 =>
            array (
                'id' => 180,
                'country_code' => 'QA',
                'country_name' => 'Qatar',
            ),
            180 =>
            array (
                'id' => 181,
                'country_code' => 'RE',
                'country_name' => 'Reunion',
            ),
            181 =>
            array (
                'id' => 182,
                'country_code' => 'RO',
                'country_name' => 'Romania',
            ),
            182 =>
            array (
                'id' => 183,
                'country_code' => 'RU',
                'country_name' => 'Russian Federation',
            ),
            183 =>
            array (
                'id' => 184,
                'country_code' => 'RW',
                'country_name' => 'Rwanda',
            ),
            184 =>
            array (
                'id' => 185,
                'country_code' => 'KN',
                'country_name' => 'Saint Kitts and Nevis',
            ),
            185 =>
            array (
                'id' => 186,
                'country_code' => 'LC',
                'country_name' => 'Saint Lucia',
            ),
            186 =>
            array (
                'id' => 187,
                'country_code' => 'VC',
                'country_name' => 'Saint Vincent and the Grenadines',
            ),
            187 =>
            array (
                'id' => 188,
                'country_code' => 'WS',
                'country_name' => 'Samoa',
            ),
            188 =>
            array (
                'id' => 189,
                'country_code' => 'SM',
                'country_name' => 'San Marino',
            ),
            189 =>
            array (
                'id' => 190,
                'country_code' => 'ST',
                'country_name' => 'Sao Tome and Principe',
            ),
            190 =>
            array (
                'id' => 191,
                'country_code' => 'SA',
                'country_name' => 'Saudi Arabia',
            ),
            191 =>
            array (
                'id' => 192,
                'country_code' => 'SN',
                'country_name' => 'Senegal',
            ),
            192 =>
            array (
                'id' => 193,
                'country_code' => 'RS',
                'country_name' => 'Serbia',
            ),
            193 =>
            array (
                'id' => 194,
                'country_code' => 'SC',
                'country_name' => 'Seychelles',
            ),
            194 =>
            array (
                'id' => 195,
                'country_code' => 'SL',
                'country_name' => 'Sierra Leone',
            ),
            195 =>
            array (
                'id' => 196,
                'country_code' => 'SG',
                'country_name' => 'Singapore',
            ),
            196 =>
            array (
                'id' => 197,
                'country_code' => 'SK',
                'country_name' => 'Slovakia',
            ),
            197 =>
            array (
                'id' => 198,
                'country_code' => 'SI',
                'country_name' => 'Slovenia',
            ),
            198 =>
            array (
                'id' => 199,
                'country_code' => 'SB',
                'country_name' => 'Solomon Islands',
            ),
            199 =>
            array (
                'id' => 200,
                'country_code' => 'SO',
                'country_name' => 'Somalia',
            ),
            200 =>
            array (
                'id' => 201,
                'country_code' => 'ZA',
                'country_name' => 'South Africa',
            ),
            201 =>
            array (
                'id' => 202,
                'country_code' => 'GS',
                'country_name' => 'South Georgia South Sandwich Islands',
            ),
            202 =>
            array (
                'id' => 203,
                'country_code' => 'SS',
                'country_name' => 'South Sudan',
            ),
            203 =>
            array (
                'id' => 204,
                'country_code' => 'ES',
                'country_name' => 'Spain',
            ),
            204 =>
            array (
                'id' => 205,
                'country_code' => 'LK',
                'country_name' => 'Sri Lanka',
            ),
            205 =>
            array (
                'id' => 206,
                'country_code' => 'SH',
                'country_name' => 'St. Helena',
            ),
            206 =>
            array (
                'id' => 207,
                'country_code' => 'PM',
                'country_name' => 'St. Pierre and Miquelon',
            ),
            207 =>
            array (
                'id' => 208,
                'country_code' => 'SD',
                'country_name' => 'Sudan',
            ),
            208 =>
            array (
                'id' => 209,
                'country_code' => 'SR',
                'country_name' => 'Suriname',
            ),
            209 =>
            array (
                'id' => 210,
                'country_code' => 'SJ',
                'country_name' => 'Svalbard and Jan Mayen Islands',
            ),
            210 =>
            array (
                'id' => 211,
                'country_code' => 'SZ',
                'country_name' => 'Swaziland',
            ),
            211 =>
            array (
                'id' => 212,
                'country_code' => 'SE',
                'country_name' => 'Sweden',
            ),
            212 =>
            array (
                'id' => 213,
                'country_code' => 'CH',
                'country_name' => 'Switzerland',
            ),
            213 =>
            array (
                'id' => 214,
                'country_code' => 'SY',
                'country_name' => 'Syrian Arab Republic',
            ),
            214 =>
            array (
                'id' => 215,
                'country_code' => 'TW',
                'country_name' => 'Taiwan',
            ),
            215 =>
            array (
                'id' => 216,
                'country_code' => 'TJ',
                'country_name' => 'Tajikistan',
            ),
            216 =>
            array (
                'id' => 217,
                'country_code' => 'TZ',
                'country_name' => 'Tanzania, United Republic of',
            ),
            217 =>
            array (
                'id' => 218,
                'country_code' => 'TH',
                'country_name' => 'Thailand',
            ),
            218 =>
            array (
                'id' => 219,
                'country_code' => 'TG',
                'country_name' => 'Togo',
            ),
            219 =>
            array (
                'id' => 220,
                'country_code' => 'TK',
                'country_name' => 'Tokelau',
            ),
            220 =>
            array (
                'id' => 221,
                'country_code' => 'TO',
                'country_name' => 'Tonga',
            ),
            221 =>
            array (
                'id' => 222,
                'country_code' => 'TT',
                'country_name' => 'Trinidad and Tobago',
            ),
            222 =>
            array (
                'id' => 223,
                'country_code' => 'TN',
                'country_name' => 'Tunisia',
            ),
            223 =>
            array (
                'id' => 224,
                'country_code' => 'TR',
                'country_name' => 'Turkey',
            ),
            224 =>
            array (
                'id' => 225,
                'country_code' => 'TM',
                'country_name' => 'Turkmenistan',
            ),
            225 =>
            array (
                'id' => 226,
                'country_code' => 'TC',
                'country_name' => 'Turks and Caicos Islands',
            ),
            226 =>
            array (
                'id' => 227,
                'country_code' => 'TV',
                'country_name' => 'Tuvalu',
            ),
            227 =>
            array (
                'id' => 228,
                'country_code' => 'UG',
                'country_name' => 'Uganda',
            ),
            228 =>
            array (
                'id' => 229,
                'country_code' => 'UA',
                'country_name' => 'Ukraine',
            ),
            229 =>
            array (
                'id' => 230,
                'country_code' => 'AE',
                'country_name' => 'United Arab Emirates',
            ),
            230 =>
            array (
                'id' => 231,
                'country_code' => 'GB',
                'country_name' => 'United Kingdom',
            ),
            231 =>
            array (
                'id' => 232,
                'country_code' => 'US',
                'country_name' => 'United States',
            ),
            232 =>
            array (
                'id' => 233,
                'country_code' => 'UM',
                'country_name' => 'United States minor outlying islands',
            ),
            233 =>
            array (
                'id' => 234,
                'country_code' => 'UY',
                'country_name' => 'Uruguay',
            ),
            234 =>
            array (
                'id' => 235,
                'country_code' => 'UZ',
                'country_name' => 'Uzbekistan',
            ),
            235 =>
            array (
                'id' => 236,
                'country_code' => 'VU',
                'country_name' => 'Vanuatu',
            ),
            236 =>
            array (
                'id' => 237,
                'country_code' => 'VA',
                'country_name' => 'Vatican City State',
            ),
            237 =>
            array (
                'id' => 238,
                'country_code' => 'VE',
                'country_name' => 'Venezuela',
            ),
            238 =>
            array (
                'id' => 239,
                'country_code' => 'VN',
                'country_name' => 'Vietnam',
            ),
            239 =>
            array (
                'id' => 240,
                'country_code' => 'VG',
            'country_name' => 'Virgin Islands (British)',
            ),
            240 =>
            array (
                'id' => 241,
                'country_code' => 'VI',
            'country_name' => 'Virgin Islands (U.S.)',
            ),
            241 =>
            array (
                'id' => 242,
                'country_code' => 'WF',
                'country_name' => 'Wallis and Futuna Islands',
            ),
            242 =>
            array (
                'id' => 243,
                'country_code' => 'EH',
                'country_name' => 'Western Sahara',
            ),
            243 =>
            array (
                'id' => 244,
                'country_code' => 'YE',
                'country_name' => 'Yemen',
            ),
            244 =>
            array (
                'id' => 245,
                'country_code' => 'ZM',
                'country_name' => 'Zambia',
            ),
            245 =>
            array (
                'id' => 246,
                'country_code' => 'ZW',
                'country_name' => 'Zimbabwe',
            ),
        ));


    }
}
