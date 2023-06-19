<?php include '../PHPCurrencyConversion/partials/header.php'; ?>
    <?php include '../PHPCurrencyConversion/partials/navbar.php'; ?>
    <content class="w-100 text-center bg-light">
        <h1 class="mt-4">Obecny stan kursów walut</h1> 
        <form method="POST" action="">
            <button type="submit" class="btn btn-primary">Odśwież dane</button>
        </form>
        <br>
        <table class="table table-hover w-50" style="margin:0 auto">
            <tr class="table-dark">
                <th scope="col">Waluta</th>
                <th scope="col">Wartość</th>
            </tr>
        <?php
            $db = new DatabaseActions();
            $api = new NBPRatesAPI();
            $ratesAPI = $api->getLatestRates();
            $rates = $db->readData($mysqli, "currencylist");
            $message = "";

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {      
                $message = setDatabase($db, $ratesAPI, $mysqli); 
                $rates = $db->readData($mysqli, "currencylist");
            }
            if(!$rates){
                $message = setDatabase($db, $ratesAPI, $mysqli); 
                $rates = $db->readData($mysqli, "currencylist");
            }

            if (is_array($rates)) {
                foreach ($rates as $rate) {
                    echo "<tr class='table-primary'>";
                    echo "<td class='w-50' style='padding: 1%;'>".$rate['name']."</td>";
                    echo "<td class='w-50' style='padding: 1%;'>".$rate['value']."</td>";
                    echo "</tr>";
                }
                echo $message;
            }else{
                echo $rates;
            }
        ?>
        </table>
    </content>
<?php include '../PHPCurrencyConversion/partials/footer.php'; ?>
