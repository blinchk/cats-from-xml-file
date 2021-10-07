<?php
$cats = simplexml_load_file("cats.xml");

$sorted_cats = array();

// Convert XML element to array
foreach($cats as $cat) {
    array_push($sorted_cats, $cat);
}
$cats = $sorted_cats;

// Compare cats by year of birth
function comparator($cat1, $cat2) {
    return strcmp($cat1->birthyear, $cat2->birthyear);
}

// Sort cats
usort($sorted_cats, 'comparator');

function filter_condition($cat) {
    return $cat->birthyear == 2010;
}

$yeartwentyten_cats = array_filter($cats, 'filter_condition');

function print_cats($cats) {
    foreach($cats as $cat) {
        echo "<tr>";
        echo "<td><strong>$cat->name</strong></td>";
        echo "<td>Sünniaasta: $cat->birthyear</td>";
        echo "</tr>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cats from XML table</title>
</head>
<body>
<table>
    <th colspan="2">Cats</th>
    <?php
    print_cats($cats);
    ?>
</table>
<hr>
<table>
    <th colspan="2">Cats, born in year 2010</th>
    <?php
    print_cats($yeartwentyten_cats);
    ?>
</table>
<footer>
    <a href="https://github.com/blinchk/cats-from-xml-file">GitHub Link</a>
</footer>
</body>
</html>