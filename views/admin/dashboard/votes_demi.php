<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 23/10/2015
 * Time: 16:56
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
                    <strong>Total des votes</strong>
                </td>
                <td>
                    <?php echo $this->votes; ?> vote(s)
                </td>
            </tr>
            </tbody>
        </table>
        <br/>
        <div style="border: 1px solid #eee;
    border-left: none;
    border-right: none;">
            <h3 style="text-decoration: underline">STATISTIQUE DES VOTES PAR VILLE</h3>

        </div>
        <table class="form-table" style="background: #eee">
            <thead style="border-bottom: 1px solid #000;">
            <tr>
                <th style="padding: 15px 10px !important;">Ville</th>
                <th style="padding: 15px 10px !important;">Nombre</th>
            </tr>
            </thead>
            <tbody>
            <?php if($this->vote_par_ville): ?>
                <?php foreach($this->vote_par_ville as $ville): ?>
                    <tr>
                        <td>
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
                            <?php echo $ville->nbr ?> Vote(s)
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

    </div>

    <div id="latest-comments" class="activity-block">
        <ul class="subsubsub">
            <li class="all"><a href="<?php echo get_site_url()."/etat/votes_stat?phase=".$this->phase; ?>" target="_blank">Imprimer en pdf</a> </li>
        </ul>

    </div>
</div>