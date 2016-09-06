<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 25/09/2015
 * Time: 11:22
 */
?>

<h2 style="text-align: center;">Liste des inscriptions</h2>

<table class="form-table" style="background: #eee">
    <tbody>
    <tr>
        <td>
            <strong>Total des inscrits (complet)</strong>
        </td>
        <td>
            <a class="button" href="<?php echo get_site_url()."/etat/listeinscrit"; ?>" target="_blank">PDF</a>
        </td>
    </tr>
    <tr>
        <td>
            <strong>Total des inscrits (en attente)</strong>
        </td>
        <td>
            <a class="button" href="<?php echo get_site_url()."/etat/listeattente"; ?>" target="_blank">PDF</a>
        </td>
    </tr>
    </tbody>
</table>
<br/>