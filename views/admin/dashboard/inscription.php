<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 24/09/2015
 * Time: 13:51
 */

?>
<div id="activity-widget">
    <div id="published-posts" class="activity-block">
        <div style="border: 1px solid #eee;
    border-left: none;
    border-right: none; border-top: none">
        <h3 style="text-decoration: underline">STATISTIQUE GLOBALE</h3>
            </div>
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
        <br/>
        <div style="border: 1px solid #eee;
    border-left: none;
    border-right: none;">
            <h3 style="text-decoration: underline">STATISTIQUE PAR VILLE</h3>
        </div>
        <table class="form-table" style="background: #eee">
            <thead style="border-bottom: 1px solid #000;">
            <tr>
                <th style="padding: 15px 10px !important;">Ville</th>
                <th style="padding: 15px 10px !important;">Nombre</th>
            </tr>
            </thead>
            <tbody>
            <?php if($this->inscrit_par_ville): ?>
            <?php foreach($this->inscrit_par_ville as $ville): ?>
                <tr>
                    <td>
                        <strong>
                            <?= $ville['ville']; ?>
                        </strong>
                    </td>
                    <td style="border-left: 1px solid #9d9d9d;">
                        <?php echo $ville['nbr'] ?> candidat(s)
                    </td>
                </tr>
            <?php endforeach; else: ?>
                <tr>
                    <td>
                        <h4>Aucune information</h4>
                    </td>
                </tr>
            <?php endif?>
            </tbody>
        </table>

        <br/>
        <div style="border: 1px solid #eee;
    border-left: none;
    border-right: none;">
            <h3 style="text-decoration: underline">STATISTIQUE PAR AGE</h3>
        </div>
        <table class="form-table" style="background: #eee">
            <thead style="border-bottom: 1px solid #000;">
                <tr>
                    <th style="padding: 15px 10px !important;">Age</th>
                    <th style="padding: 15px 10px !important;">Nombre</th>
                </tr>
            </thead>
            <tbody>
            <?php if($this->inscrit_par_age): ?>
            <?php foreach($this->inscrit_par_age as $age): ?>
            <tr>
                <td>
                    <strong><?php echo $age['Age']; ?> ans</strong>
                </td>
                <td style="border-left: 1px solid #9d9d9d;">
                    <?php echo $age['nbr']; ?> candidat(s)
                </td>
            </tr>
            <?php endforeach; else: ?>
                <tr>
                    <td>
                        <h4>Aucune information</h4>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>

    </div>

    <div id="latest-comments" class="activity-block">
        <ul class="subsubsub">
            <li class="all"><a href="<?php echo get_site_url()."/etat/statistique"; ?>" target="_blank">Imprimer en pdf</a> </li>
        </ul>

    </div>
</div>