<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 25/09/2015
 * Time: 13:54
 */
?>

<?php if($this->classement): ?>
    <h2 style="text-align: center;">Classement
        <?php
            if($this->phase_num == 2){
                echo "1/4 Finale";
            }elseif($this->phase_num == 3){
                echo "1/2 Final";
            }elseif($this->phase_num == 4){
                echo "Final";
            }
        ?>
        par ville</h2>
<?php else: ?>
<h2 style="text-align: center;">Liste des inscriptions par ville</h2>
<?php endif; ?>

<table class="form-table" style="background: #eee">
    <tbody>

    <?php
    if($this->ville):
    foreach($this->ville as $ville): ?>
    <tr>
        <td>
            <strong>
                <?=
                $ville['ville'];
                ?>
            </strong>
        </td>
        <td>
            <a class="button" href="<?php
            
            //Conversion des majuscules en minuscule
            $string = strtolower(htmlentities($ville['ville'])); 
            //Listez ici tous les balises HTML que vous pourriez rencontrer
            $string = preg_replace("/&(.)(acute|cedil|circ|ring|tilde|uml|grave);/", "$1", $string); 
            //Tout ce qui n'est pas caractère alphanumérique  -> _
            $string = preg_replace("/([^a-z0-9]+)/", "_", html_entity_decode($string)); 


            if($this->classement){
                echo get_site_url()."/etat/classementville/".$string."".$this->phase;
            }else{

                echo get_site_url()."/etat/parville/".$string."".$this->phase;
            }
            ?>

            " target="_blank">PDF</a>
        </td>
    </tr>
    <?php endforeach;

        else:
    ?>

    <tr>
        <td style="width: 100%"><h4>Aucune information à traiter</h4></td>
    </tr>
    <?php

    endif; ?>
    </tbody>
</table>