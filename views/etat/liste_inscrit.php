<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 25/09/2015
 * Time: 11:34
 */
?>
<style>
    table{
        width: 100%;
        border-collapse:collapse; border-spacing:0;
    }
    table td{
        padding: 5px;;
        border-bottom: 1px solid #000;
    }
</style>
<page backtop="7mm" backbottom="7mm" backleft="10mm" backright="10mm">
    <page_footer>
       Miss Orangina 2017: listes des inscriptions <?php echo $this->phase; ?> <?php if(isset($this->enattente)){ echo $this->enattente; }?> [[page_cu]]/[[page_nb]]
    </page_footer>
    <table>
        <tr>
            <td style="width: 31.5%;"></td>
            <td style="width: 39%; text-align: center;">
                <h3>Miss Orangina 2017</h3>
                LISTE DES INSCRIPTIONS <?php echo $this->phase; ?> <br/><strong><?php if(isset($this->enattente)){ echo $this->enattente; }?></strong>

            </td>
            <td style="width: 31.5%;"></td>
        </tr>
    </table>
    <br/>

    <table>

        <tr>
            <td style="width: 5%;
        border-bottom: 1px solid #000; ">No</td>
            <td style="width: 10% ;
        border-bottom: 1px solid #000; ">Code Insc.</td>
            <td style="width: 25%;
        border-bottom: 1px solid #000; ">Nom et prenom</td>
            <td style="width: 30%;
        border-bottom: 1px solid #000; ">Email</td>
            <td style="width: 22%;
        border-bottom: 1px solid #000; ">Telephone</td>
            <td style="width: 10%;
        border-bottom: 1px solid #000; ">Ville</td>
        </tr>

        <?php foreach($this->inscrit as $i => $inscrit): ?>
        <tr>
            <td style="width: 5% ;border-right: 1px solid #000;border-left: 1px solid #000; ">
                <?php echo $i+1 ?>
            </td>
            <td style="width: 10% ; border-right: 1px solid #000;">
                <?php echo $inscrit['codeins'] ?>
            </td>
            <td style="width: 25%; border-right: 1px solid #000;">
                <?php echo $inscrit['nom']." ".$inscrit['prenom'] ?>
            </td>
            <td style="width: 30%; border-right: 1px solid #000;">
                    <?php echo $inscrit['email'] ?>
            </td>
            <td style="width: 22%;border-right: 1px solid #000;">
                <?php echo $inscrit['phone'] ?>
            </td>
            <td style="width: 10%;border-right: 1px solid #000;">
                <?=
                $inscrit['ville'];
                ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

</page>