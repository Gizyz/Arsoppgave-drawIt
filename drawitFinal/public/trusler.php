<?php
// Initialize the session
include_once 'header.php';
 
// Check if the user is logged in, if not then redirect him to login page

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){  
    header("location: login.php");
    exit;
}
?>
<section class="support">

    <h1>Risiko analyse</h1>

    <table class="risikoanalyse">
        <tr>
            <th>Hendelse</th>
            <th>Sannsynlighet</th>
            <th>Konsekvens</th>
            <th>Risiko</th>
            <th>Preventative tiltak</th>
            <th>Korrigerende tiltak</th>
        <tr>

        <tr>
            <td>Server blir på noen måte ødelagt(mistes, mister noe på den, blir skutt.</td>
            <td>Middels</td>
            <td>Svært høy</td>
            <td>Svært høy</td>
            <td>Lås server inne i et trygt skuddsikkert område, lage regler for hva man kan ha med inn. Backup av data
                og ekstra servere/ temp maskiner. Sikring av server.</td>
            <td></td>
        </tr>
        <tr>
            <td>IT ansvarlig blir alvorligskadet</td>
            <td>Lav</td>
            <td>Høy</td>
            <td>Høy</td>
            <td>Lei ekstra personal som kan ta over.God dokumentasjon så det er lett å ta over.Leie andre
                hostingløsninger som kan drifte for meg.</td>
            <td></td>
        </tr>
        <tr>
            <td>Server blir stjålet</td>
            <td>Lav</td>
            <td>Svært høy</td>
            <td>Høy</td>
            <td>Sikring av server. Lås, overvåking. Backup av data og ekstra servere/ temp maskiner.Sikring av
                server.Lås, overvåking.</td>
            <td>Sette opp temp maskiner, kjøpe nytt utstyr</td>
        </tr>
        <tr>
            <td>SQLInjection</td>
            <td>Middels</td>
            <td>Høy</td>
            <td>Høy</td>
            <td>Escape string, prepared statements og sanitized inputs</td>
            <td></td>
        </tr>Sikre mot, SQLInjections, ddos o.s.v
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Server mister strøm</td>
            <td>Middels</td>
            <td>Middels</td>
            <td>Middels</td>
            <td>Egen strøm generator i tilleg til strøm nett. Bruke nye sikringsskap, og ha bra jording mot eventuelt
                lyn. </td>
            <td></td>
        </tr>
        <tr>
            <td>Browser oppdateres og tags siden bruker mister funksjonalitet</td>
            <td>Lav</td>
            <td>Middels</td>
            <td>Lav</td>
            <td>Finne nyheter om browser endringer og plannlegge endringer iforhold til disse</td>
            <td></td>
        </tr>
        <tr>
            <td>Noen bruker tegne programmet til å lagre sensitiv informasjon</td>
            <td>Middels</td>
            <td>Middels</td>
            <td>Middels</td>
            <td>Gjøre klart for brukere at person sensitiv information ikke skal lagres på programmet</td>
            <td>Fjerne eventuel lagret informasjon</td>
        </tr>
    </table>
    </div>
</section>



</body>

</html>