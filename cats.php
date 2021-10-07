<?php
$cats = simplexml_load_file("cats.xml");

$sorted_cats = array();

// Convert XML element to array
foreach($cats as $cat) {
    array_push($sorted_cats, $cat);
}

// Compare cats by year of birth
function comparator($cat1, $cat2) {
    return strcmp($cat1->birthyear, $cat2->birthyear);
}

// Sort cats
usort($sorted_cats, 'comparator');

function filter_birthyear_condition($cat) {
    return $cat->birthyear == 2010;
}

function filter_afterbirthyear_string_length($cat) {
    return $cat->birthyear > 2015 && strlen($cat -> name) < 6 && substr($cat -> name, 0, 1) == 'N';
}

$yeartwentyten_cats = array_filter($sorted_cats, 'filter_birthyear_condition');
$myfilter_cats = array_filter($sorted_cats, 'filter_afterbirthyear_string_length');

function print_cats_as_table_element($cats) {
    foreach($cats as $cat) {
        echo "<tr>";
        echo "<td><strong>$cat->name</strong></td>";
        echo "<td>Sünniaasta: $cat->birthyear</td>";
        echo "</tr>";
    }
}

function print_cats_as_text($cats) {
    foreach($cats as $cat) {
        echo "<h1>$cat->name</h1>";
        echo "<p>Sünniaasta: $cat->birthyear</p>";
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
<h1>XML PHP arvestus</h1>
<hr>
<?php
print_cats_as_text($cats);
?>
<hr>
<?php
print_cats_as_text($sorted_cats);
?>
<hr>
<h1>Cats, born in year 2010</h1>
<table>
    <tr><th>Name</th><th>Year of birth</th></tr>
    <?php
    print_cats_as_table_element($yeartwentyten_cats);
    ?>
</table>
<hr>
<h1>Cats, born after year 2016 with less than 6 characters in the name, also N should be first character in the name. Display as table.</h1>
<table>
    <tr><th>Name</th><th>Year of birth</th></tr>
    <?php
    print_cats_as_table_element($myfilter_cats);
    ?>
</table>
<hr>
<footer>
    <a href="https://github.com/blinchk/cats-from-xml-file">GitHub Link</a>
</footer>
</body>
</html>