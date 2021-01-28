<?php session_start(); ?>
<html lang="eng">
    <head>
        <title> Aitken Spence Weather </title>
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
        <ul class="navBar">
            <div class="photo">
                <a href='index.php'><img src="pictures/logoWhite.png" alt="diamond"></a>
            </div>
            <div class='btn-group'>
                <a class="active" href="index.php">Home</a>
                <a href="station.php">Station</a>
            </div>
        </ul>
        <div class='backbox'>
            <div class='stations'>
                <?php
                $stationsCountry = [];
                    $stationsCountry[] =  "AFGHANISTAN";
                    $stationsCountry[] =  'ALBANIA';
                    $stationsCountry[] =  'ALGERIA';
                    $stationsCountry[] =  'AMERICAN SAMOA';
                    $stationsCountry[] =  'ANDORRA';
                    $stationsCountry[] =  'ANGOLA';
                    $stationsCountry[] =  'ANTARCTICA';
                    $stationsCountry[] =  'ANTIGUA AND BARBUDA';
                    $stationsCountry[] =  'ARGENTINA';
                    $stationsCountry[] =  'ARMENIA';
                    $stationsCountry[] =  'ARUBA';
                    $stationsCountry[] =  'AUSTRALIA';
                    $stationsCountry[] =  'AUSTRIA';
                    $stationsCountry[] =  'AZERBAIJAN';
                    $stationsCountry[] =  'BAHAMAS THE';
                    $stationsCountry[] =  'BAHRAIN';
                    $stationsCountry[] =  'BANGLADESH';
                    $stationsCountry[] =  'BARBADOS';
                    $stationsCountry[] =  'BELARUS';
                    $stationsCountry[] =  'BELGIUM';
                    $stationsCountry[] =  'BELGIUM AND LUXEMBOURG';
                    $stationsCountry[] =  'BELIZE';
                    $stationsCountry[] =  'BENIN';
                    $stationsCountry[] =  'BERMUDA';
                    $stationsCountry[] =  'BOLIVIA';
                    $stationsCountry[] =  'BOSNIA AND HERZEGOVINA';
                    $stationsCountry[] =  'BOTSWANA';
                    $stationsCountry[] =  'BRAZIL';
                    $stationsCountry[] =  'BRITISH INDIAN OCEAN TERRITORY';
                    $stationsCountry[] =  'BRUNEI';
                    $stationsCountry[] =  'BULGARIA';
                    $stationsCountry[] =  'BURKINA FASO';
                    $stationsCountry[] =  'BURMA';
                    $stationsCountry[] =  'BURUNDI';
                    $stationsCountry[] =  'CAMBODIA';
                    $stationsCountry[] =  'CAMEROON';
                    $stationsCountry[] =  'CANADA';
                    $stationsCountry[] =  'CANARY ISLANDS';
                    $stationsCountry[] =  'CANTON ISLAND';
                    $stationsCountry[] =  'CAPE VERDE';
                    $stationsCountry[] =  'CAYMAN ISLANDS';
                    $stationsCountry[] =  'CENTRAL AFRICAN REPUBLIC';
                    $stationsCountry[] =  'CHAD';
                    $stationsCountry[] =  'CHILE';
                    $stationsCountry[] =  'CHINA';
                    $stationsCountry[] =  'CHRISTMAS ISLAND';
                    $stationsCountry[] =  'CLIPPERTON ISLAND';
                    $stationsCountry[] =  'COCOS (KEELING) ISLANDS';
                    $stationsCountry[] =  'COLOMBIA';
                    $stationsCountry[] =  'COMOROS';
                    $stationsCountry[] =  'CONGO';
                    $stationsCountry[] =  'COOK ISLANDS';
                    $stationsCountry[] =  'CORAL SEA ISLANDS';
                    $stationsCountry[] =  'COSTA RICA';
                    $stationsCountry[] =  'COTE D\'IVOIRE';
                    $stationsCountry[] =  'CROATIA';
                    $stationsCountry[] =  'CUBA';
                    $stationsCountry[] =  'CYPRUS';
                    $stationsCountry[] =  'CZECH REPUBLIC';
                    $stationsCountry[] =  'DEMOCRATIC YEMEN';
                    $stationsCountry[] =  'DENMARK';
                    $stationsCountry[] =  'DJIBOUTI';
                    $stationsCountry[] =  'DOMINICA';
                    $stationsCountry[] =  'DOMINICAN REPUBLIC';
                    $stationsCountry[] =  'ECUADOR';
                    $stationsCountry[] =  'EGYPT';
                    $stationsCountry[] =  'EL SALVADOR';
                    $stationsCountry[] =  'ESTONIA';
                    $stationsCountry[] =  'FALKLAND ISLANDS (ISLAS MALVINAS)';
                    $stationsCountry[] =  'FAROE ISLANDS';
                    $stationsCountry[] =  'FIJI';
                    $stationsCountry[] =  'FINLAND';
                    $stationsCountry[] =  'FORMER USSR (ASIA)';
                    $stationsCountry[] =  'FORMER USSR (EUROPE)';
                    $stationsCountry[] =  'FRANCE';
                    $stationsCountry[] =  'FRENCH GUIANA';
                    $stationsCountry[] =  'FRENCH POLYNESIA';
                    $stationsCountry[] =  'GABON';
                    $stationsCountry[] =  'GAMBIA  THE';
                    $stationsCountry[] =  'GEORGIA';
                    $stationsCountry[] =  'GERMANY';
                    $stationsCountry[] =  'GHANA';
                    $stationsCountry[] =  'GIBRALTAR';
                    $stationsCountry[] =  'GREECE';
                    $stationsCountry[] =  'GREENLAND';
                    $stationsCountry[] =  'GRENADA';
                    $stationsCountry[] =  'GUADELOUPE';
                    $stationsCountry[] =  'GUAM';
                    $stationsCountry[] =  'GUATEMALA';
                    $stationsCountry[] =  'GUERNSEY';
                    $stationsCountry[] =  'GUINEA';
                    $stationsCountry[] =  'GUYANA';
                    $stationsCountry[] =  'HAITI';
                    $stationsCountry[] =  'HONDURAS';
                    $stationsCountry[] =  'HUNGARY';
                    $stationsCountry[] =  'ICELAND';
                    $stationsCountry[] =  'INDIA';
                    $stationsCountry[] =  'INDONESIA';
                    $stationsCountry[] =  'IRAN';
                    $stationsCountry[] =  'IRAQ';
                    $stationsCountry[] =  'IRELAND';
                    $stationsCountry[] =  'ISRAEL';
                    $stationsCountry[] =  'ITALY';
                    $stationsCountry[] =  'JAMAICA';
                    $stationsCountry[] =  'JAN MAYEN';
                    $stationsCountry[] =  'JAPAN';
                    $stationsCountry[] =  'JERSEY';
                    $stationsCountry[] =  'JOHNSTON ATOLL';
                    $stationsCountry[] =  'JORDAN';
                    $stationsCountry[] =  'KAZAKHSTAN';
                    $stationsCountry[] =  'KENYA';
                    $stationsCountry[] =  'KIRIBATI';
                    $stationsCountry[] =  'KOREA, NORTH';
                    $stationsCountry[] =  'KOREA, SOUTH';
                    $stationsCountry[] =  'KUWAIT';
                    $stationsCountry[] =  'KYRGYZSTAN';
                    $stationsCountry[] =  'LAOS';
                    $stationsCountry[] =  'LATVIA';
                    $stationsCountry[] =  'LEBANON';
                    $stationsCountry[] =  'LIBERIA';
                    $stationsCountry[] =  'LIBYA';
                    $stationsCountry[] =  'LIECHTENSTEIN';
                    $stationsCountry[] =  'LITHUANIA';
                    $stationsCountry[] =  'LUXEMBOURG';
                    $stationsCountry[] =  'MACAU';
                    $stationsCountry[] =  'MACEDONIA';
                    $stationsCountry[] =  'MADAGASCAR';
                    $stationsCountry[] =  'MALAWI';
                    $stationsCountry[] =  'MALAYSIA';
                    $stationsCountry[] =  'MALDIVES';
                    $stationsCountry[] =  'MALI';
                    $stationsCountry[] =  'MALTA';
                    $stationsCountry[] =  'MAN  ISLE OF';
                    $stationsCountry[] =  'MARSHALL ISLANDS';
                    $stationsCountry[] =  'MARTINIQUE';
                    $stationsCountry[] =  'MAURITANIA';
                    $stationsCountry[] =  'MAURITIUS';
                    $stationsCountry[] =  'MAYOTTE';
                    $stationsCountry[] =  'MEXICO';
                    $stationsCountry[] =  'MICRONESIA, FEDERATED STATES OF';
                    $stationsCountry[] =  'MIDWAY ISLANDS';
                    $stationsCountry[] =  'MOLDOVA';
                    $stationsCountry[] =  'MONGOLIA';
                    $stationsCountry[] =  'MOROCCO';
                    $stationsCountry[] =  'MOZAMBIQUE';
                    $stationsCountry[] =  'NAMIBIA';
                    $stationsCountry[] =  'NETHERLANDS';
                    $stationsCountry[] =  'NETHERLANDS ANTILLES';
                    $stationsCountry[] =  'NEW CALEDONIA';
                    $stationsCountry[] =  'NEW ZEALAND';
                    $stationsCountry[] =  'NICARAGUA';
                    $stationsCountry[] =  'NIGER';
                    $stationsCountry[] =  'NIUE';
                    $stationsCountry[] =  'NORFOLK ISLAND';
                    $stationsCountry[] =  'NORTHERN MARIANA ISLANDS';
                    $stationsCountry[] =  'NORWAY';
                    $stationsCountry[] =  'OMAN';
                    $stationsCountry[] =  'PAKISTAN';
                    $stationsCountry[] =  'PALAU - TRUST TERRITORY OF THE PACIFIC ISLANDS';
                    $stationsCountry[] =  'PANAMA';
                    $stationsCountry[] =  'PAPUA NEW GUINEA';
                    $stationsCountry[] =  'PARACEL ISLANDS';
                    $stationsCountry[] =  'PARAGUAY';
                    $stationsCountry[] =  'PERU';
                    $stationsCountry[] =  'PHILIPPINES';
                    $stationsCountry[] =  'POLAND';
                    $stationsCountry[] =  'PORTUGAL';
                    $stationsCountry[] =  'PUERTO RICO';
                    $stationsCountry[] =  'QATAR';
                    $stationsCountry[] =  'REUNION AND ASSOCIATED ISLANDS';
                    $stationsCountry[] =  'ROMANIA';
                    $stationsCountry[] =  'RUSSIA';
                    $stationsCountry[] =  'SAUDI ARABIA';
                    $stationsCountry[] =  'SENEGAL';
                    $stationsCountry[] =  'SERBIA AND MONTENEGRO, STATE UNION OF';
                    $stationsCountry[] =  'SEYCHELLES';
                    $stationsCountry[] =  'SINGAPORE';
                    $stationsCountry[] =  'SLOVAKIA';
                    $stationsCountry[] =  'SLOVENIA';
                    $stationsCountry[] =  'SOLOMON ISLANDS';
                    $stationsCountry[] =  'SOUTH AFRICA';
                    $stationsCountry[] =  'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS';
                    $stationsCountry[] =  'SPAIN';
                    $stationsCountry[] =  'SPRATLY ISLANDS';
                    $stationsCountry[] =  'SRI LANKA';
                    $stationsCountry[] =  'ST. HELENA';
                    $stationsCountry[] =  'ST. KITTS AND NEVIS';
                    $stationsCountry[] =  'ST. LUCIA';
                    $stationsCountry[] =  'ST. PIERRE AND MIQUELON';
                    $stationsCountry[] =  'ST. VINCENT AND THE GRENADINES';
                    $stationsCountry[] =  'SUDAN';
                    $stationsCountry[] =  'SURINAME';
                    $stationsCountry[] =  'SVALBARD';
                    $stationsCountry[] =  'SWAZILAND';
                    $stationsCountry[] =  'SWEDEN';
                    $stationsCountry[] =  'SWITZERLAND';
                    $stationsCountry[] =  'SYRIA';
                    $stationsCountry[] =  'TAIWAN';
                    $stationsCountry[] =  'TAJIKISTAN';
                    $stationsCountry[] =  'TANZANIA';
                    $stationsCountry[] =  'THAILAND';
                    $stationsCountry[] =  'TOGO';
                    $stationsCountry[] =  'TONGA';
                    $stationsCountry[] =  'TRINIDAD AND TOBAGO';
                    $stationsCountry[] =  'TROMELIN ISLAND';
                    $stationsCountry[] =  'TUNISIA';
                    $stationsCountry[] =  'TURKEY';
                    $stationsCountry[] =  'TURKMENISTAN';
                    $stationsCountry[] =  'TUVALU';
                    $stationsCountry[] =  'UGANDA';
                    $stationsCountry[] =  'UKRAINE';
                    $stationsCountry[] =  'UNITED ARAB EMIRATES';
                    $stationsCountry[] =  'UNITED KINGDOM';
                    $stationsCountry[] =  'UNITED STATES';
                    $stationsCountry[] =  'URUGUAY';
                    $stationsCountry[] =  'UZBEKISTAN';
                    $stationsCountry[] =  'VANUATU';
                    $stationsCountry[] =  'VENEZUELA';
                    $stationsCountry[] =  'VIETNAM';
                    $stationsCountry[] =  'VIRGIN ISLANDS (U.S.)';
                    $stationsCountry[] =  'WAKE ISLAND';
                    $stationsCountry[] =  'WALLIS AND FUTUNA';
                    $stationsCountry[] =  'WEST BANK';
                    $stationsCountry[] =  'WESTERN SAHARA';
                    $stationsCountry[] =  'WESTERN SAMOA';
                    $stationsCountry[] =  'YEMEN';
                    $stationsCountry[] =  'YUGOSLAVIA (FORMER TERRITORY)';
                    $stationsCountry[] =  'ZAIRE';
                    $stationsCountry[] =  'ZAMBIA';
                    $stationsCountry[] =  'ZIMBABWE';

                print("<form method='post' action=''><fieldset><legend>Country</legend><select id='country' class='selectCountry' name='country'>");
                for($i=0; $i < sizeof($stationsCountry); $i++) {
                    print("<option value='{$stationsCountry[$i]}'>$stationsCountry[$i]</option>");
                };
                print("</select ><input type='submit' class='submitButton' value='Select Country'></fieldset></form>");
                ?>
            </div>
            <?php

                if(isset($_POST['country'])) {
                    $stationland = $_POST['country'];
                        echo "<form method='post' action='station.php'>";
                            print ("<table class='stationTable'>
                                        <tr>
                                            <th>Number</th>
                                            <th>Name</th>
                                            <th>Country</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Elevation</th>
                                        </tr>");
//                            while ($row = mysqli_fetch_array($result)) {
//                                print ("<tr>
//                                            <td><input type='submit' class='stnButton' name='stn' value='{$row['stn']}'></td>
//                                            <td>{$row['name']}</td>
//                                            <td>{$row['country']}</td>
//                                            <td>{$row['latitude']}</td>
//                                            <td>{$row['longitude']}</td>
//                                            <td>{$row['elevation']}</td>
//                                        </tr>");
//                            }
                            print ("</form></table>");
                }
            ?>
        </div>
    </body>
</html>