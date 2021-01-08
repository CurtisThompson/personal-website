<?php
if(isset($_GET['category'])) {
    $cat = $_GET['category'];
} else {
    $cat = 'overall';
}

if(isset($_GET['min'])) {
    $min = $_GET['min'];
} else {
    $min = -1;
}

if(isset($_GET['max'])) {
    $max = $_GET['max'];
} else {
    $max = 7;
}

if($max < $min){
    $max = 7;
}

$db = new SQLite3('birds.db');

if($cat == "overall") {
    $stmt = $db->prepare('SELECT Name FROM Birds WHERE `Rarity Overall` >= :min AND `Rarity Overall` <= :max');
} else if($cat == "winter") {
    $stmt = $db->prepare('SELECT Name FROM Birds WHERE `Rarity Winter` >= :min AND `Rarity Winter` <= :max');
} else if($cat == "summer") {
    $stmt = $db->prepare('SELECT Name FROM Birds WHERE `Rarity Summer` >= :min AND `Rarity Summer` <= :max');
} else if($cat == "winter") {
    $stmt = $db->prepare('SELECT Name FROM Birds WHERE `Rarity Breeding` >= :min AND `Rarity Breeding` <= :max');
} else if($cat == "winter") {
    $stmt = $db->prepare('SELECT Name FROM Birds WHERE `Rarity Passage` >= :min AND `Rarity Passage` <= :max');
} else if($cat == "winter") {
    $stmt = $db->prepare('SELECT Name FROM Birds WHERE `Rarity Vagrant` >= :min AND `Rarity Vagrant` <= :max');
} else if($cat == "winter") {
    $stmt = $db->prepare('SELECT Name FROM Birds WHERE `Rarity Feral` >= :min AND `Rarity Feral` <= :max');
} else {
    $stmt = $db->prepare('SELECT Name FROM Birds WHERE `Rarity Escapee` >= :min AND `Rarity Escapee` <= :max');
}
$stmt->bindParam(":min", $min, SQLITE3_INTEGER);
$stmt->bindParam(":max", $max, SQLITE3_INTEGER);
$results = $stmt->execute();
$birds = array();
while ($row = $results->fetchArray()) {
    $birds[] = $row['Name'];
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Is This Bird In Leicestershire?</title>
        <style>
            body {
                background: #fafaff;
            }
            
            #search-panel {
                width: 95%;
                max-width: 800px;
                margin: 0 auto;
                margin-top: 30px;
            }
            
            #bird-search-bar select,
            #bird-search-bar input[type="numeric"]{
                display: inline-block;
                margin: 0;
                padding: 0.3em 0;
            }
            
            #bird-search-bar select {
                width: calc(90% - 200px - 1em);
            }
            
            #bird-search-bar input[type="numeric"]{
                width: 50px;
                text-align: center;
            }
            
            #bird-search-bar input[type="submit"] {
                width: 100px;
                display: inline-block;
                margin: 0 0 0 1em;
                padding: 0.3em 0;
            }
            
            #rarity-box {
                background-color: #fcfcfc;
                border: 1px solid #777;
                padding: 0.25em 1em;
            }
            
            #rarity-box .rarity-label {
                width: 30%;
                min-width: 150px;
                display: inline-block;
            }
        </style>
    </head>
    
    <body>
        <div id="search-panel">
            <form method="get" action="" id="bird-search-bar">
                <select name="category">
                    <option value="overall" <?php if($cat == "overall"){ echo "selected";} ?>>Overall</option>
                    <option value="winter" <?php if($cat == "winter"){ echo "selected";} ?>>Winter</option>
                    <option value="summer" <?php if($cat == "summer"){ echo "selected";} ?>>Summer</option>
                    <option value="breeding" <?php if($cat == "breeding"){ echo "selected";} ?>>Breeding</option>
                    <option value="passage" <?php if($cat == "passage"){ echo "selected";} ?>>Passage</option>
                    <option value="vagrant" <?php if($cat == "vagrant"){ echo "selected";} ?>>Vagrant</option>
                    <option value="feral" <?php if($cat == "feral"){ echo "selected";} ?>>Feral</option>
                    <option value="escapee" <?php if($cat == "escapee"){ echo "selected";} ?>>Escapee</option>
                </select>
                <input type="numeric" name="min" value="<?php echo $min; ?>" />
                <input type="numeric" name="max" value="<?php echo $max; ?>" />
                <input type="submit" />
            </form>
            <?php
                if(isset($birds)){
                    echo "<p class='rarity_heading'>Birds with ".$cat." rarity, min ".$min.", max ".$max." (".sizeof($birds)." total)</p>";
                    foreach($birds as $b) {
                        echo "<p>".$b."</p>";
                    }
                } else {
                    echo "<p class='rarity_heading'>No birds found</p>";
                }
            ?>
        </div>
    </body>
</html>