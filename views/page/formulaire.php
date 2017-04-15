<style>
    table{ width: 100%;}
</style>

<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">


    <table>
        <tr>
            <td style="width: 33%;"></td>
            <td style="width: 33%; text-align: center;">
                <h3>Miss Orangina 2017</h3>
                FORMULAIRE D’INSCRIPTION ET QUESTIONNAIRE

            </td>
            <td style="width: 33%;"></td>
        </tr>
    </table>

    <table style="border: 1px solid #000; margin-top: 20px; padding: 10px;">
        <tr>
            <td style="text-align: center; ">

                La prise en compte effective de l’inscription implique que le présent formulaire et le règlement
                soient signés et accompagnés de la photocopie de CNI, et  <b>d’un accord parental légalisé pour les  les candidates âgées de moins de 21 ans</b>

            </td>
        </tr>
    </table>

    <table style="margin-top: 10px;">
        <tr>
            <td style="padding: 20px 0; width: 100%;" colspan="2">Je soussignée, atteste de l’exactitude des informations fournies ci-après</td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;"><b>CANDIDAT No</b></td>
            <td style="width: 50%;"> <?php echo $this->candidat['codeins'] ?></td>

        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;"><b>NOMS ET PRENOMS</b></td>
            <td style="width: 50%;"><?php echo $this->candidat['nom']." ".$this->candidat['prenom']; ?> </td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;"><b>DATE ET LIEU DE NAISSANCE</b></td>
            <td style="width: 50%;">
                <?php
                echo $this->candidat['dateNais'];
                ?> a <?php echo $this->candidat['lieuNais'] ?></td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;"><b>NATIONALITE</b></td>
            <td style="width: 50%;"><?php echo $this->candidat['nationalite'] ?></td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;"><b>ADRESSE PERSONNELLE</b></td>
            <td style="width: 50%;"><?php echo $this->candidat['adresse'] ?></td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;"><b>VILLE</b></td>
            <td style="width: 50%;">
                <?php
                    if($this->candidat['ville'] == "DLA"){
                        echo 'Douala';
                    }elseif($this->candidat['ville'] == "YDE"){
                        echo 'Yaounde';
                    }else{
                        echo 'Buea';
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;"><b>TEL/PORTABLE</b></td>
            <td style="width: 50%;"><?php echo $this->candidat['phone'] ?></td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;"><b>COMPTE TWITTER</b></td>
            <td style="width: 50%;"><?php echo $this->candidat['tweeter'] ?></td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;"><b>PROFESSION OU ÉTUDES EN COURS</b></td>
            <td style="width: 50%;"><?php echo $this->candidat['profession'] ?></td>
        </tr>
        <tr>
            <td style="padding: 10px 0;"><b>SIGNES DISTINCTIFS </b></td>
            <td style="width: 50%"><?php echo $this->candidat['signe'] ?></td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;"><b>TAILLE SANS TALONS</b></td>
            <td style="width: 50%;"><?php echo $this->candidat['taille'] ?></td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;"><b>SITUATION MATRIMONIALE</b></td>
            <td style="width: 50%;">
                <?php
                    if($this->candidat['marie'] == true){
                        echo "Mariée";
                    }else{
                        echo 'Célibataire';
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 50%;"><b>ENFANTS</b></td>
            <td style="width: 50%;">
                <?php
                if($this->candidat['enfant'] == true){
                    echo "Oui";
                }else{
                    echo 'Non';
                }
                ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 100%" colspan="2"><b>Avez-vous déja fait l’objet de poursuites judiciaires pénales ?</b>
                <?php echo $this->candidat['poursuite'] ?>
            </td>
        </tr>
        <tr>
            <td style="padding: 10px 0; width: 100%" colspan="2"><b>Avez vous déja participé a un concours de beauté? Si oui, indiquez la dénomination, l’année et l’organisateur?</b>
                <?php echo $this->candidat['concours'] ?>
            </td>
        </tr>
        
    </table>

    <table style="margin-top: 20px;">
        <tr>
            <td style="width: 10%;">
                <table>
                    <tr>
                        <td style="border: 5px solid #000; width:10%;padding: 10px;"> </td>
                    </tr>
                </table>
                cocher
            </td>
            <td style="text-align: justify; width: 90%">
                Je déclare être en bonne sante physique et mentale me permettant de participer  aux différentes activités de l’élection Miss Orangina. Je confirme également  la sincérité des informations  contenues dans ce document. J’ai conscience que toute information inexacte serait susceptible de me disqualifier, d’occasionner un grave préjudice à l’élection et à ses organisateurs que je devrai alors assumer.
            </td>
        </tr>
    </table>

    <table style="margin-top: 20px;">
        <tr>
            <td style="width: 50%"></td>
            <td style="width: 50%; text-align: center;">
                Signature de la candidate <br/>
                Faire précéder de la mention : « Je le certifie »

            </td>
        </tr>
    </table>
    


</page>