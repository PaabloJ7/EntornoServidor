<!DOCTYPE html>
<html>
<head>
    <title>Language Selection</title>
</head>
<body>
<?php
// Check if the user's language is stored in a cookie
if (isset($_COOKIE['language'])) {
    $selectedLanguage = $_COOKIE['language'];
} else {
    // If the cookie doesnt exist, set the default language to spanish
    $selectedLanguage = 'es';
}

// Send the selection
if (isset($_POST['language'])) {
    $selectedLanguage = $_POST['language'];
    setcookie('language', $selectedLanguage, time() + 3600 * 24 * 30); // Set a cookie for 30 days
}
// Display the language selection form
echo '<form method="post">';
echo 'Select your preferred language: ';
echo '<select name="language">';
echo '<option value="es" ' . ($selectedLanguage == 'es' ? 'selected' : '') . '>Spanish</option>';
echo '<option value="en" ' . ($selectedLanguage == 'en' ? 'selected' : '') . '>English</option>';
echo '</select>';
echo '<input type="submit" value="Save Language">';
echo '</form>';

// Display content based on the selected language
if ($selectedLanguage == 'es') {

    echo '<h2>Bienvenido a nuestra página web</h2>';
    echo '<p>Esta página se muestra en español.</p>';
} else {
    echo '<h2>Welcome to our website</h2>';
    echo '<p>This page is displayed in English.</p>';
}
?>
</body>
</html>
