<?php
/* Short and sweet */
define('WP_USE_THEMES', false);
require('./wp-blog-header.php');
?>

<?php
$posts = get_posts('numberposts=10&order=ASC&orderby=post_title');
foreach ($posts as $post) : setup_postdata( $post ); ?>
    <?php the_date(); echo "<br />"; ?>
    <?php the_title(); ?>
    <?php the_excerpt(); ?>
<?php
endforeach;
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, maximum-scale=1">
    <meta charset="UTF-8">
    <title>Credicant</title>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href="../resources/css/foundation.min.css" type="text/css" rel="stylesheet">
    <link href="../resources/css/style.css" type="text/css" rel="stylesheet">
</head>
<body>
<div class="bg-image"></div>
<div class="row centered main">

    <nav class="top-bar header shadow" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name">
                <h1><a href="#">Credicant</a></h1>
            </li>
            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
            <li class="toggle-topbar menu-icon"><a href="#"><span>Navigation</span></a></li>
        </ul>

        <section class="top-bar-section">
            <!-- Right Nav Section -->
            <ul class="right">
                <li ref="site-cart"><a href="#">Warenkorb</a></li>
            </ul>

            <!-- Left Nav Section -->
            <ul class="left">
                <li ref="site-home" class="active"><a href="#">Über mich</a></li>
                <li ref="site-shop"><a href="#" >Shop</a></li>
                <li ><a href="">Blog</a></li>
            </ul>
        </section>
    </nav>

    <div data-alert class="alert-box success radius">
        Bestellbestätigung wurde per Email versandt.
        <a href="#" class="close">&times;</a>
    </div>
    <div data-alert class="alert-box alert radius">
        Bei der Bestellung ist etwas schief gegangen. :-(
        <a href="#" class="close">&times;</a>
    </div>

    <!-- Content -->
    <div class="large-12 columns content">
        <!-- Home -->
        <div class="row" id="site-home">
            <div class="large-4 small-12 columns ">
                <img class="shadow" src="../resources/gfx/logo-schwarz.jpg">

                <div class="hide-for-small panel shadow opac">
                    <h3>Credicant</h3>
                    <h5 class="subheader">Create your Life<br/><br/>
                        Du liebst es einfach einfach,
                        reist gerne oder bist viel unterwegs?
                        Du magst es exklusiv und unkompliziert?<br/><br/>
                        Für dich bin ich auf die Reise gegangen.
                        In meinem Onlineshop findest du
                        coole Produkte aus aller Welt!
                    </h5>
                </div>

                <a href="#">
                    <div id="shoppingCartLabel" class="panel callout radius shadow opac">
                        <h5 class="shopping-cart-icon">keine Waren im Korb</h5>
                    </div>
                </a>
            </div>
            <div class="large-8 columns">
                <div class="row">
                    <div class="large-12 columns opac">
                        <div class="shadow">
                            <div class="panel">
                                <div class="row opac">
                                    <img class=" small-6 columns site-owner-picture"
                                         src="../resources/gfx/shop_owner.jpg">

                                    <div class=" small-6 columns ">
                                        <div>Hi, mein Name ist Flo. Ich starte hier ein Projekt, bei dem ich immer
                                            auf der Suche nach
                                            neuen, abgefahrenen Dingen bin. Schon immer hatte ich ein großes
                                            Interesse für Produkte,
                                            die mich faszinieren. Diese mussten mich durch Aussehen, Qualität und
                                            praktischem Nutzen
                                            überzeugen. Meine Begeisterung möchte ich nun mit Euch auf dieser
                                            Plattform teilen.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Home -->

        <!-- Shop -->
        <div class="row" id="site-shop"></div>
        <!-- End Shop -->

        <!-- Detail -->
        <div class="row" id="site-detail">
            <div class="small-6 columns">
                <div class="row">
                    <div class="small-12 columns text-center">
                        <img src="" id="detailPicture"/>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        <div id="detailThumbs"></div>
                    </div>
                </div>
            </div>
            <div class="small-6 columns">
                <div class="row">
                    <div class="small-6 columns item-margin">
                        <h2 id="detailTitle"></h2>
                    </div>
                    <div class="small-6 columns item-margin">
                        <button id="detailBack" class="primary tiny radius right">zurück</button>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns item-margin">
                        <div id="detailDesc"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="small-12 columns item-margin">
                        <ul id="detailKeywords"></ul>
                    </div>
                </div>
                <div class="row">
                    <div class="small-6 columns item-margin">
                        <h2 id="detailPrice"></h2>

                        <div class="small-text">keine MwSt Ausweiß gem. § 19 UStG</div>
                        <a class="small-text" href="#" data-reveal-id="shippingModal">zzgl. 5,90€ Versandkosten</a>
                    </div>
                    <div class="small-6 columns item-margin text-right">
                        <button id="detailAdd" style="margin-top: 10px;" class="add-to-cart primary small radius">+1
                        </button>
                        <a href="#" id="detailCart">
                            <div id="shoppingCartDetail"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Detail -->

        <!-- Cart -->
        <div class="row" id="site-cart">
            <div class="large-6 columns">
                <form id="order">
                    <div class="row">
                        <div class="large-12 columns">
                            <label>Vorname
                                <input type="text" name="forename" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>Nachname
                                <input type="text" name="surname" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>Straße
                                <input type="text" name="street" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>Stadt
                                <input type="text" name="city" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>PLZ
                                <input type="number" name="postal" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>E-Mail Adresse
                                <input type="email" name="mail" required/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <input type="submit" class="button medium primary radius"
                                   value="kostenpflichtig Bestellen"/>
                        </div>
                    </div>
                </form>
            </div>
            <div id="cartItems" class="large-6 columns"></div>
        </div>
        <!-- End Cart -->
    </div>
    <!-- End Content -->
    <footer class="row ">
        <div class="small-12 columns margin-top">
            <ul class="inline-list right small-text">
                <li><a href="#" data-reveal-id="impressumModal">Impressum</a></li>
                <li><a href="#" data-reveal-id="privacyModal">Datenschutzerklärung</a></li>
                <li><a href="#" data-reveal-id="rightModal">Widerrufsrecht</a></li>
                <li><a href="#" data-reveal-id="agbModal">AGB</a></li>
                <li><a href="#" data-reveal-id="shippingModal">Versandinformationen</a></li>
            </ul>
        </div>
    </footer>
</div>
<div id="impressumModal" class="reveal-modal" data-reveal aria-labelledby="impressumTitle" aria-hidden="true"
     role="dialog">
    <h2 id="impressumTitle">Impressum</h2>

    <p>Florian Herrmann<br/>Credicant<br/>Ingeborg-Bachmann-Weg 2<br/>79111 Freiburg im Breisgau</p>

    <p>Telefon: 076151924554</p>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
<div id="privacyModal" class="reveal-modal" data-reveal aria-hidden="true" role="dialog">
    <h2>Datenschutzerklärung</h2>

    <p>Wir freuen uns über Ihr Interesse an unserer Website. Der Schutz Ihrer
        Privatsphäre ist für uns sehr wichtig. Nachstehend informieren wir Sie ausführlich
        über den Umgang mit Ihren Daten.</p>

    <h3>Erhebung, Verarbeitung und Nutzung personenbezogener Daten</h3>

    <p>Sie können unsere Seite besuchen, ohne Angaben zu Ihrer Person zu machen.
        Wir speichern lediglich Zugriffsdaten ohne Personenbezug wie z.B. den Namen
        Ihres Internet Service Providers, die Seite, von der aus Sie uns besuchen oder
        den Namen der angeforderten Datei. Diese Daten werden ausschließlich zur
        Verbesserung unseres Angebotes ausgewertet und erlauben keinen Rückschluss
        auf Ihre Person.<br/><br/>
        Personenbezogene Daten werden nur erhoben, wenn Sie uns diese im Rahmen
        Ihrer Warenbestellung oder bei Eröffnung eines Kundenkontos oder
        Registrierung für unseren Newsletter freiwillig mitteilen. Wir verwenden die von
        ihnen mitgeteilten Daten ohne Ihre gesonderte Einwilligung ausschließlich zur
        Erfüllung und Abwicklung Ihrer Bestellung. Mit vollständiger Abwicklung des
        Vertrages und vollständiger Kaufpreiszahlung werden Ihre Daten für die weitere
        Verwendung gesperrt und nach Ablauf der steuer- und handelsrechtlichen
        Vorschriften gelöscht, sofern Sie nicht ausdrücklich in die weitere Nutzung Ihrer
        Daten eingewilligt haben. Bei Anmeldung zum Newsletter wird Ihre E-Mail-
        Adresse mit Ihrer Einwilligung für eigene Werbezwecke genutzt, bis Sie sich vom
        Newsletter abmelden. Die Abmeldung ist jederzeit möglich.</p>

    <h3>Weitergabe personenbezogener Daten</h3>

    <p>Eine Weitergabe Ihrer Daten erfolgt an das mit der Lieferung beauftragte
        Versandunternehmen, soweit dies zur Lieferung der Waren notwendig ist. Zur
        Abwicklung von Zahlungen geben wir Ihre Zahlungsdaten an das mit der Zahlung
        beauftragte Kreditinstitut weiter.</p>

    <h3>Auskunftsrecht</h3>

    <p>Nach dem Bundesdatenschutzgesetz haben Sie ein Recht auf unentgeltliche
        Auskunft über Ihre gespeicherten Daten sowie ggf. ein Recht auf Berichtigung,
        Sperrung oder Löschung dieser Daten.</p>

    <h3>Ansprechpartner für Datenschutz</h3>

    <p>Bei Fragen zur Erhebung, Verarbeitung oder Nutzung Ihrer personenbezogenen
        Daten, bei Auskünften, Berichtigung, Sperrung oder Löschung von Daten sowie
        Widerruf erteilter Einwilligungen wenden Sie sich bitte an:<br/>
        Florian Herrmann<br/>
        Ingeborg-Bachmann-Weg 2<br/>
        79111 Freiburg</p>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
<div id="rightModal" class="reveal-modal" data-reveal aria-hidden="true" role="dialog">
    <h2>Widerrufsbelehrung</h2>

    <h3>Widerrufsrecht</h3>

    <p>Sie können Ihre Vertragserklärung innerhalb von zwei Wochen ohne Angabe von
        Gründen in Textform (z. B. Brief, Fax, E-Mail) oder - wenn Ihnen die Sache vor
        Fristablauf überlassen wird - durch Rücksendung der Sache widerrufen. Die Frist
        beginnt nach Erhalt dieser Belehrung in Textform, jedoch nicht vor Eingang der
        Ware beim Empfänger (bei der wiederkehrenden Lieferung gleichartiger Waren
        nicht vor dem Eingang der ersten Teillieferung) und auch nicht vor Erfüllung
        unserer Informationspflichten gemäß § 312c Abs. 2 BGB in Verbindung mit § 1
        Abs. 1, 2 und 4 BGB-InfoV sowie unserer Pflichten gemäß § 312e Abs. 1 Satz 1
        BGB in Verbindung mit § 3 BGB-InfoV. Zur Wahrung der Widerrufsfrist genügt die
        rechtzeitige Absendung des Widerrufs oder der Sache. Der Widerruf ist zu richten
        an:<br/>
        Credicant<br/>
        Florian Herrmann<br/>
        Ingeborg-Bachmann-Weg 2<br/>
        79111 Freiburg im Breisgau<br/>
        info@credicant.com </p>

    <h3>Widerrufsfolgen</h3>

    <p>Im Falle eines wirksamen Widerrufs sind die beiderseits empfangenen Leistungen
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
        deren Empfang.</p>

    <h3>Ende der Widerrufsbelehrung</h3>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
<div id="agbModal" class="reveal-modal" data-reveal aria-hidden="true" role="dialog">
    <h2>Allgemeine Geschäftsbedingungen</h2>

    <h3>Geltungsbereich</h3>

    <p>Für alle Lieferungen vom Shop Credicant an
        Verbraucher (§ 13 BGB) gelten diese Allgemeinen Geschäftsbedingungen (AGB).</p>

    <h3>Vertragspartner</h3>

    <p>Der Kaufvertrag kommt zustande mit: Credicant, Inhaber: Florian Herrmann
        Ingeborg-Bachmann-Weg 2, 79111 Freiburg, Handelsregister: Amt für öffentliche Ordnung Freiburg. Sie erreichen
        unseren Kundendienst für Fragen,
        Reklamationen und Beanstandungen werktags von 17 UHR bis 21:00
        UHR unter der Telefonnummer 0761 -519 24 554 sowie per E-Mail unter info@credicant.com.</p>

    <h3>Angebot und Vertragsschluss</h3>

    <p>Die Darstellung der Produkte im Online-Shop stellt kein rechtlich bindendes
        Angebot, sondern einen unverbindlichen Online-Katalog dar.<br/>
        Durch Anklicken des Buttons kostenpflichtig bestellen geben Sie eine verbindliche
        Bestellung der auf der Bestellseite aufgelisteten Waren ab. Der Kaufvertrag
        kommt zustande, wenn wir Ihre Bestellung durch eine Auftragsbestätigung per EMail
        unmittelbar nach dem Erhalt Ihrer Bestellung annehmen.</p>

    <h3>Widerrufsrecht</h3>

    <p>Verbraucher haben ein zweiwöchiges Widerrufsrecht.</p>
    <h4>Widerrufsrecht</h4>

    <p>Sie können Ihre Vertragserklärung innerhalb von zwei Wochen ohne Angabe von
        Gründen in Textform (z. B. Brief, Fax, E-Mail) oder - wenn Ihnen die Sache vor
        Fristablauf überlassen wird - durch Rücksendung der Sache widerrufen. Die Frist
        beginnt nach Erhalt dieser Belehrung in Textform, jedoch nicht vor Eingang der
        Ware beim Empfänger (bei der wiederkehrenden Lieferung gleichartiger Waren
        nicht vor dem Eingang der ersten Teillieferung) und auch nicht vor Erfüllung
        unserer Informationspflichten gemäß § 312c Abs. 2 BGB in Verbindung mit § 1
        Abs. 1, 2 und 4 BGB-InfoV sowie unserer Pflichten gemäß § 312e Abs. 1 Satz 1
        BGB in Verbindung mit § 3 BGB-InfoV. Zur Wahrung der Widerrufsfrist genügt die
        rechtzeitige Absendung des Widerrufs oder der Sache. Der Widerruf ist zu richten
        an:<br/>
        Credicant<br/>
        Florian Herrmann<br/>
        Ingeborg-Bachmann-Weg 2<br/>
        79111 Freiburg im Breisgau<br/>
        info@credicant.com<br/></p>
    <h4>Widerrufsfolgen</h4>

    <p>Im Falle eines wirksamen Widerrufs sind die beiderseits empfangenen Leistungen
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
        deren Empfang.<br/><br/>
        Das Widerrufsrecht besteht nicht bei Lieferung von Waren, die nach
        Kundenspezifikation angefertigt werden (z.B. T-Shirts mit Ihrem Foto und Ihrem
        Namen) oder eindeutig auf die persönlichen Bedürfnisse zugeschnitten sind oder
        bei Lieferung von Audio- oder Videoaufzeichnungen oder von Software, sofern
        die gelieferten Datenträger von Ihnen entsiegelt worden sind (z.B. Software-CDs,
        bei denen die Cellophanhülle geöffnet wurde).</p>
    <h4>Rücksendekosten bei Ausübung des Widerrufsrechtes</h4>

    <p>Machen Sie von Ihrem gesetzlichen Widerrufsrecht Gebrauch (siehe
        Widerrufsbelehrung), haben Sie die regelmäßigen Kosten der Rücksendung zu
        tragen, wenn die gelieferte Ware der bestellten entspricht und wenn der Preis der
        zurückzusendenden Sache einen Betrag von 40 Euro nicht übersteigt oder wenn
        Sie bei einem höheren Preis der Sache zum Zeitpunkt des Widerrufs noch nicht
        die Gegenleistung oder eine vertraglich vereinbarte Teilzahlung erbracht haben.
        Anderenfalls ist die Rücksendung für Sie kostenfrei.
    </p>

    <h3>Preise und Versandkosten</h3>

    <p>Gem § 19 UStG wird die Mehrwertsteuer in der Rechnung nicht ausgewiesen.</p>

    <p>Zusätzlich zu den angegebenen Preisen berechnen wir für die Lieferung
        innerhalb Deutschlands pauschal 5,90 EUR pro Bestellung. Die Versandkosten
        werden Ihnen auf den Produktseiten, im Warenkorbsystem und auf der Bstellseite
        nochmals deutlich mitgeteilt.</p>

    <h3>Lieferung</h3>

    <p>Die Lieferung erfolgt nur innerhalb Deutschlands.</p>

    <p>Die Lieferzeit beträgt ca. 3 - 7 Tage.

    <h3>Liefervorbehalt</h3>

    <p>Alle Lieferungen erfolgen grundsätzlich so lange der Vorrat reicht. Sollte ein bestellter Artikel nicht lieferbar
        sein, werden wir Sie unverzüglich darüber informieren.</p>

    <h3>Zahlung</h3>

    <p>Die Zahlung erfolgt wahlweise per Vorkasse oder Paypal.</p>

    <p>Bei Auswahl der Zahlungsart Vorkasse nennen wir Ihnen unsere
        Bankverbindung in der Auftragsbestätigung und liefern die Ware nach
        Zahlungseingang.</p>

    <p>Ein Recht zur Aufrechnung steht Ihnen nur dann zu, wenn Ihre
        Gegenansprüche rechtskräftig gerichtlich festgestellt oder unbestritten sind oder
        schriftlich durch uns anerkannt wurden.</p>

    <p>Sie können ein Zurückbehaltungsrecht nur ausüben, soweit die Ansprüche
        aus dem gleichen Vertragsverhältnis resultieren.</p>

    <h3>Eigentumsvorbehalt</h3>

    <p>Bis zur vollständigen Zahlung bleibt die Ware unser Eigentum.</p>
    <h4>Weitere Informationen</h4>
    <h4>Bestellvorgang</h4>

    <p>Wenn Sie das gewünschte Produkt gefunden haben, können Sie dieses
        unverbindlich durch Anklicken des Symbols Warenkorb in den Warenkorb
        legen. Den Inhalt des Warenkorbs können Sie jederzeit durch Anklicken des
        Buttons Warenkorb unverbindlich ansehen. Die Produkte können Sie jederzeit
        durch Anklicken des Buttons Löschen wieder aus dem Warenkorb entfernen.
        Wenn Sie die Produkte im Warenkorb kaufen wollen, klicken Sie den Button zur
        Kasse. Bitte geben Sie dann Ihre Daten ein. Die Pflichtangaben sind mit einem *
        gekennzeichnet. Eine Registrierung ist nicht erforderlich. Ihre Daten werden
        verschlüsselt übertragen. Nach Eingabe Ihrer Daten und Auswahl der Zahlungsart
        gelangen Sie über den Button Eingaben prüfen zur Bestellseite, auf der Sie Ihre
        Eingaben nochmals überprüfen können. Durch Anklicken des Buttons kostenpflichtig bestellen schließen Sie den
        Bestellvorgang ab. Der Vorgang lässt sich jederzeit durch
        Schließen des Browser-Fensters abbrechen. Auf den einzelnen Seiten erhalten
        Sie weitere Informationen, z.B. zu Korrekturmöglichkeiten.</p>

    <p>Der Vertragstext wird auf unseren internen Systemen gespeichert. Die
        Allgemeinen Geschäftsbedingungen können Sie jederzeit auf dieser Seite
        einsehen. Die Bestelldaten und die AGB werden Ihnen per Email zugesendet.
        Nach Abschluss der Bestellung sind Ihre Bestelldaten aus Sicherheitsgründen
        nicht mehr über das Internet zugänglich.</p>

    <h3>Ende der Widerrufsbelehrung</h3>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
<div id="shippingModal" class="reveal-modal" data-reveal aria-hidden="true" role="dialog">
    <h2>Versandinformationen</h2>

    <p>Lieferzeit ca. 3 - 7 Tage</p>

    <p>Alle Lieferungen erfolgen grundsätzlich so lange der Vorrat reicht. Sollte ein bestellter Artikel nicht lieferbar
        sein, werden wir Sie unverzüglich darüber informieren.</p>

    <p>Kosten: 5,90 innerhalb Deutschlands</p>

    <p>Für Sendungen außerhalb Deutschlands kontaktieren Sie mich bitte unter info@credicant.com</p>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
<script src="../libs/vendor/jquery.js"></script>
<script src="../libs/foundation.min.js"></script>
<script src="../libs/inheritance-2.7.js"></script>
<script src="../libs/Namespace.js"></script>
<script src="../libs/Observable.js"></script>
<script src="../js/controller/Database.js"></script>
<script src="../js/models/Product.js"></script>
<script src="../js/models/Order.js"></script>
<script src="../js/models/ShoppingCartProducts.js"></script>
<script src="../js/views/ProductThumbView.js"></script>
<script src="../js/views/ProductDetailView.js"></script>
<script src="../js/views/ShoppingCartView.js"></script>
<script src="../js/views/ShoppingCartLabel.js"></script>
<script src="../js/views/Navigation.js"></script>
<script src="../js/Credicant.js"></script>
</body>
</html>