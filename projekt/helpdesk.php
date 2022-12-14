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
	$( ".bloginhelp" ).click(function() {
			$( ".content" ).hide();
			$(".defaulthelptext").hide();
			$(".loginhelp").show();
		});
	$( ".bshowhelp" ).click(function() {
			$( ".content" ).hide();
			$(".defaulthelptext").hide();
			$(".showhelp").show();
		});
	$( ".baddhelp" ).click(function() {
			$( ".content" ).hide();
			$(".defaulthelptext").hide();
			$(".addhelp").show();
		});
	$( ".bshowreviewhelp" ).click(function() {
			$( ".content" ).hide();
			$(".defaulthelptext").hide();
			$(".showreviewhelp").show();
		});
	$( ".bformhelp" ).click(function() {
			$( ".content" ).hide();
			$(".defaulthelptext").hide();
			$(".formhelp").show();
		});
	$( ".breviewinghelp" ).click(function() {
			$( ".content" ).hide();
			$(".defaulthelptext").hide();
			$(".reviewinghelp").show();
		});
	$( ".bstatehelp" ).click(function() {
			$( ".content" ).hide();
			$(".defaulthelptext").hide();
			$(".statehelp").show();
		});
	$( ".breviewallowhelp" ).click(function() {
			$( ".content" ).hide();
			$(".defaulthelptext").hide();
			$(".reviewallowhelp").show();
		});
	$( ".bcomhelp" ).click(function() {
			$( ".content" ).hide();
			$(".defaulthelptext").hide();
			$(".comhelp").show();
		});
	$( ".bsmallchangeapprovehelp" ).click(function() {
			$( ".content" ).hide();
			$(".defaulthelptext").hide();
			$(".smallchangeapprovehelp").show();
		});
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
                <li><a href="/">??VOD</a></li>
                <li><a href="clanky.php">??L??NKY</a></li>
                <li><a href="archiv.php">ARCHIV</a></li>
                <?= $menu_login ?>
                <li class="kontakt"><a href="contact.php">KONTAKT</a></li>
                <li class="helpdesk"><a href="helpdesk.php">HELPDESK</a></li>
            </ul>
        </div>
        <div class="realhelpdesk" style="border: 2px solid black;float:left;width:100%">
            <div class="menu" style="background-color:aliceblue; float:left;width:31%;padding:15px 0 15px 15px">
                <p class="bloginhelp">Prihlaseni</p>
				<p class="bshowhelp">Zobrazen?? ??l??nku</p>
                <p class="baddhelp">P??id??v??n?? ??l??nku</p>
				<p class="bshowreviewhelp">Zobrazen?? recenz??</p>
				<p class="bformhelp">Oponentn?? formul????</p>
				<p class="breviewinghelp">Recenzov??n??</p>
				<p class="bstatehelp">Informov??n?? autora o stavu ??l??nku</p>
				<p class="breviewallowhelp">Zp????stupn??n?? recenz??</p>
				<p class="bcomhelp">Komunikace s recenzenty</p>
				<p class="bsmallchangeapprovehelp">Schvalov??n?? drobn??ch zm??n</p>
            </div>
			<div class="defaulthelptext" style="float:left;width:66%;padding:15px 15px 15px 0">
			Vyberte si z menu o ??em chcete n??co v??d??t
			</div>
            <div class="content loginhelp">
P??ihl????en?? u??ivatel??
Jedn?? se o formul????, kter?? slou???? k p??ihla??ov??n?? zaregistrovan??ch u??ivatel??. Obsahuje dv?? textov?? pole: emailov?? adresa a heslo; a tla????tko pro p??ihl????en??. Po odesl??n?? formul????e se kontroluje, zda se ??daje shoduj?? se z??pisy v datab??zi, jestli??e ano, pak je u??ivatel ??sp????n?? p??ihl????en, v opa??n??m p????pad?? je u??ivatel p??esm??rov??n zp??tky na ??vodn?? str??nku syst??mu s ur??itou zpr??vou.

            </div>
			<div class="content showhelp">
			U??ivatel m?? mo??nost zobrazit si vydan?? ??l??nky. D??le je zde mo??nost filtrov??n?? podle t??matu. ??l??nek si zobraz?? tak ??e klikne na odkaz ??l??nky v navigaci.
			
            </div>
			<div class="content addhelp">
			Autor m?? po p??ihl????en?? mo??nost p??ej??t na str??nku pro p??id??v??n?? ??l??nk??.
Ta obsahuje formul???? se vstupem pro titulek ??l??nku, spoluautory, samotn?? dokument ??l??nku s p????ponou .doc, .docx nebo .pdf, v??b??r ze ??ty?? t??mat a tla????tko na odesl??n??.
Po vypln??n?? a stisknut?? tla????tka se data z formul????e ode??lou do souboru se skriptem, kde jsou data zpracov??na a n??sledn?? vlo??ena jako nov?? z??znam do tabulky v datab??zi.

            </div>
			<div class="content showreviewhelp">
			Autor si m????e zobrazit recenze, nach??zej??c?? se na spodku str??nky u jeho zhodnocen??ch ??l??nk??.
Ka??d?? recenze obsahuje jm??no recenzenta, datum odesl??n??, hodnocen?? jednotliv??ch aspekt?? na stupnici od jedn?? po p??t hv??zd a tla????tko pro zobrazen?? cel?? recenze.
To po kliknut?? zobraz?? text slovn??ho zhodnocen?? a tla????tko odkazuj??c?? na oponentn?? formul????, m??-li autor k jak??koliv recenzi n??jak?? n??mitky.

            </div>
			<div class="content formhelp">
			Autor m?? mo??nost poslat n??mitky k recenz??m jeho ??l??nk?? pomoc?? oponentn??ho formul????e.
Formul???? obsahuje jm??no ??l??nku, jm??no recenzenta, textov?? pole pro n??mitky k recenzi a tla????tko k odesl??n??. Po odesl??n?? se n??mitka k recenzi objev?? ve vzkazech (podstr??nka webu), na kter?? vid?? redaktor.

            </div>
			<div class="content reviewinghelp">
			Recenzent m?? mo??nost si zobrazit p??id??len?? ??l??nky od redaktora, kter?? m?? zrecenzovat, v podstr??nce ?????L??NKY K RECENZI???.
            </div>
			<div class="content statehelp">
			Je m??sto kde redaktor m????e m??nit stav ??l??nku a p??idat k n??mu i n??jak?? vzkaz.
obr??zek ukazuje, jak se redaktor dostane k formul????i
Vlastn?? str??nka formul????e potom d??v?? mo??nost nastavit stav p????sp??vku a p????padn?? napsat autorovi n??jak?? informace pomoc?? vzkaz??. Zobrazuje se zde i n??zev ??l??nku, aby redaktor v??d??l, ke kter??mu ??l??nku d??l??.
            </div>
			<div class="content reviewallowhelp">
			Redaktor m????e zp????stupnit posudky recenzent?? autorovi vybr??n??m mo??nosti Zp????stupnit recenze.
            </div>
			<div class="content comhelp">
			Redaktor m?? mo??nost p??edat dan??m recenzent??m ur??it?? ??l??nek pomoc?? formul????e, na kter?? se dostane p??es: SPR??VA ??L??NK?? > SPRAVOVAT > P??edat recenzent??m.
            </div>
			<div class="content smallchangeapprovehelp">
			Pokud se redaktorovi na ??l??nku n??co nel??b??,  m????e si vy????dat od autora, aby sv??j ??l??nek upravil.
Po ??prav?? autorem se ve spr??v?? ??l??nk?? zobraz?? tla????tko, kter??m se redaktor dostane na str??nku, na n???? jsou odkazy jak na p??edchoz??, tak i upraven?? ??l??nek.
Tento upraven?? ??l??nek pak m????e pomoc?? tla????tek bu?? schv??lit, a nebo zam??tnout.

            </div>
        </div>
    </div>
</body>
</html>
