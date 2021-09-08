<?php 
    include "inc/database.php";
    include "inc/filter.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Quattro Cottage Rental</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/index.css">
    </head>
    <header>
        <div class="head"> <h1>Quattro Cottage Rental</h1></div>
    </header>

    <body>
        <main>
        <!--flip-card-->
            <?php foreach($database_gegevens as $value) {?>
                <div class="flip-card">
                <div class="flip-card-inner">
                <div class="flip-card-front">
                    <img src="images/<?php echo $value['image']; ?>" alt="Avatar" style="width:300px;height:300px;">
                </div>
                <div class="flip-card-back">
                    <?php   echo "<h1>".$value['name']."</h1>";
                            echo $value['description'];
                    ?>
                </div>
                </div>
                </div>
            <?php } ?>
            </main>
                <!--form-->
            <main>
                <div class="left">
                <div id="mapid"></div>
                    <div class="book">
                        <h3>Reservering maken</h3>
                        <div class="form-control">
                            <form id="boeking_huis" name="boeking_huis" method="GET">
                            <label for="aantal_personen">Vakantiehuis</label>
                            <select name="gekozen_huis" id="gekozen_huis">
                                <option value="1">IJmuiden Cottage</option>
                                <option value="2">Assen Bungalow</option>
                                <option value="3">Espelo Entree</option>
                                <option value="4">Weustenrade Woning</option>
                            </select>
                        </div>
                            <div class="form-control">
                                <label for="aantal_personen">Aantal personen</label>
                                <input type="number" name="aantal_personen" id="aantal_personen">
                            </div>
                            <div class="form-control">
                                <label for="aantal_dagen">Aantal dagen</label>
                                <input type="number" name="aantal_dagen" id="aantal_dagen">
                            </div>
                            <div class="form-control">
                                <h5>Beddengoed</h5>
                                    <label for="beddengoed_ja">Ja</label>
                                    <input type="radio" id="beddengoed_ja" name="beddengoed" value="ja">
                                    <label for="beddengoed_nee">Nee</label>
                                    <input type="radio" id="beddengoed_nee" name="beddengoed" value="nee">
                            </div>
                        <button type="submit">zie prijs</button>
                        <button>Reserveer huis</button>
                    </div>
                        <div class="currentBooking">
                        <div class="bookedHome"></div>
                        <div class="totalPriceBlock">Totale prijs &euro;<span class="totalPrice">0.00</span></div>
                    </div>
                </div>       
                    <div class="right">
                    <div class="filter-box">
                        <form class="filter-form">
                    <div class="form-control">
                        <a href="index.php">Reset Filters</a>
                    </div>      
                        </form>
                            <div class="form-control">
                                <label for="ligbad">Ligbad</label>
                                <input type="radio" id="ligbad" name="faciliteiten" value="ligbad" <?php if ($bathIsChecked) echo 'checked' ?>>
                            </div>
                            <div class="form-control">
                                <label for="zwembad">Zwembad</label>
                                <input type="radio" id="zwembad" name="faciliteiten" value="zwembad" <?php if ($poolIsChecked) echo 'checked' ?>>
                            </div>
                                <button type="submit" name="filter_submit">Filter</button>
                        </form>

                            <!--<div class="homes-box">
                            <?php if (isset($database_gegevens) && $database_gegevens != null) : ?>
                            <?php foreach ($database_gegevens as $huisje) : ?>
                                <h4>
                                    <?php echo $huisje['name']; ?>
                                </h4>
                                <p>
                                    <?php echo $huisje['description'] ?>
                                </p>
                                    <div class="kenmerken">
                                        <h6>Kenmerken</h6>
                                            <ul>
                                                <?php
                                                    if ($huisje['bath_present'] ==  1) {
                                                        echo "<li>Er is ligbad!</li>";
                                                        }
                                                ?>
                                                <?php
                                                    if ($huisje['pool_present'] ==  1) {
                                                        echo "<li>Er is zwembad!</li>";
                                                        }
                                                ?>
                                            </ul>
                                    </div>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                </div>
                            </div> -->
                        </div>
                    
                    </main>


            <script src="js/map_init.js"></script>
                <script>
                    // De verschillende markers moeten geplaatst worden. Vul de longitudes en latitudes uit de database hierin
                        var coordinates = [
                            ['52.44902','4.61001'],
                            ['52.99864','6.64928'],
                            ['52.30340','6.36800'],
                            ['50.89720','5.90979'],
                        ];
                        var bubbleTexts = [
                            "<h2>IJmuiden Cottage</h2> <img src=images/Ijmuiden.jpg width=100% height=100%>",
                            "<h2>Assen</h2> <img src=images/Assen.jpg width=100% height=100%>",
                            "<h2>Espelo</h2> <img src=images/Espelo.jpg width=100% height=100%>",
                            "<h2>Weustenrade</h2> <img src=images/Weustenrade.jpg width=100% height=100%>"
                        ];
                </script>
            <script src="js/place_markers.js"></script>

            <footer>
                <div></div>
                <div>copyright Quattro Rentals BV.</div>
                <div></div>
            </footer>
</body>
</html>

