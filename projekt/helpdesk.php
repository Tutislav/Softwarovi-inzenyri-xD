<?php
    require("backend/common.php");
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT World</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/<?= basename(__FILE__, ".php") ?>.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?= $scripts ?>
	<script>
	$( document ).ready(function() {
    $(".content").toggle();
	});
	</script>
	<style>
	.content{
		padding:15px 15px 15px 0;
		width:66%;
		float:left;
	}
	</style>
</head>
<body>
    <div class="container">
        <div id="login_register">
            <span id="message"><?= $message ?></span>
            <span id="login"><?= $login_span ?></span>
            <span id="register"><?= $register_span ?></span>
        </div>
        <div id="heading">
            <h1>IT WORLD</h1>
        </div>
        <div id="navigation">
            <ul> 
                <li><a href="/">ÚVOD</a></li>
                <li><a href="clanky.php">ČLÁNKY</a></li>
                <li><a href="archiv.php">ARCHIV</a></li>
                <?= $menu_login ?>
                <li class="kontakt"><a href="contact.php">KONTAKT</a></li>
                <li class="helpdesk"><a href="helpdesk.php">HELPDESK</a></li>
            </ul>
        </div>
		<script>
$( ".bloginhelp" ).click(function() {
  $( ".content" ).hide();
  $(".loginhelp").show();
});
</script>
        <div class="realhelpdesk" style="border: 2px solid black;float:left;width:100%">
            <div class="menu" style="background-color:aliceblue; float:left;width:31%;padding:15px 0 15px 15px">
                <p class="all bloginhelp">Prihlaseni</p>
				<p class="all bshowhelp">Zobrazení článku</p>
                <p class="all baddhelp">Přidávání článku</p>
				<p class="all bshowreviewhelp">Zobrazení recenzí</p>
				<p class="all bformhelp">Oponentní formulář</p>
				<p class="all breviewinghelp">Recenzování</p>
				<p class="all bstatehelp">Informování autora o stavu článku</p>
				<p class="all breviewallowhelp">Zpřístupnění recenzí</p>
				<p class="all bcomhelp">Komunikace s recenzenty</p>
				<p class="all bsmallchangeapprovehelp">Schvalování drobných změn</p>
            </div>
			<div class="defaulthelptext" style="float:left;width:66%;padding:15px 15px 15px 0">
			Vyberte si z menu o čem chcete něco vědět
			</div>
            <div class="content loginhelp">
Přihlášení uživatelů
Jedná se o formulář, který slouží k přihlašování zaregistrovaných uživatelů. Obsahuje dvě textové pole: emailová adresa a heslo; a tlačítko pro přihlášení. Po odeslání formuláře se kontroluje, zda se údaje shodují se zápisy v databázi, jestliže ano, pak je uživatel úspěšně přihlášen, v opačném případě je uživatel přesměrován zpátky na úvodní stránku systému s určitou zprávou.

            </div>
			<div class="content showhelp">
			Uživatel má možnost zobrazit si vydané články. Dále je zde možnost filtrování podle tématu. článek si zobrazí tak že klikne na odkaz články v navigaci.
			
            </div>
			<div class="content addhelp">
			Autor má po přihlášení možnost přejít na stránku pro přidávání článků.
Ta obsahuje formulář se vstupem pro titulek článku, spoluautory, samotný dokument článku s příponou .doc, .docx nebo .pdf, výběr ze čtyř témat a tlačítko na odeslání.
Po vyplnění a stisknutí tlačítka se data z formuláře odešlou do souboru se skriptem, kde jsou data zpracována a následně vložena jako nový záznam do tabulky v databázi.

            </div>
			<div class="content showreviewhelp">
			Autor si může zobrazit recenze, nacházející se na spodku stránky u jeho zhodnocených článků.
Každá recenze obsahuje jméno recenzenta, datum odeslání, hodnocení jednotlivých aspektů na stupnici od jedné po pět hvězd a tlačítko pro zobrazení celé recenze.
To po kliknutí zobrazí text slovního zhodnocení a tlačítko odkazující na oponentní formulář, má-li autor k jakékoliv recenzi nějaké námitky.

            </div>
			<div class="content formhelp">
			Autor má možnost poslat námitky k recenzím jeho článků pomocí oponentního formuláře.
Formulář obsahuje jméno článku, jméno recenzenta, textové pole pro námitky k recenzi a tlačítko k odeslání. Po odeslání se námitka k recenzi objeví ve vzkazech (podstránka webu), na které vidí redaktor.

            </div>
			<div class="content reviewinghelp">
			Recenzent má možnost si zobrazit přidělené články od redaktora, které má zrecenzovat, v podstránce „ČLÁNKY K RECENZI“.
            </div>
			<div class="content statehelp">
			Je místo kde redaktor může měnit stav článku a přidat k němu i nějaký vzkaz.
obrázek ukazuje, jak se redaktor dostane k formuláři
Vlastní stránka formuláře potom dává možnost nastavit stav příspěvku a případně napsat autorovi nějaké informace pomocí vzkazů. Zobrazuje se zde i název článku, aby redaktor věděl, ke kterému článku dělá.
            </div>
			<div class="content reviewallowhelp">
			Redaktor může zpřístupnit posudky recenzentů autorovi vybráním možnosti Zpřístupnit recenze.
            </div>
			<div class="content comhelp">
			Redaktor má možnost předat daným recenzentům určitý článek pomocí formuláře, na který se dostane přes: SPRÁVA ČLÁNKŮ > SPRAVOVAT > Předat recenzentům.
            </div>
			<div class="content smallchangeapprovehelp">
			Pokud se redaktorovi na článku něco nelíbí,  může si vyžádat od autora, aby svůj článek upravil.
Po úpravě autorem se ve správě článků zobrazí tlačítko, kterým se redaktor dostane na stránku, na níž jsou odkazy jak na předchozí, tak i upravený článek.
Tento upravený článek pak může pomocí tlačítek buď schválit, a nebo zamítnout.

            </div>
        </div>
    </div>
</body>
</html>
