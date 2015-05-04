<?php
    function createOrderMail() {
        $shoppingItems = $_POST["order"];
        $surname = $_POST["surname"];
        $forename = $_POST["forename"];
        $street = $_POST["street"];
        $city = $_POST["city"];
        $postal = $_POST["postal"];

        $mail =
"Bestellung

";
        $sum = 0;
        foreach($shoppingItems as $item) {
            if ($item["count"] > 0) {
                $mail .= $item["count"] . " x " . $item["title"] . ": EUR " . $item["price"]*$item["count"] . PHP_EOL;
                $sum += $item["price"]*$item["count"];
            }
        }

        $mail .= "Gesamtpreis: EUR " . $sum . PHP_EOL;;
        $mail .= "Rechnungsanschrift: " . $forename . " " . $surname . ", " . $street . ", " . $postal . " " . $city . PHP_EOL;;

        return $mail;
    }

    function createConfirmationMail() {

        $shoppingItems = $_POST["order"];
        $surname = $_POST["surname"];
        $forename = $_POST["forename"];
        $street = $_POST["street"];
        $city = $_POST["city"];
        $postal = $_POST["postal"];

        $mail =
"Credicant
Florian Herrmann
Ingeborg-Bachmann-Weg 2
79111 Freiburg im Breisgau

Auftragsbestätigung
";

        $sum = 0;
        foreach($shoppingItems as $item) {
            if ($item["count"] > 0) {
                $mail .= $item["count"] . " x " . $item["title"] . ": EUR " . $item["price"] * $item["count"] . PHP_EOL;
                $sum += $item["price"] * $item["count"];
            }
        }

        $mail .= "Versandkosten: EUR 6,90" . PHP_EOL;;
        $mail .= "Gesamtpreis: EUR " . $sum . PHP_EOL;;
        $mail .= "Rechnungsanschrift: " . $forename . " " . $surname . ", " . $street . ", " . $postal . " " . $city . PHP_EOL;;

        $mail .=
"Zahlungsart: Vorkasse

Lieferzeit: ca. 3-7 Tage nach Zahlungseingang

Bitte überweisen Sie den Rechnungsbetrag binnen 5 Tagen auf unser Konto:

Florian Herrmann
KTO 7100884, BLZ 76560060 (Raiffeisen u. Volksbank Ansbach)
IBAN: DE55 7656 0060 0007 1008 84, BIC: GENODEF1ANS


Ich danke Ihnen ganz herzlich für Ihre Bestellung. Mit dieser E-Mail ist der Kaufvertrag geschlossen.
Es gelten unsere AGB (siehe Homepage), die Sie mit der Lieferung in Textform erhalten.

In Fröhlichkeit


Credicant



Verbraucher haben ein zweiwöchiges Widerrufsrecht. Das Widerrufsrecht besteht nicht bei
Fernabsatzverträgen zur Lieferung von Audio- oder Videoaufzeichnungen oder von Software, sofern
die gelieferten Datenträger vom Verbraucher entsiegelt worden sind.

**************************************************************************************************************
Widerrufsbelehrung

Widerrufsrecht

Sie können Ihre Vertragserklärung innerhalb von zwei Wochen ohne Angabe von
Gründen in Textform (z. B. Brief, Fax, E-Mail) oder - wenn Ihnen die Sache vor
Fristablauf überlassen wird - durch Rücksendung der Sache widerrufen. Die Frist
beginnt nach Erhalt dieser Belehrung in Textform, jedoch nicht vor Eingang der
Ware beim Empfänger (bei der wiederkehrenden Lieferung gleichartiger Waren
nicht vor dem Eingang der ersten Teillieferung) und auch nicht vor Erfüllung
unserer Informationspflichten gemäß § 312c Abs. 2 BGB in Verbindung mit § 1
Abs. 1, 2 und 4 BGB-InfoV sowie unserer Pflichten gemäß § 312e Abs. 1 Satz 1
BGB in Verbindung mit § 3 BGB-InfoV. Zur Wahrung der Widerrufsfrist genügt die
rechtzeitige Absendung des Widerrufs oder der Sache. Der Widerruf ist zu richten
an:

Credicant
Florian Herrmann
Ingeborg-Bachmann-Weg 2
79111 Freiburg im Breisgau
info@credicant.com

Widerrufsfolgen
Im Falle eines wirksamen Widerrufs sind die beiderseits empfangenen Leistungen
zurückzugew.hren und ggf. gezogene Nutzungen (z. B. Zinsen) herauszugeben.
Können Sie uns die empfangene Leistung ganz oder teilweise nicht oder nur in
verschlechtertem Zustand zurückgew.hren, müssen Sie uns insoweit ggf.
Wertersatz leisten. Bei der Überlassung von Sachen gilt dies nicht, wenn die
Verschlechterung der Sache ausschließlich auf deren Prüfung - wie sie Ihnen
etwa im Ladengeschäft möglich gewesen wäre - zurückzuführen ist. Im Übrigen
können Sie die Pflicht zum Wertersatz für eine durch die bestimmungsgemäße
Ingebrauchnahme der Sache entstandene Verschlechterung vermeiden, indem
Sie die Sache nicht wie Ihr Eigentum in Gebrauch nehmen und alles unterlassen,
was deren Wert beeinträchtigt. Paketversandfähige Sachen sind auf unsere
Gefahr zurückzusenden. Sie haben die Kosten der Rücksendung zu tragen, wenn
die gelieferte Ware der bestellten entspricht und wenn der Preis der
zurückzusendenden Sache einen Betrag von 40 Euro nicht übersteigt oder wenn
Sie bei einem höheren Preis der Sache zum Zeitpunkt des Widerrufs noch nicht
die Gegenleistung oder eine vertraglich vereinbarte Teilzahlung erbracht haben.
Anderenfalls ist die Rücksendung für Sie kostenfrei. Nicht paketversandfähige
Sachen werden bei Ihnen abgeholt. Verpflichtungen zur Erstattung von
Zahlungen müssen innerhalb von 30 Tagen erfüllt werden. Die Frist beginnt für
Sie mit der Absendung Ihrer Widerrufserklärung oder der Sache, für uns mit
deren Empfang.

Ende der Widerrufsbelehrung";

            return $mail;
    }

	$errors = array(); //To store errors
	$form_data = array(); //Pass back the data to `form.php`

	/* Validate the form on the server side */
	if (empty($_POST['order'])) { //Name cannot be empty
	    $errors['order'] = 'order cannot be blank';
	}

	if (!empty($errors)) { //If errors in validation
	    $form_data['success'] = false;
	    $form_data['errors']  = $errors;
	}
	else { //If not, process the form, and return true on success
	    $form_data['success'] = true;
	    $form_data['posted'] = 'Data Was Posted Successfully';

        if (isset($_POST["mail"]) &&
            isset($_POST["order"]) &&
            isset($_POST["surname"]) &&
            isset($_POST["forename"]) &&
            isset($_POST["street"]) &&
            isset($_POST["city"]) &&
            isset($_POST["postal"])) {

            $confirmationMail = createConfirmationMail();
            $orderMail = createOrderMail();

            $header = 'From: info@credicant.com' . "\r\n" .
                'Reply-To: info@credicant.com' . "\r\n" .
                "Mime-Version: 1.0\r\n" .
                "Content-type: text/plain; charset=iso-8859-1" .
                'X-Mailer: PHP/' . phpversion();

            mail($_POST["mail"], "Bestätigung Ihrer Bestellung bei Credicant.com", $confirmationMail, $header);
            mail("heizungauf5@gmx.net", "Bestellung eingegangen", $orderMail, $header);
        }
	}

	//Return the data back to form.php
	echo json_encode($form_data);
