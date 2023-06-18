<?php 
    /**
     * Ustawia bazę danych oraz pobiera najnowszy stan walut z API.
     *
     * @param object $db - Klasa DatabaseActions.
     * @param array $ratesAPI - Tablica zawierająca dane dotyczące kursów walut z API.
     * @param mysqli $mysqli Obiekt reprezentujący połączenie z bazą danych.
     * @param string $message - Opcjonalna wiadomość, która zostanie zwrócona.
     * @return string - Komunikat z informacją o pomyślnym pobraniu stanu walut lub błędzie.
     */
    function setDatabase($db, $ratesAPI, $mysqli, $message="") {
        if(!$ratesAPI){
            $message = "Nie udało się pobrać najnowszego stanu walut";
            return $message;
        }else{
            foreach ($ratesAPI[0]['rates'] as $rateAPI) {
                $message = $db->saveData($mysqli, "currencylist", $rateAPI['currency'], $rateAPI['mid']);
            }
            return $message;
        }
    }
    /**
     * Wykonuje konwersję walut na podstawie danych z formularza.
     *
     * @param array $rates - Tablica zawierająca dane dotyczące kursów walut z bazy danych.
     * @param object $db - Klasa DatabaseActions.
     * @param mysqli $mysqli Obiekt reprezentujący połączenie z bazą danych.
     * @param string $message - Opcjonalna wiadomość, która zostanie zwrócona.
     * @return string - Komunikat z wynikiem kalkulacji lub informacją o błędzie.
     */
    function currencyConversion($rates, $db, $mysqli, $message="") {
        if(!isset($_POST['sourceCurrency']) || !isset($_POST['targetCurrency'])){
            $message = "Należy wybrać odpowiednie waluty";
        }else{
            $sourceCurrency = $_POST['sourceCurrency'];
            $targetCurrency = $_POST['targetCurrency'];
            $amount = $_POST['amount'];
            $sourceValue = 1;
            $targetValue = 1;

            if (is_array($rates)) {
                foreach ($rates as $rate) {
                    if($rate['name'] == $sourceCurrency){
                        $sourceValue = $rate['value'];
                    }
                    if($rate['name'] == $targetCurrency){
                        $targetValue = $rate['value'];
                    }
                }
            }else{
                return $rates;
            }

            if($targetCurrency == 1){
                $targetCurrency = "pln Polski złoty";
            }
            if($sourceCurrency == 1){
                $sourceCurrency = "pln Polski złoty";
            }

            $convertedAmount = $amount * ($sourceValue / $targetValue);
            $convertedAmount = number_format($convertedAmount, 2, '.', '');
        
            $message = "Wynik kalkulacji to: $convertedAmount $targetCurrency";

            $db->saveData($mysqli, "conversionlist", $sourceCurrency, $targetCurrency, $amount, $convertedAmount);
        }
        return $message;
    }
?>