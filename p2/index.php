<?php
session_start(); // Start the session

include 'functions.php';

// Check if the shopping list already exists in the session
if (!isset($_SESSION['shoppingList'])) {
    $_SESSION['shoppingList'] = []; // If it doesn't exist, initialize it as an empty array
}

$shoppingList = &$_SESSION['shoppingList']; // Reference to the shopping list

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['insert'])) {
        // Process insertion
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        if (!empty($name)) {
            $shoppingList[] = ['name' => $name, 'quantity' => $quantity, 'price' => $price];
        }
    } elseif (isset($_POST['modify'])) {
        // Process modification
        $id = $_POST['id'];
        $name = $_POST['name'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        if (!empty($name)) {
            $shoppingList[$id] = ['name' => $name, 'quantity' => $quantity, 'price' => $price];
        }
    } elseif (isset($_POST['delete'])) {
        // Process deletion
        $id = $_POST['id'];
        if (isset($shoppingList[$id])) {
            unset($shoppingList[$id]);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shopping List</title>
    <link rel="stylesheet" type="text/css" href="index.css">  <!-- Include a CSS file for styling. -->
</head>
<body>
    <h1>Shopping List</h1>
    <form method="post">
        <h2>Add</h2>
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Quantity:</label>
        <input type="number" name="quantity" required>
        <label>Price:</label>
        <input type="number" name="price" step="0.01" required>
        <input type="submit" name="insert" value="Add">
    </form>

    <h2>Modify</h2>
    <form method="post">
        <label>Select a product to modify:</label>
        <select name="id">
            <?php
            foreach ($shoppingList as $key => $item) {
                echo "<option value='$key'>$item[name]</option>";
            }
            ?>
        </select>
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Quantity:</label>
        <input type="number" name="quantity" required>
        <label>Price:</label>
        <input type="number" name="price" step="0.01" required>
        <input type="submit" name="modify" value="Modify">
    </form>

    <h2>Delete</h2>
    <form method="post">
        <label>Select a product to delete:</label>
        <select name="id">
            <?php
            foreach ($shoppingList as $key => $item) {
                echo "<option value='$key'>$item[name]</option>";
            }
            ?>
        </select>
        <input type="submit" name="delete" value="Delete">
    </form>

    <h2>Shopping List</h2>
    <?php
    if (count($shoppingList) > 0) {
        echo '<table>';
        echo '<tr><th>Name</th><th>Quantity</th><th>Price</th><th>Total</th></tr>';
        foreach ($shoppingList as $key => $item) {
            $total = 0;
            Calculate_Total_Product_Price($item['quantity'], $item['price'], $total);
            echo "<tr><td>$item[name]</td><td>$item[quantity]<a/td><td>$item[price]</td><td>$total</td></tr>";
        }
        $totalPurchase = Calculate_Total_Purchase_Price($shoppingList);
        echo "<tr><td colspan='3'>Total Purchase Price</td><td>$totalPurchase</td></tr>";
        echo '</table>';
    } else {
        echo 'There are no items in the shopping list.';
    }
    ?>
</body>
</html>
