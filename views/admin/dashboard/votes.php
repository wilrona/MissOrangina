<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 23/10/2015
 * Time: 16:37
 */
?>

<div id="activity-widget">
    <div id="published-posts" class="activity-block">
        <div style="border: 1px solid #eee;
    border-left: none;
    border-right: none; border-top: none">
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
    </div>
</div>