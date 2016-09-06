<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 23/10/2015
 * Time: 17:33
 */
?>

<style>
    table{
        width: 100%;
    }
    table td{
        width: 50%;
        padding: 20px 10px;
    }
</style>

<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <table>
        <tr>
            <td style="width: 30%;"></td>
            <td style="width: 39%; text-align: center;">
                <h3>Miss Orangina 2015</h3>
                STATISTIQUE DES VOTES  <?= $this->phase; ?>

            </td>
            <td style="width: 30%;"></td>
        </tr>
    </table>

    <table style="border: 1px solid #eee;
        border-left: none;
        border-right: none; border-top: none">
        <tr>
            <td style="width: 100%; text-align: center">
                <h4 style="text-decoration: underline;">STATISTIQUE GLOBALE</h4>
            </td>
        </tr>
    </table>


    <table class="form-table" style="background: #eee">
        <tbody>
        <tr>
            <td>
                <strong>Total des votes</strong>
            </td>
            <td>
                <?php echo $this->votes; ?> vote(s)
            </td>
        </tr>
        </tbody>
    </table>

    <table style="border: 1px solid #eee;
        border-left: none;
        border-right: none; border-top: none">
        <tr>
            <td style="width: 100%; text-align: center">
                <h4 style="text-decoration: underline;">STATISTIQUE DES VOTES PAR VILLE</h4>
            </td>
        </tr>
    </table>

    <table class="form-table" style="background: #eee">

        <tbody>
        <tr>
            <td style="border-bottom: 1px solid #9d9d9d">Ville</td>
            <td style="border-bottom: 1px solid #9d9d9d">Nombre</td>
        </tr>
        <?php foreach($this->vote_par_ville as $ville): ?>
            <tr>
                <td style="border-right: 1px solid #9d9d9d;">
                    <strong>
                        <?php
                        foreach ($this->villes as $villes) {
                            if($villes['id'] == $ville->ville){
                                echo $villes['ville'];
                            }
                        }?>
                    </strong>
                </td>
                <td style="border-left: 1px solid #9d9d9d;">
                    <?php echo $ville->nbr ?> vote(s)
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</page>