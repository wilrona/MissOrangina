<?php
/**
 * Created by PhpStorm.
 * User: ronal
 * Date: 18/09/2015
 * Time: 14:33
 */

require_once(ABSPATH . 'wp-admin/includes/template.php' );

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class List_View_Inscrit extends WP_List_Table{

    function __construct() {
        parent::__construct( array(
                'singular'=> 'Inscrit',
                'plural' => 'Inscrits',
                'ajax' => true,
                'screen' => null
            ) );
    }

    /**
     * [REQUIRED] this is a default column renderer
     *
     * @param $item - row (key, value array)
     * @param $column_name - string (key)
     * @return HTML
     */
    function column_default($item, $column_name)
    {
        return $item[$column_name];
    }

    function column_codeins($item)
    {
        $menu_page = menu_page_url(PREFIX_PLUGINS_NAME."_view_inscrit", false );
        $menu_page_tache_create = get_site_url()."/page/formulaire/";
        $actions = array(
            'create' => sprintf('<a href="' .$menu_page_tache_create. '%s" target="_blank">%s</a>',$item["codeins"], 'imprimer ' )
        );

        return sprintf('%s %s ',
            '<a href="'.$menu_page.'&id='.$item["id"].'">'.$item['codeins'].'</a>',
            $this->row_actions($actions)
        );
    }

    function column_nom($item)
    {

        return sprintf('%s',
            ''.$item['nom'].''
        );
    }

    function column_prenom($item)
    {

        return sprintf('%s',
            ''.$item['prenom'].''
        );
    }

    function column_dateNais($item)
    {
        list($annee, $mois, $jour) = split('[-.]', $item['dateNais']);
        $today['mois'] = date('n');
        $today['jour'] = date('j');
        $today['annee'] = date('Y');
        $annees = $today['annee'] - $annee;
        if ($today['mois'] <= $mois) {
            if ($mois == $today['mois']) {
                if ($jour > $today['jour'])
                    $annees--;
            }
            else
                $annees--;
        }

        return sprintf('%s',
            ''.$annees.' ans'
        );
    }


    function column_email($item)
    {

        return sprintf('%s',
            ''.$item['email'].''
        );
    }

    function column_phone($item)
    {

        return sprintf('%s',
            ''.$item['phone'].''
        );
    }

    function column_etape($item)
    {
        if($item['etape'] == 2){
            $passage = 'Est passée en quart de final';
        }
        elseif($item['etape'] <=1){
            $passage = 'Passe en quart de final';
            return sprintf('%s',
                '<a href="'.menu_page_url(PREFIX_PLUGINS_NAME."_add_to_phase", false ).'&id='.$item['id'].'">'.$passage.'</a>'
            );
        }elseif($item['etape'] > 2){
            if($item['etape'] == 3){
                $passage = 'Est passée en demi final';
            }
            if($item['etape'] == 4){
                $passage = 'Est passée en final';
            }
        }
        return sprintf('%s',
            ''.$passage.''
        );
    }

    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['id']
        );
    }

    function get_sortable_columns()
    {
        $sortable_columns = array(
            'cb' => array('cb', true),
            'codeins' => array('codeins', true),
            'nom' => array('nom', true),
            'prenom' => array('prenom', true),
            'dateNais' => array('dateNais', false),
            'email' => array('email', true),
            'phone' => array('phone', true)
        );
        global $wpdb;
        $table_phase = $wpdb->prefix. 'miss_phase';
        $phases = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_phase WHERE active = %d", 1), ARRAY_A);
        foreach ($phases as $phase) {
            if ($phase['etape'] >= 2) {
                $sortable_columns['passage'] = array('etape', true);
            }
        }
        return $sortable_columns;
    }

    /**
     * [REQUIRED] This method return columns to display in table
     * you can skip columns that you do not want to show
     * like content, or description
     *
     * @return array
     */
    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'codeins' => 'Code Inscription',
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'dateNais' => 'Age',
            'email' => 'Email',
            'phone' => 'Phone'
        );
        global $wpdb;
        $table_phase = $wpdb->prefix. 'miss_phase';
        $phases = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_phase WHERE active = %d", 1), ARRAY_A);
        foreach ($phases as $phase) {
            if($phase['etape'] >= 2){
                $columns['etape'] = 'Passage';
            }
        }
        return $columns;
    }

    function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    function process_bulk_action()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . 'miss_inscrit';
        $table_parrain = $wpdb->prefix . 'miss_parrain';

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            $used = false;
            if(is_array($ids)){
                $idIn = $ids;
                $ids = implode(',', $ids);
                foreach ($idIn as $id) {
                    $count_parrain = $wpdb->get_var("SELECT COUNT(*) FROM $table_parrain WHERE idcandidat IN ($id)");

                    if($count_parrain){
                        $used = true;
                        $wpdb->update($table_parrain, array('idcandidat' => null), array('idcandidat' => $id));
                    }

                }

            }else{
                $count_parrain = $wpdb->get_var("SELECT COUNT(*) FROM $table_parrain WHERE idcandidat IN ($ids)");

                if($count_parrain){
                    $used = true;
                    $wpdb->update($table_parrain, array('idcandidat' => null), array('idcandidat' => $ids));
                }
            }

//            if (is_array($ids)) $ids = implode(',', $ids);

            if(!empty($ids)) {
                $wpdb->query("DELETE FROM $table_name WHERE id IN($ids)");
            }
        }
    }

    function prepare_items($search = NULL, $filtre = NULL) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'miss_inscrit';

        $per_page = 25;

        $columns = self::get_columns();
        $hidden = array();
        $sortable = self::get_sortable_columns();

        // here we configure table headers, defined in our methods
        $this->_column_headers = array($columns, $hidden, $sortable);

        // [OPTIONAL] process bulk action if any
        $this->process_bulk_action();


        // prepare query params, as usual current page, order by and order direction
        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys(self::get_sortable_columns()))) ? $_REQUEST['orderby'] : 'id';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'asc';

        // [REQUIRED] define $items array
        // notice that last argument is ARRAY_A, so we will retrieve array


        if(!empty($search)){
            $search = trim($search);
            // will be used in pagination settings
            $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name WHERE codeins LIKE '%%".$search."%%' OR nom LIKE '%%".$search."%%' or prenom LIKE '%%".$search."%%'");
            $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE codeins LIKE '%%%s%%' OR nom LIKE '%%%s%%' or prenom LIKE '%%%s%%' ORDER BY $orderby $order LIMIT %d OFFSET %d", $search, $search, $search, $per_page, ($paged*$per_page)), ARRAY_A);

        }
//        elseif(($filtre == '0' || $filtre == '1') && !isset($search)){
////            $filtre = trim($filtre);
//            // will be used in pagination settings
//
//            $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name WHERE inscrit = ".$filtre."");
//            $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE  inscrit = %d ORDER BY $orderby $order LIMIT %d OFFSET %d", $filtre, $per_page, $paged), ARRAY_A);
//        }
//        elseif(!empty($search) && !empty($filtre)){
//            $search = trim($search);
//            $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name WHERE inscrit = ".$filtre." AND valeur LIKE '%".$search."%'");
//            $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE  inscrit = %d AND (codeins LIKE '%%%s%%' OR nom LIKE '%%%s%%' or prenom LIKE '%%%s%%') ORDER BY $orderby $order LIMIT %d OFFSET %d", $filtre, $search, $search, $search, $per_page, $paged), ARRAY_A);
//        }
        else{
            // will be used in pagination settings
            $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $table_name ");
            $this->items = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d", $per_page, ($paged*$per_page)), ARRAY_A);

        }

        // [REQUIRED] configure pagination
        self::set_pagination_args(array(
                'total_items' => $total_items, // total items defined above
                'per_page' => $per_page, // per page constant defined at top of method
                'total_pages' => ceil($total_items / $per_page) // calculate pages count
            ));
    }




}