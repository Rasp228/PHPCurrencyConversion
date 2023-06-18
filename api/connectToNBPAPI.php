<?php
    class NBPRatesAPI {
        private $baseUrl = 'http://api.nbp.pl/api/exchangerates/tables/';
        /**
         * Pobiera najnowsze kursy walut.
         *
         * @param string $tableType Typ tabeli kursów walut (domyślnie 'A').
         * @return array|null Tablica zawierająca najnowsze kursy walut lub null w przypadku błędu.
         */
        public function getLatestRates($tableType = 'A') {
            $url = $this->baseUrl.$tableType.'/';
            $response = file_get_contents($url);
            
            if ($response !== false) {
                $data = json_decode($response, true);
                return $data;
            }
            return null;
        }
    }
?>