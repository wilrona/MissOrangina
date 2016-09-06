<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 25/09/2015
 * Time: 14:16
 */
?>

<h2 style="text-align: center;">Liste des inscriptions par age</h2>

<table class="form-table" style="background: #eee">
    <tbody>

    <?php
    if($this->age):
        foreach($this->age as $age): ?>
        <tr>
            <td style="width: 50%;">
                Candidat ayant l'age de <strong> <?php echo $age['age'] ?> ans
                </strong>
            </td>
            <td style="width: 50%;">
                <a class="button" href="<?php echo get_site_url()."/etat/parage/".$age['age']."".$this->phase.""; ?>" target="_blank">PDF</a>
            </td>
        </tr>
    <?php
        endforeach;
    else:
        ?>

        <tr>
            <td style="width: 100%"><h4>Aucune information à traiter</h4></td>
        </tr>
    <?php
    endif;
    ?>
    </tbody>
</table>