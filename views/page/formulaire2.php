<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 25/09/2015
 * Time: 15:25
 */
?>

<style>
    table{ width: 100%;}
</style>

<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">


    <table>
        <tr>
            <td style="width: 25%;"></td>
            <td style="width: 50%; text-align: center;">
                <h3>Miss Orangina 2017</h3>
                FORMULAIRE D’INSCRIPTION
            </td>
            <td style="width: 25%;"></td>
        </tr>
    </table>

    <table style="border: 1px solid #000; margin-top: 10px; padding: 10px;">
        <tr>
            <td style="text-align: justify;">
                La prise en compte effective de l’inscription implique que le présent formulaire et le règlement
                soient signés et accompagnés de la photocopie de CNI de la candidate, et  <b>d’un accord parental pour les  les candidates âgées de moins de 21 ans. En outre, les candidates mineures peuvent être accompagnées par leur père ou leur tuteur LEGAL</b>
            </td>
        </tr>
    </table>

    <h4 style="text-align: center"> INSCRIPTION (<?php echo $this->candidat['codeins'] ?>)</h4>
    <table style="margin-top: 10px;">
        <tr>
            <td style="padding: 10px 0 0; width: 50%;" colspan="2">Je soussignée, Mademoiselle <b><?php echo $this->candidat['nom']." ".$this->candidat['prenom']; ?></b></td>
        </tr>
        <tr>
            <td style="padding: 10px 0 0; width: 50%;" colspan="2">Atteste de l’exactitude des informations ci-après :</td>
        </tr>
        <tr>
            <td style="padding: 10px 0 0; width: 50%;" colspan="2">Je suis née le <?php
                echo $this->candidat['dateNais'];
                ?> a <?php echo $this->candidat['lieuNais'] ?></td>

        </tr>
        <tr>
            <td style="padding: 10px 0 0; width: 50%;">Je suis de Nationalité</td>
            <td style="width: 50%;"><strong><?php echo $this->candidat['nationalite'] ?></strong></td>
        </tr>
        <tr>
            <td style="padding: 10px 0 0; width: 50%;">Mon Adresse E-Mail est</td>
            <td style="padding: 10px 0 0; width: 50%;"><?php echo $this->candidat['email'] ?></td>
        </tr>
        <tr>
            <td style="padding: 10px 0 0; width: 50%;">Mon Adresse Personnelle est <strong><?php echo $this->candidat['adresse'] ?></strong>
            </td>
            <td style="padding: 10px 0 0; width: 50%;"><strong>Ville :</strong><?php echo $this->candidat['ville'] ?></td>

        </tr>
        <tr>
            <td style="padding: 10px 0 0; width: 50%;">Mon Numéro de Tél. est le</td>
            <td style="padding: 10px 0 0; width: 50%;"><b><?php echo $this->candidat['phone'] ?></b></td>
        </tr>
    </table>

    <h4 style="text-align: center"> QUESTIONNAIRE </h4>

    <table style="margin-top: 10px;">
        <tr>
            <td style="padding: 10px 0; width: 50%;">Profession ou études en cours</td>
            <td style="width: 50%;"><?php echo $this->candidat['profession'] ?></td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;">Dernier diplôme obtenu </td>
            <td style="width: 50%;"><?php echo $this->candidat['diplome'] ?></td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%">Si vous êtes élue Miss Orangina, quel serait votre rêve ?

            </td>
            <td style="width: 50%;"><?php echo $this->candidat['dream'] ?></td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%">Quelle est votre ambition dans la vie ?
            </td>
            <td style="width: 50%;">
                <?php echo $this->candidat['ambition'] ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;">Quels sont vos loisirs ?</td>
            <td style="width: 50%"><?php echo $this->candidat['loisir'] ?></td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;">Avez-vous déjà participé à un concours de beauté ? <br/>Si oui, à quelle occasion</td>
            <td style="width: 50%;"><?php echo $this->candidat['concours'] ?> </td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;">Votre taille sans talons</td>
            <td style="width: 50%"><?php echo $this->candidat['taille'] ?></td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;">Votre pointure </td>
            <td style="width: 50%"><?php echo $this->candidat['poitrine'] ?></td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;">Votre Citez 3 de vos qualités </td>
            <td style="width: 50%"><?php echo $this->candidat['qualite'] ?></td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;">Combien d’enfant (s) avez-vous ?</td>
            <td style="width: 50%;"> <?php echo $this->candidat['enfant'] ?> </td>
        </tr>

    </table>


    <table style="margin-top: 20px;">
        <tr>
            <td style="width: 50%"></td>
            <td style="width: 50%; text-align: center;">
                Fait à ---------------------------, le----------------------- 2017 <br/><br/>
                <b>Nom Prenom et Signature</b>

            </td>
        </tr>
    </table>



</page>
