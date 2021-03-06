<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 25/09/2015
 * Time: 06:33
 */ ?>

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
                <h3>Miss Orangina 2017</h3>
                STATISTIQUE DES INSCRIPTIONS

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
                <strong>Total des inscrits</strong>
            </td>
            <td>
                <?php echo $this->inscrit_complet; ?> candidat(s)
            </td>
        </tr>
        </tbody>
    </table>

    <table style="border: 1px solid #eee;
        border-left: none;
        border-right: none; border-top: none">
        <tr>
            <td style="width: 100%; text-align: center">
                <h4 style="text-decoration: underline;">STATISTIQUE PAR VILLE</h4>
            </td>
        </tr>
    </table>

    <table class="form-table" style="background: #eee">

        <tbody>
        <tr>
            <td style="border-bottom: 1px solid #9d9d9d">Ville</td>
            <td style="border-bottom: 1px solid #9d9d9d">Nombre</td>
        </tr>
        <?php foreach($this->inscrit_par_ville as $ville): ?>
            <tr>
                <td style="border-right: 1px solid #9d9d9d;">
                    <strong>
                        <?= $ville['ville']; ?>
                    </strong>
                </td>
                <td style="border-left: 1px solid #9d9d9d;">
                    <?php echo $ville['nbr'] ?> candidat(s)
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <table style="border: 1px solid #eee;
        border-left: none;
        border-right: none; border-top: none">
        <tr>
            <td style="width: 100%; text-align: center">
                <h4 style="text-decoration: underline;">STATISTIQUE PAR AGE</h4>
            </td>
        </tr>
    </table>

    <table class="form-table" style="background: #eee">

        <tbody>
            <tr>
                <td style="border-bottom: 1px solid #9d9d9d">Age</td>
                <td style="border-bottom: 1px solid #9d9d9d">Nombre</td>
            </tr>
            <?php foreach($this->inscrit_par_age as $age): ?>
                <tr>
                    <td style="border-right: 1px solid #9d9d9d;">
                        <strong><?php echo $age['Age']; ?> ans</strong>
                    </td>
                    <td style="border-left: 1px solid #9d9d9d;">
                        <?php echo $age['nbr']; ?> candidat(s)
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</page>