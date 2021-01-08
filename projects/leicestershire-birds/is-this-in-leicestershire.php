<?php
if(isset($_GET['bird'])) {
    $bird = $_GET['bird'];
} else {
    $bird = '';
}

$db = new SQLite3('birds.db');

$stmt = $db->prepare('SELECT * FROM Birds WHERE Name=:bird COLLATE NOCASE;');
$stmt->bindParam(":bird", $bird, SQLITE3_TEXT);
$results = $stmt->execute();

while ($row = $results->fetchArray()) {
    $b_cat = $row['Category'];
    $b_name = $row['Name'];
    $b_status = $row['Status'];
    $b_taxon = $row['Taxon'];
    $b_r_winter = $row['Rarity Winter'];
    $b_r_summer = $row['Rarity Summer'];
    $b_r_breeding = $row['Rarity Breeding'];
    $b_r_passage = $row['Rarity Passage'];
    $b_r_vagrant = $row['Rarity Vagrant'];
    $b_r_feral = $row['Rarity Feral'];
    $b_r_escapee = $row['Rarity Escapee'];
    $b_r_overall = $row['Rarity Overall'];
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
            
            #bird-search-bar input[type="text"] {
                width: calc(90% - 1em - 100px);
                display: inline-block;
                margin: 0;
                padding: 0.3em 0;
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
                <input type="text" name="bird" />
                <input type="submit" />
            </form>
            <?php
                if(isset($b_name)){
                    echo "<p><strong>".$b_name."</strong> has been found in Leicestershire and Rutland</p>";
                    echo "<div id='rarity-box'>";
                    echo "<p><span class='rarity-label'>Overall Rarity</span><span class='rarity-value'>".$b_r_overall."</span></p>";
                    echo "<p><span class='rarity-label'>Breeding Rarity</span><span class='rarity-value'>".$b_r_breeding."</span></p>";
                    echo "<p><span class='rarity-label'>Winter Rarity</span><span class='rarity-value'>".$b_r_winter."</span></p>";
                    echo "<p><span class='rarity-label'>Summer Rarity</span><span class='rarity-value'>".$b_r_summer."</span></p>";
                    echo "<p><span class='rarity-label'>Passage Rarity</span><span class='rarity-value'>".$b_r_passage."</span></p>";
                    echo "<p><span class='rarity-label'>Vagrant Rarity</span><span class='rarity-value'>".$b_r_vagrant."</span></p>";
                    echo "<p><span class='rarity-label'>Feral Rarity</span><span class='rarity-value'>".$b_r_feral."</span></p>";
                    echo "<p><span class='rarity-label'>Escapee Rarity</span><span class='rarity-value'>".$b_r_escapee."</span></p>";
                    echo "</div>";
                } else {
                    echo "<p>".$b_name." has not been found in Leicestershire and Rutland</p>";
                }
            ?>
        </div>
    </body>
</html>