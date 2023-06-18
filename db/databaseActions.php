<?php
    class DatabaseActions {
        /**
         * Zapisuje bądź aktualizuje danne w bazie danych.
         *
         * @param mysqli $mysqli Obiekt reprezentujący połączenie z bazą danych.
         * @param string $tableName Nazwa tabeli, do której mają zostać zapisane dane.
         * @param string $param1 - w zależności od scenariusza nazwa waluty lub nazwa początkowej waluty.
         * @param string $param2 - w zależności od scenariusza wartość waluty lub nazwa docelowej waluty.
         * @param string $param3 - wartość początkowej waluty.
         * @param string $param4 - wartość docelowej waluty.
         * @return string Informacja zwrotna o rezultacie operacji
        */
        public function saveData($mysqli, $tableName, $param1, $param2, $param3 = "", $param4 = "") {
            try {
                if ($tableName == "currencylist") {
                    $selectQuery = "SELECT COUNT(*) FROM $tableName WHERE name = ?";
                    $select = $mysqli->prepare($selectQuery);
                    $select->bind_param("s", $param1);
                    $select->execute();
                    $select->bind_result($count);
                    $select->fetch();
                    $select->close();

                    if ($count > 0) {
                        $updateQuery = "UPDATE $tableName SET value = ? WHERE name = ?";
                        $update = $mysqli->prepare($updateQuery);
                        $update->bind_param("ds", $param2, $param1);
                        $update->execute();

                        return "Dane zostały odświerzone";
                    } else {
                        $insertQuery = "INSERT INTO $tableName (name, value) VALUES (?, ?)";
                        $insert = $mysqli->prepare($insertQuery);
                        $insert->bind_param("sd", $param1, $param2);
                        $insert->execute();
                        $insert->close();
                    }
                }else if ($tableName == "conversionlist"){
                    $insertQuery = "INSERT INTO $tableName (sourceCurrencyName, targetCurrencyName, sourceCurrencyValue, targetCurrencyValue) VALUES (?, ?, ?, ?)";
                    $insert = $mysqli->prepare($insertQuery);
                    $insert->bind_param("ssdd", $param1, $param2, $param3, $param4);
                    $insert->execute();
                    $insert->close();
                }
            } catch (mysqli_sql_exception $e) {
                return "Błąd zapisu/odświerzenia danych: " . $e->getMessage();
            }
        }
        /**
         * Oczytuje dane z bazy danych.
         *
         * @param mysqli $mysqli Obiekt reprezentujący połączenie z bazą danych.
         * @param string $tableName Nazwa tabeli, do której mają zostać zapisane dane.
         * @return array|string Tablica zawierająca odczytane dane z bazy danych lub informacja zwrotna o błędzie.
        */
        public function readData($mysqli, $tableName) {
            try {
                if($tableName == "currencylist"){
                    $query = "SELECT * FROM $tableName ORDER BY name ASC";
                    $temp = $mysqli->prepare($query);
                    $temp->execute();
                    $result = $temp->get_result()->fetch_all(MYSQLI_ASSOC);

                    return $result;
                }else if ($tableName == "conversionlist"){
                    $query = "SELECT * FROM $tableName ORDER BY id DESC LIMIT 7";
                    $temp = $mysqli->prepare($query);
                    $temp->execute();
                    $result = $temp->get_result()->fetch_all(MYSQLI_ASSOC);

                    return $result;
                }
                
            } catch (mysqli_sql_exception $e) {
                return "Błąd odczytu danych: " . $e->getMessage();
            }
        }
    }
?>