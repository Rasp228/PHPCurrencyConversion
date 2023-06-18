<?php include '../PHPCurrencyConversion/partials/header.php'; ?>
    <?php include '../PHPCurrencyConversion/partials/navbar.php'; ?>
    <content class="w-100 text-center bg-light">
        <form class="form-group w-50" style="margin:0 auto" method="POST" action="">
            <h3 class="mt-4">Podaj kwotę oraz wybierz walutę źródłową i docelową</h3><br>
            <div class="input-group mb-3 d-flex">
                <?php                     
                    $db = new DatabaseActions();
                    $api = new NBPRatesAPI();
                    $rates = $db->readData($mysqli, "currencylist");
                    $conversions = $db->readData($mysqli, "conversionlist");
                    $ratesAPI = $api->getLatestRates();
                    $message = "";
                
                    if(!$rates){
                        $message = setDatabase($db, $ratesAPI, $mysqli); 
                        $rates = $db->readData($mysqli, "currencylist");
                    }

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $message = currencyConversion($rates, $db, $mysqli);
                        $conversions = $db->readData($mysqli, "conversionlist");
                    }
                ?>
                <span class="input-group-text flex-fill flex-sm-grow-0">Waluta źródłowa:</span>
                <select class="form-select flex-fill" name="sourceCurrency" required>
                    <option disabled selected>Wybierz walutę</option>
                    <option value="1" data-description="pln Polski złoty">pln Polski złoty</option>
                    <?php  
                        if (is_array($rates)) {
                            foreach ($rates as $rate) {
                                echo "<option value='".$rate['name']."'>".$rate['name']."</option>";
                            }
                        }else{
                            echo $rates;
                        }
                    ?>
                </select>
                <span class="input-group-text flex-fill flex-sm-grow-0">Waluta docelowa:</span>
                <select class="form-select flex-fill" name="targetCurrency" required>
                    <option disabled selected>Wybierz walutę</option>
                    <option value="1">pln Polski złoty</option>
                    <?php  
                        if (is_array($rates)) {
                            foreach ($rates as $rate) {
                                echo "<option value='".$rate['name']."'>".$rate['name']."</option>";
                            }
                        }else{
                            echo $rates;
                        }
                    ?>
                </select>
            </div>
            <div class="input-group mb-3">
                <input type="number" step="0.01" inputmode="decimal" class="form-control" name="amount" placeholder="Podaj kwotę do przewalutowania" required>
                <button class="btn btn-primary" type="submit">Przelicz</button>
            </div>
        </form>
        <?php
            echo '<h3 class="mt-4">'.$message.'</h3>';
        ?>
        <br><br><br><h3 class="mt-4">Historia ostatnich przewalutowań</h3><br>
        <table class="table table-hover w-50" style="margin:0 auto">
            <tr class="table-dark">
                <th scope="col">Waluta źródłowa</th>
                <th scope="col">Wartość</th>
                <th scope="col">Waluta docelowa</th>
                <th scope="col">Wartość</th>
            </tr>
        <?php  
            if (is_array($conversions)) {
                foreach ($conversions as $conversion) {
                    echo "<tr class='table-primary'>";
                    echo "<td class='w-25' style='padding: 1%;'>".$conversion["sourceCurrencyName"]."</td>";
                    echo "<td class='w-25' style='padding: 1%;'>".$conversion["sourceCurrencyValue"]."</td>";
                    echo "<td class='w-25' style='padding: 1%;'>".$conversion["targetCurrencyName"]."</td>";
                    echo "<td class='w-25' style='padding: 1%;'>".$conversion["targetCurrencyValue"]."</td>";
                    echo "</tr>";
                }
            }else{
                echo $conversions;
            }
        ?>
        </table>
    </content>
<?php include '../PHPCurrencyConversion/partials/footer.php'; ?>