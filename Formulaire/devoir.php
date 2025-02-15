<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Formulaire</title>
</head>

<body>
    <?php

    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pass = $_POST['pass'];
        $confpass = $_POST['confpass'];

        if ($pass !== $confpass) {
            echo "<p style='color:red;'>Les mots de passe ne correspondent pas.</p>";
        } else {
            if (isset($_POST['activities'])) {
                $activities = $_POST['activities'];
                if (count($activities) < 2 || count($activities) > 4) {
                    echo "<p style='color:red;'>Veuillez sélectionner entre deux et quatre activités de loisirs.</p>";
                } else {
                    echo "<p style='color:green;'>Formulaire soumis avec succès.</p>";
                }
            } else {
                echo "<p style='color:red;'>Veuillez sélectionner entre deux et quatre activités de loisirs.</p>";
            }
        }
    }
    ?>

    <form method="post" action="">
        <fieldset>
            <legend>Informations personnelles :</legend>
            <div class="champ">
                <label for="nom">Nom de famille :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="champ">
                <label for="prenom">Prenom :</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="champ">
                <label for="number">Numero :</label>
                <input type="number" id="number" name="numero" required>
                <label for="name">Nom de rue :</label>
                <input type="text" id="rue" name="rue" required>
                <label for="ville">Ville :</label>
                <input type="text" id="ville" name="ville" required>
                <label for="nom">Code postale :</label>
                <input type="number" id="Number" name="Number" min="0" max="99999" required><br>

                <?php

                ini_set('display_errors', 'On');
                error_reporting(E_ALL);

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $Number = $_POST["Number"];

                    if (!is_numeric($Number)) {
                        echo "Please enter a valid number.";
                    } elseif ($Number > 99999) {
                        echo "The number cannot exceed 99999.";
                    }
                }
                ?>
            </div>
            <div class="champ">
                <label for="mail">Adresse mail :</label>
                <input type="email" id="mail" name="mail" required>
            </div>
            <div class="champ">
                <label for="nom">Age :</label>
                <input type="number" id="Age" name="Age" min="0" max="99" required><br>

                <?php

                ini_set('display_errors', 'On');
                error_reporting(E_ALL);

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $Age = $_POST["Age"];

                    if (!is_numeric($Age)) {
                        echo "Vous devez entrer un age valide.";
                    } elseif ($Age > 99) {
                        echo "L'age ne peut pas depasser 99.";
                    }
                }
                ?>
            </div>
            <div class="champ">
                <input type="radio" id="h" name="sexe" value="homme">
                <label for="h">Homme</label>
                <input type="radio" id="f" name="sexe" value="femme">
                <label for="f">Femme</label>
            </div>
            <br>
            <div class="champ">
                <select id="nationalite" name="nationalite" required>
                    <option value="">votre nationalité</option>

                    <?php

                    ini_set('display_errors', 'On');
                    error_reporting(E_ALL);

                    if (($handle = fopen("nationality.csv", "r")) !== FALSE) {
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            echo '<option value=>' . htmlspecialchars($data[0]) . '</option>';
                        }
                        fclose($handle);
                    }
                    ?>

                </select>
            </div>
            <br>
            <div class="champ">
                <select id="pays_naissance" name="pays_naissance" required>
                    <option value="">pays de naissance</option>
                    <?php

                    ini_set('display_errors', 'On');
                    error_reporting(E_ALL);

                    if (($handle = fopen("pays.csv", "r")) !== FALSE) {
                        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                            echo '<option value=>' . htmlspecialchars($data[5]) . '</option>';
                        }
                        fclose($handle);
                    }
                    ?>
                </select>
            </div>
            <br>
            <div class="champ">
                <option value="">Presentez vous en 978 caracteres ! </option>
                <textarea name="exp" placeholder="Optionnel" maxlength="978"></textarea>
            </div>
            <?php !empty($_POST) ? var_dump($_POST) : ""; ?>
                <enctype="multipart/form-data" action="./upload.php" method="post">
                        <legend>Ajoutez votre avatar :</legend>
                        <p>
                            <label>Envoyer le fichier :</label>
                            <input name="fichier" type="file" />
                        </p>
        </fieldset>
        <fieldset>
            <legend>Activités :</legend>
            <div class="champ">
                <label for="activities">Sélectionnez vos activités (entre 2 et 4 maximums) :</label>
                <?php

                ini_set('display_errors', 'On');
                error_reporting(E_ALL);

                if (($handle = fopen("activity.txt", "r")) !== FALSE) {
                    while (($line = fgets($handle)) !== FALSE) {
                        $activity = htmlspecialchars(trim($line));
                        echo '<input type="checkbox" name="activities[]" value="' . $activity . '"> ' . $activity . '<br>';
                    }
                    fclose($handle);
                }
                ?>
            </div>
        </fieldset>
        <fieldset>
            <legend>Validation :</legend>
            <div class="champ">
                <label for="pass">Choisissez un mot de passe :</label>
                <input type="password" id="pass" name="pass" required>
            </div>

            <div class="champ">
                <label for="confpass">Confirmer votre mot de passe :</label>
                <input type="password" id="confpass" name="confpass" required>
            </div>
            <br>
            <div class="champ">
                <input type="checkbox" id="data" name="data" value="data">
                <label for="html">Vous consentez a la recolte et l'enregistrement des donnees fournies dans ce
                    formulaire pour un usage interne au site internet et a but non commercial.</label>
            </div>
            <br>
            <div>
                <input type="submit" value="Envoyer">
            </div>
            <?php

            ini_set('display_errors', 'On');
            error_reporting(E_ALL);

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $pass = $_POST['pass'];
                $confpass = $_POST['confpass'];

                if ($pass !== $confpass) {
                    echo "Les mots de passe ne correspondent pas.";
                    exit;
                }

                if (isset($_POST['activities'])) {
                    $activities = $_POST['activities'];
                    if (count($activities) < 2 || count($activities) > 4) {
                        echo "Veuillez sélectionner entre deux et quatre activités.";
                        exit;
                    }
                } else {
                    echo "Veuillez sélectionner entre deux et quatre activités.";
                    exit;
                }
            }
            ?>
        </fieldset>
    </form>
</body>

</html>