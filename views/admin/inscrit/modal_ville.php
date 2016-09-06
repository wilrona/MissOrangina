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
                <?php
                foreach ($this->villes as $villes) {
                        if($villes['id'] == $ville['ville']){
                            echo $villes['ville'];
                        }
                }?>
            </strong>
        </td>
        <td>
            <a class="button" href="<?php
            if($this->classement){
                echo get_site_url()."/etat/classementville/".$ville['ville']."".$this->phase;
            }else{

                echo get_site_url()."/etat/parville/".$ville['ville']."".$this->phase;
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